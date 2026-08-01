<?php
/**
 * Single Product Floating Sticky Buy Now Bar
 *
 * @package fastest_fj
 */

defined( 'ABSPATH' ) || exit;

global $product;
if ( ! $product ) {
    return;
}

$buy_now_url = $product->is_type( 'variable' ) ? get_permalink( $product->get_id() ) : add_query_arg( 'add-to-cart', $product->get_id(), wc_get_checkout_url() );
$image_url   = wp_get_attachment_image_url( $product->get_image_id(), 'thumbnail' ) ?: wc_placeholder_img_src( 'thumbnail' );
?>

<!-- Floating Sticky Buy Now Bar -->
<div id="floating-buy-bar" class="fixed bottom-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-t border-amber-200/80 shadow-[0_-4px_20px_rgba(0,0,0,0.12)] py-2.5 px-4 transform translate-y-full opacity-0 transition-all duration-300 pointer-events-none">
    <div class="container mx-auto max-w-5xl flex items-center justify-between gap-4">
        
        <!-- Product Image & Title -->
        <div class="flex items-center gap-3 overflow-hidden">
            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>" class="w-10 h-10 object-contain rounded border border-gray-200 flex-shrink-0 bg-white p-0.5">
            <div class="min-w-0">
                <h4 class="font-semibold text-gray-900 text-xs sm:text-sm truncate">
                    <?php echo esc_html( $product->get_name() ); ?>
                </h4>
                <div class="text-[#F4A24C] font-bold text-xs sm:text-sm">
                    <?php echo wp_kses_post( $product->get_price_html() ); ?>
                </div>
            </div>
        </div>

        <!-- Floating Buy Now Button -->
        <div class="flex-shrink-0">
            <a href="<?php echo esc_url( $buy_now_url ); ?>" class="bg-[#F5A647] hover:bg-[#E09335] text-white px-5 sm:px-8 py-2 sm:py-2.5 rounded-full font-bold uppercase text-xs sm:text-sm tracking-wider transition duration-200 shadow-md block text-center border-0 !text-white">
                <?php esc_html_e( 'BUY NOW', 'fastest_fj' ); ?>
            </a>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainBuyBtn = document.querySelector('.buy-now-button') || document.querySelector('.single_add_to_cart_button');
    const floatingBar = document.getElementById('floating-buy-bar');

    if (!mainBuyBtn || !floatingBar) return;

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (!entry.isIntersecting) {
                // Main buy button is NOT visible in viewport -> Show floating bar
                floatingBar.classList.remove('translate-y-full', 'opacity-0', 'pointer-events-none');
                floatingBar.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
            } else {
                // Main buy button IS visible in viewport -> Hide floating bar
                floatingBar.classList.add('translate-y-full', 'opacity-0', 'pointer-events-none');
                floatingBar.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
            }
        });
    }, {
        threshold: 0.1
    });

    observer.observe(mainBuyBtn);
});
</script>
