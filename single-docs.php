<?php
global $post;

$skip_sidebar = get_post_meta( $post->ID, 'skip_sidebar', true );
?>
<div class="row wedocs-single-wrap">

    <?php if ( $skip_sidebar != 'yes' ) { ?>
        <div class="col-sm-3">

            <aside class="widget doc-nav-widget">
                <?php
                $ancestors = array();
                $root      = $parent = false;
                // $ancestors = get_post_ancestors( $post->ID );
                // var_dump( $ancestors );
                if ( $post->post_parent ) {
                    $ancestors = get_post_ancestors($post->ID);
                    $root      = count($ancestors) - 1;
                    $parent    = $ancestors[$root];
                } else {
                    $parent = $post->ID;
                }

                // var_dump( $parent, $ancestors, $root );
                $walker = new WeDocs_Walker_Docs();
                $children = wp_list_pages( array(
                    'title_li'  => '',
                    'order'     => 'menu_order',
                    'child_of'  => $parent,
                    'echo'      => false,
                    'post_type' => 'docs',
                    'walker'    => $walker
                ) );
                ?>

                <h3 class="widget-title">
                    <?php echo get_post_field( 'post_title', $parent, 'display' ); ?>
                </h3>

                <?php if ($children) { ?>
                    <ul class="doc-nav-list list-unstyled">
                        <?php echo $children; ?>
                    </ul>
                <?php } ?>
            </aside>

        </div>
    <?php } ?>

    <div class="col-sm-<?php echo $skip_sidebar == 'yes' ? '12 skip-sidebar' : 9; ?> wedocs-single-content">
        <?php wedocs_breadcrumbs(); ?>
        <?php get_template_part('templates/content', 'single'); ?>
    </div>
</div>