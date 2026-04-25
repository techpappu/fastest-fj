<?php
/**
 * Custom template functions for fastest_fj
 *
 * @package fastest_fj
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Reading time calculator
 */
function fastest_fj_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / 200 );
    return sprintf( __( '%d min read', 'fastest_fj' ), $reading_time );
}

/**
 * Newsletter subscribe handler
 */
function fastest_fj_handle_newsletter() {
    if ( ! isset( $_POST['newsletter_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['newsletter_nonce'] ) ), 'fastest_fj_newsletter' ) ) {
        wp_die( esc_html__( 'Security check failed', 'fastest_fj' ) );
    }

    $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';

    if ( ! is_email( $email ) ) {
        wp_safe_redirect( wp_get_referer() ? wp_get_referer() : home_url() );
        exit;
    }

    // Store subscriber (in production, use MailChimp, etc.)
    $subscribers = get_option( 'fastest_fj_newsletter_subscribers', array() );
    if ( ! in_array( $email, $subscribers ) ) {
        $subscribers[] = $email;
        update_option( 'fastest_fj_newsletter_subscribers', $subscribers );
    }

    wp_safe_redirect( add_query_arg( 'newsletter', 'success', wp_get_referer() ? wp_get_referer() : home_url() ) );
    exit;
}
add_action( 'admin_post_fastest_fj_newsletter', 'fastest_fj_handle_newsletter' );
add_action( 'admin_post_nopriv_fastest_fj_newsletter', 'fastest_fj_handle_newsletter' );

/**
 * AJAX Quick View
 */
function fastest_fj_ajax_quick_view() {
    check_ajax_referer( 'fastest_fj_nonce', 'nonce' );

    $product_id = isset( $_POST['product_id'] ) ? intval( $_POST['product_id'] ) : 0;
    if ( ! $product_id ) {
        wp_send_json_error();
    }

    $product = wc_get_product( $product_id );
    if ( ! $product ) {
        wp_send_json_error();
    }

    ob_start();
    ?>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="bg-brand-cream rounded-lg overflow-hidden">
            <?php echo wp_kses_post( $product->get_image( 'fastest_fj-product-grid', array( 'class' => 'w-full h-full object-cover' ) ) ); ?>
        </div>
        <div>
            <h2 class="font-serif text-2xl font-bold mb-2"><?php echo esc_html( $product->get_name() ); ?></h2>
            <p class="text-brand-orange font-bold text-xl mb-4"><?php echo wp_kses_post( $product->get_price_html() ); ?></p>
            <div class="text-gray-600 text-sm mb-6">
                <?php echo wp_kses_post( wp_trim_words( $product->get_short_description(), 30 ) ); ?>
            </div>
            <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" class="ajax_add_to_cart inline-block bg-brand-dark text-white px-8 py-3 rounded-full font-semibold hover:bg-brand-gold transition">
                <?php esc_html_e( 'Add to Cart', 'fastest_fj' ); ?>
            </a>
            <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="inline-block ml-3 text-brand-gold font-semibold hover:underline">
                <?php esc_html_e( 'View Details', 'fastest_fj' ); ?>
            </a>
        </div>
    </div>
    <?php
    $html = ob_get_clean();

    wp_send_json_success( array( 'html' => $html ) );
}
add_action( 'wp_ajax_fastest_fj_quick_view', 'fastest_fj_ajax_quick_view' );
add_action( 'wp_ajax_nopriv_fastest_fj_quick_view', 'fastest_fj_ajax_quick_view' );

/**
 * AJAX Newsletter Subscribe
 */
function fastest_fj_ajax_newsletter_subscribe() {
    check_ajax_referer( 'fastest_fj_nonce', 'nonce' );

    $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';

    if ( ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => __( 'Please enter a valid email address.', 'fastest_fj' ) ) );
    }

    $subscribers = get_option( 'fastest_fj_newsletter_subscribers', array() );
    if ( in_array( $email, $subscribers ) ) {
        wp_send_json_error( array( 'message' => __( 'You are already subscribed!', 'fastest_fj' ) ) );
    }

    $subscribers[] = $email;
    update_option( 'fastest_fj_newsletter_subscribers', $subscribers );

    wp_send_json_success( array( 'message' => __( 'Thank you for subscribing!', 'fastest_fj' ) ) );
}
add_action( 'wp_ajax_fastest_fj_newsletter_subscribe', 'fastest_fj_ajax_newsletter_subscribe' );
add_action( 'wp_ajax_nopriv_fastest_fj_newsletter_subscribe', 'fastest_fj_ajax_newsletter_subscribe' );

/**
 * Add custom meta boxes
 */
function fastest_fj_add_meta_boxes() {
    add_meta_box(
        'fastest_fj_product_banner',
        __( 'Homepage Banner', 'fastest_fj' ), 
        'fastest_fj_product_banner_callback',
        'product',
        'side',
        'low'
    );
}
// add_action( 'add_meta_boxes', 'fastest_fj_add_meta_boxes' );

/**
 * Remove WooCommerce wrappers
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
 * Add custom content wrapper
 */
add_action( 'woocommerce_before_main_content', function() {
    echo '<main id="primary" class="site-main">';
}, 10 );

add_action( 'woocommerce_after_main_content', function() {
    echo '</main>';
}, 10 );

/**
 * Remove default WooCommerce sidebar
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Add custom sidebar for shop
 */
add_action( 'woocommerce_before_shop_loop', function() {
    echo '<div class="container mx-auto px-4 py-10"><div class="flex flex-col lg:flex-row gap-10">';
    echo '<aside class="lg:w-64 flex-shrink-0">';
    if ( is_active_sidebar( 'shop-sidebar' ) ) {
        dynamic_sidebar( 'shop-sidebar' );
    } else {
        // Default sidebar content
        the_widget( 'WC_Widget_Product_Categories', array(
            'title' => __( 'Categories', 'fastest_fj' ),
        ) );
        the_widget( 'WC_Widget_Price_Filter', array(
            'title' => __( 'Price Range', 'fastest_fj' ),
        ) );
        the_widget( 'WC_Widget_Layered_Nav', array(
            'title'    => __( 'Material', 'fastest_fj' ),
            'attribute' => 'pa_material',
        ) );
    }
    echo '</aside>';
    echo '<div class="flex-1">';
}, 5 );

add_action( 'woocommerce_after_shop_loop', function() {
    echo '</div></div></div>';
}, 15 );

/**
 * Shop page header
 */
add_action( 'woocommerce_before_main_content', function() {
    if ( is_shop() || is_product_category() || is_product_tag() ) {
        $title = is_shop() ? woocommerce_page_title( false ) : single_term_title( '', false );
        ?>
        <section class="bg-brand-cream py-10">
            <div class="container mx-auto px-4 text-center">
                <h1 class="font-serif text-3xl sm:text-4xl font-bold mb-2"><?php echo esc_html( $title ); ?></h1>
                <?php
                if ( is_product_category() ) {
                    $description = term_description();
                    if ( $description ) {
                        echo '<p class="text-gray-600 text-sm max-w-xl mx-auto">' . wp_kses_post( $description ) . '</p>';
                    }
                }
                ?>
            </div>
        </section>
        <?php
    }
}, 15 );

/**
 * Single product layout
 */
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

// Add custom single product layout
add_action( 'woocommerce_before_single_product', function() {
    echo '<div class="container mx-auto px-4 py-10">';
}, 5 );

add_action( 'woocommerce_after_single_product', function() {
    echo '</div>';
}, 15 );

add_action( 'woocommerce_before_single_product_summary', 'fastest_fj_single_product_gallery', 20 );

add_action( 'woocommerce_single_product_summary', function() {
    global $product;
    ?>
    <div class="product-summary">
        <!-- Meta & Badges -->
        <div class="flex items-center gap-2 mb-2 flex-wrap">
            <?php if ( $product->is_on_sale() ) : ?>
                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded font-semibold"><?php esc_html_e( 'SALE', 'fastest_fj' ); ?></span>
            <?php endif; ?>
            <?php
            $created = strtotime( $product->get_date_created() );
            if ( ( time() - $created ) < 30 * DAY_IN_SECONDS ) :
            ?>
                <span class="bg-brand-orange text-white text-xs px-2 py-1 rounded font-semibold"><?php esc_html_e( 'NEW', 'fastest_fj' ); ?></span>
            <?php endif; ?>
            <?php if ( $product->get_average_rating() > 0 ) : ?>
                <div class="flex text-yellow-400 text-xs">
                    <?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
                </div>
                <span class="text-gray-500 text-xs">(<?php echo esc_html( $product->get_review_count() ); ?> <?php esc_html_e( 'Reviews', 'fastest_fj' ); ?>)</span>
            <?php endif; ?>
        </div>

        <!-- Title -->
        <?php woocommerce_template_single_title(); ?>

        <!-- Short Description -->
        <?php if ( $product->get_short_description() ) : ?>
            <p class="text-gray-500 text-sm mb-4"><?php echo wp_kses_post( $product->get_short_description() ); ?></p>
        <?php endif; ?>

        <!-- Price -->
        <div class="flex items-center gap-3 mb-6">
            <span class="text-brand-orange font-bold text-2xl"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
            <?php if ( $product->is_on_sale() && $product->get_regular_price() ) :
                $saved = floatval( $product->get_regular_price() ) - floatval( $product->get_sale_price() );
                if ( $saved > 0 ) : ?>
                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded font-semibold">
                    <?php printf( __( 'Save %s', 'fastest_fj' ), wc_price( $saved ) ); ?>
                </span>
            <?php endif; endif; ?>
        </div>

        <!-- Description -->
        <div class="text-gray-600 text-sm leading-relaxed mb-6">
            <?php the_content(); ?>
        </div>

        <!-- Add to Cart -->
        <?php woocommerce_template_single_add_to_cart(); ?>

        <!-- Product Meta -->
        <div class="space-y-2 text-sm text-gray-500 border-t border-gray-100 pt-4 mt-6">
            <p><span class="font-semibold text-brand-text"><?php esc_html_e( 'SKU:', 'fastest_fj' ); ?></span> <?php echo esc_html( $product->get_sku() ? $product->get_sku() : __( 'N/A', 'fastest_fj' ) ); ?></p>
            <p><span class="font-semibold text-brand-text"><?php esc_html_e( 'Category:', 'fastest_fj' ); ?></span> <?php echo wp_kses_post( wc_get_product_category_list( $product->get_id(), ', ' ) ); ?></p>
            <?php if ( wc_get_product_tag_list( $product->get_id() ) ) : ?>
                <p><span class="font-semibold text-brand-text"><?php esc_html_e( 'Tags:', 'fastest_fj' ); ?></span> <?php echo wp_kses_post( wc_get_product_tag_list( $product->get_id(), ', ' ) ); ?></p>
            <?php endif; ?>
            <p class="flex items-center gap-2 pt-2">
                <span class="font-semibold text-brand-text"><?php esc_html_e( 'Share:', 'fastest_fj' ); ?></span>
                <span class="flex gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="w-8 h-8 bg-brand-cream rounded-full flex items-center justify-center text-gray-500 hover:text-brand-gold transition"><i class="fab fa-facebook-f text-xs"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( get_permalink() ); ?>&text=<?php echo esc_attr( get_the_title() ); ?>" target="_blank" class="w-8 h-8 bg-brand-cream rounded-full flex items-center justify-center text-gray-500 hover:text-brand-gold transition"><i class="fab fa-twitter text-xs"></i></a>
                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url( get_permalink() ); ?>&media=<?php echo esc_url( get_the_post_thumbnail_url() ); ?>&description=<?php echo esc_attr( get_the_title() ); ?>" target="_blank" class="w-8 h-8 bg-brand-cream rounded-full flex items-center justify-center text-gray-500 hover:text-brand-gold transition"><i class="fab fa-pinterest-p text-xs"></i></a>
                </span>
            </p>
        </div>
    </div>
    <?php
}, 10 );

/**
 * Wrap single product in grid
 */
add_action( 'woocommerce_before_single_product_summary', function() {
    echo '<div class="grid grid-cols-1 lg:grid-cols-2 gap-10">';
}, 1 );

add_action( 'woocommerce_after_single_product_summary', function() {
    echo '</div>';
}, 5 );

/**
 * Single Product Gallery
 */
function fastest_fj_single_product_gallery() {
    global $product;
    $attachment_ids = $product->get_gallery_image_ids();
    $featured_id    = $product->get_image_id();
    if ( $featured_id ) {
        array_unshift( $attachment_ids, $featured_id );
    }
    ?>
    <div class="product-gallery">
        <div class="bg-brand-cream rounded-lg overflow-hidden mb-4 aspect-[4/5]">
            <?php
            if ( $featured_id ) {
                echo wp_get_attachment_image( $featured_id, 'fastest_fj-product-single', false, array(
                    'id'    => 'main-product-image',
                    'class' => 'w-full h-full object-cover',
                ) );
            }
            ?>
        </div>
        <?php if ( count( $attachment_ids ) > 1 ) : ?>
        <div class="grid grid-cols-4 gap-3">
            <?php foreach ( $attachment_ids as $index => $attachment_id ) : ?>
                <button class="thumbnail <?php echo $index === 0 ? 'active' : ''; ?> aspect-square rounded-lg overflow-hidden border-2 <?php echo $index === 0 ? 'border-brand-gold' : 'border-transparent'; ?> hover:border-brand-gold transition" data-image="<?php echo esc_url( wp_get_attachment_image_url( $attachment_id, 'fastest_fj-product-single' ) ); ?>">
                    <?php echo wp_get_attachment_image( $attachment_id, 'thumbnail', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
                </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * Contact Form Handler
 */
function fastest_fj_handle_contact_form() {
    if ( ! isset( $_POST['contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['contact_nonce'] ) ), 'fastest_fj_contact' ) ) {
        wp_die( esc_html__( 'Security check failed', 'fastest_fj' ) );
    }

    $first_name = isset( $_POST['first_name'] ) ? sanitize_text_field( wp_unslash( $_POST['first_name'] ) ) : '';
    $last_name  = isset( $_POST['last_name'] ) ? sanitize_text_field( wp_unslash( $_POST['last_name'] ) ) : '';
    $email      = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    $subject    = isset( $_POST['subject'] ) ? sanitize_text_field( wp_unslash( $_POST['subject'] ) ) : '';
    $message    = isset( $_POST['message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';

    if ( empty( $email ) || empty( $message ) ) {
        wp_safe_redirect( wp_get_referer() ? wp_get_referer() : home_url() );
        exit;
    }

    $to      = get_option( 'admin_email' );
    $headers = array( 'Content-Type: text/html; charset=UTF-8', 'From: ' . $first_name . ' ' . $last_name . ' <' . $email . '>' );
    $body    = '<p><strong>Name:</strong> ' . esc_html( $first_name . ' ' . $last_name ) . '</p>';
    $body   .= '<p><strong>Email:</strong> ' . esc_html( $email ) . '</p>';
    $body   .= '<p><strong>Subject:</strong> ' . esc_html( $subject ) . '</p>';
    $body   .= '<p><strong>Message:</strong><br>' . nl2br( esc_html( $message ) ) . '</p>';

    wp_mail( $to, '[' . get_bloginfo( 'name' ) . '] ' . $subject, $body, $headers );

    wp_safe_redirect( add_query_arg( 'contact', 'success', wp_get_referer() ? wp_get_referer() : home_url() ) );
    exit;
}
add_action( 'admin_post_fastest_fj_contact_form', 'fastest_fj_handle_contact_form' );
add_action( 'admin_post_nopriv_fastest_fj_contact_form', 'fastest_fj_handle_contact_form' );

/**
 * Cart page - remove coupon from default location
 */
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
