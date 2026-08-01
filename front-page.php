<?php
/**
 * The template for displaying the front page matching fashion.stylebari.com
 *
 * @package fastest_fj
 */

get_header();

// Get featured categories
$featured_categories = get_terms(array(
    'taxonomy' => 'product_cat',
    'hide_empty' => true,
    'number' => 4,
    'parent' => 0,
));

// Transient Caching for Front Page Product Queries (Speed Optimization)
$new_products = get_transient( 'fastest_fj_new_products' );
if ( false === $new_products ) {
    $new_products = wc_get_products(array(
        'status' => 'publish',
        'limit' => 4,
        'orderby' => 'date',
        'order' => 'DESC',
        'stock_status' => 'instock',
    ));
    set_transient( 'fastest_fj_new_products', $new_products, 12 * HOUR_IN_SECONDS );
}

$nose_pin_products = get_transient( 'fastest_fj_nose_pin_products' );
if ( false === $nose_pin_products ) {
    $nose_pin_products = wc_get_products(array(
        'status' => 'publish',
        'limit' => 4,
        'category' => array('nose-pin', 'nosepin', 'nose_pin'),
        'stock_status' => 'instock',
    ));
    if (empty($nose_pin_products)) {
        $nose_pin_products = $new_products;
    }
    set_transient( 'fastest_fj_nose_pin_products', $nose_pin_products, 12 * HOUR_IN_SECONDS );
}

$rings_products = get_transient( 'fastest_fj_rings_products' );
if ( false === $rings_products ) {
    $rings_products = wc_get_products(array(
        'status' => 'publish',
        'limit' => 4,
        'category' => array('rings', 'ring'),
        'stock_status' => 'instock',
    ));
    if (empty($rings_products)) {
        $rings_products = $new_products;
    }
    set_transient( 'fastest_fj_rings_products', $rings_products, 12 * HOUR_IN_SECONDS );
}

$hero_bg = get_theme_mod('fastest_fj_hero_bg', '');
?>

<main id="primary" class="site-main">

    <!-- Hero Section (LCP Optimized) -->
    <section class="relative h-[450px] sm:h-[550px] lg:h-[650px] overflow-hidden mb-6">
        <?php if ($hero_bg): ?>
            <img src="<?php echo esc_url($hero_bg); ?>" alt="<?php bloginfo('name'); ?>"
                class="absolute inset-0 w-full h-full object-cover"
                loading="eager" fetchpriority="high" decoding="async">
        <?php else: ?>
            <img src="https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?w=1600&h=800&fit=crop"
                alt="Discover Your Timeless Elegance" class="absolute inset-0 w-full h-full object-cover"
                loading="eager" fetchpriority="high" decoding="async"
                onerror="this.src='https://images.unsplash.com/photo-1599643477877-530eb83abc8e?w=1600&h=800&fit=crop'">
        <?php endif; ?>
        <div class="hero-overlay absolute inset-0 bg-black/40"></div>
        <div class="relative z-10 container mx-auto px-4 h-full flex items-center justify-center text-center">
            <div class="max-w-2xl">
                <h1 class="font-serif text-3xl sm:text-5xl lg:text-6xl text-white font-bold mb-5 leading-tight">
                    <?php echo esc_html(get_theme_mod('fastest_fj_hero_title', __("Discover Your Timeless Elegance", 'fastest_fj'))); ?>
                </h1>
                <p class="text-white/90 text-sm sm:text-base mb-8 max-w-lg mx-auto">
                    <?php echo esc_html(get_theme_mod('fastest_fj_hero_desc', __('Experience the artistry of handcrafted jewelry designed to illuminate your unique beauty. Each piece is a statement of sophistication, crafted with passion and precision.', 'fastest_fj'))); ?>
                </p>
                <div class="flex justify-center">
                    <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"
                        class="border-2 border-[#F5A647] text-white hover:bg-[#F5A647] hover:text-white px-8 py-2.5 rounded-md font-medium text-sm transition duration-300">
                        <?php echo esc_html(get_theme_mod('fastest_fj_hero_btn1', __('Explore Collection', 'fastest_fj'))); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- 3 Category Banners Grid (Necklace, Earring, Gold Ring) -->
    <section class="py-6 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 max-w-6xl mx-auto">
                <!-- Necklace Banner -->
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>?category=necklace" class="group block border border-gray-800 overflow-hidden bg-[#d7d57f] p-4 flex items-center justify-between transition hover:shadow-md">
                    <div class="w-1/2 aspect-square flex items-center justify-center overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?w=400&h=400&fit=crop" alt="Necklace" class="object-contain max-h-full transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="w-1/2 text-right pl-3">
                        <h3 class="font-bold text-gray-900 text-sm sm:text-base tracking-wider uppercase mb-1">NECKLACE</h3>
                        <p class="text-xs sm:text-sm font-semibold text-gray-800">Sale off 40%</p>
                    </div>
                </a>

                <!-- Earring Banner -->
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>?category=earring" class="group block border border-gray-800 overflow-hidden bg-[#f8e392] p-4 flex items-center justify-between transition hover:shadow-md">
                    <div class="w-1/2 aspect-square flex items-center justify-center overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1630019852942-f89202989a59?w=400&h=400&fit=crop" alt="Earring" class="object-contain max-h-full transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="w-1/2 text-right pl-3">
                        <h3 class="font-bold text-gray-900 text-sm sm:text-base tracking-wider uppercase mb-1">EARRING</h3>
                        <p class="text-xs sm:text-sm font-semibold text-gray-800">Extra 40% off</p>
                    </div>
                </a>

                <!-- Gold Ring Banner -->
                <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>?category=rings" class="group block border border-gray-800 overflow-hidden bg-[#7ae8e8] p-4 flex items-center justify-between transition hover:shadow-md">
                    <div class="w-1/2 aspect-square flex items-center justify-center overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=400&h=400&fit=crop" alt="Gold Ring" class="object-contain max-h-full transition duration-300 group-hover:scale-105">
                    </div>
                    <div class="w-1/2 text-right pl-3">
                        <h3 class="font-bold text-gray-900 text-sm sm:text-base tracking-wider uppercase mb-1">GOLD RING</h3>
                        <p class="text-xs sm:text-sm font-semibold text-gray-800">Up to 40% off</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- ELEGANT DESIGN Section -->
    <section class="py-12 sm:py-16 bg-[#FFF3EC]">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10">
                <h2 class="font-serif text-2xl sm:text-4xl font-bold text-gray-900 tracking-wider uppercase mb-2">
                    <?php esc_html_e('ELEGANT DESIGN', 'fastest_fj'); ?>
                </h2>
                <!-- Star Ornament Divider -->
                <div class="flex items-center justify-center gap-3 text-[#F5A647] mb-3">
                    <span class="h-[1px] w-16 bg-amber-300"></span>
                    <span class="text-sm">✡</span>
                    <span class="h-[1px] w-16 bg-amber-300"></span>
                </div>
                <p class="text-gray-700 text-xs sm:text-sm font-semibold uppercase tracking-widest max-w-2xl mx-auto">
                    <?php esc_html_e('TIMELESS JEWELRY CRAFTED TO REFLECT YOUR UNIQUE ELEGANCE AND STORY', 'fastest_fj'); ?>
                </p>
            </div>

            <!-- 3 Feature Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8 max-w-6xl mx-auto">
                <!-- Card 1: Where Elegance Begins -->
                <div class="bg-white p-6 border-4 border-[#D9D9D9] text-center shadow-sm flex flex-col items-center justify-between">
                    <div class="w-full aspect-square border border-[#F5A647] p-4 flex items-center justify-center bg-gray-50 mb-6">
                        <img src="https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=400&h=400&fit=crop" alt="Where Elegance Begins" class="max-h-full max-w-full object-contain">
                    </div>
                    <div>
                        <h3 class="font-serif text-lg font-bold text-gray-900 mb-2">Where Elegance Begins</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">
                            Discover handcrafted jewelry that speaks your story — timeless, radiant, and uniquely yours.
                        </p>
                    </div>
                </div>

                <!-- Card 2: Crafted for Moments -->
                <div class="bg-white p-6 border-4 border-[#D9D9D9] text-center shadow-sm flex flex-col items-center justify-between">
                    <div class="w-full aspect-square border border-[#F5A647] p-4 flex items-center justify-center bg-gray-50 mb-6">
                        <img src="https://images.unsplash.com/photo-1630019852942-f89202989a59?w=400&h=400&fit=crop" alt="Crafted for Moments" class="max-h-full max-w-full object-contain">
                    </div>
                    <div>
                        <h3 class="font-serif text-lg font-bold text-gray-900 mb-2">Crafted for Moments</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">
                            Every piece is a promise — of beauty, memory, and timeless grace.
                        </p>
                    </div>
                </div>

                <!-- Card 3: Shine with Purpose (Highlighted with Gold Border & Gold Title) -->
                <div class="bg-white p-6 border-4 border-[#C9A961] text-center shadow-sm flex flex-col items-center justify-between">
                    <div class="w-full aspect-square border border-[#F5A647] p-4 flex items-center justify-center bg-gray-50 mb-6">
                        <img src="https://images.unsplash.com/photo-1603561591411-07134e71a2a9?w=400&h=400&fit=crop" alt="Shine with Purpose" class="max-h-full max-w-full object-contain">
                    </div>
                    <div>
                        <h3 class="font-serif text-lg font-bold text-[#C9A961] mb-2">Shine with Purpose</h3>
                        <p class="text-gray-500 text-xs leading-relaxed">
                            Wear jewelry that empowers your elegance and reflects who you are.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NEW PRODUCTS Section (New Year 26 Taka Blast Offer) -->
    <section class="py-10 sm:py-14 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="font-serif text-2xl sm:text-4xl font-bold text-gray-900 mb-2">
                    <?php esc_html_e('NEW PRODUCTS', 'fastest_fj'); ?>
                </h2>
                <p class="text-gray-600 text-xs sm:text-sm max-w-2xl mx-auto mb-3">
                    <?php esc_html_e('From proposals to anniversaries, our timeless designs celebrate love, elegance, and unforgettable memories.', 'fastest_fj'); ?>
                </p>
                <!-- Star Ornament Divider -->
                <div class="flex items-center justify-center gap-3 text-[#F5A647]">
                    <span class="h-[1px] w-12 bg-amber-300"></span>
                    <span class="text-sm">✦</span>
                    <span class="h-[1px] w-12 bg-amber-300"></span>
                </div>
            </div>

            <?php if (!empty($new_products)): ?>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 max-w-6xl mx-auto">
                    <?php foreach ($new_products as $product):
                        $GLOBALS['post'] = get_post($product->get_id());
                        setup_postdata($GLOBALS['post']);
                        wc_get_template_part('content', 'product');
                    endforeach;
                    wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Promises / Trust Badges (One year warranty, Refundable, Lifetime Exchange) -->
    <section class="py-10 bg-brand-cream border-y border-amber-100">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-center max-w-5xl mx-auto">
                <div class="bg-white p-6 rounded-md shadow-sm border border-amber-200/60 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-brand-cream rounded-full flex items-center justify-center mx-auto mb-3 text-brand-gold">
                        <i class="fas fa-certificate text-2xl"></i>
                    </div>
                    <h3 class="font-serif text-base font-bold text-gray-900 mb-1">
                        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="hover:text-brand-gold">
                            <?php esc_html_e('One Year Warranty', 'fastest_fj'); ?>
                        </a>
                    </h3>
                    <p class="text-gray-500 text-xs">
                        <?php esc_html_e('Comprehensive one-year warranty on craftsmanship and materials.', 'fastest_fj'); ?>
                    </p>
                </div>
                <div class="bg-white p-6 rounded-md shadow-sm border border-amber-200/60 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-brand-cream rounded-full flex items-center justify-center mx-auto mb-3 text-brand-gold">
                        <i class="fas fa-undo-alt text-2xl"></i>
                    </div>
                    <h3 class="font-serif text-base font-bold text-gray-900 mb-1">
                        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="hover:text-brand-gold">
                            <?php esc_html_e('100% Refundable', 'fastest_fj'); ?>
                        </a>
                    </h3>
                    <p class="text-gray-500 text-xs">
                        <?php esc_html_e('Hassle-free 100% money back return policy for your peace of mind.', 'fastest_fj'); ?>
                    </p>
                </div>
                <div class="bg-white p-6 rounded-md shadow-sm border border-amber-200/60 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-brand-cream rounded-full flex items-center justify-center mx-auto mb-3 text-brand-gold">
                        <i class="fas fa-sync-alt text-2xl"></i>
                    </div>
                    <h3 class="font-serif text-base font-bold text-gray-900 mb-1">
                        <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>" class="hover:text-brand-gold">
                            <?php esc_html_e('Lifetime Exchange & Buyback', 'fastest_fj'); ?>
                        </a>
                    </h3>
                    <p class="text-gray-500 text-xs">
                        <?php esc_html_e('Upgrade or exchange your jewelry anytime with guaranteed value.', 'fastest_fj'); ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Nose Pin Section -->
    <section class="py-10 sm:py-14 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="font-serif text-2xl sm:text-4xl font-bold text-gray-900 mb-2">
                    <?php esc_html_e('Nose Pin', 'fastest_fj'); ?>
                </h2>
                <p class="text-gray-600 text-xs sm:text-sm max-w-2xl mx-auto mb-3">
                    <?php esc_html_e('discover jewelry that blends perfectly with your daily style and lasting charm.', 'fastest_fj'); ?>
                </p>
                <!-- Star Ornament Divider -->
                <div class="flex items-center justify-center gap-3 text-[#F5A647]">
                    <span class="h-[1px] w-12 bg-amber-300"></span>
                    <span class="text-sm">✦</span>
                    <span class="h-[1px] w-12 bg-amber-300"></span>
                </div>
            </div>

            <?php if (!empty($nose_pin_products)): ?>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 max-w-6xl mx-auto">
                    <?php foreach ($nose_pin_products as $product):
                        $GLOBALS['post'] = get_post($product->get_id());
                        setup_postdata($GLOBALS['post']);
                        wc_get_template_part('content', 'product');
                    endforeach;
                    wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Rings Section -->
    <section class="py-10 sm:py-14 bg-brand-cream border-t border-amber-100">
        <div class="container mx-auto px-4">
            <div class="text-center mb-8">
                <h2 class="font-serif text-2xl sm:text-4xl font-bold text-gray-900 mb-2">
                    <?php esc_html_e('Rings', 'fastest_fj'); ?>
                </h2>
                <p class="text-gray-600 text-xs sm:text-sm max-w-2xl mx-auto mb-3">
                    <?php esc_html_e('discover jewelry that blends perfectly with your daily style and lasting charm.', 'fastest_fj'); ?>
                </p>
                <!-- Star Ornament Divider -->
                <div class="flex items-center justify-center gap-3 text-[#F5A647]">
                    <span class="h-[1px] w-12 bg-amber-300"></span>
                    <span class="text-sm">✦</span>
                    <span class="h-[1px] w-12 bg-amber-300"></span>
                </div>
            </div>

            <?php if (!empty($rings_products)): ?>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 max-w-6xl mx-auto">
                    <?php foreach ($rings_products as $product):
                        $GLOBALS['post'] = get_post($product->get_id());
                        setup_postdata($GLOBALS['post']);
                        wc_get_template_part('content', 'product');
                    endforeach;
                    wp_reset_postdata(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Find the Perfect Gift Section -->
    <section class="relative py-16 sm:py-20 overflow-hidden bg-brand-dark">
        <div class="absolute inset-0 opacity-25">
            <img src="https://images.unsplash.com/photo-1515562149394-8f09292c8569?w=1600&h=600&fit=crop"
                alt="Gift background" class="w-full h-full object-cover">
        </div>
        <div class="relative z-10 container mx-auto px-4 text-center">
            <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-white font-bold mb-4">
                <?php esc_html_e('Find the Perfect Gift', 'fastest_fj'); ?>
            </h2>
            <p class="text-white/80 text-xs sm:text-sm max-w-lg mx-auto mb-8">
                <?php esc_html_e('Make every moment memorable with our curated collection of exquisite jewelry gifts for your loved ones.', 'fastest_fj'); ?>
            </p>
            <a href="<?php echo esc_url(wc_get_page_permalink('shop')); ?>"
                class="inline-block bg-[#F5A647] hover:bg-[#E09335] text-white px-8 py-3 rounded-md font-semibold transition duration-300 shadow-lg">
                <?php esc_html_e('Shop Gifts', 'fastest_fj'); ?>
            </a>
        </div>
    </section>

</main>

<?php
get_footer();
