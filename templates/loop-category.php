<li class="category">
    <h3><a href="<?php echo get_term_link( $category ); ?>"><?php echo $category->name; ?></a></h3>

    <div class="inside">
        <?php if ( !empty( $category->description ) ) { ?>
            <?php echo $category->description; ?>
        <?php } ?>

        <?php
        $args = array(
            'hide_empty'       => false,
            'orderby'          => 'term_id',
            'child_of'         => $category->term_id,
            'title_li'         => '',
            'show_option_none' => ''
        );

        echo '<ul class="child-cats">';
        wp_list_categories( $args );
        echo '</ul>';

        /*
        $childrens = get_terms( 'category', $args );

        if ( $childrens ) {

            echo '<ul class="child-cats">';
            foreach ($childrens as $child) {
                // printf( '<li><a href="%s">%s</a></li>', get_term_link( $child ), $child->name );
            }
            echo '</ul>';
        }
        */
        ?>
    </div>
</li>