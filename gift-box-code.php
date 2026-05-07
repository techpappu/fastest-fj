<?php
function fastest_fj_premium_box_product_id() {
    return 83;
}

function fastest_fj_cart_has_premium_box() {
    if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
        return false;
    }

    $product_id = fastest_fj_premium_box_product_id();

    foreach ( WC()->cart->get_cart() as $cart_item ) {
        if ( (int) $cart_item['product_id'] === $product_id ) {
            return true;
        }
    }

    return false;
}

// Premium box add-on in checkout payment section.
add_action( 'woocommerce_review_order_before_payment', 'add_custom_checkout_checkbox', 20 );
function add_custom_checkout_checkbox() {
    $is_checked = fastest_fj_cart_has_premium_box();
    ?>
    <div class="premium-box-option">
        <input type="checkbox" id="custom_product" name="custom_product" value="1" class="premium-box-option__input" <?php checked( $is_checked ); ?>>
        <label for="custom_product" class="premium-box-option__card">
            <span class="premium-box-option__icon" aria-hidden="true">
                <i class="fas fa-gift"></i>
            </span>
            <span class="premium-box-option__content">
                <span class="premium-box-option__top">
                    <span class="premium-box-option__title"><?php esc_html_e( 'Premium Gift Box', 'fastest_fj' ); ?></span>
                    <span class="premium-box-option__price"><?php echo wp_kses_post( wc_price( 100 ) ); ?></span>
                </span>
            </span>
            <span class="premium-box-option__check" aria-hidden="true">
                <i class="fas fa-check"></i>
            </span>
        </label>
    </div>
    <?php
}

// jQuery + Ajax logic
add_action( 'wp_footer', 'custom_product_script' );
function custom_product_script() {
    if ( is_checkout() && ! is_wc_endpoint_url() ) :
    ?>
    <script type="text/javascript">
    jQuery(function($){
        if (typeof woocommerce_params === 'undefined') return;

        // Auto-check and send Ajax on load
        $(document).ready(function(){
            var $premiumBox = $('input[name=custom_product]');
            if ($premiumBox.length && ! $premiumBox.is(':checked')) {
                $premiumBox.prop('checked', true).trigger('change');
            }
        });

        $(document.body).on('change', 'input[name=custom_product]', function(){
            var add = $(this).is(':checked') ? '1' : '0';
            $.ajax({
                type: 'POST',
                url: woocommerce_params.ajax_url,
                data: {
                    action: 'custom_product_action',
                    add_custom_product: add
                },
                success: function(response){
                    $('body').trigger('update_checkout');
                }
            });
        });
    });
    </script>
    <?php
    endif;
}

// Handle Ajax: add/remove product from cart
add_action('wp_ajax_custom_product_action', 'handle_custom_product_ajax');
add_action('wp_ajax_nopriv_custom_product_action', 'handle_custom_product_ajax');
function handle_custom_product_ajax() {
    $product_id = fastest_fj_premium_box_product_id();
	$cart = WC()->cart;

    if (isset($_POST['add_custom_product'])) {
        $add = sanitize_text_field( wp_unslash( $_POST['add_custom_product'] ) ) === '1';

        // Remove existing product if already in cart
        foreach ($cart->get_cart() as $cart_item_key => $cart_item) {
            if ($cart_item['product_id'] == $product_id) {
                $cart->remove_cart_item($cart_item_key);
            }
        }

        // Add product if checkbox is checked
        if ($add) {
            $cart->add_to_cart($product_id);
        }

        wp_send_json_success( array( 'status' => 'ok' ) );
    }
    wp_die();
}
