<?php
/**
 * Single Product Special Offer & Hurry Stock Urgency Box
 *
 * @package fastest_fj
 */

defined( 'ABSPATH' ) || exit;

global $product;
if ( ! $product ) {
    return;
}

$product_id = $product->get_id();
// Seed pseudo-random values based on Product ID for organic realistic feel
$initial_sold  = 280 + ( ($product_id * 37) % 180 );
$initial_stock = 7 + ( ($product_id * 13) % 11 );
$progress_pct  = max(15, min(92, round(($initial_stock / 25) * 100)));
?>

<!-- Special Offer List -->
<div class="special-offer-section my-5 font-sans">
    <h4 class="text-emerald-600 text-base sm:text-lg font-bold mb-2 flex items-center gap-1">
        <?php esc_html_e( 'Special Offer', 'fastest_fj' ); ?>
    </h4>
    <ul class="space-y-1.5 text-xs sm:text-sm text-emerald-600 font-semibold">
        <li class="flex items-center gap-2">
            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full inline-block"></span>
            <span><?php esc_html_e( 'In Stock', 'fastest_fj' ); ?></span>
        </li>
        <li class="flex items-center gap-2">
            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full inline-block"></span>
            <span>🚚 <?php esc_html_e( 'Free delivery if you order more than ৳2000*', 'fastest_fj' ); ?></span>
        </li>
        <li class="flex items-center gap-2">
            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full inline-block"></span>
            <span>🏷️ <?php esc_html_e( 'Special Discount Available', 'fastest_fj' ); ?></span>
        </li>
    </ul>
</div>

<!-- Stock Hurry Urgency Box (JS Illusion Effect) -->
<div class="urgency-stock-box bg-[#FFF6F6] border border-[#FF6B6B] rounded-lg p-4 my-5 shadow-sm">
    <div class="flex items-center gap-2 text-gray-900 font-bold text-xs sm:text-sm mb-1.5">
        <span class="text-base animate-pulse">🔥</span>
        <span><strong id="urgency-sold-count"><?php echo esc_html( $initial_sold ); ?></strong> <?php esc_html_e( 'sold in last 14 hours', 'fastest_fj' ); ?></span>
    </div>

    <div class="text-[#D93838] font-black text-xs sm:text-sm tracking-wider uppercase mb-2.5">
        <?php esc_html_e( 'HURRY! ONLY', 'fastest_fj' ); ?> <span id="urgency-stock-left"><?php echo esc_html( $initial_stock ); ?></span> <?php esc_html_e( 'LEFT IN STOCK', 'fastest_fj' ); ?>
    </div>

    <!-- Progress Bar -->
    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
        <div id="urgency-progress-bar" class="bg-gradient-to-r from-orange-500 to-red-500 h-full rounded-full transition-all duration-700 ease-out" style="width: <?php echo esc_attr( $progress_pct ); ?>%;"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const soldElem = document.getElementById('urgency-sold-count');
    const stockElem = document.getElementById('urgency-stock-left');
    const progressElem = document.getElementById('urgency-progress-bar');

    if (!soldElem || !stockElem || !progressElem) return;

    let currentSold = parseInt(soldElem.textContent, 10) || <?php echo (int) $initial_sold; ?>;
    let currentStock = parseInt(stockElem.textContent, 10) || <?php echo (int) $initial_stock; ?>;

    setInterval(function() {
        if (Math.random() > 0.6 && currentStock > 3) {
            currentSold += 1;
            currentStock -= 1;
            soldElem.textContent = currentSold;
            stockElem.textContent = currentStock;

            let newPct = Math.max(10, Math.round((currentStock / 25) * 100));
            progressElem.style.width = newPct + '%';
        }
    }, 12000);
});
</script>
