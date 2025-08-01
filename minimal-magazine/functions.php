<?php
/**
 * Minimal Magazine functions and definitions
 */

if ( ! function_exists( 'minimal_magazine_setup' ) ) :
  /**
   * Sets up theme defaults and registers support for various WordPress features.
   */
  function minimal_magazine_setup() {
    // Add featured image support.
    add_theme_support( 'post-thumbnails' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for HTML5 markup.
    add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption' ) );
  }
endif;
add_action( 'after_setup_theme', 'minimal_magazine_setup' );

/**
 * Enqueue scripts and styles.
 */
function minimal_magazine_scripts() {
  // Main stylesheet.
  wp_enqueue_style( 'minimal-magazine-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'minimal_magazine_scripts' );