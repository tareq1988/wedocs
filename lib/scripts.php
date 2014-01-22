<?php
/**
 * Enqueue scripts and stylesheets
 *
 * Enqueue stylesheets in the following order:
 * 1. /theme/assets/css/main.min.css
 *
 * Enqueue scripts in the following order:
 * 1. jquery-1.10.2.min.js via Google CDN
 * 2. /theme/assets/js/vendor/modernizr-2.7.0.min.js
 * 3. /theme/assets/js/main.min.js (in footer)
 */
function wedevs_docs_scripts() {
    wp_enqueue_style('wedevs-docs-main', get_template_directory_uri() . '/assets/css/main.min.css', false );
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', false );

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.7.0.min.js', array(), null, false);
    wp_register_script('wedevs-docs-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), false, true);
    wp_enqueue_script('modernizr');
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-tooltip', get_template_directory_uri() . '/assets/js/plugins/bootstrap/tooltip.js', array(), false, true);
    wp_enqueue_script('bootstrap-scrollspy', get_template_directory_uri() . '/assets/js/plugins/bootstrap/scrollspy.js', array(), false, true);
    wp_enqueue_script('wedevs-docs-scripts');
}

add_action('wp_enqueue_scripts', 'wedevs_docs_scripts', 100);