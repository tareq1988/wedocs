<?php
/**
 * Roots includes
 */
require_once locate_template( '/lib/utils.php' );           // Utility functions
require_once locate_template( '/lib/init.php' );            // Initial theme setup and constants
require_once locate_template( '/lib/wrapper.php' );         // Theme wrapper class
require_once locate_template( '/lib/sidebar.php' );         // Sidebar class
require_once locate_template( '/lib/config.php' );          // Configuration
require_once locate_template( '/lib/titles.php' );          // Page titles
require_once locate_template( '/lib/cleanup.php' );         // Cleanup
require_once locate_template( '/lib/nav.php' );             // Custom nav modifications
require_once locate_template( '/lib/relative-urls.php' );   // Root relative URLs
require_once locate_template( '/lib/widgets.php' );         // Sidebars and widgets
require_once locate_template( '/lib/scripts.php' );         // Scripts and stylesheets
require_once locate_template( '/lib/custom.php' );          // Custom functions
require_once locate_template( '/lib/customizer.php' );      // Theme customizer
require_once locate_template( '/lib/walker-docs.php' );      // Theme customizer


function wedocs_ajax_feedback() {
    check_ajax_referer( 'wedocs-ajax' );

    $template = '<div class="alert alert-%s">%s</div>';
    $previous = isset( $_COOKIE['wedocs_response'] ) ? explode( ',', $_COOKIE['wedocs_response'] ) : array();
    $post_id = intval( $_POST['post_id'] );
    $type = in_array( $_POST['type'], array( 'positive', 'negative' ) ) ? $_POST['type'] : false;

    // check previous response
    if ( in_array( $post_id, $previous ) ) {
        $message = sprintf( $template, 'danger', __( 'Sorry, you\'ve already recorded your feedback!', 'wedocs' ) );
        wp_send_json_error( $message );
    }

    // seems new
    if ( $type ) {
        $count = (int) get_post_meta( $post_id, $type, true );
        update_post_meta( $post_id, $type, $count + 1 );

        array_push( $previous, $post_id );
        $cookie_val = implode( ',',  $previous);

        $val = setcookie( 'wedocs_response', $cookie_val, time() + WEEK_IN_SECONDS, COOKIEPATH, COOKIE_DOMAIN );
    }

    $message = sprintf( $template, 'warning', __( 'Thanks for your feedback!', 'wedocs' ) );
    wp_send_json_success( $message );
    exit;
}

add_action( 'wp_ajax_wedocs_ajax_feedback', 'wedocs_ajax_feedback' );
add_action( 'wp_ajax_nopriv_wedocs_ajax_feedback', 'wedocs_ajax_feedback' );

function wedocs_register_post_type() {

    $labels = array(
        'name'                => _x( 'Docs', 'Post Type General Name', 'wedocs' ),
        'singular_name'       => _x( 'Docs', 'Post Type Singular Name', 'wedocs' ),
        'menu_name'           => __( 'Docs', 'wedocs' ),
        'name_admin_bar'      => __( 'Docs', 'wedocs' ),
        'parent_item_colon'   => __( 'Parent Doc:', 'wedocs' ),
        'all_items'           => __( 'All Docs', 'wedocs' ),
        'add_new_item'        => __( 'Add New Doc', 'wedocs' ),
        'add_new'             => __( 'Add New', 'wedocs' ),
        'new_item'            => __( 'New Doc', 'wedocs' ),
        'edit_item'           => __( 'Edit Doc', 'wedocs' ),
        'update_item'         => __( 'Update Doc', 'wedocs' ),
        'view_item'           => __( 'View Doc', 'wedocs' ),
        'search_items'        => __( 'Search Docs', 'wedocs' ),
        'not_found'           => __( 'Not found', 'wedocs' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'wedocs' ),
    );
    $args = array(
        'label'               => __( 'Doc', 'wedocs' ),
        'description'         => __( 'Post type for Documentation ', 'wedocs' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'page-attributes', 'custom-fields' ),
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 20,
        'menu_icon'           => 'dashicons-media-document',
        'show_in_admin_bar'   => true,
        'show_in_nav_menus'   => true,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
    );
    register_post_type( 'docs', $args );

}
add_action( 'init', 'wedocs_register_post_type', 0 );

function wedocs_docs_search_filter( $query ) {

    if ( ! is_admin() && is_search() && $query->is_main_query() ) {
        $param = isset( $_GET['search_param'] ) ? sanitize_text_field( $_GET['search_param'] ) : false;

        if ( $param ) {
            $query->set( 'post_type', 'docs' );

            if ( $param != 'all' ) {
                $parent_doc_id = intval( $param );
                $post__in      = array( $parent_doc_id => $parent_doc_id );
                $children_docs = wedocs_get_posts_children( $parent_doc_id, 'docs' );

                if ( $children_docs ) {
                    $post__in = array_merge( $post__in, wp_list_pluck( $children_docs, 'ID' ) );
                }

                $query->set( 'post__in', $post__in );
            }
        }
    }

    return $query;
}

add_filter( 'pre_get_posts', 'wedocs_docs_search_filter' );

if ( ! function_exists( 'wedocs_get_posts_children' ) ) :

function wedocs_get_posts_children( $parent_id, $post_type = 'page' ){
    $children = array();
    // grab the posts children
    $posts = get_posts( array( 'numberposts' => -1, 'post_status' => 'publish', 'post_type' => $post_type, 'post_parent' => $parent_id, 'suppress_filters' => false ));
    // now grab the grand children
    foreach( $posts as $child ){
        // recursion!! hurrah
        $gchildren = wedocs_get_posts_children( $child->ID, $post_type );
        // merge the grand children into the children array
        if ( !empty($gchildren) ) {
            $children = array_merge($children, $gchildren);
        }
    }
    // merge in the direct descendants we found earlier
    $children = array_merge($children,$posts);
    return $children;
}

endif;
