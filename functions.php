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