<?php

//----------------------------------------------------
// Custom Header
//-----------------------------------------------------

function redxunlite_custom_header_setup() {
    $args = array(
        'default-image'      => get_template_directory_uri() . '/img/defaultbg.jpg',
        'default-text-color' => 'fff',
        'width'              => 1349,
        'flex-width'         => true,
        'flex-height'        => true,
        'wp-head-callback'   => 'redxunlite_header_style',
    );
    add_theme_support( 'custom-header', $args );
}
add_action( 'after_setup_theme', 'redxunlite_custom_header_setup' );

//----------------------------------------------------
// Custom Header Style
//-----------------------------------------------------
if ( ! function_exists( 'redxunlite_header_style' ) ) {
  function redxunlite_header_style() {
      $redxunlite_header_text_color = get_header_textcolor();
      if ( get_theme_support( 'custom-header', 'default-text-color' ) === $redxunlite_header_text_color ) {
        return;
      }

      ?>
    <style id="redxunlite-custom-header-styles" type="text/css">
      .blog-title, .blog-description, .blog-description a, .home .blog-title, .home .blog-title a {  color:#<?php echo esc_attr( $redxunlite_header_text_color ); ?>; }
      .separateline {background-color:#<?php echo esc_attr( $redxunlite_header_text_color ); ?>;}
      <?php if ( 'blank' === $redxunlite_header_text_color ) { ?>
        .home .blog-title, .home .blog-title a, .home .coverheadline .blog-description {display:none;}
      <?php } ?>
    </style>
  <?php
  }
}
