<?php while (have_posts()) : the_post(); ?>
    <article <?php post_class( 'row' ); ?>>

        <?php
            $content = get_the_content();
            $content = apply_filters( 'the_content', $content );
            $content = str_replace( ']]>', ']]&gt;', $content );

            preg_match_all( "/<h1>(.*?)<\/h1>/si", $content, $matches );
            list( $with_tags, $without_tags) = $matches;

            if ( $with_tags ) {
            ?>
            <div class="col-md-3 hidden-xs">
                <div class="bs-sidebar hidden-print affix">
                    <ul class="nav bs-sidenav">
                        <?php
                        foreach ($without_tags as $link_text) {
                            $slug = sanitize_title_with_dashes( $link_text );

                            printf('<li><a href="#%s"><i class="fa fa-chevron-right pull-right"></i> %s</a></li>', $slug, strip_tags( $link_text ) );
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <?php } ?>

            <div class="col-md-<?php echo $with_tags ? '9' : '12'; ?>">
                <div class="entry-content">
                    <header>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                    </header>
                    <?php
                    foreach ($without_tags as $link_text) {
                        $slug = sanitize_title_with_dashes( $link_text );
                        $replace = sprintf('<div class="spy-item" id="%s"></div>', $slug );
                        $replace = $replace . '<div class="page-header"><h3 class="section-title">' . $link_text . '</h3></div>';

                        $content = str_replace("<h1>$link_text</h1>", $replace, $content);
                    }

                    echo $content;
                    ?>
                </div>

                <?php get_template_part( 'templates/content', 'feedback' ); ?>

            </div><!-- .col-md-# -->
    </article>
<?php endwhile; ?>
