<?php
$categories = get_terms( 'category', array('hide_empty' => false, 'orderby' => 'name', 'parent' => 0) );

if ( $categories ) {

    echo '<ul class="doc-category clearfix">';

    foreach ( $categories as $category ) {
        include 'templates/loop-category.php';
    }

    echo '</ul>';
}