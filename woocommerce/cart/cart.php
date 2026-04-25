<?php
/**
 * Cart Page
 *
 * @package fastest_fj
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' );
?>

<section class="py-10">
    <div class="container mx-auto px-4">
        <h1 class="font-serif text-3xl sm:text-4xl font-bold mb-8"><?php esc_html_e( 'Shopping Cart', 'fastest_fj' ); ?></h1>

        <form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
            <?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>

            <div class="flex flex-col lg:flex-row gap-10">
                <!-- Cart Items -->
                <div class="flex-1">
                    <div class="hidden sm:grid grid-cols-12 gap-4 text-sm font-semibold text-gray-500 border-b border-gray-200 pb-3 mb-4">
                        <div class="col-span-6"><?php esc_html_e( 'Product', 'fastest_fj' ); ?></div>
                        <div class="col-span-2 text-center"><?php esc_html_e( 'Price', 'fastest_fj' ); ?></div>
                        <div class="col-span-2 text-center"><?php esc_html_e( 'Quantity', 'fastest_fj' ); ?></div>
                        <div class="col-span-2 text-right"><?php esc_html_e( 'Total', 'fastest_fj' ); ?></div>
                    </div>

                    <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
                            $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
                            ?>
                            <div class="flex flex-col sm:grid sm:grid-cols-12 gap-4 items-center border-b border-gray-100 py-4 <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">
                                <!-- Product -->
                                <div class="col-span-6 flex items-center gap-4 w-full">
                                    <div class="w-20 h-20 flex-shrink-0">
                                        <?php
                                        $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image( array( 80, 80 ), array( 'class' => 'w-full h-full object-cover rounded-lg' ) ), $cart_item, $cart_item_key );
                                        if ( ! $product_permalink ) {
                                            echo wp_kses_post( $thumbnail );
                                        } else {
                                            printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), wp_kses_post( $thumbnail ) );
                                        }
                                        ?>
                                    </div>
                                    <div>
                                        <h3 class="font-serif font-semibold text-sm">
                                            <?php
                                            if ( ! $product_permalink ) {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) );
                                            } else {
                                                echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s" class="hover:text-brand-gold transition">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
                                            }
                                            ?>
                                        </h3>
                                        <?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>
                                        <button type="submit" name="remove_cart_item" value="<?php echo esc_attr( $cart_item_key ); ?>" class="text-red-500 text-xs mt-2 hover:underline sm:hidden remove-item-mobile">
                                            <i class="fas fa-trash-alt mr-1"></i><?php esc_html_e( 'Remove', 'fastest_fj' ); ?>
                                        </button>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="col-span-2 text-center hidden sm:block">
                                    <p class="font-semibold"><?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?></p>
                                </div>

                                <!-- Quantity -->
                                <div class="col-span-2 flex items-center justify-center">
                                    <div class="flex items-center border border-gray-200 rounded-full">
                                        <button type="button" class="qty-minus w-8 h-8 flex items-center justify-center text-gray-500 hover:text-brand-gold"><i class="fas fa-minus text-xs"></i></button>
                                        <?php
                                        if ( $_product->is_sold_individually() ) {
                                            $product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
                                        } else {
                                            $product_quantity = woocommerce_quantity_input(
                                                array(
                                                    'input_name'   => "cart[{$cart_item_key}][qty]",
                                                    'input_value'  => $cart_item['quantity'],
                                                    'max_value'    => $_product->get_max_purchase_quantity(),
                                                    'min_value'    => '0',
                                                    'product_name' => $_product->get_name(),
                                                    'classes'      => 'w-10 h-8 text-center text-sm font-semibold border-x border-gray-200 focus:outline-none',
                                                ),
                                                $_product,
                                                false
                                            );
                                        }
                                        echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item );
                                        ?>
                                        <button type="button" class="qty-plus w-8 h-8 flex items-center justify-center text-gray-500 hover:text-brand-gold"><i class="fas fa-plus text-xs"></i></button>
                                    </div>
                                </div>

                                <!-- Subtotal -->
                                <div class="col-span-2 text-right flex items-center justify-between sm:justify-end gap-4 w-full">
                                    <div class="sm:hidden">
                                        <p class="font-bold text-brand-orange"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></p>
                                    </div>
                                    <p class="font-bold hidden sm:block"><?php echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); ?></p>
                                    <button type="submit" name="remove_cart_item" value="<?php echo esc_attr( $cart_item_key ); ?>" class="text-gray-400 hover:text-red-500 transition hidden sm:block remove-item-desktop">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                    <div class="flex items-center justify-between mt-6">
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="text-sm text-brand-gold hover:underline font-semibold"><i class="fas fa-arrow-left mr-2"></i><?php esc_html_e( 'Continue Shopping', 'fastest_fj' ); ?></a>
                        <button type="submit" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'fastest_fj' ); ?>" class="text-sm text-gray-500 hover:text-red-500 transition font-semibold update-cart-button">
                            <?php esc_html_e( 'Update Cart', 'fastest_fj' ); ?>
                        </button>
                    </div>

                    <?php do_action( 'woocommerce_cart_contents' ); ?>
                </div>

                <!-- Cart Summary -->
                <div class="lg:w-96 flex-shrink-0">
                    <div class="bg-brand-cream rounded-lg p-6 sm:p-8">
                        <h2 class="font-serif text-xl font-bold mb-6"><?php esc_html_e( 'Order Summary', 'fastest_fj' ); ?></h2>

                        <div class="space-y-3 text-sm border-b border-gray-200 pb-4">
                            <div class="flex justify-between"><span class="text-gray-600"><?php esc_html_e( 'Subtotal', 'fastest_fj' ); ?></span><span class="font-semibold"><?php wc_cart_totals_subtotal_html(); ?></span></div>
                            <?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
                                <div class="flex justify-between cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
                                    <span class="text-gray-600"><?php wc_cart_totals_coupon_label( $coupon ); ?></span>
                                    <span class="text-red-500 font-semibold"><?php wc_cart_totals_coupon_html( $coupon ); ?></span>
                                </div>
                            <?php endforeach; ?>
                            <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
                                <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>
                                <?php wc_cart_totals_shipping_html(); ?>
                                <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>
                            <?php endif; ?>
                            <?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
                                <div class="flex justify-between"><span class="text-gray-600"><?php echo esc_html( $fee->name ); ?></span><span class="font-semibold"><?php wc_cart_totals_fee_html( $fee ); ?></span></div>
                            <?php endforeach; ?>
                            <?php if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) : ?>
                                <?php if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
                                    <?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
                                        <div class="flex justify-between tax-rate tax-rate-<?php echo esc_attr( sanitize_title( $code ) ); ?>"><span class="text-gray-600"><?php echo esc_html( $tax->label ); ?></span><span class="font-semibold"><?php echo wp_kses_post( $tax->formatted_amount ); ?></span></div>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <div class="flex justify-between"><span class="text-gray-600"><?php echo esc_html( WC()->countries->tax_or_vat() ); ?></span><span class="font-semibold"><?php wc_cart_totals_taxes_total_html(); ?></span></div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <div class="flex justify-between items-center py-4 border-b border-gray-200">
                            <span class="font-serif text-lg font-bold"><?php esc_html_e( 'Total', 'fastest_fj' ); ?></span>
                            <span class="font-serif text-2xl font-bold text-brand-orange"><?php wc_cart_totals_order_total_html(); ?></span>
                        </div>

                        <!-- Coupon -->
                        <div class="mt-4 mb-6">
                            <label class="text-sm font-semibold mb-2 block"><?php esc_html_e( 'Promo Code', 'fastest_fj' ); ?></label>
                            <div class="coupon flex gap-2">
                                <input type="text" name="coupon_code" placeholder="<?php esc_attr_e( 'Enter code', 'fastest_fj' ); ?>" class="flex-1 px-3 py-2 border border-gray-200 rounded-full text-sm focus:outline-none focus:border-brand-gold" id="coupon_code">
                                <button type="submit" name="apply_coupon" value="<?php esc_attr_e( 'Apply', 'fastest_fj' ); ?>" class="bg-brand-dark text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-brand-gold transition"><?php esc_html_e( 'Apply', 'fastest_fj' ); ?></button>
                            </div>
                            <?php do_action( 'woocommerce_cart_coupon' ); ?>
                        </div>

                        <div class="wc-proceed-to-checkout">
                            <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
                        </div>

                        <div class="flex items-center justify-center gap-2 text-xs text-gray-500 mb-4 mt-4">
                            <i class="fas fa-lock"></i> <?php esc_html_e( 'Secure SSL Encrypted Checkout', 'fastest_fj' ); ?>
                        </div>
                        <div class="flex items-center justify-center gap-2">
                            <i class="fab fa-cc-visa text-gray-400 text-xl"></i>
                            <i class="fab fa-cc-mastercard text-gray-400 text-xl"></i>
                            <i class="fab fa-cc-amex text-gray-400 text-xl"></i>
                            <i class="fab fa-cc-paypal text-gray-400 text-xl"></i>
                            <i class="fab fa-cc-apple-pay text-gray-400 text-xl"></i>
                        </div>
                    </div>

                    <!-- Need Help -->
                    <div class="mt-6 bg-white border border-gray-200 rounded-lg p-6">
                        <h3 class="font-semibold mb-3"><?php esc_html_e( 'Need Help?', 'fastest_fj' ); ?></h3>
                        <p class="text-gray-500 text-sm mb-3"><?php esc_html_e( 'Our jewelry experts are here to assist you with your purchase.', 'fastest_fj' ); ?></p>
                        <a href="tel:<?php echo esc_attr( get_theme_mod( 'fastest_fj_phone', '1-800-123-4567' ) ); ?>" class="text-brand-gold text-sm font-semibold hover:underline"><i class="fas fa-phone mr-2"></i><?php echo esc_html( get_theme_mod( 'fastest_fj_phone', '1-800-123-4567' ) ); ?></a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php do_action( 'woocommerce_after_cart' ); ?>
