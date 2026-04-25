<?php
/**
 * The template for displaying 404 pages
 *
 * @package fastest_fj
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-24 text-center">
        <div class="max-w-lg mx-auto">
            <div class="w-24 h-24 bg-brand-cream rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-search text-brand-gold text-4xl"></i>
            </div>
            <h1 class="font-serif text-6xl font-bold text-brand-text mb-4">404</h1>
            <h2 class="font-serif text-2xl font-bold mb-4"><?php esc_html_e( 'Page Not Found', 'fastest_fj' ); ?></h2>
            <p class="text-gray-600 mb-8"><?php esc_html_e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'fastest_fj' ); ?></p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="bg-brand-dark text-white px-8 py-3 rounded-full font-semibold hover:bg-brand-gold transition">
                    <i class="fas fa-home mr-2"></i><?php esc_html_e( 'Back to Home', 'fastest_fj' ); ?>
                </a>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="border-2 border-brand-dark text-brand-dark px-8 py-3 rounded-full font-semibold hover:bg-brand-dark hover:text-white transition">
                    <i class="fas fa-shopping-bag mr-2"></i><?php esc_html_e( 'Shop Now', 'fastest_fj' ); ?>
                </a>
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
