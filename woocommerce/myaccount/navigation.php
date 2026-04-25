<?php
/**
 * My Account Navigation
 *
 * @package fastest_fj
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
    <ul>
        <?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
            <li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
                <a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>">
                    <?php
                    // Map icons to endpoints
                    $icons = array(
                        'dashboard'       => 'fas fa-home',
                        'orders'          => 'fas fa-box',
                        'downloads'       => 'fas fa-download',
                        'edit-address'    => 'fas fa-map-marker-alt',
                        'payment-methods' => 'fas fa-credit-card',
                        'edit-account'    => 'fas fa-user',
                        'customer-logout' => 'fas fa-sign-out-alt',
                    );
                    $icon = isset( $icons[ $endpoint ] ) ? $icons[ $endpoint ] : 'fas fa-circle';
                    ?>
                    <i class="<?php echo esc_attr( $icon ); ?> w-5"></i>
                    <?php echo esc_html( $label ); ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
