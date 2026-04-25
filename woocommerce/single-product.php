<?php
/**
 * The Template for displaying all single products
 *
 * @package fastest_fj
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<!-- Breadcrumb -->
<section class="bg-brand-cream py-6">
    <div class="container mx-auto px-4">
        <?php woocommerce_breadcrumb(); ?>
    </div>
</section>

<?php
while ( have_posts() ) :
    the_post();
    ?>

    <main id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
        <div class="container mx-auto px-4 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                <!-- Product Images -->
                <div>
                    <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
                </div>

                <!-- Product Summary -->
                <div class="summary entry-summary">
                    <?php do_action( 'woocommerce_single_product_summary' ); ?>
                </div>

            </div>

            <!-- Product Tabs -->
            <div class="mt-16">
                <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
            </div>
        </div>
    </main>

    <?php do_action( 'woocommerce_after_single_product' ); ?>

<?php endwhile; ?>

<?php
get_footer();
