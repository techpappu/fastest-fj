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

    // Product loop buttons.
    $wp_customize->add_section( 'fastest_fj_product_buttons', array(
        'title'       => __( 'Product Card Buttons', 'fastest_fj' ),
        'description' => __( 'Choose what product cards do on WooCommerce archives and on product grids added to WordPress pages.', 'fastest_fj' ),
        'panel'       => 'fastest_fj_theme_options',
    ) );

    $button_choices = array(
        'buy_now'     => __( 'Buy Now (go to checkout)', 'fastest_fj' ),
        'add_to_cart' => __( 'Add to Cart', 'fastest_fj' ),
    );

    $wp_customize->add_setting( 'fastest_fj_archive_product_button', array(
        'default'           => 'buy_now',
        'sanitize_callback' => 'fastest_fj_sanitize_product_button',
    ) );
    $wp_customize->add_control( 'fastest_fj_archive_product_button', array(
        'label'       => __( 'Shop and category pages', 'fastest_fj' ),
        'description' => __( 'Applies to the Shop page, product categories, tags, and other product archives.', 'fastest_fj' ),
        'section'     => 'fastest_fj_product_buttons',
        'type'        => 'select',
        'choices'     => $button_choices,
    ) );

    $wp_customize->add_setting( 'fastest_fj_page_product_button', array(
        'default'           => 'buy_now',
        'sanitize_callback' => 'fastest_fj_sanitize_product_button',
    ) );
    $wp_customize->add_control( 'fastest_fj_page_product_button', array(
        'label'       => __( 'Product grids on WordPress pages', 'fastest_fj' ),
        'description' => __( 'Default for WooCommerce blocks, shortcodes, or template product loops displayed on a page.', 'fastest_fj' ),
        'section'     => 'fastest_fj_product_buttons',
        'type'        => 'select',
        'choices'     => $button_choices,
    ) );

    $page_choices = array_merge( array(
        'inherit' => __( 'Use page-grid default', 'fastest_fj' ),
    ), $button_choices );

    foreach ( get_pages( array( 'post_status' => 'publish' ) ) as $product_button_page ) {
        $setting_id = 'fastest_fj_page_product_button_' . $product_button_page->ID;
        $wp_customize->add_setting( $setting_id, array(
            'default'           => 'inherit',
            'sanitize_callback' => 'fastest_fj_sanitize_page_product_button',
        ) );
        $wp_customize->add_control( $setting_id, array(
            'label'   => sprintf( __( 'Page: %s', 'fastest_fj' ), $product_button_page->post_title ),
            'section' => 'fastest_fj_product_buttons',
            'type'    => 'select',
            'choices' => $page_choices,
        ) );
    }

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

    // Checkout Options
    $wp_customize->add_section( 'fastest_fj_checkout', array(
        'title' => __( 'Checkout Options', 'fastest_fj' ),
        'panel' => 'fastest_fj_theme_options',
    ) );

    $wp_customize->add_setting( 'fastest_fj_premium_box_enabled', array(
        'default'           => '1',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'fastest_fj_premium_box_enabled', array(
        'label'   => __( 'Show premium gift box option', 'fastest_fj' ),
        'section' => 'fastest_fj_checkout',
        'type'    => 'checkbox',
    ) );

    $wp_customize->add_setting( 'fastest_fj_premium_box_checked', array(
        'default'           => '1',
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'fastest_fj_premium_box_checked', array(
        'label'       => __( 'Check premium gift box by default', 'fastest_fj' ),
        'description' => __( 'When enabled, the premium box product is added automatically on checkout load.', 'fastest_fj' ),
        'section'     => 'fastest_fj_checkout',
        'type'        => 'checkbox',
    ) );

    $wp_customize->add_setting( 'fastest_fj_premium_box_product_id', array(
        'default'           => 184,
        'sanitize_callback' => 'absint',
    ) );
    $wp_customize->add_control( 'fastest_fj_premium_box_product_id', array(
        'label'       => __( 'Premium gift box product ID', 'fastest_fj' ),
        'description' => __( 'Enter the WooCommerce product ID used for the premium gift box add-on.', 'fastest_fj' ),
        'section'     => 'fastest_fj_checkout',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'step' => 1,
        ),
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

function fastest_fj_sanitize_product_button( $value ) {
    return in_array( $value, array( 'buy_now', 'add_to_cart' ), true ) ? $value : 'buy_now';
}

function fastest_fj_sanitize_page_product_button( $value ) {
    return in_array( $value, array( 'inherit', 'buy_now', 'add_to_cart' ), true ) ? $value : 'inherit';
}
