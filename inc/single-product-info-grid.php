<?php
/**
 * Single Product Info Grid Template (Know Your Product & Quality & Care Instructions)
 *
 * @package fastest_fj
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Primary Image for grid 1 & 2
$image1_url = 'https://images.unsplash.com/photo-1630019852942-f89202989a59?w=800&h=800&fit=crop';
$image2_url = 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=800&h=800&fit=crop';

if ( $product ) {
    $gallery_ids = $product->get_gallery_image_ids();
    if ( ! empty( $gallery_ids[0] ) ) {
        $img1 = wp_get_attachment_image_url( $gallery_ids[0], 'large' );
        if ( $img1 ) $image1_url = $img1;
    }
    if ( ! empty( $gallery_ids[1] ) ) {
        $img2 = wp_get_attachment_image_url( $gallery_ids[1], 'large' );
        if ( $img2 ) $image2_url = $img2;
    }
}
?>

<div class="single-product-info-grid py-10 my-10 space-y-12 sm:space-y-16 max-w-6xl mx-auto border-t border-gray-100">
    
    <!-- Row 1: Know Your Product -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-14 items-center">
        <!-- Left: Image -->
        <div class="aspect-square overflow-hidden bg-gray-50 rounded-lg shadow-sm group">
            <img src="<?php echo esc_url( $image1_url ); ?>" alt="<?php esc_attr_e( 'Know Your Product', 'fastest_fj' ); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        </div>
        <!-- Right: Text Content -->
        <div class="flex flex-col justify-center">
            <h3 class="font-serif text-2xl sm:text-3xl font-bold text-gray-900 mb-4">
                <?php esc_html_e( 'Know Your Product', 'fastest_fj' ); ?>
            </h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-6">
                <?php esc_html_e( 'This jewelry is crafted with high-grade imitation stones and premium gold-polished metal, designed to look and shine like real diamond jewelry. It is hypoallergenic & skin-safe, suitable for everyday wear.', 'fastest_fj' ); ?>
            </p>
            <div>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="inline-block text-gray-900 text-sm font-bold border-b-2 border-gray-900 pb-0.5 hover:text-brand-gold hover:border-brand-gold transition">
                    <?php esc_html_e( 'Buy More', 'fastest_fj' ); ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Row 2: Quality & Care Instructions -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-14 items-center">
        <!-- Left: Text Content -->
        <div class="flex flex-col justify-center order-2 md:order-1">
            <h3 class="font-serif text-2xl sm:text-3xl font-bold text-gray-900 mb-4">
                <?php esc_html_e( 'Quality & Care Instructions', 'fastest_fj' ); ?>
            </h3>
            <p class="text-gray-500 text-sm leading-relaxed mb-6">
                <?php esc_html_e( 'To maintain long-lasting shine, keep your jewelry away from water, perfume and excessive sweat. Gently wipe with a soft cloth after use and store in a dry box. Every piece is individually checked before shipping, ensuring premium finish & long-lasting shine. If you face any issues, feel free to contact us — customer satisfaction is our priority.', 'fastest_fj' ); ?>
            </p>
            <div>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="inline-block text-gray-900 text-sm font-bold border-b-2 border-gray-900 pb-0.5 hover:text-brand-gold hover:border-brand-gold transition">
                    <?php esc_html_e( 'Buy More', 'fastest_fj' ); ?>
                </a>
            </div>
        </div>
        <!-- Right: Image -->
        <div class="aspect-square overflow-hidden bg-gray-50 rounded-lg shadow-sm group order-1 md:order-2">
            <img src="<?php echo esc_url( $image2_url ); ?>" alt="<?php esc_attr_e( 'Quality & Care Instructions', 'fastest_fj' ); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
        </div>
    </div>

</div>
