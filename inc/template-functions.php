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
