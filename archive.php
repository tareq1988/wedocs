<?php
$parent_cat = get_queried_object();
$categories = get_terms( 'category', array('hide_empty' => false, 'orderby' => 'term_id', 'parent' => $parent_cat->term_id) );

if ( $categories ) {
    printf( '<h2 class="category-title">%s</h2>', $parent_cat->name );

    echo '<ul class="doc-category clearfix">';
    foreach ( $categories as $category ) {
        include 'templates/loop-category.php';
    }
    echo '</ul>';
}

// WP_Query arguments
$args = array(
    'post_type' => 'post',
    'category__in' => array( $parent_cat->term_id ),
    'posts_per_page' => -1,
    'order' => 'ASC',
    'orderby' => 'post_date'
);

// The Query
$doc_query = new WP_Query( $args );

// The Loop
if ( $doc_query->have_posts() ) {

    printf( '<h2 class="category-title">%s</h2>', __( 'Documents', 'wedevs-docs' ) );

    echo '<ul class="doc-category">';
    while ($doc_query->have_posts()) {
        $doc_query->the_post();

        get_template_part( 'templates/loop-content' );
    }
    echo '</ul>';
} else {
    // no posts found
}

// Restore original Post Data
wp_reset_postdata();
?>

<?php if ( !$categories && !$doc_query->have_posts() ) { ?>
    <div class="alert alert-warning">
        <?php _e( 'Nothing found!', 'wedevs-docs' ); ?>
    </div>
<?php } ?>