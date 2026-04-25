<?php
/**
 * The template for displaying all WooCommerce pages
 *
 * @package fastest_fj
 */

get_header();
?>

<?php
// Output WooCommerce breadcrumb
if ( function_exists( 'woocommerce_breadcrumb' ) && ! is_front_page() ) {
    woocommerce_breadcrumb();
}
?>

<main id="primary" class="site-main">
    <?php woocommerce_content(); ?>
</main>

<?php
get_footer();
