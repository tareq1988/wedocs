<?php

if ( ! class_exists( 'WeDocs_Walker_Docs' ) ) :

/**
 * weDocs Docs Walker
 */
class WeDocs_Walker_Docs extends Walker_Page {

    public static $parent_item = false;
    public static $parent_item_class = '';

    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class='children'>\n";

        if ( $args['has_children'] && $depth == 0 ) {
            $classes = array( 'page_item', 'page-item-' . self::$parent_item->ID );

            if ( self::$parent_item_class ) {
                $classes[] = self::$parent_item_class;
            }

            $output .= '<li class="' . implode( ' ', $classes ) . '"><a href="' . get_permalink( self::$parent_item ) . '">' . __( 'Introduction', 'wedocs' ) . '</a></li>';
        }
    }

    public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {

        if ( $depth == 0 ) {
            self::$parent_item = $page;
        }

        if ( $page->ID == $current_page ) {
            self::$parent_item_class = 'current_page_item';
        } else {
            self::$parent_item_class = '';
        }

        parent::start_el( $output, $page, $depth, $args, $current_page);
    }
}

endif;
