<?php

/**
 * redxunlite Theme Customizer.
 *
 * @package redxunlite
 */
if ( class_exists( 'Kirki_Fonts_Google' ) ) {
    Kirki_Fonts_Google::$force_load_all_variants = true;
}
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function redxunlite_s_customize_register( $wp_customize )
{
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'refresh';
}

add_action( 'customize_register', 'redxunlite_s_customize_register' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function redxunlite_s_customize_preview_js()
{
    wp_enqueue_script(
        'redxunlite_s_customizer',
        get_template_directory_uri() . '/js/customizer.js',
        array( 'customize-preview' ),
        '20151215',
        true
    );
}

add_action( 'customize_preview_init', 'redxunlite_s_customize_preview_js' );
/**
 * Add the theme configuration
 */
redxunlite_s_Kirki::add_config( '_redxunlite_theme', array(
    'option_type' => 'theme_mod',
    'capability'  => 'edit_theme_options',
) );
redxunlite_s_Kirki::add_panel( 'mainthemepanel_redxun', array(
    'priority'    => 10,
    'title'       => __( 'Redxun Theme', 'redxunlite' ),
    'description' => __( 'Redxun Theme Options', 'redxunlite' ),
) );
//endifpremium
//-----------------------------------------------------
// SECTION: Logo & Menu
//-----------------------------------------------------
redxunlite_s_Kirki::add_section( 'sectionlogonav', array(
    'title'      => esc_attr__( 'Fixed Navigations', 'redxunlite' ),
    'priority'   => 2,
    'capability' => 'edit_theme_options',
    'panel'      => 'mainthemepanel_redxun',
) );

redxunlite_s_Kirki::add_field( '_redxunlite_theme', array(
    'type'        => 'checkbox',
    'settings'    => 'disablefixedsidenav_sectionlogonav',
    'label'       => __( 'Disable Fixed Side Nav', 'redxunlite' ),
    'description' => __( 'Appears on articles/archives as fixed side nav (older/newer posts & prev/next post).', 'redxunlite' ),
    'section'     => 'sectionlogonav',
    'priority'    => 10,
    'default'     => '0',
) );
redxunlite_s_Kirki::add_field( '_redxunlite_theme', array(
    'type'        => 'checkbox',
    'settings'    => 'disablefixedbottom_sectionlogonav',
    'label'       => __( 'Disable Fixed Bottom Nav', 'redxunlite' ),
    'description' => __( 'Appears on index/archives as fixed bottom nav (older/newer posts).', 'redxunlite' ),
    'section'     => 'sectionlogonav',
    'priority'    => 10,
    'default'     => '0',
) );

//-----------------------------------------------------
// SECTION: Home Intro
//-----------------------------------------------------
redxunlite_s_Kirki::add_section( 'sectionhomeintro', array(
    'title'      => __( 'Start Here', 'redxunlite' ),
    'priority'   => 1,
    'capability' => 'edit_theme_options',
    'panel'      => 'mainthemepanel_redxun',
) );


redxunlite_s_Kirki::add_field( '_redxunlite_theme', array(
    'type'     => 'custom',
    'settings' => 'guide_sectionhomeintro',
    'label'    => __( 'Short guide to get started', 'redxunlite' ),
    'section'  => 'sectionhomeintro',
    'priority' => 11,
    'default'  => __( '1. To add custom logo, home intro text & description, go back 2 levels and select Site Identity. 2. To set a default custom header and a header text color go back 2 levels and select Custom Header. 3. Go back one level for the rest of the settings.', 'redxunlite' ),
) );

redxunlite_s_Kirki::add_field( '_redxunlite_theme', array(
    'type'     => 'custom',
    'settings' => 'demo_sectionhomeintro',
    'section'  => 'sectionhomeintro',
    'priority' => 11,
    'default'     => '<a target="_blank" style="text-decoration:none;padding: 15px 20px;background-color: #8a53fb; text-align:center;color: #fff; border-radius: 50px;margin-top:10px;font-weight:400;display:inline-block;box-shadow:0 19px 38px rgba(0,0,0,.02), 0 15px 12px rgba(0,0,0,.07); font-size:14px;" href="https://www.wowthemes.net/themes/redxun/?utm_source=upsell-dashboard-redxunlite&utm_campaign=ViewFrom%20Redxun%20LiteCustomizer">' . esc_html__( 'Visit "Redxun" Pro with extra features', 'redxunlite' ) . '</a>',
) );

//-----------------------------------------------------
// SECTION: Custom BG Headers
//-----------------------------------------------------
redxunlite_s_Kirki::add_section( 'sectionbgheaders', array(
    'title'      => esc_attr__( 'Background Headers', 'redxunlite' ),
    'priority'   => 2,
    'capability' => 'edit_theme_options',
    'panel'      => 'mainthemepanel_redxun',
) );
redxunlite_s_Kirki::add_field( '_redxunlite_theme', array(
    'type'      => 'image',
    'settings'  => 'bg_sectionhomeintro',
    'label'     => __( 'Blog Home Intro Image', 'redxunlite' ),
    'section'   => 'sectionbgheaders',
    'priority'  => 10,
    'transport' => 'auto',
    'default'   => '',
) );
redxunlite_s_Kirki::add_field( '_redxunlite_theme', array(
    'type'        => 'image',
    'settings'    => 'bg_archiveheader',
    'label'       => __( 'Special Background Header', 'redxunlite' ),
    'description' => __( 'Archives, 404, Search Results.', 'redxunlite' ),
    'section'     => 'sectionbgheaders',
    'priority'    => 10,
    'transport'   => 'auto',
    'default'     => '',
) );
redxunlite_s_Kirki::add_field( '_redxunlite_theme', array(
    'type'     => 'custom',
    'settings' => 'note_sectionbgheaders',
    'label'       => __( 'Tip', 'redxunlite' ),
    'section'  => 'sectionbgheaders',
    'priority' => 11,
    'default'     => __( 'Need to set a default image header or to change the white title color? Go back 2 levels and select <i>Header Image</i>.', 'redxunlite' ),
) );


//-----------------------------------------------------
// SECTION: Layouts
//-----------------------------------------------------
redxunlite_s_Kirki::add_section( 'sectionlayouts', array(
    'title'      => esc_attr__( 'Layouts', 'redxunlite' ),
    'priority'   => 2,
    'capability' => 'edit_theme_options',
    'panel'      => 'mainthemepanel_redxun',
) );
redxunlite_s_Kirki::add_field( '_redxunlite_theme', array(
    'type'        => 'radio-image',
    'settings'    => 'index_layout',
    'label'       => __( 'Main Index Layout', 'redxunlite' ),
    'description' => __( 'Select layout for index and archive pages', 'redxunlite' ),
    'section'     => 'sectionlayouts',
    'default'     => 'nosidebar',
    'priority'    => 10,
    'choices'     => array(
    'rightsidebar' => get_template_directory_uri() . '/img/2.jpg',
    'nosidebar'    => get_template_directory_uri() . '/img/3.jpg',
),
) );
redxunlite_s_Kirki::add_field( '_redxunlite_theme', array(
    'type'        => 'radio-image',
    'settings'    => 'article_layout',
    'label'       => __( 'Article Layout', 'redxunlite' ),
    'section'     => 'sectionlayouts',
    'default'     => 'nosidebar',
    'priority'    => 10,
    'choices'     => array(
    'rightsidebar' => get_template_directory_uri() . '/img/2.jpg',
    'nosidebar'    => get_template_directory_uri() . '/img/3.jpg',
),
) );

//-----------------------------------------------------
// SECTION: Footer
//-----------------------------------------------------
redxunlite_s_Kirki::add_section( 'sectionfooter', array(
    'title'      => __( 'Footer', 'redxunlite' ),
    'priority'   => 2,
    'capability' => 'edit_theme_options',
    'panel'      => 'mainthemepanel_redxun',
) );
redxunlite_s_Kirki::add_field( '_redxunlite_theme', array(
    'type'     => 'textarea',
    'settings' => 'copyright_sectionfooter',
    'label'    => __( 'Footer Copyright', 'redxunlite' ),
    'section'  => 'sectionfooter',
    'priority' => 10,
) );
