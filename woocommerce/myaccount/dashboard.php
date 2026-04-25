<?php
/**
 * My Account Dashboard
 *
 * @package fastest_fj
 */

defined( 'ABSPATH' ) || exit;

$current_user = wp_get_current_user();
$customer_orders = wc_get_orders( array(
    'customer' => get_current_user_id(),
    'limit'    => 4,
    'status'   => array( 'wc-completed', 'wc-processing', 'wc-shipped' ),
) );
?>

<div class="woocommerce-MyAccount-content">
    <h2 class="font-serif text-2xl font-bold mb-6"><?php printf( __( 'Hello, %s', 'fastest_fj' ), esc_html( $current_user->first_name ?: $current_user->display_name ) ); ?></h2>

    <!-- Stats -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
        <div class="bg-brand-cream rounded-lg p-6 text-center">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 text-brand-gold text-xl">
                <i class="fas fa-box"></i>
            </div>
            <p class="text-2xl font-bold"><?php echo count( $customer_orders ); ?></p>
            <p class="text-gray-500 text-sm"><?php esc_html_e( 'Total Orders', 'fastest_fj' ); ?></p>
        </div>
        <div class="bg-brand-cream rounded-lg p-6 text-center">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 text-brand-gold text-xl">
                <i class="fas fa-heart"></i>
            </div>
            <p class="text-2xl font-bold"><?php echo esc_html( fastest_fj_get_wishlist_count() ); ?></p>
            <p class="text-gray-500 text-sm"><?php esc_html_e( 'Wishlist Items', 'fastest_fj' ); ?></p>
        </div>
        <div class="bg-brand-cream rounded-lg p-6 text-center">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center mx-auto mb-3 text-brand-gold text-xl">
                <i class="fas fa-gift"></i>
            </div>
            <p class="text-2xl font-bold"><?php echo esc_html( WC()->customer->get_total_spent() ? wc_price( WC()->customer->get_total_spent() ) : wc_price( 0 ) ); ?></p>
            <p class="text-gray-500 text-sm"><?php esc_html_e( 'Total Spent', 'fastest_fj' ); ?></p>
        </div>
    </div>

    <!-- Recent Orders -->
    <h3 class="font-serif text-lg font-bold mb-4"><?php esc_html_e( 'Recent Orders', 'fastest_fj' ); ?></h3>

    <?php if ( ! empty( $customer_orders ) ) : ?>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-brand-cream">
                    <tr>
                        <th class="text-left px-4 py-3 font-semibold rounded-l-lg"><?php esc_html_e( 'Order #', 'fastest_fj' ); ?></th>
                        <th class="text-left px-4 py-3 font-semibold"><?php esc_html_e( 'Date', 'fastest_fj' ); ?></th>
                        <th class="text-left px-4 py-3 font-semibold"><?php esc_html_e( 'Status', 'fastest_fj' ); ?></th>
                        <th class="text-right px-4 py-3 font-semibold rounded-r-lg"><?php esc_html_e( 'Total', 'fastest_fj' ); ?></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php foreach ( $customer_orders as $order ) : ?>
                        <tr>
                            <td class="px-4 py-3">
                                <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>" class="text-brand-gold hover:underline font-semibold">
                                    #<?php echo esc_html( $order->get_order_number() ); ?>
                                </a>
                            </td>
                            <td class="px-4 py-3 text-gray-600"><?php echo esc_html( wc_format_datetime( $order->get_date_created() ) ); ?></td>
                            <td class="px-4 py-3">
                                <?php
                                $status = $order->get_status();
                                $status_classes = array(
                                    'completed'  => 'bg-green-100 text-green-700',
                                    'processing' => 'bg-blue-100 text-blue-700',
                                    'shipped'    => 'bg-purple-100 text-purple-700',
                                    'on-hold'    => 'bg-yellow-100 text-yellow-700',
                                    'pending'    => 'bg-gray-100 text-gray-700',
                                    'cancelled'  => 'bg-red-100 text-red-700',
                                );
                                $status_class = isset( $status_classes[ $status ] ) ? $status_classes[ $status ] : 'bg-gray-100 text-gray-700';
                                ?>
                                <span class="<?php echo esc_attr( $status_class ); ?> text-xs px-2 py-1 rounded-full font-semibold capitalize"><?php echo esc_html( wc_get_order_status_name( $status ) ); ?></span>
                            </td>
                            <td class="px-4 py-3 text-right font-bold"><?php echo wp_kses_post( $order->get_formatted_order_total() ); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <a href="<?php echo esc_url( wc_get_account_endpoint_url( 'orders' ) ); ?>" class="inline-block mt-4 text-brand-gold text-sm font-semibold hover:underline"><?php esc_html_e( 'View All Orders', 'fastest_fj' ); ?></a>
    <?php else : ?>
        <div class="bg-brand-cream rounded-lg p-8 text-center">
            <i class="fas fa-box-open text-gray-300 text-4xl mb-3"></i>
            <p class="text-gray-500"><?php esc_html_e( 'No orders yet. Start shopping!', 'fastest_fj' ); ?></p>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="inline-block mt-4 bg-brand-dark text-white px-6 py-2 rounded-full text-sm font-semibold hover:bg-brand-gold transition"><?php esc_html_e( 'Shop Now', 'fastest_fj' ); ?></a>
        </div>
    <?php endif; ?>
</div>
