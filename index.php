<?php
global $allowedtags;

if ( $headline = get_theme_mod( 'wedocs_home_text' ) ) { ?>
    <div class="jumbotron">
        <h1><?php echo wp_kses( $headline, $allowedtags ); ?></h1>

        <?php if ( $tagline = get_theme_mod( 'wedocs_home_text_tag' ) ) { ?>
            <p><?php echo wp_kses( $tagline, $allowedtags ); ?></p>
        <?php } ?>
    </div>
<?php } ?>

<?php
$categories = get_terms( 'category', array('hide_empty' => false, 'orderby' => 'name', 'parent' => 0) );

if ( $categories ) {

    echo '<ul class="doc-category clearfix">';

    foreach ( $categories as $category ) {
        include 'templates/loop-category.php';
    }

    echo '</ul>';
}