<?php
/**
 * Review order table
 *
 * @package fastest_fj
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="lg:w-96 flex-shrink-0 order-review-wrapper">
    <div class="bg-brand-cream rounded-lg p-6 sm:p-8 order-review" id="order_review">
        <h3 id="order_review_heading" class="font-serif text-xl font-bold mb-6"><?php esc_html_e( 'Order Summary', 'fastest_fj' ); ?></h3>

        <?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

        <table class="shop_table woocommerce-checkout-review-order-table w-full text-sm">
            <tbody>
                <?php
                do_action( 'woocommerce_review_order_before_cart_contents' );

                foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                    $_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );

                    if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_checkout_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                        ?>
                        <tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                            <td class="product-name py-3">
                                <div class="flex gap-3">
                                    <div class="w-16 h-16 flex-shrink-0">
                                        <?php echo wp_kses_post( $_product->get_image( array( 64, 64 ), array( 'class' => 'w-full h-full object-cover rounded-lg' ) ) ); ?>
                                    </div>
                                    <div>
                                        <h4 class="font-serif text-sm font-semibold"><?php echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) ); ?></h4>
                                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                                        <span class="text-xs text-gray-500"><?php echo apply_filters( 'woocommerce_checkout_cart_item_quantity', 'Qty: ' . $cart_item['quantity'], $cart_item, $cart_item_key ); ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="product-total text-right py-3 font-bold">
                                <?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?>
                            </td>
                        </tr>
                        <?php
                    }
                }

                do_action( 'woocommerce_review_order_after_cart_contents' );
                ?>
            </tbody>
            <tfoot class="border-t border-gray-200">
                <tr class="cart-subtotal">
                    <th class="text-left py-3 text-gray-600"><?php esc_html_e( 'Subtotal', 'fastest_fj' ); ?></th>
                    <td class="text-right py-3 font-semibold"><?php wc_cart_totals_subtotal_html(); ?></td>
                </tr>

                <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                    <tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                        <th class="text-left py-3 text-gray-600"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
                        <td class="text-right py-3 text-red-500 font-semibold"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                    <?php do_action( 'woocommerce_review_order_before_shipping' ); ?>
                    <tr class="shipping">
                        <th class="text-left py-3 text-gray-600"><?php esc_html_e( 'Shipping', 'fastest_fj' ); ?></th>
                        <td class="text-right py-3 font-semibold"><?php wc_cart_totals_shipping_html(); ?></td>
                    </tr>
                    <?php do_action( 'woocommerce_review_order_after_shipping' ); ?>
                <?php endif; ?>

                <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                    <tr class="fee">
                        <th class="text-left py-3 text-gray-600"><?php echo esc_html( $fee->name ); ?></th>
                        <td class="text-right py-3 font-semibold"><?php wc_cart_totals_fee_html( $fee ); ?></td>
                    </tr>
                <?php endforeach; ?>

                <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
                    <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                        <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                            <tr class="tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                                <th class="text-left py-3 text-gray-600"><?php echo esc_html( $tax->label ); ?></th>
                                <td class="text-right py-3 font-semibold"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr class="tax-total">
                            <th class="text-left py-3 text-gray-600"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></th>
                            <td class="text-right py-3 font-semibold"><?php wc_cart_totals_taxes_total_html(); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>

                <?php do_action( 'woocommerce_review_order_before_order_total' ); ?>

                <tr class="order-total border-t border-gray-200">
                    <th class="text-left py-4 font-serif text-lg font-bold"><?php esc_html_e( 'Total', 'fastest_fj' ); ?></th>
                    <td class="text-right py-4 font-serif text-2xl font-bold text-brand-orange"><?php wc_cart_totals_order_total_html(); ?></td>
                </tr>

                <?php do_action( 'woocommerce_review_order_after_order_total' ); ?>
            </tfoot>
        </table>

        <?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
    </div>
</div>
