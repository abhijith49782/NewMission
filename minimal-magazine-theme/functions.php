<?php
/**
 * Minimal Magazine Theme Functions
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Theme Setup
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
    
    // Add image sizes
    add_image_size('post-thumbnail', 800, 400, true);
    add_image_size('large', 1200, 600, true);
    
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
    return 25;
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
 * Add custom classes to body
 */
function minimal_magazine_body_classes($classes) {
    if (is_singular()) {
        $classes[] = 'single-post';
    }
    
    if (is_home() || is_archive()) {
        $classes[] = 'blog-feed';
    }
    
    return $classes;
}
add_filter('body_class', 'minimal_magazine_body_classes');

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
    
    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'minimal_magazine_cleanup');

/**
 * Add custom image sizes to media library
 */
function minimal_magazine_custom_image_sizes($sizes) {
    return array_merge($sizes, array(
        'post-thumbnail' => __('Post Thumbnail', 'minimal-magazine'),
    ));
}
add_filter('image_size_names_choose', 'minimal_magazine_custom_image_sizes');

/**
 * Security: Remove WordPress version from admin footer
 */
function minimal_magazine_remove_version() {
    return '';
}
add_filter('the_generator', 'minimal_magazine_remove_version');

/**
 * Add theme customizer support
 */
function minimal_magazine_customize_register($wp_customize) {
    // Add section for theme options
    $wp_customize->add_section('minimal_magazine_options', array(
        'title' => __('Theme Options', 'minimal-magazine'),
        'priority' => 30,
    ));
    
    // Add setting for custom CSS
    $wp_customize->add_setting('minimal_magazine_custom_css', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('minimal_magazine_custom_css', array(
        'label' => __('Custom CSS', 'minimal-magazine'),
        'section' => 'minimal_magazine_options',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'minimal_magazine_customize_register');

/**
 * Output custom CSS from customizer
 */
function minimal_magazine_custom_css() {
    $custom_css = get_theme_mod('minimal_magazine_custom_css');
    if (!empty($custom_css)) {
        echo '<style type="text/css">' . $custom_css . '</style>';
    }
}
add_action('wp_head', 'minimal_magazine_custom_css');