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

$in_wishlist = fastest_fj_is_in_wishlist( $product->get_id() );
?>
<li <?php wc_product_class( 'product-card group relative bg-white border border-[#E5C384] hover:border-brand-orange/70 rounded-none p-2.5 sm:p-3 flex flex-col justify-between transition-all duration-300 shadow-sm hover:shadow-md h-full', $product ); ?>>
    <?php
    /**
     * Hook: woocommerce_before_shop_loop_item.
     */
    do_action( 'woocommerce_before_shop_loop_item' );
    ?>

    <div>
        <!-- Product Image Container (No rounded corners) -->
        <div class="relative overflow-hidden rounded-none bg-white aspect-square mb-2.5 flex items-center justify-center p-1 border border-gray-100">
            <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" class="block w-full h-full flex items-center justify-center">
                <?php
                if ( has_post_thumbnail( $product->get_id() ) ) {
                    echo wp_kses_post( $product->get_image( 'woocommerce_thumbnail', array( 'class' => 'product-img w-full h-full object-contain group-hover:scale-105 transition duration-500', 'loading' => 'lazy', 'decoding' => 'async' ) ) );
                } else {
                    echo wp_kses_post( wc_placeholder_img( 'woocommerce_thumbnail', array( 'class' => 'product-img w-full h-full object-contain', 'loading' => 'lazy', 'decoding' => 'async' ) ) );
                }
                ?>
            </a>

            <!-- Offer / Sale Badge (Top Right) -->
            <?php if ( $product->is_on_sale() ) : 
                $regular_price = (float) $product->get_regular_price();
                $sale_price    = (float) $product->get_sale_price();
                $discount      = ( $regular_price > 0 && $sale_price > 0 ) ? round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 ) : 0;
            ?>
                <div class="absolute top-1.5 right-1.5 z-10 bg-[#D32F2F] text-white text-[10px] leading-tight px-1.5 py-1 rounded-none font-bold text-center uppercase shadow-sm border border-amber-200 pointer-events-none">
                    <span class="block text-[8px] text-yellow-300 font-extrabold tracking-tight">New Year</span>
                    <span class="text-white text-[10px] font-black block"><?php echo $discount > 0 ? esc_html( $discount . '% OFF' ) : esc_html__( 'BLAST OFFER', 'fastest_fj' ); ?></span>
                </div>
            <?php elseif ( ( time() - strtotime( $product->get_date_created() ) ) < 30 * DAY_IN_SECONDS ) : ?>
                <div class="absolute top-1.5 right-1.5 z-10 bg-[#D32F2F] text-white text-[10px] leading-tight px-1.5 py-1 rounded-none font-bold text-center uppercase shadow-sm border border-amber-200 pointer-events-none">
                    <span class="block text-[8px] text-yellow-300 font-extrabold tracking-tight">SPECIAL</span>
                    <span class="text-white text-[10px] font-black block"><?php esc_html_e( 'NEW ARRIVAL', 'fastest_fj' ); ?></span>
                </div>
            <?php endif; ?>

            <!-- Wishlist Button (Top Left) -->
            <button class="add-to-wishlist absolute top-1.5 left-1.5 z-10 w-7 h-7 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center text-gray-500 hover:text-red-500 transition shadow-sm <?php echo $in_wishlist ? 'in-wishlist text-red-500' : ''; ?>" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>" title="<?php esc_attr_e( 'Add to Wishlist', 'fastest_fj' ); ?>">
                <i class="heart-icon <?php echo $in_wishlist ? 'fas text-red-500' : 'far'; ?> fa-heart text-xs"></i>
            </button>

            <!-- Quick View Button (Center Overlay on Hover) -->
            <button class="quick-view-btn absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-9 h-9 bg-white/95 rounded-full flex items-center justify-center text-gray-700 hover:text-brand-gold transition shadow-md opacity-0 group-hover:opacity-100 duration-200" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>" title="<?php esc_attr_e( 'Quick View', 'fastest_fj' ); ?>">
                <i class="fas fa-eye text-xs"></i>
            </button>
        </div>

        <!-- Product Info Section -->
        <div class="product-info flex flex-col text-center">
            <!-- Offer Price Headline -->
            <?php if ( $product->is_on_sale() ) : ?>
                <div class="text-center text-xs font-semibold text-gray-700 mb-1">
                    <?php esc_html_e( 'Blast Offer', 'fastest_fj' ); ?> <span class="text-red-600 font-bold"><?php echo wp_kses_post( wc_price( $product->get_price() ) ); ?></span>
                </div>
            <?php else : ?>
                <div class="text-center text-[11px] font-medium text-gray-500 mb-1 tracking-wide uppercase">
                    <?php esc_html_e( 'Exclusive Offer', 'fastest_fj' ); ?>
                </div>
            <?php endif; ?>

            <!-- Product Title -->
            <h3 class="text-xs sm:text-sm font-semibold text-gray-800 hover:text-brand-gold transition tracking-wide uppercase text-center line-clamp-1 mb-1.5">
                <a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>">
                    <?php echo esc_html( get_the_title( $product->get_id() ) ); ?>
                </a>
            </h3>

            <!-- Price Display Row -->
            <div class="flex items-center justify-center gap-2 mb-2 sm:mb-3 text-center">
                <?php if ( $product->is_on_sale() && $product->get_regular_price() ) : ?>
                    <span class="line-through text-gray-400 text-xs sm:text-sm font-normal">
                        <?php echo wp_kses_post( wc_price( $product->get_regular_price() ) ); ?>
                    </span>
                <?php endif; ?>
                <span class="text-[#F4A24C] font-bold text-sm sm:text-base">
                    <?php echo wp_kses_post( wc_price( $product->get_price() ) ); ?>
                </span>
            </div>
        </div>
    </div>

    <!-- Configurable product action button -->
    <div class="mt-auto pt-1">
        <?php if ( $product->is_in_stock() ) :
            $card_action = fastest_fj_get_product_card_action();
            echo '<!-- fastest_fj product-card action: ' . esc_html( $card_action ) . ' -->';
            if ( 'add_to_cart' === $card_action ) :
                echo wp_kses_post( apply_filters(
                    'woocommerce_loop_add_to_cart_link',
                    sprintf(
                        '<a href="%s" data-quantity="1" class="%s w-full bg-[#F5A647] hover:bg-[#E09335] text-white py-2 sm:py-2.5 rounded-full text-xs sm:text-sm font-bold uppercase tracking-wider text-center block transition duration-200 shadow-sm border-0 !text-white" %s>%s</a>',
                        esc_url( $product->add_to_cart_url() ),
                        esc_attr( implode( ' ', array_filter( array(
                            'button',
                            'product_type_' . $product->get_type(),
                            $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() ? 'fastest_fj_ajax_add_to_cart' : '',
                        ) ) ) ),
                        wc_implode_html_attributes( array(
                            'data-product_id'  => $product->get_id(),
                            'data-product_sku' => $product->get_sku(),
                            'aria-label'       => $product->add_to_cart_description(),
                            'rel'              => 'nofollow',
                        ) ),
                        esc_html( $product->add_to_cart_text() )
                    ),
                    $product,
                    array()
                ) );
            else :
            $buy_now_url = $product->is_type( 'variable' ) ? get_permalink( $product->get_id() ) : add_query_arg( 'add-to-cart', $product->get_id(), wc_get_checkout_url() );
        ?>
            <a href="<?php echo esc_url( $buy_now_url ); ?>" 
               class="buy-now-button w-full bg-[#F5A647] hover:bg-[#E09335] text-white py-2 sm:py-2.5 rounded-full text-xs sm:text-sm font-bold uppercase tracking-wider text-center block transition duration-200 shadow-sm border-0 !text-white">
                <?php esc_html_e( 'BUY NOW', 'fastest_fj' ); ?>
            </a>
            <?php endif; ?>
        <?php else : ?>
            <span class="w-full bg-gray-200 text-gray-500 py-2 sm:py-2.5 rounded-full text-xs sm:text-sm font-bold uppercase tracking-wider text-center block opacity-75 cursor-not-allowed">
                <?php esc_html_e( 'Out of Stock', 'fastest_fj' ); ?>
            </span>
        <?php endif; ?>
    </div>

    <?php
    /**
     * Hook: woocommerce_after_shop_loop_item.
     */
    do_action( 'woocommerce_after_shop_loop_item' );
    ?>
</li>
