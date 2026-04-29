<?php
/**
 * The Template for displaying product archives
 *
 * @package fastest_fj
 */

defined( 'ABSPATH' ) || exit;

get_header();

// Shop header
$title = is_search() ? sprintf( __( 'Search Results: %s', 'fastest_fj' ), get_search_query() ) : woocommerce_page_title( false );
?>

<section class="bg-brand-cream py-10">
    <div class="container mx-auto px-4 text-center">
        <h1 class="font-serif text-3xl sm:text-4xl font-bold mb-2"><?php echo esc_html( $title ); ?></h1>
        <?php if ( is_product_category() ) : ?>
            <?php the_archive_description( '<p class="text-gray-600 text-sm max-w-xl mx-auto">', '</p>' ); ?>
        <?php else : ?>
            <p class="text-gray-600 text-sm"><?php esc_html_e( 'Discover our handcrafted jewelry collection', 'fastest_fj' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="py-10">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Mobile Filter Toggle -->
            <div class="lg:hidden flex items-center justify-between mb-4">
                <button id="filterToggle" class="flex items-center gap-2 bg-brand-dark text-white px-4 py-2 rounded-full text-sm">
                    <i class="fas fa-filter"></i> <?php esc_html_e( 'Filters', 'fastest_fj' ); ?>
                </button>
                <?php //woocommerce_catalog_ordering(); ?>
            </div>

            <!-- Sidebar -->
            <aside id="filterSidebar" class="filter-sidebar fixed inset-y-0 left-0 z-50 w-80 bg-white shadow-xl lg:static lg:w-64 lg:shadow-none lg:transform-none overflow-y-auto lg:h-fit flex-shrink-0">
                <div class="p-6 lg:p-0">
                    <div class="flex justify-between items-center lg:hidden mb-6">
                        <h3 class="font-serif text-xl font-bold"><?php esc_html_e( 'Filters', 'fastest_fj' ); ?></h3>
                        <button id="closeFilter" class="text-xl"><i class="fas fa-times"></i></button>
                    </div>

                    <?php
                    /**
                     * Hook: woocommerce_sidebar.
                     */
                    do_action( 'woocommerce_sidebar' );
                    ?>

                    <!-- Default sidebar if no widgets -->
                    <?php if ( ! is_active_sidebar( 'shop-sidebar' ) ) : ?>
                        <!-- Categories -->
                        <div class="mb-8">
                            <h4 class="font-serif text-lg font-semibold mb-4"><?php esc_html_e( 'Categories', 'fastest_fj' ); ?></h4>
                            <ul class="space-y-2 text-sm">
                                <?php
                                $categories = get_terms( array(
                                    'taxonomy'   => 'product_cat',
                                    'hide_empty' => true,
                                    'parent'     => 0,
                                ) );
                                foreach ( $categories as $cat ) :
                                ?>
                                <li>
                                    <a href="<?php echo esc_url( get_term_link( $cat ) ); ?>" class="flex items-center justify-between hover:text-brand-gold transition">
                                        <span><?php echo esc_html( $cat->name ); ?></span>
                                        <span class="text-gray-400 text-xs">(<?php echo esc_html( $cat->count ); ?>)</span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Price Filter -->
                        <?php //the_widget( 'WC_Widget_Price_Filter', array( 'title' => __( 'Price Range', 'fastest_fj' ) ) ); ?>

                    <?php else : ?>
                        <?php dynamic_sidebar( 'shop-sidebar' ); ?>
                    <?php endif; ?>
                </div>
            </aside>

            <!-- Product Grid -->
            <div class="flex-1">
                <!-- Toolbar -->
                <div class="hidden lg:flex items-center justify-between mb-6">
                    <?php woocommerce_result_count(); ?>
                    <?php woocommerce_catalog_ordering(); ?>
                </div>

                <?php
                if ( woocommerce_product_loop() ) {
                    /**
                     * Hook: woocommerce_before_shop_loop.
                     */
                    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
                    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
                    do_action( 'woocommerce_before_shop_loop' );

                    woocommerce_product_loop_start();

                    if ( wc_get_loop_prop( 'total' ) ) {
                        while ( have_posts() ) {
                            the_post();

                            /**
                             * Hook: woocommerce_shop_loop.
                             */
                            do_action( 'woocommerce_shop_loop' );

                            wc_get_template_part( 'content', 'product' );
                        }
                    }

                    woocommerce_product_loop_end();

                    /**
                     * Hook: woocommerce_after_shop_loop.
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                } else {
                    /**
                     * Hook: woocommerce_no_products_found.
                     */
                    do_action( 'woocommerce_no_products_found' );
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
/**
 * Hook: woocommerce_after_main_content.
 */
do_action( 'woocommerce_after_main_content' );

get_footer();
