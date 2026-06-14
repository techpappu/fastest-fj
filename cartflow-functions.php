<?php
/**
 * Cartflow landing page helpers.
 *
 * @package fastest_fj
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function fastest_fj_cartflow_is_template() {
	return is_page_template( 'template-carflow.php' );
}

function fastest_fj_cartflow_defaults() {
	return array(
		'product_ids'        => '',
		'default_product_id' => '',
		'hero_title'         => 'আপনার পছন্দের প্যাকেজটি সিলেক্ট করুন',
		'hero_subtitle'      => 'বেশি সাশ্রয় ও দীর্ঘমেয়াদী ব্যবহারের জন্য বড় প্যাকেজ বেছে নিন',
		'show_alert'         => '1',
		'alert_text'         => '🔥 বেশি সাশ্রয় ও দীর্ঘমেয়াদী ব্যবহারের জন্য বড় প্যাকেজ বেছে নিন',
		'phone_number'       => '০১৭১২-৩৪৫৬৭৮',
		'show_scarcity'      => '1',
		'scarcity_title'     => '⚡ আজকের বিশেষ অফার - সীমিত সময়ের জন্য',
		'scarcity_desc'      => 'আজ অর্ডার করলে পাবেন <strong>ফ্রি ডেলিভারি</strong> এবং <strong>১০% অতিরিক্ত ছাড়</strong>',
		'selector_title'     => 'আপনার পছন্দের প্যাকেজটি সিলেক্ট করুন',
		'selector_alert'     => 'বেশি সাশ্রয় ও দীর্ঘমেয়াদী ব্যবহারের জন্য বড় প্যাকেজ বেছে নিন',
		'benefits_title'     => 'কেন আমাদের থেকে কিনবেন?',
		'testimonials_title' => 'আমাদের গ্রাহকরা যা বলছেন',
		'faq_title'          => 'সাধারণ জিজ্ঞাসা',
		'guarantee_title'    => '১০০% সন্তুষ্টি গ্যারান্টি',
		'guarantee_desc'     => 'আমরা আমাদের পণ্যের গুণগত মান নিয়ে পুরোপুরি নিশ্চিত। যদি কোনো কারণে আপনি সন্তুষ্ট না হন, ৭ দিনের মধ্যে ফেরত দিন।',
		'final_cta_title'    => 'আজই অর্ডার করুন - সীমিত স্টক!',
		'final_cta_desc'     => 'সারাদেশে ক্যাশ অন ডেলিভারি। পণ্য হাতে পেয়ে মূল্য পরিশোধ করুন।',
		'cta_button'         => 'অর্ডার করুন',
		'show_sticky'        => '1',
		'sticky_bar'         => '☎️ যেকোনো প্রয়োজনে কল করুন: ০১৭১২-৩৪৫৬৭৮',
		'footer_text'        => '',
		'badges'             => "fa-shield-alt|মূল পণ্য|১০০% অরিজিনাল\nfa-truck|ফ্রি ডেলিভারি|ঢাকায় ২৪ ঘণ্টা\nfa-money-bill|ক্যাশ অন ডেলিভারি|হাতে পেয়ে টাকা দিন\nfa-undo|৭ দিন রিটার্ন|সহজ ফেরত নীতি",
		'benefits'           => "fa-gem|প্রিমিয়াম কোয়ালিটি|সেরা উপাদান দিয়ে তৈরি প্রতিটি পণ্য\nfa-hand-holding-usd|সেরা দামে|মার্কেটের সেরা দামে উন্নত মান\nfa-shipping-fast|দ্রুত ডেলিভারি|সর্বোচ্চ ২৪-৪৮ ঘণ্টায় ডেলিভারি\nfa-headset|২৪/৭ সাপোর্ট|আমাদের টিম সবসময় আপনার পাশে",
		'testimonials'       => "রাহিনা বেগম|ঢাকা|5|পণ্যের গুণগত মান অসাধারণ! দ্রুত ডেলিভারি পেয়েছি। আবার অর্ডার করব ইনশাআল্লাহ।\nকামরুল হাসান|চট্টগ্রাম|5|৩০ পিসের প্যাকেজটি নিয়েছিলাম। দারুণ সাশ্রয় হচ্ছে। সবাইকে রিকমেন্ড করব।\nফাতেমা আক্তার|রাজশাহী|5|কাস্টমার সার্ভিস খুব ভালো। পণ্য হাতে পেয়ে টাকা দিয়েছি। পুরোপুরি নিরাপদ।",
		'faqs'               => "ডেলিভারি কতদিনে পাবো?|ঢাকায় ১-২ দিন এবং ঢাকার বাইরে ৩-৫ কার্যদিবসের মধ্যে ডেলিভারি দেওয়া হয়।\nক্যাশ অন ডেলিভারি কি পাবো?|হ্যাঁ, আপনি পণ্য হাতে পেয়ে মূল্য পরিশোধ করতে পারবেন।\nপণ্য ভালো না লাগলে ফেরত দিতে পারবো?|অবশ্যই! ৭ দিনের মধ্যে ব্যবহার না করা পণ্য ফেরত দিতে পারবেন।\nআপনাদের হেল্পলাইন নম্বর কত?|আমাদের হেল্পলাইনে সকাল ১০টা - রাত ৮টা পর্যন্ত যোগাযোগ করতে পারবেন।",
	);
}

function fastest_fj_cartflow_meta_key( $key ) {
	return '_fastest_fj_cartflow_' . $key;
}

function fastest_fj_cartflow_get( $key, $post_id = 0 ) {
	$defaults = fastest_fj_cartflow_defaults();
	$post_id  = $post_id ? absint( $post_id ) : get_the_ID();
	$value    = $post_id ? get_post_meta( $post_id, fastest_fj_cartflow_meta_key( $key ), true ) : '';

	return '' === $value && isset( $defaults[ $key ] ) ? $defaults[ $key ] : $value;
}

function fastest_fj_cartflow_parse_lines( $value, $keys ) {
	$items = array();
	$rows  = preg_split( '/\r\n|\r|\n/', (string) $value );

	foreach ( $rows as $row ) {
		$row = trim( $row );
		if ( '' === $row ) {
			continue;
		}

		$parts = array_map( 'trim', explode( '|', $row ) );
		$item  = array();
		foreach ( $keys as $index => $key ) {
			$item[ $key ] = $parts[ $index ] ?? '';
		}
		$items[] = $item;
	}

	return $items;
}

function fastest_fj_cartflow_product_ids( $post_id = 0 ) {
	$ids = fastest_fj_cartflow_get( 'product_ids', $post_id );

	return array_filter( array_map( 'absint', explode( ',', $ids ) ) );
}

function fastest_fj_cartflow_default_product_id( $product_ids = array(), $post_id = 0 ) {
	$default_id = absint( fastest_fj_cartflow_get( 'default_product_id', $post_id ) );

	if ( $default_id && in_array( $default_id, $product_ids, true ) ) {
		return $default_id;
	}

	return empty( $product_ids ) ? 0 : absint( reset( $product_ids ) );
}

function fastest_fj_cartflow_placeholder_img() {
	if ( function_exists( 'wc_placeholder_img_src' ) ) {
		return wc_placeholder_img_src( 'thumbnail' );
	}

	$svg = '<svg xmlns="http://www.w3.org/2000/svg" width="300" height="300" viewBox="0 0 300 300"><rect width="300" height="300" fill="#FAF8F4"/><circle cx="150" cy="120" r="46" fill="#C9A961"/><path d="M73 233c20-45 52-68 77-68s57 23 77 68" fill="#E8913A"/><text x="150" y="268" text-anchor="middle" font-family="Arial" font-size="18" fill="#2D2D2D">Package</text></svg>';

	return 'data:image/svg+xml;charset=UTF-8,' . rawurlencode( $svg );
}

function fastest_fj_cartflow_dummy_products() {
	$image = fastest_fj_cartflow_placeholder_img();

	return array(
		array(
			'id'      => 0,
			'name'    => __( '20 Pcs Golden Package', 'fastest_fj' ),
			'slogan'  => __( 'Best value package', 'fastest_fj' ),
			'price'   => '1,850',
			'image'   => $image,
			'checked' => false,
		),
		array(
			'id'      => 0,
			'name'    => __( '10 Pcs Starter Package', 'fastest_fj' ),
			'slogan'  => __( 'Most popular choice', 'fastest_fj' ),
			'price'   => '1,250',
			'image'   => $image,
			'checked' => true,
		),
		array(
			'id'      => 0,
			'name'    => __( '5 Pcs Trial Package', 'fastest_fj' ),
			'slogan'  => __( 'Easy first order', 'fastest_fj' ),
			'price'   => '750',
			'image'   => $image,
			'checked' => false,
		),
		array(
			'id'      => 0,
			'name'    => __( '3 Pcs Mini Package', 'fastest_fj' ),
			'slogan'  => __( 'Small and simple', 'fastest_fj' ),
			'price'   => '590',
			'image'   => $image,
			'checked' => false,
		),
	);
}

function fastest_fj_cartflow_sync_cart( $product_id ) {
	if ( ! class_exists( 'WooCommerce' ) || ! WC()->cart || ! $product_id ) {
		return false;
	}

	$product = wc_get_product( $product_id );
	if ( ! $product || ! $product->is_purchasable() ) {
		return false;
	}	
	$premium_box_product_id = fastest_fj_premium_box_enabled() ? fastest_fj_premium_box_product_id() : 0;
	$cart_item_key          = '';

	foreach ( WC()->cart->get_cart() as $key => $cart_item ) {
		$cart_product_id = absint( $cart_item['product_id'] );

		if ( $premium_box_product_id && $cart_product_id === $premium_box_product_id ) {
			continue;
		}

		if ( $cart_product_id === absint( $product_id ) ) {
			$cart_item_key = $key;
			WC()->cart->set_quantity( $key, 1, false );
			continue;
		}

		WC()->cart->remove_cart_item( $key );
	}

	if ( ! $cart_item_key ) {
		$cart_item_key = WC()->cart->add_to_cart( $product_id, 1 );
	}

	if ( ! $cart_item_key ) {
		return false;
	}

	WC()->cart->calculate_totals();

	if ( WC()->session ) {
		WC()->session->set_customer_session_cookie( true );
		WC()->cart->set_session();
	}

	return true;
}

function fastest_fj_cartflow_ensure_default_cart( $default_id, $product_ids ) {
	if ( is_admin() || wp_doing_ajax() || ! class_exists( 'WooCommerce' ) || ! WC()->cart || ! $default_id ) {
		return;
	}

	if ( ! in_array( absint( $default_id ), $product_ids, true ) ) {
		return;
	}

	fastest_fj_cartflow_sync_cart( $default_id );
}

function fastest_fj_cartflow_checkout_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'default-product' => '',
			'ids'             => '',
			'page-id'         => '',
		),
		$atts,
		'cartflow-custom'
	);

	$post_id     = absint( $atts['page-id'] ) ? absint( $atts['page-id'] ) : get_the_ID();
	$product_ids = array_filter( array_map( 'absint', explode( ',', $atts['ids'] ) ) );
	if ( empty( $product_ids ) ) {
		$product_ids = fastest_fj_cartflow_product_ids( $post_id );
	}

	$default_id = absint( $atts['default-product'] );
	if ( ! $default_id ) {
		$default_id = fastest_fj_cartflow_default_product_id( $product_ids, $post_id );
	}

	if ( class_exists( 'WooCommerce' ) && ! empty( $product_ids ) ) {
		$product_ids = array_values(
			array_filter(
				$product_ids,
				function ( $product_id ) {
					$product = wc_get_product( $product_id );

					return $product && $product->is_purchasable();
				}
			)
		);

		if ( ! in_array( $default_id, $product_ids, true ) ) {
			$default_id = empty( $product_ids ) ? 0 : absint( reset( $product_ids ) );
		}
	}

	ob_start();
	?>
	<div class="order-form fastest-cartflow-order-form" data-default="<?php echo esc_attr( $default_id ); ?>" data-ids="<?php echo esc_attr( implode( ',', $product_ids ) ); ?>">
		<h2 class="form-title"><?php echo esc_html( fastest_fj_cartflow_get( 'selector_title', $post_id ) ); ?></h2>
		<?php if ( fastest_fj_cartflow_get( 'selector_alert', $post_id ) ) : ?>
			<p class="fastest-cartflow-alert" role="alert">
				<span aria-hidden="true">🔥</span>
				<span><?php echo esc_html( fastest_fj_cartflow_get( 'selector_alert', $post_id ) ); ?></span>
			</p>
		<?php endif; ?>

		<div class="checkout-wrapper">
			<div class="checkout-product-selector" aria-label="<?php esc_attr_e( 'Choose package', 'fastest_fj' ); ?>">
				<?php
				if ( class_exists( 'WooCommerce' ) && ! empty( $product_ids ) ) :
					fastest_fj_cartflow_ensure_default_cart( $default_id, $product_ids );
					foreach ( $product_ids as $pid ) :
						$product = wc_get_product( $pid );
						if ( ! $product ) {
							continue;
						}

						$slogan = $product->get_meta( '_product_slogan' );
						$price  = $product->get_sale_price() ? $product->get_sale_price() : $product->get_regular_price();
						?>
						<label class="cartflow-package-card <?php echo $pid === $default_id ? 'is-selected' : ''; ?>">
							<input type="radio" name="checkout_product" value="<?php echo esc_attr( $pid ); ?>" <?php checked( $pid, $default_id ); ?>>
							<span class="cartflow-package-radio" aria-hidden="true"></span>
							<span class="cartflow-package-image"><?php echo wp_kses_post( $product->get_image( 'thumbnail' ) ); ?></span>
							<span class="cartflow-package-content">
								<strong><?php echo esc_html( $product->get_name() ); ?></strong>
								<small><?php echo esc_html( $slogan ? $slogan : __( 'Premium package', 'fastest_fj' ) ); ?></small>
							</span>
							<span class="cartflow-package-price"><?php echo wp_kses_post( wc_price( $price ) ); ?></span>
						</label>
						<?php
					endforeach;
				else :
					foreach ( fastest_fj_cartflow_dummy_products() as $dummy ) :
						?>
						<label class="cartflow-package-card <?php echo $dummy['checked'] ? 'is-dummy-selected' : ''; ?>">
							<input type="radio" name="checkout_product_dummy" disabled <?php checked( $dummy['checked'] ); ?>>
							<span class="cartflow-package-radio" aria-hidden="true"></span>
							<span class="cartflow-package-image"><img src="<?php echo esc_url( $dummy['image'] ); ?>" alt=""></span>
							<span class="cartflow-package-content">
								<strong><?php echo esc_html( $dummy['name'] ); ?></strong>
								<small><?php echo esc_html( $dummy['slogan'] ); ?></small>
							</span>
							<span class="cartflow-package-price"><?php echo esc_html( $dummy['price'] ); ?><?php echo function_exists( 'get_woocommerce_currency_symbol' ) ? esc_html( get_woocommerce_currency_symbol() ) : esc_html__( 'Tk', 'fastest_fj' ); ?></span>
						</label>
						<?php
					endforeach;
				endif;
				?>
			</div>

			<?php if ( class_exists( 'WooCommerce' ) && ! empty( $product_ids ) ) : ?>
				<?php echo do_shortcode( '[woocommerce_checkout]' ); ?>
			<?php else : ?>
				<div class="fastest-cartflow-dummy-checkout">
					<h3><?php esc_html_e( 'আপনার নাম, নাম্বার ও ঠিকানা দিন', 'fastest_fj' ); ?></h3>
					<input type="text" placeholder="<?php esc_attr_e( 'আপনার নাম লিখুন', 'fastest_fj' ); ?>" disabled>
					<input type="text" placeholder="<?php esc_attr_e( '+880 01xxx-xxxxxx', 'fastest_fj' ); ?>" disabled>
					<input type="text" placeholder="<?php esc_attr_e( 'থানা: রামপুরা, জেলা: ঢাকা', 'fastest_fj' ); ?>" disabled>
					<button type="button" disabled><?php esc_html_e( 'অর্ডার করুন', 'fastest_fj' ); ?></button>
					<p><?php esc_html_e( 'এই পেজের Cartflow Settings থেকে Product IDs যোগ করলে এখানে লাইভ WooCommerce checkout দেখাবে।', 'fastest_fj' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php

	return ob_get_clean();
}
add_shortcode( 'cartflow-custom', 'fastest_fj_cartflow_checkout_shortcode' );

function fastest_fj_cartflow_select_product() {
	check_ajax_referer( 'fastest_fj_cartflow_nonce', 'nonce' );

	$product_id  = absint( $_POST['product_id'] ?? 0 );
	$allowed_ids = array_filter( array_map( 'absint', explode( ',', sanitize_text_field( wp_unslash( $_POST['ids'] ?? '' ) ) ) ) );

	if ( empty( $allowed_ids ) || ! in_array( $product_id, $allowed_ids, true ) ) {
		wp_send_json_error( array( 'message' => __( 'Invalid product selected.', 'fastest_fj' ) ) );
	}

	if ( ! fastest_fj_cartflow_sync_cart( $product_id ) ) {
		wp_send_json_error( array( 'message' => __( 'Unable to update cart.', 'fastest_fj' ) ) );
	}

	wp_send_json_success(
		array(
			'cart_count' => WC()->cart->get_cart_contents_count(),
			'total'      => WC()->cart->get_total(),
		)
	);
}
add_action( 'wp_ajax_fastest_fj_cartflow_select_product', 'fastest_fj_cartflow_select_product' );
add_action( 'wp_ajax_nopriv_fastest_fj_cartflow_select_product', 'fastest_fj_cartflow_select_product' );

function fastest_fj_cartflow_assets() {
	if ( ! fastest_fj_cartflow_is_template() && ! is_singular() ) {
		return;
	}

	wp_register_script( 'fastest-fj-cartflow', '', array( 'jquery' ), fastest_fj_VERSION, true );
	wp_enqueue_script( 'fastest-fj-cartflow' );
	wp_localize_script(
		'fastest-fj-cartflow',
		'fastestCartflow',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'fastest_fj_cartflow_nonce' ),
		)
	);
	$script = <<<'JS'
(function($){
	function fastestCartflowSetSelected(input) {
		var form = input.closest('.fastest-cartflow-order-form');

		form.find('.cartflow-package-card').removeClass('is-selected');
		input.closest('.cartflow-package-card').addClass('is-selected');
	}

	$('.fastest-cartflow-order-form input[name="checkout_product"]:checked').each(function(){
		var input = $(this);

		fastestCartflowSetSelected(input);
		input.closest('.fastest-cartflow-order-form').data('selectedProduct', input.val());
	});

	$(document).on('click', '.fastest-cartflow-order-form .cartflow-package-card', function(event){
		var card = $(this);
		var input = card.find('input[name="checkout_product"]');

		if (!input.length || input.prop('checked')) {
			return;
		}

		event.preventDefault();
		input.prop('checked', true).trigger('change');
	});

	$(document).on('change', '.fastest-cartflow-order-form input[name="checkout_product"]', function(){
		var input = $(this);
		var form = input.closest('.fastest-cartflow-order-form');
		var previous = form.data('selectedProduct') || form.find('input[name="checkout_product"]:checked').val();

		fastestCartflowSetSelected(input);
		form.data('selectedProduct', input.val());

		form.addClass('is-updating');

		$.post(fastestCartflow.ajaxUrl, {
			action: 'fastest_fj_cartflow_select_product',
			nonce: fastestCartflow.nonce,
			product_id: input.val(),
			ids: form.data('ids')
		}).done(function(response){
			if (response && response.success) {
				$(document.body).trigger('wc_fragment_refresh');
				$(document.body).trigger('update_checkout');
			} else {
				form.find('input[name="checkout_product"][value="' + previous + '"]').prop('checked', true).each(function(){
					fastestCartflowSetSelected($(this));
				});
				form.data('selectedProduct', previous);
				if (window.console && response && response.data && response.data.message) {
					console.warn(response.data.message);
				}
			}
		}).fail(function(){
			form.find('input[name="checkout_product"][value="' + previous + '"]').prop('checked', true).each(function(){
				fastestCartflowSetSelected($(this));
			});
			form.data('selectedProduct', previous);
		}).always(function(){
			form.removeClass('is-updating');
		});
	});
})(jQuery);
JS;

	wp_add_inline_script( 'fastest-fj-cartflow', $script );

	wp_register_style( 'fastest-fj-cartflow', false, array(), fastest_fj_VERSION );
	wp_enqueue_style( 'fastest-fj-cartflow' );
	wp_add_inline_style( 'fastest-fj-cartflow', fastest_fj_cartflow_css() );
}
add_action( 'wp_enqueue_scripts', 'fastest_fj_cartflow_assets', 35 );

function fastest_fj_cartflow_css() {
	return '
.cartflow-page{background:#faf8f4;color:#2d2d2d}
.cartflow-hero{position:relative;overflow:hidden;background:#1e1e1e;color:#fff}
.cartflow-hero:before{content:"";position:absolute;inset:0;background:linear-gradient(90deg,rgba(30,30,30,.82),rgba(30,30,30,.42))}
.cartflow-hero__bg{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}
.cartflow-hero__inner{position:relative;z-index:1;min-height:430px;display:flex;align-items:center;padding:70px 0}
.cartflow-hero__content{max-width:650px}
.cartflow-hero__eyebrow{color:#c9a961;font-size:13px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;margin-bottom:12px}
.cartflow-hero h1{font-family:"Playfair Display",serif;font-size:clamp(34px,6vw,58px);line-height:1.05;font-weight:700;margin:0 0 16px}
.cartflow-hero p{font-size:16px;line-height:1.7;color:rgba(255,255,255,.86);margin:0 0 24px}
.cartflow-hero__button{display:inline-flex;align-items:center;gap:8px;background:#c9a961;color:#fff;border-radius:999px;padding:13px 24px;font-weight:700}
.cartflow-benefits{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:14px;margin-top:-34px;position:relative;z-index:2}
.cartflow-benefit{background:#fff;border:1px solid #eee5d5;border-radius:8px;padding:18px;box-shadow:0 12px 28px rgba(0,0,0,.07)}
.cartflow-benefit i{color:#c9a961;margin-bottom:10px}
.cartflow-benefit strong{display:block;font-family:"Playfair Display",serif;font-size:18px;margin-bottom:4px}
.cartflow-benefit span{display:block;font-size:13px;color:#666;line-height:1.5}
.fastest-cartflow-section{padding:54px 0 70px}
.fastest-cartflow-order-form{max-width:760px;margin:0 auto;background:#fff;border-radius:10px;box-shadow:0 10px 30px rgba(0,0,0,.08);overflow:hidden}
.fastest-cartflow-order-form .form-title{font-family:"Playfair Display",serif;color:#c41e3a;text-align:center;font-size:28px;font-weight:800;line-height:1.2;margin:0;padding:18px 14px 4px}
.fastest-cartflow-alert{display:flex;align-items:center;justify-content:center;gap:8px;margin:0 10px 14px;padding:10px 14px;color:#7a2413;background:#fff5e5;border:1px solid #f2c46d;border-left:4px solid #d4af37;border-radius:8px;box-shadow:0 6px 18px rgba(196,30,58,.08);font-weight:400;font-size:12px;line-height:1.5;text-align:center}
.fastest-cartflow-order-form .checkout-wrapper{padding:0 10px 10px}
.checkout-product-selector{display:grid;gap:8px;background:#f7f7f7;padding:10px;border-bottom:1px solid #e7e7e7}
.cartflow-package-card{position:relative;display:grid;grid-template-columns:auto 44px minmax(0,1fr) auto;align-items:center;gap:9px;min-height:58px;margin:0;background:#fff;border:1px solid #d8d8d8;border-radius:6px;padding:7px;cursor:pointer;transition:all .18s ease}
.cartflow-package-card:has(input:checked),.cartflow-package-card.is-selected,.cartflow-package-card.is-dummy-selected{border-color:#d4af37;background:#fffdf6;box-shadow:0 0 0 1px rgba(212,175,55,.22)}
.cartflow-package-card input{position:absolute;opacity:0;pointer-events:none}
.cartflow-package-radio{width:13px;height:13px;border:1px solid #969696;border-radius:50%;background:#fff}
.cartflow-package-card:has(input:checked) .cartflow-package-radio,.cartflow-package-card.is-selected .cartflow-package-radio,.cartflow-package-card.is-dummy-selected .cartflow-package-radio{border:4px solid #b98c00}
.cartflow-package-image{width:40px;height:40px;border-radius:4px;overflow:hidden;background:#f5f3ee}
.cartflow-package-image img{width:100%;height:100%;object-fit:cover}
.cartflow-package-content{min-width:0}
.cartflow-package-content strong{display:block;font-size:13px;line-height:1.15;color:#1e1e1e;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.cartflow-package-content small{display:block;margin-top:2px;color:#e8913a;font-size:12px;font-weight:700;line-height:1.15;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.cartflow-package-price{font-size:12px;font-weight:700;text-align:right;white-space:nowrap;color:#1e1e1e}
.fastest-cartflow-order-form.is-updating{opacity:.72;pointer-events:none}
.fastest-cartflow-order-form section.pb-16{padding-bottom:0}
.fastest-cartflow-order-form section.pb-16>.container{padding-left:0;padding-right:0}
.fastest-cartflow-order-form section.pb-16 .max-w-6xl{max-width:none;box-shadow:none;border-radius:0;padding:0;gap:0}
.fastest-cartflow-order-form .woocommerce-checkout form.checkout{width:100%}
.fastest-cartflow-order-form .woocommerce-checkout .col2-set{background:#fff;padding:0 0 10px}
.fastest-cartflow-order-form .woocommerce-billing-fields h3{font-family:"Playfair Display",serif;text-align:center;font-size:24px;color:#2d2d2d;margin:0 0 8px;border-top:2px solid #e5e5e5;padding-top:8px}
.fastest-cartflow-order-form .woocommerce form .form-row{margin-bottom:8px}
.fastest-cartflow-order-form .woocommerce form .form-row label{display:inline-block;background:#fff;color:#c41e3a;font-size:11px;margin:0 0 -8px 12px;position:relative;z-index:1;padding:0 4px}
.fastest-cartflow-order-form .woocommerce form .form-row .input-text,.fastest-cartflow-order-form .woocommerce form .form-row select,.fastest-cartflow-order-form .woocommerce form .form-row textarea{border-radius:6px;border-color:#d7d7d7;padding:12px 14px;font-size:16px}
.fastest-cartflow-order-form form.checkout{display:flex !important;flex-direction:column}
.fastest-cartflow-order-form .woocommerce-checkout #customer_details{order:1 !important;}
.fastest-cartflow-order-form .woocommerce-checkout #order_review_heading{order:3}
.fastest-cartflow-order-form .woocommerce-checkout .woocommerce-additional-fields{display:none}
.fastest-cartflow-order-form .woocommerce-checkout .premium-box-option{order:3}
.fastest-cartflow-order-form .woocommerce-checkout .woocommerce-checkout-review-order-table{order:4}
.fastest-cartflow-order-form .woocommerce-checkout #payment{display:flex;flex-direction:column;order:2 !important;background:transparent;border:0;margin:0 0 12px;padding:0}
.fastest-cartflow-order-form .woocommerce-checkout #payment ul.payment_methods,.fastest-cartflow-order-form .woocommerce-checkout #payment .payment_box{display:none!important}
.fastest-cartflow-order-form .woocommerce-checkout #payment .place-order{order:1;margin:0;padding:0;background:transparent;border:0}
.fastest-cartflow-order-form .woocommerce-checkout #payment .woocommerce-terms-and-conditions-wrapper{display:none}
.fastest-cartflow-order-form #payment #place_order{width:100%;background:#ff8900;border-radius:6px;font-size:16px;font-weight:800;margin:0;padding:14px;color:#fff}
.fastest-cartflow-dummy-checkout{padding:8px 0 10px}
.fastest-cartflow-dummy-checkout h3{font-family:"Playfair Display",serif;text-align:center;font-size:24px;margin:0 0 8px}
.fastest-cartflow-dummy-checkout input{display:block;width:100%;border:1px solid #d7d7d7;border-radius:6px;padding:13px;margin-bottom:8px;background:#fff;font-size:16px}
.fastest-cartflow-dummy-checkout button{width:100%;border:0;border-radius:6px;background:#ff8900;color:#fff;font-weight:800;padding:13px}
.fastest-cartflow-dummy-checkout p{text-align:center;font-size:12px;color:#777;margin:10px 0 0}
@media (max-width:767px){.cartflow-hero__inner{min-height:360px;padding:48px 0}.cartflow-benefits{grid-template-columns:1fr;margin-top:14px}.fastest-cartflow-section{padding-top:22px}.fastest-cartflow-order-form{border-radius:0}.fastest-cartflow-order-form .form-title{font-size:24px}.cartflow-package-card{grid-template-columns:auto 40px minmax(0,1fr) auto}.cartflow-package-content strong,.cartflow-package-price{font-size:11px}.cartflow-package-content small{font-size:10px}}
';
}

function fastest_fj_cartflow_add_meta_box() {
	add_meta_box(
		'fastest_fj_cartflow_settings',
		__( 'Cartflow Settings', 'fastest_fj' ),
		'fastest_fj_cartflow_meta_box',
		'page',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'fastest_fj_cartflow_add_meta_box' );

function fastest_fj_cartflow_meta_box( $post ) {
	wp_nonce_field( 'fastest_fj_cartflow_save_meta', 'fastest_fj_cartflow_nonce_field' );

	$fields = array(
		'product_ids'        => array( 'Product IDs', 'text', 'Comma separated WooCommerce product IDs. Example: 12,15,18' ),
		'default_product_id' => array( 'Default Product ID', 'text', 'Optional. Must be one of the product IDs above.' ),
		'hero_title'         => array( 'Hero Title', 'textarea', '' ),
		'hero_subtitle'      => array( 'Hero Subtitle', 'textarea', '' ),
		'show_alert'         => array( 'Show Top Alert Bar', 'checkbox', '' ),
		'alert_text'         => array( 'Top Alert Text', 'textarea', '' ),
		'phone_number'       => array( 'Phone Number', 'text', '' ),
		'show_scarcity'      => array( 'Show Scarcity Banner', 'checkbox', '' ),
		'scarcity_title'     => array( 'Scarcity Title', 'text', '' ),
		'scarcity_desc'      => array( 'Scarcity Description', 'textarea', 'HTML allowed: strong, br, span.' ),
		'selector_title'     => array( 'Package Selector Title', 'text', '' ),
		'selector_alert'     => array( 'Package Selector Alert', 'textarea', '' ),
		'benefits_title'     => array( 'Benefits Section Title', 'text', '' ),
		'testimonials_title' => array( 'Testimonials Section Title', 'text', '' ),
		'faq_title'          => array( 'FAQ Section Title', 'text', '' ),
		'guarantee_title'    => array( 'Guarantee Title', 'text', '' ),
		'guarantee_desc'     => array( 'Guarantee Description', 'textarea', '' ),
		'final_cta_title'    => array( 'Final CTA Title', 'text', '' ),
		'final_cta_desc'     => array( 'Final CTA Description', 'textarea', '' ),
		'cta_button'         => array( 'CTA Button Text', 'text', '' ),
		'show_sticky'        => array( 'Show Sticky Bottom Bar', 'checkbox', '' ),
		'sticky_bar'         => array( 'Sticky Bar Text', 'text', '' ),
		'footer_text'        => array( 'Footer Text', 'textarea', 'Leave empty for default copyright.' ),
		'badges'             => array( 'Trust Badges', 'textarea', 'One per line: icon|title|description' ),
		'benefits'           => array( 'Benefits', 'textarea', 'One per line: icon|title|description' ),
		'testimonials'       => array( 'Testimonials', 'textarea', 'One per line: name|location|stars|text' ),
		'faqs'               => array( 'FAQ Items', 'textarea', 'One per line: question|answer' ),
	);
	?>
	<div class="fastest-cartflow-meta-grid">
		<?php foreach ( $fields as $key => $field ) : ?>
			<?php
			$value = fastest_fj_cartflow_get( $key, $post->ID );
			$full  = in_array( $key, array( 'badges', 'benefits', 'testimonials', 'faqs', 'hero_title', 'hero_subtitle', 'alert_text', 'scarcity_desc', 'selector_alert', 'guarantee_desc', 'final_cta_desc', 'footer_text' ), true );
			?>
			<p class="fastest-cartflow-meta-field <?php echo $full ? 'full' : ''; ?>">
				<label for="fastest_fj_cartflow_<?php echo esc_attr( $key ); ?>"><strong><?php echo esc_html( $field[0] ); ?></strong></label>
				<?php if ( 'checkbox' === $field[1] ) : ?>
					<input type="checkbox" id="fastest_fj_cartflow_<?php echo esc_attr( $key ); ?>" name="fastest_fj_cartflow[<?php echo esc_attr( $key ); ?>]" value="1" <?php checked( $value, '1' ); ?>>
				<?php elseif ( 'textarea' === $field[1] ) : ?>
					<textarea id="fastest_fj_cartflow_<?php echo esc_attr( $key ); ?>" name="fastest_fj_cartflow[<?php echo esc_attr( $key ); ?>]" style="width:100%;min-height:90px;"><?php echo esc_textarea( $value ); ?></textarea>
				<?php else : ?>
					<input type="text" id="fastest_fj_cartflow_<?php echo esc_attr( $key ); ?>" name="fastest_fj_cartflow[<?php echo esc_attr( $key ); ?>]" value="<?php echo esc_attr( $value ); ?>" style="width:100%;">
				<?php endif; ?>
				<?php if ( $field[2] ) : ?>
					<small style="display:block;color:#646970;margin-top:4px;"><?php echo esc_html( $field[2] ); ?></small>
				<?php endif; ?>
			</p>
		<?php endforeach; ?>
	</div>
	<?php
}

function fastest_fj_cartflow_save_meta( $post_id ) {
	if ( ! isset( $_POST['fastest_fj_cartflow_nonce_field'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['fastest_fj_cartflow_nonce_field'] ) ), 'fastest_fj_cartflow_save_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$defaults = fastest_fj_cartflow_defaults();
	$posted   = isset( $_POST['fastest_fj_cartflow'] ) && is_array( $_POST['fastest_fj_cartflow'] ) ? wp_unslash( $_POST['fastest_fj_cartflow'] ) : array();

	foreach ( $defaults as $key => $default ) {
		if ( in_array( $key, array( 'show_alert', 'show_scarcity', 'show_sticky' ), true ) ) {
			$value = isset( $posted[ $key ] ) ? '1' : '0';
		} else {
			$value = isset( $posted[ $key ] ) ? (string) $posted[ $key ] : '';
			$value = 'scarcity_desc' === $key ? wp_kses_post( $value ) : sanitize_textarea_field( $value );
		}

		update_post_meta( $post_id, fastest_fj_cartflow_meta_key( $key ), $value );
	}
}
add_action( 'save_post_page', 'fastest_fj_cartflow_save_meta' );

add_filter( 'woocommerce_is_checkout', function ( $is_checkout ) {
	if ( fastest_fj_cartflow_is_template() ) {
		return true;
	}
} );
