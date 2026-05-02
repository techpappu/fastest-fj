<?php
/**
 * fastest_fj functions and definitions
 *
 * @package fastest_fj
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Theme version
define( 'fastest_fj_VERSION', '1.0.0' );

/**
 * Theme Setup
 */
function fastest_fj_setup() {
    // Add theme support
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 400,
        'single_image_width'    => 600,
        'product_grid'          => array(
            'default_rows'    => 3,
            'min_rows'        => 2,
            'max_rows'        => 8,
            'default_columns' => 3,
            'min_columns'     => 2,
            'max_columns'     => 4,
        ),
    ) );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 200,
        'flex-height' => true,
        'flex-width'  => true,
    ) );
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Register menus
    register_nav_menus( array(
        'primary'   => __( 'Primary Menu', 'fastest_fj' ),
        'mobile'    => __( 'Mobile Menu', 'fastest_fj' ),
        'footer-1'  => __( 'Footer Column 1', 'fastest_fj' ),
        'footer-2'  => __( 'Footer Column 2', 'fastest_fj' ),
        'footer-3'  => __( 'Footer Column 3', 'fastest_fj' ),
    ) );

    // Image sizes
    add_image_size( 'fastest_fj-product-grid', 400, 530, true );
    add_image_size( 'fastest_fj-product-single', 600, 750, true );
    add_image_size( 'fastest_fj-category', 600, 500, true );
    add_image_size( 'fastest_fj-blog', 800, 450, true );

    // Load text domain
    load_theme_textdomain( 'fastest_fj', get_template_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'fastest_fj_setup' );

/**
 * Enqueue Scripts and Styles
 */
function fastest_fj_asset_version( $relative_path ) {
    $path = get_template_directory() . $relative_path;

    return file_exists( $path ) ? filemtime( $path ) : fastest_fj_VERSION;
}

function fastest_fj_scripts() {
    // Tailwind CSS build
    wp_enqueue_style(
        'tailwindcss',
        get_template_directory_uri() . '/src/output.css',
        array(),
        fastest_fj_asset_version( '/src/output.css' ),
        'all'
    );

    // Font Awesome
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );

    // Google Fonts
    wp_enqueue_style( 'fastest_fj-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Lato:wght@300;400;500;600;700&display=swap', array(), null );

    // Main stylesheet
    wp_enqueue_style(
        'fastest_fj-style',
        get_stylesheet_uri(),
        array( 'tailwindcss' ),
        fastest_fj_asset_version( '/style.css' ),
        'all'
    );

    // Theme JS
    wp_enqueue_script( 'fastest_fj-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), fastest_fj_VERSION, true );

    // AJAX URL
    wp_localize_script( 'fastest_fj-main', 'fastest_fj_ajax', array(
        'ajax_url' => admin_url( 'admin-ajax.php' ),
        'nonce'    => wp_create_nonce( 'fastest_fj_nonce' ),
        'strings'  => array(
            'added_to_cart'   => __( 'Added to cart!', 'fastest_fj' ),
            'add_to_cart'     => __( 'Add to Cart', 'fastest_fj' ),
            'view_cart'       => __( 'View Cart', 'fastest_fj' ),
            'removed'         => __( 'Removed from wishlist', 'fastest_fj' ),
            'added_wishlist'  => __( 'Added to wishlist', 'fastest_fj' ),
        ),
    ) );

    // Wishlist JS
    wp_enqueue_script( 'fastest_fj-wishlist', get_template_directory_uri() . '/assets/js/wishlist.js', array( 'jquery' ), fastest_fj_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'fastest_fj_scripts' );

/**
 * WooCommerce Specific Scripts
 */
function fastest_fj_wc_scripts() {
    if ( class_exists( 'WooCommerce' ) ) {
        wp_enqueue_script( 'fastest_fj-wc', get_template_directory_uri() . '/assets/js/woocommerce.js', array( 'jquery', 'wc-add-to-cart' ), fastest_fj_VERSION, true );
    }
}
add_action( 'wp_enqueue_scripts', 'fastest_fj_wc_scripts', 20 );

/**
 * Admin Scripts
 */
function fastest_fj_admin_scripts( $hook ) {
    if ( 'post.php' === $hook || 'post-new.php' === $hook ) {
        wp_enqueue_style( 'fastest_fj-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), fastest_fj_VERSION );
    }
}
add_action( 'admin_enqueue_scripts', 'fastest_fj_admin_scripts' );

/**
 * Disable WooCommerce default styles
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
/**
 *  WooCommerce functions
 */
include_once 'wc-functions.php';

/**
 * Sidebars & Widgets
 */
function fastest_fj_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Shop Sidebar', 'fastest_fj' ),
        'id'            => 'shop-sidebar',
        'description'   => __( 'Add widgets here to appear in your shop sidebar.', 'fastest_fj' ),
        'before_widget' => '<div id="%1$s" class="widget mb-8 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-serif text-lg font-semibold mb-4">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'fastest_fj' ),
        'id'            => 'blog-sidebar',
        'description'   => __( 'Add widgets here to appear in your blog sidebar.', 'fastest_fj' ),
        'before_widget' => '<div id="%1$s" class="widget mb-8 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-serif text-lg font-semibold mb-4">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Top', 'fastest_fj' ),
        'id'            => 'footer-top',
        'description'   => __( 'Add widgets here for footer top section.', 'fastest_fj' ),
        'before_widget' => '<div class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="font-serif text-lg font-semibold mb-4 text-brand-gold">',
        'after_title'   => '</h4>',
    ) );
}
add_action( 'widgets_init', 'fastest_fj_widgets_init' );

/**
 * Custom Login/Register Redirect
 */
function fastest_fj_login_redirect( $redirect ) {
    return wc_get_page_permalink( 'myaccount' );
}
add_filter( 'woocommerce_login_redirect', 'fastest_fj_login_redirect' );

/**
 * Disable admin bar for non-admin users
 */
function fastest_fj_disable_admin_bar() {
    if ( ! current_user_can( 'administrator' ) && ! is_admin() ) {
        show_admin_bar( false );
    }
}
add_action( 'after_setup_theme', 'fastest_fj_disable_admin_bar' );

/**
 * Add body classes
 */
function fastest_fj_body_classes( $classes ) {
    if ( is_front_page() ) {
        $classes[] = 'front-page';
    }
    if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
        $classes[] = 'woocommerce-active';
    }
    return $classes;
}
add_filter( 'body_class', 'fastest_fj_body_classes' );

/**
 * Custom Excerpt Length
 */
function fastest_fj_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'fastest_fj_excerpt_length', 999 );

/**
 * Ensure cart fragments load
 */
function fastest_fj_ensure_cart_fragments() {
    wp_enqueue_script( 'wc-cart-fragments' );
}
add_action( 'wp_enqueue_scripts', 'fastest_fj_ensure_cart_fragments', 30 );

/**
 * Custom WooCommerce Form Field Arguments
 */
function fastest_fj_form_field_args( $args, $key, $value ) {
    $args['input_class'] = array( 'w-full', 'px-4', 'py-3', 'border', 'border-gray-200', 'rounded-lg', 'text-sm', 'focus:outline-none', 'focus:border-brand-gold', 'transition' );
    $args['label_class'] = array( 'text-sm', 'font-semibold', 'mb-1', 'block' );
    return $args;
}
add_filter( 'woocommerce_form_field_args', 'fastest_fj_form_field_args', 10, 3 );

/**
 * Add custom template body class for full-width pages
 */
function fastest_fj_page_template_body_class( $classes ) {
    if ( is_page_template( 'template-fullwidth.php' ) ) {
        $classes[] = 'full-width-page';
    }
    return $classes;
}
add_filter( 'body_class', 'fastest_fj_page_template_body_class' );

/**
 * Include required files
 */
require_once get_template_directory() . '/inc/template-functions.php';
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Plugin activation notice
 */
function fastest_fj_admin_notice() {
    if ( ! class_exists( 'WooCommerce' ) ) {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><?php esc_html_e( 'fastest_fj theme requires WooCommerce to be installed and activated for full functionality.', 'fastest_fj' ); ?></p>
        </div>
        <?php
    }
}
add_action( 'admin_notices', 'fastest_fj_admin_notice' );
