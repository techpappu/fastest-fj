<?php
/**
 * The template for displaying product content within loops
 *
 * @package fastest_fj
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
    return;
}
?>
<div <?php wc_product_class( 'product-card group', $product ); ?>>
    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     */
    do_action( 'woocommerce_before_shop_loop_item' );
    ?>

    <div class="relative overflow-hidden rounded-lg bg-brand-cream aspect-[3/4] mb-3">
        <?php
        /**
         * Hook: woocommerce_before_shop_loop_item_title.
         * @hooked woocommerce_show_product_loop_sale_flash - 10
         * @hooked woocommerce_template_loop_product_thumbnail - 10
         */
        do_action( 'woocommerce_before_shop_loop_item_title' );

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
        $in_wishlist = fastest_fj_is_in_wishlist( $product->get_id() );
        ?>
        <button class="add-to-wishlist absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center text-gray-600 hover:text-red-500 transition shadow-sm <?php echo $in_wishlist ? 'in-wishlist' : ''; ?>" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
            <i class="heart-icon <?php echo $in_wishlist ? 'fas' : 'far'; ?> fa-heart"></i>
        </button>

        <!-- Add to Cart -->
        <div class="add-to-cart absolute bottom-0 left-0 right-0 p-3">
            <?php
            woocommerce_template_loop_add_to_cart( array(
                'class' => 'button w-full bg-brand-dark text-white py-2 rounded-full text-sm font-semibold hover:bg-brand-gold transition text-center block !text-white',
            ) );
            ?>
        </div>
    </div>

    <div class="product-info">
        <?php
        /**
         * Hook: woocommerce_shop_loop_item_title.
         */
        do_action( 'woocommerce_shop_loop_item_title' );

        /**
         * Hook: woocommerce_after_shop_loop_item_title.
         * @hooked woocommerce_template_loop_rating - 5
         * @hooked woocommerce_template_loop_price - 10
         */
        do_action( 'woocommerce_after_shop_loop_item_title' );
        ?>
    </div>

    <?php
    /**
     * Hook: woocommerce_after_shop_loop_item.
     */
    do_action( 'woocommerce_after_shop_loop_item' );
    ?>
</div>
