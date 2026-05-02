<?php

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
    return 5;
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
//remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
//add_action( 'woocommerce_after_single_product_summary', 'fastest_fj_upsell_display', 15 );

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

add_filter('woocommerce_checkout_fields', function ($fields) {

	// ===== Billing Fields =====
	// Keep only required ones
	$allowed = array(
		'billing_first_name',
		'billing_address_1',
		'billing_phone',
	);

	foreach ($fields['billing'] as $key => $field) {
		if (!in_array($key, $allowed)) {
			unset($fields['billing'][$key]);
		}
	}

	// ===== Remove all shipping fields =====
	unset($fields['shipping']);

	// ===== Remove order notes =====
	unset($fields['order']['order_comments']);

	// ===== Make sure required =====
	$fields['billing']['billing_first_name']['required'] = true;
	$fields['billing']['billing_address_1']['required'] = true;
	$fields['billing']['billing_phone']['required'] = true;


	/* Name field */
	$fields['billing']['billing_first_name']['label']       = 'নাম';
	$fields['billing']['billing_first_name']['placeholder'] = 'আপনার নাম লিখুন';
	$fields['billing']['billing_first_name']['priority']    = 10;

	/* Phone field */
	$fields['billing']['billing_phone']['label']       = 'মোবাইল নাম্বার';
	$fields['billing']['billing_phone']['placeholder'] = '+880 01xxx-xxxxxx';
	$fields['billing']['billing_phone']['required']    = true;
	$fields['billing']['billing_phone']['priority']    = 20;

	/* Address field */
	$fields['billing']['billing_address_1']['label']       = 'ঠিকানা';
	$fields['billing']['billing_address_1']['placeholder'] = 'থানা: রামপুর, জেলা: ঢাকা';
	//$fields['billing']['billing_address_1']['placeholder'] = 'ঈদের ৬–৭ দিনের পর ডেলিভারি করা হবে। সঠিক ঠিকানা লিখুন।';
	$fields['billing']['billing_address_1']['priority']    = 30;

	return $fields;
});

add_filter('gettext', 'bd_change_checkout_heading', 20, 3);
function bd_change_checkout_heading($translated, $text, $domain)
{
	if ($domain === 'woocommerce' && $text === 'Billing details') {
		return 'আপনার নাম, নাম্বার ও ঠিকানা দিন';
	}
	return $translated;
}

/**
 * Custom WooCommerce Pagination with Numbered Pages
 */
function fastest_fj_pagination() {
	if ( ! woocommerce_product_loop() ) {
		return;
	}

	$total   = wc_get_loop_prop( 'total_pages' );
	$current = wc_get_loop_prop( 'current_page' );

	if ( $total <= 1 ) {
		return;
	}

	?>
	<nav class="woocommerce-pagination py-8">
		<div class="flex items-center justify-center gap-2 flex-wrap">
			<?php
			// Previous button - Circular with only icon
			if ( $current > 1 ) {
				$prev_link = get_pagenum_link( $current - 1 );
				echo '<a href="' . esc_url( $prev_link ) . '" class="pagination-prev w-10 h-10 border border-gray-300 rounded-full flex items-center justify-center hover:bg-brand-gold hover:text-white hover:border-brand-gold transition"><i class="fas fa-chevron-left"></i></a>';
			} else {
				echo '<span class="pagination-prev w-10 h-10 border border-gray-200 rounded-full flex items-center justify-center text-gray-300 cursor-not-allowed"><i class="fas fa-chevron-left"></i></span>';
			}

			// Page numbers
			$range = 2; // Number of pages to show around current page
			$showitems = $range * 2 + 1;

			if ( $total > $showitems ) {
				// Show first page
				if ( $current > 1 ) {
					echo '<a href="' . esc_url( get_pagenum_link( 1 ) ) . '" class="page-number w-10 h-10 border border-gray-300 rounded-full flex items-center justify-center hover:bg-brand-gold hover:text-white hover:border-brand-gold transition text-sm font-semibold">1</a>';
				} else {
					echo '<span class="page-number page-number-current w-10 h-10 border border-brand-gold bg-brand-gold text-white rounded-full flex items-center justify-center text-sm font-semibold">1</span>';
				}

				// Ellipsis if needed
				if ( $current > $range + 2 ) {
					echo '<span class="page-number-ellipsis px-2 py-2 text-gray-500">...</span>';
				}

				// Show pages around current
				for ( $i = max( 2, $current - $range ); $i <= min( $total - 1, $current + $range ); $i++ ) {
					if ( $i === $current ) {
						echo '<span class="page-number page-number-current w-10 h-10 border border-brand-gold bg-brand-gold text-white rounded-full flex items-center justify-center text-sm font-semibold">' . esc_html( $i ) . '</span>';
					} else {
						echo '<a href="' . esc_url( get_pagenum_link( $i ) ) . '" class="page-number w-10 h-10 border border-gray-300 rounded-full flex items-center justify-center hover:bg-brand-gold hover:text-white hover:border-brand-gold transition text-sm font-semibold">' . esc_html( $i ) . '</a>';
					}
				}

				// Ellipsis if needed
				if ( $current < $total - $range - 1 ) {
					echo '<span class="page-number-ellipsis px-2 py-2 text-gray-500">...</span>';
				}

				// Show last page
				if ( $current !== $total ) {
					echo '<a href="' . esc_url( get_pagenum_link( $total ) ) . '" class="page-number w-10 h-10 border border-gray-300 rounded-full flex items-center justify-center hover:bg-brand-gold hover:text-white hover:border-brand-gold transition text-sm font-semibold">' . esc_html( $total ) . '</a>';
				}
			} else {
				// Show all pages if total is small
				for ( $i = 1; $i <= $total; $i++ ) {
					if ( $i === $current ) {
						echo '<span class="page-number page-number-current w-10 h-10 border border-brand-gold bg-brand-gold text-white rounded-full flex items-center justify-center text-sm font-semibold">' . esc_html( $i ) . '</span>';
					} else {
						echo '<a href="' . esc_url( get_pagenum_link( $i ) ) . '" class="page-number w-10 h-10 border border-gray-300 rounded-full flex items-center justify-center hover:bg-brand-gold hover:text-white hover:border-brand-gold transition text-sm font-semibold">' . esc_html( $i ) . '</a>';
					}
				}
			}

			// Next button - Circular with only icon
			if ( $current < $total ) {
				$next_link = get_pagenum_link( $current + 1 );
				echo '<a href="' . esc_url( $next_link ) . '" class="pagination-next w-10 h-10 border border-gray-300 rounded-full flex items-center justify-center hover:bg-brand-gold hover:text-white hover:border-brand-gold transition"><i class="fas fa-chevron-right"></i></a>';
			} else {
				echo '<span class="pagination-next w-10 h-10 border border-gray-200 rounded-full flex items-center justify-center text-gray-300 cursor-not-allowed"><i class="fas fa-chevron-right"></i></span>';
			}
			?>
		</div>
	</nav>
	<?php
}

// Remove default WooCommerce pagination and add custom pagination
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );
add_action( 'woocommerce_after_shop_loop', 'fastest_fj_pagination', 10 );

add_filter('woocommerce_order_button_text', function () {
	return '🛒 অর্ডার করুন';
});

/**
 * Ultra-light WooCommerce mode:
 * - Completely disables all WooCommerce emails
 * - Prevents PHPMailer from ever loading
 * - Blocks wp_mail() at the earliest possible point
 * - Zero background email queue
 * - Minimal CPU & memory usage
 */

// 1️⃣ Stop wp_mail BEFORE PHPMailer is initialized
add_filter('pre_wp_mail', '__return_true', 0);

// 2️⃣ Disable ALL WooCommerce email triggers at source
add_filter('woocommerce_email_enabled_new_order', '__return_false', 0);
add_filter('woocommerce_email_enabled_customer_processing_order', '__return_false', 0);
add_filter('woocommerce_email_enabled_customer_completed_order', '__return_false', 0);
add_filter('woocommerce_email_enabled_customer_invoice', '__return_false', 0);
add_filter('woocommerce_email_enabled_customer_note', '__return_false', 0);
add_filter('woocommerce_email_enabled_cancelled_order', '__return_false', 0);
add_filter('woocommerce_email_enabled_failed_order', '__return_false', 0);

// 3️⃣ Prevent WooCommerce background email queue entirely
add_filter('woocommerce_defer_transactional_emails', '__return_false', 0);

// 4️⃣ Extra safety: remove email actions if already registered
add_action('init', function () {
	if (class_exists('WC_Emails')) {
		remove_action('woocommerce_order_status_pending_to_processing', array(WC()->mailer(), 'send_transactional_email'));
		remove_action('woocommerce_order_status_pending_to_completed', array(WC()->mailer(), 'send_transactional_email'));
		remove_action('woocommerce_order_status_failed_to_processing', array(WC()->mailer(), 'send_transactional_email'));
		remove_action('woocommerce_order_status_failed_to_completed', array(WC()->mailer(), 'send_transactional_email'));
	}
}, 0);

//hide order number from thank you page but keep it in admin order list and email
add_filter( 'woocommerce_order_number', function( $order_number, $order ) {

    // Only affect Thank You (order received) page
    if ( is_order_received_page() ) {
        return '';
    }

    return $order_number;

}, 10, 2 );

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('wc-price-slider');
});