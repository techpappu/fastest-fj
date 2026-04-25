<?php
/**
 * The template for displaying the front page
 *
 * @package fastest_fj
 */

get_header();

// Get featured categories
$featured_categories = get_terms( array(
    'taxonomy'   => 'product_cat',
    'hide_empty' => true,
    'number'     => 3,
    'parent'     => 0,
) );

// Get new products
$new_products = wc_get_products( array(
    'status'       => 'publish',
    'limit'        => 4,
    'orderby'      => 'date',
    'order'        => 'DESC',
    'stock_status' => 'instock',
) );

// Get featured products
$featured_products = wc_get_products( array(
    'status'       => 'publish',
    'limit'        => 6,
    'featured'     => true,
    'stock_status' => 'instock',
) );

// Get rings category products
$rings_products = wc_get_products( array(
    'status'       => 'publish',
    'limit'        => 4,
    'category'     => array( 'rings' ),
    'stock_status' => 'instock',
) );

$hero_bg = get_theme_mod( 'fastest_fj_hero_bg', '' );
?>

<main id="primary" class="site-main">

    <!-- Hero Section -->
    <section class="relative h-[500px] sm:h-[600px] lg:h-[700px] overflow-hidden">
        <?php if ( $hero_bg ) : ?>
            <img src="<?php echo esc_url( $hero_bg ); ?>" alt="<?php bloginfo( 'name' ); ?>" class="absolute inset-0 w-full h-full object-cover">
        <?php else : ?>
            <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero.jpg' ); ?>" alt="Elegant jewelry" class="absolute inset-0 w-full h-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1599643477877-530eb83abc8e?w=1600&h=800&fit=crop'">
        <?php endif; ?>
        <div class="hero-overlay absolute inset-0"></div>
        <div class="relative z-10 container mx-auto px-4 h-full flex items-center justify-center text-center">
            <div class="max-w-2xl">
                <p class="text-brand-gold text-sm sm:text-base tracking-[0.3em] uppercase mb-4 font-semibold"><?php echo esc_html( get_theme_mod( 'fastest_fj_hero_subtitle', __( 'Handcrafted With Love', 'fastest_fj' ) ) ); ?></p>
                <h1 class="font-serif text-4xl sm:text-5xl lg:text-7xl text-white font-bold mb-6 leading-tight">
                    <?php echo esc_html( get_theme_mod( 'fastest_fj_hero_title', __( "Discover Your\nTimeless Elegance", 'fastest_fj' ) ) ); ?>
                </h1>
                <p class="text-white/90 text-sm sm:text-lg mb-8 max-w-lg mx-auto">
                    <?php echo esc_html( get_theme_mod( 'fastest_fj_hero_desc', __( 'Experience the artistry of handcrafted jewelry designed to illuminate your unique beauty. Each piece is a testament to exceptional craftsmanship and passion.', 'fastest_fj' ) ) ); ?>
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="bg-brand-orange hover:bg-brand-gold text-white px-8 py-3 rounded-full font-semibold transition duration-300">
                        <?php echo esc_html( get_theme_mod( 'fastest_fj_hero_btn1', __( 'Shop Collection', 'fastest_fj' ) ) ); ?>
                    </a>
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>" class="border-2 border-white text-white hover:bg-white hover:text-brand-text px-8 py-3 rounded-full font-semibold transition duration-300">
                        <?php echo esc_html( get_theme_mod( 'fastest_fj_hero_btn2', __( 'Our Story', 'fastest_fj' ) ) ); ?>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Category Cards -->
    <?php if ( ! empty( $featured_categories ) && ! is_wp_error( $featured_categories ) ) : ?>
    <section class="py-12 sm:py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <?php foreach ( $featured_categories as $category ) :
                    $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                    $image = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'fastest_fj-category' ) : wc_placeholder_img_src( 'fastest_fj-category' );
                ?>
                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="category-card relative overflow-hidden rounded-lg aspect-[4/3] sm:aspect-square group">
                    <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $category->name ); ?>" class="category-img w-full h-full object-cover transition duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-6">
                        <div>
                            <h3 class="font-serif text-2xl text-white font-semibold"><?php echo esc_html( $category->name ); ?></h3>
                            <p class="text-white/80 text-sm mt-1"><?php echo esc_html( $category->count ); ?> <?php esc_html_e( 'Products', 'fastest_fj' ); ?></p>
                        </div>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Elegant Design / Featured Products -->
    <section class="py-12 sm:py-16 bg-brand-cream">
        <div class="container mx-auto px-4 text-center">
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-text mb-2"><?php echo esc_html( get_theme_mod( 'fastest_fj_featured_title', __( 'Elegant Design', 'fastest_fj' ) ) ); ?></h2>
            <p class="text-gray-600 text-sm sm:text-base mb-10 max-w-xl mx-auto"><?php echo esc_html( get_theme_mod( 'fastest_fj_featured_desc', __( 'Timeless jewelry crafted to reflect your unique elegance and story', 'fastest_fj' ) ) ); ?></p>

            <?php if ( ! empty( $featured_products ) ) : ?>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 sm:gap-8">
                <?php foreach ( array_slice( $featured_products, 0, 3 ) as $product ) : ?>
                <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                    <div class="aspect-square overflow-hidden rounded-lg mb-4">
                        <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
                            <?php echo wp_kses_post( $product->get_image( 'fastest_fj-product-grid', array( 'class' => 'w-full h-full object-cover hover:scale-105 transition duration-500' ) ) ); ?>
                        </a>
                    </div>
                    <h3 class="font-serif text-lg font-semibold mb-1"><a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="hover:text-brand-gold transition"><?php echo esc_html( $product->get_name() ); ?></a></h3>
                    <p class="text-gray-500 text-sm mb-3"><?php echo esc_html( wc_get_product_category_list( $product->get_id(), ', ' ) ); ?></p>
                    <p class="text-brand-orange font-bold"><?php echo wp_kses_post( $product->get_price_html() ); ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- New Products -->
    <section class="py-12 sm:py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10">
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-text mb-2"><?php esc_html_e( 'New Products', 'fastest_fj' ); ?></h2>
                <p class="text-gray-600 text-sm sm:text-base"><?php esc_html_e( 'From gemstones to metalsmithing, our jewelry designs celebrate love, elegance, and unforgettable moments.', 'fastest_fj' ); ?></p>
            </div>

            <?php if ( ! empty( $new_products ) ) : ?>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <?php foreach ( $new_products as $product ) : setup_postdata( $GLOBALS['post'] =& get_post( $product->get_id() ) ); ?>
                <div <?php wc_product_class( 'product-card group', $product ); ?>>
                    <?php
                       wc_get_template_part( 'content', 'product' );
                        
                    ?>
                </div>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Our Promise -->
    <section class="py-12 sm:py-16 bg-brand-cream">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <div class="bg-white p-6 sm:p-8 rounded-lg text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-brand-cream rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-certificate text-brand-gold text-2xl"></i>
                    </div>
                    <h3 class="font-serif text-lg font-semibold mb-2"><?php echo esc_html( get_theme_mod( 'fastest_fj_promise1_title', __( 'One Year Warranty', 'fastest_fj' ) ) ); ?></h3>
                    <p class="text-gray-500 text-sm"><?php echo esc_html( get_theme_mod( 'fastest_fj_promise1_desc', __( 'Every piece comes with a comprehensive one-year warranty covering craftsmanship and materials.', 'fastest_fj' ) ) ); ?></p>
                </div>
                <div class="bg-white p-6 sm:p-8 rounded-lg text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-brand-cream rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-hands text-brand-gold text-2xl"></i>
                    </div>
                    <h3 class="font-serif text-lg font-semibold mb-2"><?php echo esc_html( get_theme_mod( 'fastest_fj_promise2_title', __( 'Handcrafted', 'fastest_fj' ) ) ); ?></h3>
                    <p class="text-gray-500 text-sm"><?php echo esc_html( get_theme_mod( 'fastest_fj_promise2_desc', __( 'Each jewelry piece is meticulously handcrafted by skilled artisans with decades of experience.', 'fastest_fj' ) ) ); ?></p>
                </div>
                <div class="bg-white p-6 sm:p-8 rounded-lg text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-brand-cream rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-exchange-alt text-brand-gold text-2xl"></i>
                    </div>
                    <h3 class="font-serif text-lg font-semibold mb-2"><?php echo esc_html( get_theme_mod( 'fastest_fj_promise3_title', __( 'Lifetime Exchange', 'fastest_fj' ) ) ); ?></h3>
                    <p class="text-gray-500 text-sm"><?php echo esc_html( get_theme_mod( 'fastest_fj_promise3_desc', __( 'Upgrade or exchange your jewelry anytime. We guarantee the best value for your precious pieces.', 'fastest_fj' ) ) ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Full Width Banner -->
    <section class="relative h-[300px] sm:h-[400px] overflow-hidden">
        <img src="https://images.unsplash.com/photo-1605100804763-247f67b3557e?w=1600&h=500&fit=crop" alt="Diamond collection" class="absolute inset-0 w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="relative z-10 container mx-auto px-4 h-full flex items-center justify-center text-center">
            <div>
                <p class="text-brand-gold text-sm tracking-widest uppercase mb-2"><?php esc_html_e( 'Exclusive Collection', 'fastest_fj' ); ?></p>
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-white font-bold mb-4"><?php esc_html_e( 'Diamonds Are Forever', 'fastest_fj' ); ?></h2>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>?s=diamond" class="inline-block bg-white text-brand-text px-8 py-3 rounded-full font-semibold hover:bg-brand-gold hover:text-white transition">
                    <?php esc_html_e( 'Explore Diamonds', 'fastest_fj' ); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Rings Section -->
    <section class="py-12 sm:py-16 bg-brand-cream">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10">
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-text mb-2"><?php esc_html_e( 'Rings', 'fastest_fj' ); ?></h2>
                <p class="text-gray-600 text-sm sm:text-base"><?php esc_html_e( 'Discover jewelry that blends perfectly with your daily style and lasting charm.', 'fastest_fj' ); ?></p>
            </div>

            <?php if ( ! empty( $rings_products ) ) : ?>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <?php foreach ( $rings_products as $product ) : setup_postdata( $GLOBALS['post'] =& get_post( $product->get_id() ) ); ?>
                <div <?php wc_product_class( 'product-card group', $product ); ?>>
                    <?php
                    do_action( 'woocommerce_before_shop_loop_item' );
                    do_action( 'woocommerce_before_shop_loop_item_title' );
                    do_action( 'woocommerce_shop_loop_item_title' );
                    do_action( 'woocommerce_after_shop_loop_item_title' );
                    do_action( 'woocommerce_after_shop_loop_item' );
                    ?>
                </div>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Product Grid (Featured) -->
    <section class="py-12 sm:py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="text-center mb-10">
                <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-text mb-2"><?php esc_html_e( 'Shop the Collection', 'fastest_fj' ); ?></h2>
                <p class="text-gray-600 text-sm sm:text-base"><?php esc_html_e( 'Handpicked favorites from our master artisans', 'fastest_fj' ); ?></p>
            </div>

            <?php if ( ! empty( $featured_products ) ) : ?>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-6">
                <?php foreach ( $featured_products as $product ) : ?>
                <div class="product-card group text-center">
                    <a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="block">
                        <div class="relative overflow-hidden rounded-lg bg-brand-cream aspect-square mb-2 p-4">
                            <?php echo wp_kses_post( $product->get_image( 'thumbnail', array( 'class' => 'w-full h-full object-cover transition duration-500' ) ) ); ?>
                        </div>
                        <h3 class="text-xs sm:text-sm font-semibold hover:text-brand-gold transition line-clamp-1"><?php echo esc_html( $product->get_name() ); ?></h3>
                        <p class="text-brand-orange font-bold text-sm"><?php echo wp_kses_post( $product->get_price_html() ); ?></p>
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Gift Section -->
    <section class="relative py-16 sm:py-24 overflow-hidden bg-brand-dark">
        <div class="absolute inset-0 opacity-20">
            <img src="https://images.unsplash.com/photo-1515562149394-8f09292c8569?w=1600&h=600&fit=crop" alt="Gift background" class="w-full h-full object-cover">
        </div>
        <div class="relative z-10 container mx-auto px-4 text-center">
            <p class="text-brand-gold text-sm tracking-widest uppercase mb-3"><?php esc_html_e( 'Special Occasions', 'fastest_fj' ); ?></p>
            <h2 class="font-serif text-3xl sm:text-4xl lg:text-5xl text-white font-bold mb-4"><?php esc_html_e( 'Find the Perfect Gift', 'fastest_fj' ); ?></h2>
            <p class="text-white/80 text-sm sm:text-base max-w-lg mx-auto mb-8"><?php esc_html_e( 'Make every moment memorable with our curated collection of exquisite jewelry gifts for your loved ones.', 'fastest_fj' ); ?></p>
            <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="inline-block bg-brand-orange hover:bg-brand-gold text-white px-8 py-3 rounded-full font-semibold transition duration-300"><?php esc_html_e( 'Shop Gifts', 'fastest_fj' ); ?></a>
        </div>
    </section>

    <!-- Shop by Category -->
    <section class="py-12 sm:py-16 bg-brand-cream">
        <div class="container mx-auto px-4">
            <h2 class="font-serif text-3xl sm:text-4xl font-bold text-brand-text text-center mb-10"><?php esc_html_e( 'Shop by Category', 'fastest_fj' ); ?></h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
                <?php
                $shop_categories = get_terms( array(
                    'taxonomy'   => 'product_cat',
                    'hide_empty' => true,
                    'number'     => 4,
                    'parent'     => 0,
                ) );
                if ( ! empty( $shop_categories ) && ! is_wp_error( $shop_categories ) ) :
                    foreach ( $shop_categories as $category ) :
                        $thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true );
                        $image = $thumbnail_id ? wp_get_attachment_image_url( $thumbnail_id, 'fastest_fj-category' ) : wc_placeholder_img_src( 'fastest_fj-category' );
                ?>
                <a href="<?php echo esc_url( get_term_link( $category ) ); ?>" class="group">
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition">
                        <div class="aspect-square overflow-hidden">
                            <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $category->name ); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                        </div>
                        <div class="p-4 text-center">
                            <h3 class="font-serif text-lg font-semibold"><?php echo esc_html( $category->name ); ?></h3>
                            <p class="text-gray-500 text-sm"><?php echo esc_html( $category->count ); ?> <?php esc_html_e( 'Products', 'fastest_fj' ); ?></p>
                        </div>
                    </div>
                </a>
                <?php endforeach; endif; ?>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
