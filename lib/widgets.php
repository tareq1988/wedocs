<?php
/**
 * Register sidebars and widgets
 */
function wedevs_docs_widgets_init() {
    // Sidebars
    register_sidebar(array(
        'name'          => __('Primary', 'wedocs'),
        'id'            => 'sidebar-primary',
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('Footer 1', 'wedocs'),
        'id'            => 'sidebar-footer',
        'before_widget' => '<section class="widget col-md-3 %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}

add_action('widgets_init', 'wedevs_docs_widgets_init');