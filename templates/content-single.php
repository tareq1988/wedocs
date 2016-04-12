<?php while (have_posts()) : the_post(); ?>
    <?php $skip_sidebar = get_post_meta( $post->ID, 'skip_sidebar', true ); ?>

    <article <?php post_class( 'row' ); ?>>

        <div class="col-md-12">
            <div class="entry-content">
                <header>
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header>

                <?php the_content(); ?>
            </div>

            <?php

            if ( $skip_sidebar != 'yes' ) {

                $children = wp_list_pages("title_li=&order=menu_order&child_of=". $post->ID ."&echo=0&post_type=" . $post->post_type);

                if ( $children ) {
                    echo '<div class="article-child well">';
                    echo '<h3>' . __( 'Articles', 'wedocs' ) . '</h3>';
                    echo '<ul>';
                    echo $children;
                    echo '</ul>';
                    echo '</div>';
                }

                if ( function_exists( 'wedocs_doc_nav' ) ) {
                    wedocs_doc_nav();
                }

                if ( function_exists( 'wedocs_get_template_part' ) ) {
                    wedocs_get_template_part( 'content', 'feedback' );
                }
            }
            ?>

        </div><!-- .col-md-# -->
    </article>
<?php endwhile; ?>
