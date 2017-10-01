<?php

/**
 * Functions and definitions
 *
 */

//-----------------------------------------------------
// Setups
//-----------------------------------------------------
if ( !function_exists( 'redxunlite_setup' ) ) {
    function redxunlite_setup()
    {
        if ( !isset( $content_width ) ) {
            $content_width = 640;
        }
        load_theme_textdomain( 'redxunlite', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'title-tag' );
        register_nav_menus( array(
            'primary'   => __( 'Primary Menu', 'redxunlite' ),
            'wtnfooter' => __( 'Footer Menu', 'redxunlite' ),
        ) );

        add_theme_support( 'html5', array(
            'comment-list',
            'search-form',
            'comment-form',
            'gallery'
        ) );
    }

}
add_action( 'after_setup_theme', 'redxunlite_setup' );


//----------------------------------------------------
// Conditional Pingback
//-----------------------------------------------------
function redxunlite_pingback_header() {
  if ( is_singular() && pings_open() ) {
  printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
  }
}
add_action( 'wp_head', 'redxunlite_pingback_header' );

//----------------------------------------------------
// Register Widgets
//-----------------------------------------------------

if ( !function_exists( 'redxunlite_widgets_init' ) ) {
    function redxunlite_widgets_init()
    {
        register_sidebar( array(
            'name'          => __( 'Sidebar', 'redxunlite' ),
            'id'            => 'sidebar-right',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget'  => '</aside>',
            'before_title'  => '<h1 class="widget-title"><span>',
            'after_title'   => '</span></h1>',
        ) );
    }
}
// _widgets_init
if ( get_theme_mod ( 'index_layout' ) == 'rightsidebar' ) {
  add_action( 'widgets_init', 'redxunlite_widgets_init' );
}

//-----------------------------------------------------
// Styles & Scripts
//-----------------------------------------------------
if ( !function_exists( 'redxunlite_scripts' ) ) {
    function redxunlite_scripts()
    {
        wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css' );
        wp_enqueue_style( 'bootstrap-css' );
        wp_register_style( 'font-awesome-css', get_template_directory_uri() . '/fontawesome/css/font-awesome.css' );
        wp_enqueue_style( 'font-awesome-css' );
        wp_enqueue_style( 'redxunlite-style', get_stylesheet_uri() );
        wp_enqueue_script(
            'bootstrap-js',
            get_template_directory_uri() . '/js/bootstrap.min.js',
            array( 'jquery' ),
            '1.0.0',
            true
        );
        wp_enqueue_script(
            'redxunlite-index',
            get_template_directory_uri() . '/js/main.js',
            array( 'jquery' ),
            '1.0.0',
            true
        );
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
            wp_enqueue_script( 'comment-reply' );
        }
    }

}
add_action( 'wp_enqueue_scripts', 'redxunlite_scripts' );

//-----------------------------------------------------
// Custom Logo
//-----------------------------------------------------
function redxunlite_custom_logo_setup() {
    $defaults = array(
        'height'      => 56,
        'width'       => 200,
        'flex-height' => false,
        'flex-width'  => true,
        'header-text' => array( 'site-title'),
    );
    add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'redxunlite_custom_logo_setup' );

//-----------------------------------------------------
// Add Roboto
//-----------------------------------------------------
function redxunlite_fonts() {
            wp_register_style('redxunlite-googleFonts', 'https://fonts.googleapis.com/css?family=Roboto:300italic,400italic,700italic,400,700,300');
            wp_enqueue_style( 'redxunlite-googleFonts');
        }
  add_action( 'wp_enqueue_scripts', 'redxunlite_fonts' );


//-----------------------------------------------------
// Require
//-----------------------------------------------------
include_once get_template_directory() . '/inc/custom-header.php';
require_once get_template_directory() . '/inc/template-tags.php';
include_once get_template_directory() . '/inc/options/include-kirki.php';
include_once get_template_directory() . '/inc/options/kirki-fallback.php';
include_once get_template_directory() . '/inc/options/customizer.php';



//-----------------------------------------------------
// Hello, World
//-----------------------------------------------------
if ( is_admin() && ! is_child_theme() ) {
	include_once get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
}
