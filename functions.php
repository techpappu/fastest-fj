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
function fastest_fj_scripts() {
    // Tailwind CSS CDN
    wp_enqueue_script( 'tailwindcss', 'https://cdn.tailwindcss.com', array(), null,false );

    // Font Awesome
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );

    // Google Fonts
    wp_enqueue_style( 'fastest_fj-fonts', 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Lato:wght@300;400;500;600;700&display=swap', array(), null );

    // Main stylesheet
    wp_enqueue_style( 'fastest_fj-style', get_stylesheet_uri(), array(), fastest_fj_VERSION );

    // Tailwind config
    wp_add_inline_script( 'tailwindcss', "
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            gold: '#C9A961',
                            orange: '#E8913A',
                            cream: '#FAF8F4',
                            dark: '#1E1E1E',
                            text: '#2D2D2D',
                            lightgray: '#F5F3EE'
                        }
                    },
                    fontFamily: {
                        serif: ['Playfair Display', 'serif'],
                        sans: ['Lato', 'sans-serif']
                    }
                }
            }
        }
    " );

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
 * WooCommerce Product Loop - Products per page
 */
function fastest_fj_products_per_page() {
    return 12;
}
add_filter( 'loop_shop_per_page', 'fastest_fj_products_per_page', 20 );

/**
 * WooCommerce Product Loop - Columns
 */
function fastest_fj_loop_columns() {
    return 4;
}
add_filter( 'loop_shop_columns', 'fastest_fj_loop_columns', 20 );

/**
 * WooCommerce Related Products
 */
function fastest_fj_related_products_args( $args ) {
    $args['posts_per_page'] = 4;
    $args['columns']        = 4;
    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'fastest_fj_related_products_args', 20 );

/**
 * WooCommerce Upsells
 */
function fastest_fj_upsell_display() {
    woocommerce_upsell_display( 4, 4 );
}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
add_action( 'woocommerce_after_single_product_summary', 'fastest_fj_upsell_display', 15 );

/**
 * WooCommerce Breadcrumb
 */
function fastest_fj_breadcrumb_args( $args ) {
    $args['delimiter']   = ' <i class=\"fas fa-chevron-right text-xs\"></i> ';
    $args['wrap_before'] = '<nav class=\"woocommerce-breadcrumb bg-brand-cream py-6\"><div class=\"container mx-auto px-4\">';
    $args['wrap_after']  = '</div></nav>';
    $args['before']      = '';
    $args['after']       = '';
    $args['home']        = __( 'Home', 'fastest_fj' );
    return $args;
}
add_filter( 'woocommerce_breadcrumb_defaults', 'fastest_fj_breadcrumb_args' );

/**
 * WooCommerce Product Thumbnail
 */
function fastest_fj_loop_product_thumbnail() {
    global $product;
    $image_size = 'fastest_fj-product-grid';
    $image_id   = $product->get_image_id();
    $image_html = wp_get_attachment_image( $image_id, $image_size, false, array(
        'class' => 'product-img w-full h-full object-cover transition duration-500',
    ) );
    echo '<div class="relative overflow-hidden rounded-lg bg-brand-cream aspect-[4/4] mb-3">';
    echo $image_html;
    // Sale badge
    if ( $product->is_on_sale() ) {
        echo '<div class="absolute top-3 left-3 bg-red-500 text-white text-xs px-2 py-1 rounded font-semibold">' . esc_html__( 'SALE', 'fastest_fj' ) . '</div>';
    }
    // New badge
    $created = strtotime( $product->get_date_created() );
    if ( ( time() - $created ) < 30 * DAY_IN_SECONDS ) {
        echo '<div class="absolute top-3 left-3 bg-brand-orange text-white text-xs px-2 py-1 rounded font-semibold">' . esc_html__( 'NEW', 'fastest_fj' ) . '</div>';
    }
    // Wishlist button
    echo '<button class="add-to-wishlist absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 transition shadow-sm" data-product-id="' . esc_attr( $product->get_id() ) . '"><i class="heart-icon far fa-heart"></i></button>';
    // Quick add overlay
    //echo '<div class="add-to-cart absolute bottom-0 left-0 right-0 p-3">';
    //echo '</div>';
    echo '</div>';
}
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'fastest_fj_loop_product_thumbnail', 10 );

/**
 * Product Title
 */
function fastest_fj_loop_product_title() {
    global $product;
    echo '<h3 class="font-serif text-sm sm:text-base font-semibold"><a href="' . esc_url( get_permalink( $product->get_id() ) ) . '" class="hover:text-brand-gold transition">' . esc_html( get_the_title() ) . '</a></h3>';
}
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
add_action( 'woocommerce_shop_loop_item_title', 'fastest_fj_loop_product_title', 10 );

/**
 * Product Price
 */
function fastest_fj_loop_price() {
    global $product;
    echo '<div class="flex items-center gap-2 mt-1">';
    echo '<span class="text-brand-orange font-bold text-sm sm:text-base">' . wp_kses_post( $product->get_price_html() ) . '</span>';
    echo '</div>';
}
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'fastest_fj_loop_price', 10 );

/**
 * Remove default add to cart from loop
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

/**
 * Custom Add to Cart Button for Loop
 */
function fastest_fj_loop_add_to_cart() {
    global $product;
    // echo '<div class="add-to-cart absolute bottom-0 left-0 right-0 p-3">';
    // echo '<a href="' . esc_url( $product->add_to_cart_url() ) . '" data-product_id="' . esc_attr( $product->get_id() ) . '" data-quantity="1" class="ajax_add_to_cart button w-full bg-brand-dark text-white py-2 rounded-full text-sm font-semibold hover:bg-brand-gold transition text-center block">' . esc_html( $product->add_to_cart_text() ) . '</a>';
    // echo '</div>';
}
add_action( 'woocommerce_after_shop_loop_item', 'fastest_fj_loop_add_to_cart', 10 );

/**
 * AJAX Add to Cart Handler
 */
function fastest_fj_ajax_add_to_cart() {
    check_ajax_referer( 'fastest_fj_nonce', 'nonce' );
    $product_id   = isset( $_POST['product_id'] ) ? intval( $_POST['product_id'] ) : 0;
    $quantity     = isset( $_POST['quantity'] ) ? intval( $_POST['quantity'] ) : 1;
    $variation_id = isset( $_POST['variation_id'] ) ? intval( $_POST['variation_id'] ) : 0;

    if ( $product_id > 0 ) {
        $added = WC()->cart->add_to_cart( $product_id, $quantity, $variation_id );
        if ( $added ) {
            wp_send_json_success( array(
                'message'     => __( 'Added to cart!', 'fastest_fj' ),
                'cart_count'  => WC()->cart->get_cart_contents_count(),
                'cart_total'  => WC()->cart->get_cart_total(),
                'fragments'   => apply_filters( 'woocommerce_add_to_cart_fragments', array() ),
            ) );
        }
    }
    wp_send_json_error( array( 'message' => __( 'Could not add to cart', 'fastest_fj' ) ) );
}
add_action( 'wp_ajax_fastest_fj_add_to_cart', 'fastest_fj_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_fastest_fj_add_to_cart', 'fastest_fj_ajax_add_to_cart' );

/**
 * AJAX Wishlist Toggle
 */
function fastest_fj_ajax_wishlist_toggle() {
    check_ajax_referer( 'fastest_fj_nonce', 'nonce' );
    $product_id = isset( $_POST['product_id'] ) ? intval( $_POST['product_id'] ) : 0;
    $user_id    = get_current_user_id();

    if ( ! $product_id ) {
        wp_send_json_error();
    }

    $wishlist = get_user_meta( $user_id, '_fastest_fj_wishlist', true );
    if ( ! is_array( $wishlist ) ) {
        $wishlist = array();
    }

    if ( in_array( $product_id, $wishlist ) ) {
        $wishlist = array_diff( $wishlist, array( $product_id ) );
        $status   = 'removed';
    } else {
        $wishlist[] = $product_id;
        $status     = 'added';
    }

    update_user_meta( $user_id, '_fastest_fj_wishlist', array_values( $wishlist ) );

    wp_send_json_success( array(
        'status' => $status,
        'count'  => count( $wishlist ),
    ) );
}
add_action( 'wp_ajax_fastest_fj_wishlist_toggle', 'fastest_fj_ajax_wishlist_toggle' );
add_action( 'wp_ajax_nopriv_fastest_fj_wishlist_toggle', 'fastest_fj_ajax_wishlist_toggle' );

/**
 * Get wishlist count
 */
function fastest_fj_get_wishlist_count() {
    if ( ! is_user_logged_in() ) {
        return 0;
    }
    $wishlist = get_user_meta( get_current_user_id(), '_fastest_fj_wishlist', true );
    return is_array( $wishlist ) ? count( $wishlist ) : 0;
}

/**
 * Check if product is in wishlist
 */
function fastest_fj_is_in_wishlist( $product_id ) {
    if ( ! is_user_logged_in() ) {
        return false;
    }
    $wishlist = get_user_meta( get_current_user_id(), '_fastest_fj_wishlist', true );
    return is_array( $wishlist ) && in_array( $product_id, $wishlist );
}

/**
 * Cart Fragments - Update header cart count
 */
function fastest_fj_cart_fragments( $fragments ) {
    $fragments['span.header-cart-count'] = '<span class="header-cart-count">' . esc_html( WC()->cart->get_cart_contents_count() ) . '</span>';
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'fastest_fj_cart_fragments' );



/**
 * Custom Single Product Summary
 */
function fastest_fj_single_product_summary() {
    global $product;
    ?>
    <div class="product-summary">
        <?php woocommerce_template_single_meta(); ?>

        <div class="flex items-center gap-2 mb-2 mt-4">
            <?php if ( $product->is_on_sale() ) : ?>
                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded font-semibold"><?php esc_html_e( 'SALE', 'fastest_fj' ); ?></span>
            <?php endif; ?>
            <?php if ( ( time() - strtotime( $product->get_date_created() ) ) < 30 * DAY_IN_SECONDS ) : ?>
                <span class="bg-brand-orange text-white text-xs px-2 py-1 rounded font-semibold"><?php esc_html_e( 'NEW', 'fastest_fj' ); ?></span>
            <?php endif; ?>
            <?php if ( $product->get_average_rating() > 0 ) : ?>
                <div class="flex text-yellow-400 text-xs">
                    <?php for ( $i = 1; $i <= 5; $i++ ) : ?>
                        <i class="fas fa-star<?php echo $i > $product->get_average_rating() ? '-half-alt' : ''; ?>"></i>
                    <?php endfor; ?>
                </div>
                <span class="text-gray-500 text-xs">(<?php echo esc_html( $product->get_review_count() ); ?> <?php esc_html_e( 'Reviews', 'fastest_fj' ); ?>)</span>
            <?php endif; ?>
        </div>

        <h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold mb-3"><?php the_title(); ?></h1>

        <?php if ( $product->get_short_description() ) : ?>
            <p class="text-gray-500 text-sm mb-4"><?php echo wp_kses_post( $product->get_short_description() ); ?></p>
        <?php endif; ?>

        <div class="flex items-center gap-3 mb-6">
            <span class="text-brand-orange font-bold text-2xl"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
            <?php if ( $product->is_on_sale() && $product->get_regular_price() ) : ?>
                <?php
                $saved = $product->get_regular_price() - $product->get_sale_price();
                if ( $saved > 0 ) :
                ?>
                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded font-semibold"><?php printf( __( 'Save %s', 'fastest_fj' ), wc_price( $saved ) ); ?></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="text-gray-600 text-sm leading-relaxed mb-6">
            <?php the_content(); ?>
        </div>

        <?php woocommerce_template_single_add_to_cart(); ?>

        <div class="space-y-2 text-sm text-gray-500 border-t border-gray-100 pt-4 mt-6">
            <p><span class="font-semibold text-brand-text"><?php esc_html_e( 'SKU:', 'fastest_fj' ); ?></span> <?php echo esc_html( $product->get_sku() ? $product->get_sku() : __( 'N/A', 'fastest_fj' ) ); ?></p>
            <p><span class="font-semibold text-brand-text"><?php esc_html_e( 'Category:', 'fastest_fj' ); ?></span> <?php echo wp_kses_post( wc_get_product_category_list( $product->get_id(), ', ', '', '' ) ); ?></p>
            <?php if ( wc_get_product_tag_list( $product->get_id() ) ) : ?>
                <p><span class="font-semibold text-brand-text"><?php esc_html_e( 'Tags:', 'fastest_fj' ); ?></span> <?php echo wp_kses_post( wc_get_product_tag_list( $product->get_id(), ', ' ) ); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <?php
}

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
