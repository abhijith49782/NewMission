<?php
/**
 * Minimal Magazine Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme setup
 */
function minimal_magazine_setup() {
    // Add theme support for various features
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ));

    // Set content width
    if (!isset($content_width)) {
        $content_width = 800;
    }

    // Register navigation menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'minimal-magazine'),
    ));
}
add_action('after_setup_theme', 'minimal_magazine_setup');

/**
 * Enqueue scripts and styles
 */
function minimal_magazine_scripts() {
    wp_enqueue_style('minimal-magazine-style', get_stylesheet_uri(), array(), '1.0.0');
    
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'minimal_magazine_scripts');

/**
 * Custom excerpt length
 */
function minimal_magazine_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'minimal_magazine_excerpt_length');

/**
 * Custom excerpt more
 */
function minimal_magazine_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'minimal_magazine_excerpt_more');

/**
 * Add custom image sizes
 */
function minimal_magazine_image_sizes() {
    add_image_size('minimal-magazine-featured', 800, 400, true);
    add_image_size('minimal-magazine-thumbnail', 400, 200, true);
}
add_action('after_setup_theme', 'minimal_magazine_image_sizes');

/**
 * Customize the tag cloud widget
 */
function minimal_magazine_tag_cloud_args($args) {
    $args['largest'] = 1;
    $args['smallest'] = 0.8;
    $args['unit'] = 'em';
    return $args;
}
add_filter('widget_tag_cloud_args', 'minimal_magazine_tag_cloud_args');

/**
 * Add custom body classes
 */
function minimal_magazine_body_classes($classes) {
    if (is_single()) {
        $classes[] = 'single-post';
    }
    if (is_home()) {
        $classes[] = 'home-page';
    }
    return $classes;
}
add_filter('body_class', 'minimal_magazine_body_classes');

/**
 * Remove unnecessary WordPress features
 */
function minimal_magazine_cleanup() {
    // Remove emoji scripts
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    
    // Remove WordPress version
    remove_action('wp_head', 'wp_generator');
    
    // Remove wlwmanifest link
    remove_action('wp_head', 'wlwmanifest_link');
    
    // Remove RSD link
    remove_action('wp_head', 'rsd_link');
}
add_action('init', 'minimal_magazine_cleanup');