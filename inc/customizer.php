<?php
/**
 * Customizer settings for fastest_fj
 *
 * @package fastest_fj
 */

function fastest_fj_customize_register( $wp_customize ) {

    // Theme Options Panel
    $wp_customize->add_panel( 'fastest_fj_theme_options', array(
        'title'    => __( 'fastest_fj Options', 'fastest_fj' ),
        'priority' => 30,
    ) );

    // Hero Section
    $wp_customize->add_section( 'fastest_fj_hero', array(
        'title' => __( 'Hero Section', 'fastest_fj' ),
        'panel' => 'fastest_fj_theme_options',
    ) );

    $wp_customize->add_setting( 'fastest_fj_hero_bg', array(
        'sanitize_callback' => 'esc_url_raw',
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'fastest_fj_hero_bg', array(
        'label'   => __( 'Hero Background Image', 'fastest_fj' ),
        'section' => 'fastest_fj_hero',
    ) ) );

    $wp_customize->add_setting( 'fastest_fj_hero_subtitle', array(
        'default'           => __( 'Handcrafted With Love', 'fastest_fj' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'fastest_fj_hero_subtitle', array(
        'label'   => __( 'Subtitle', 'fastest_fj' ),
        'section' => 'fastest_fj_hero',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'fastest_fj_hero_title', array(
        'default'           => __( 'Discover Your Timeless Elegance', 'fastest_fj' ),
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'fastest_fj_hero_title', array(
        'label'   => __( 'Title', 'fastest_fj' ),
        'section' => 'fastest_fj_hero',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'fastest_fj_hero_desc', array(
        'default'           => __( 'Experience the artistry of handcrafted jewelry designed to illuminate your unique beauty.', 'fastest_fj' ),
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'fastest_fj_hero_desc', array(
        'label'   => __( 'Description', 'fastest_fj' ),
        'section' => 'fastest_fj_hero',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'fastest_fj_hero_btn1', array(
        'default'           => __( 'Shop Collection', 'fastest_fj' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'fastest_fj_hero_btn1', array(
        'label'   => __( 'Primary Button Text', 'fastest_fj' ),
        'section' => 'fastest_fj_hero',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'fastest_fj_hero_btn2', array(
        'default'           => __( 'Our Story', 'fastest_fj' ),
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'fastest_fj_hero_btn2', array(
        'label'   => __( 'Secondary Button Text', 'fastest_fj' ),
        'section' => 'fastest_fj_hero',
        'type'    => 'text',
    ) );

    // Promise Section
    $wp_customize->add_section( 'fastest_fj_promise', array(
        'title' => __( 'Our Promise', 'fastest_fj' ),
        'panel' => 'fastest_fj_theme_options',
    ) );

    for ( $i = 1; $i <= 3; $i++ ) {
        $wp_customize->add_setting( "fastest_fj_promise{$i}_title", array(
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( "fastest_fj_promise{$i}_title", array(
            'label'   => sprintf( __( 'Promise %d Title', 'fastest_fj' ), $i ),
            'section' => 'fastest_fj_promise',
            'type'    => 'text',
        ) );

        $wp_customize->add_setting( "fastest_fj_promise{$i}_desc", array(
            'sanitize_callback' => 'sanitize_textarea_field',
        ) );
        $wp_customize->add_control( "fastest_fj_promise{$i}_desc", array(
            'label'   => sprintf( __( 'Promise %d Description', 'fastest_fj' ), $i ),
            'section' => 'fastest_fj_promise',
            'type'    => 'textarea',
        ) );
    }

    // Contact Info
    $wp_customize->add_section( 'fastest_fj_contact', array(
        'title' => __( 'Contact Information', 'fastest_fj' ),
        'panel' => 'fastest_fj_theme_options',
    ) );

    $wp_customize->add_setting( 'fastest_fj_phone', array(
        'default'           => '1-800-123-4567',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'fastest_fj_phone', array(
        'label'   => __( 'Phone Number', 'fastest_fj' ),
        'section' => 'fastest_fj_contact',
        'type'    => 'text',
    ) );

    $wp_customize->add_setting( 'fastest_fj_email', array(
        'default'           => 'support@fastest_fj.com',
        'sanitize_callback' => 'sanitize_email',
    ) );
    $wp_customize->add_control( 'fastest_fj_email', array(
        'label'   => __( 'Email', 'fastest_fj' ),
        'section' => 'fastest_fj_contact',
        'type'    => 'email',
    ) );

    $wp_customize->add_setting( 'fastest_fj_address', array(
        'default'           => "123 Jewelry Lane, Fashion District\nNew York, NY 10001, USA",
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'fastest_fj_address', array(
        'label'   => __( 'Address', 'fastest_fj' ),
        'section' => 'fastest_fj_contact',
        'type'    => 'textarea',
    ) );

    $wp_customize->add_setting( 'fastest_fj_hours', array(
        'default'           => 'Mon - Sat: 10AM - 7PM EST',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'fastest_fj_hours', array(
        'label'   => __( 'Business Hours', 'fastest_fj' ),
        'section' => 'fastest_fj_contact',
        'type'    => 'text',
    ) );

    // Social Media
    $wp_customize->add_section( 'fastest_fj_social', array(
        'title' => __( 'Social Media', 'fastest_fj' ),
        'panel' => 'fastest_fj_theme_options',
    ) );

    $socials = array( 'facebook', 'instagram', 'pinterest', 'twitter', 'youtube' );
    foreach ( $socials as $social ) {
        $wp_customize->add_setting( "fastest_fj_social_{$social}", array(
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( "fastest_fj_social_{$social}", array(
            'label'   => ucfirst( $social ),
            'section' => 'fastest_fj_social',
            'type'    => 'url',
        ) );
    }
}
add_action( 'customize_register', 'fastest_fj_customize_register' );
