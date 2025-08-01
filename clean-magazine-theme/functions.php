<?php
/**
 * Clean Magazine Theme Functions
 */

// Theme setup
function clean_magazine_setup() {
    // Add theme support for post thumbnails
    add_theme_support('post-thumbnails');
    
    // Add theme support for title tag
    add_theme_support('title-tag');
    
    // Add theme support for automatic feed links
    add_theme_support('automatic-feed-links');
    
    // Add theme support for HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    
    // Set post thumbnail size
    set_post_thumbnail_size(800, 400, true);
}
add_action('after_setup_theme', 'clean_magazine_setup');

// Enqueue styles and scripts
function clean_magazine_scripts() {
    wp_enqueue_style('clean-magazine-style', get_stylesheet_uri());
    
    // Enqueue jQuery for tag filtering
    wp_enqueue_script('jquery');
    
    // Enqueue custom JavaScript for tag filtering
    wp_enqueue_script('clean-magazine-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '1.0', true);
    
    // Localize script for AJAX
    wp_localize_script('clean-magazine-js', 'ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('filter_posts_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'clean_magazine_scripts');

// Get all tags for filter
function clean_magazine_get_all_tags() {
    $tags = get_tags(array(
        'hide_empty' => true,
        'number' => 20, // Limit to 20 most used tags
        'orderby' => 'count',
        'order' => 'DESC'
    ));
    return $tags;
}

// AJAX handler for filtering posts by tag
function clean_magazine_filter_posts() {
    // Verify nonce
    if (!wp_verify_nonce($_POST['nonce'], 'filter_posts_nonce')) {
        wp_die('Security check failed');
    }
    
    $tag_slug = sanitize_text_field($_POST['tag']);
    
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'paged' => 1
    );
    
    if (!empty($tag_slug)) {
        $args['tag'] = $tag_slug;
    }
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/post-item');
        }
    } else {
        echo '<p class="no-posts">No posts found for this tag.</p>';
    }
    
    wp_reset_postdata();
    wp_die();
}
add_action('wp_ajax_filter_posts', 'clean_magazine_filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'clean_magazine_filter_posts');

// Custom excerpt length
function clean_magazine_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'clean_magazine_excerpt_length');

// Custom excerpt more
function clean_magazine_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'clean_magazine_excerpt_more');

// Add custom body classes
function clean_magazine_body_classes($classes) {
    if (is_tag()) {
        $classes[] = 'tag-archive';
    }
    return $classes;
}
add_filter('body_class', 'clean_magazine_body_classes');
?>