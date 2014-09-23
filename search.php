<?php
// The Loop
if ( have_posts() ) {

    printf( '<h2 class="category-title">%s</h2>', __( 'Documents', 'wedocs' ) );

    echo '<ul class="doc-category">';
    while (have_posts()) {
        the_post();

        get_template_part( 'templates/loop-content' );
    }
    echo '</ul>';
} else {
    ?>
    <div class="alert alert-warning">
        <?php _e( 'Nothing found!', 'wedocs' ); ?>
    </div>
    <?php
}
?>

<?php if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav class="post-nav">
        <ul class="pager">
            <li class="previous"><?php next_posts_link( __( '&larr; Older posts', 'wedocs' ) ); ?></li>
            <li class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'wedocs' ) ); ?></li>
        </ul>
    </nav>
<?php endif; ?>
