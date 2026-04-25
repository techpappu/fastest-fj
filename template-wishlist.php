<?php
/**
 * Template Name: Wishlist Page
 *
 * @package fastest_fj
 */

get_header();

if ( ! is_user_logged_in() ) {
    ?>
    <section class="py-24">
        <div class="container mx-auto px-4 text-center">
            <div class="max-w-md mx-auto">
                <div class="w-20 h-20 bg-brand-cream rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-heart text-brand-gold text-3xl"></i>
                </div>
                <h1 class="font-serif text-2xl font-bold mb-3"><?php esc_html_e( 'Please Log In', 'fastest_fj' ); ?></h1>
                <p class="text-gray-600 text-sm mb-6"><?php esc_html_e( 'You need to be logged in to view and manage your wishlist.', 'fastest_fj' ); ?></p>
                <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="inline-block bg-brand-dark text-white px-8 py-3 rounded-full font-semibold hover:bg-brand-gold transition"><?php esc_html_e( 'Log In / Register', 'fastest_fj' ); ?></a>
            </div>
        </div>
    </section>
    <?php
    get_footer();
    return;
}

$wishlist = get_user_meta( get_current_user_id(), '_fastest_fj_wishlist', true );
$wishlist = is_array( $wishlist ) ? array_filter( $wishlist );
$products = array();
if ( ! empty( $wishlist ) ) {
    $products = wc_get_products( array(
        'status' => 'publish',
        'limit'  => -1,
        'include' => $wishlist,
    ) );
}
?>

<main id="primary" class="site-main">
    <section class="py-10">
        <div class="container mx-auto px-4">
            <h1 class="font-serif text-3xl sm:text-4xl font-bold mb-2"><?php esc_html_e( 'My Wishlist', 'fastest_fj' ); ?></h1>
            <p class="text-gray-600 text-sm mb-8"><?php printf( __( '%d items saved', 'fastest_fj' ), count( $products ) ); ?></p>

            <?php if ( ! empty( $products ) ) : ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ( $products as $product ) : ?>
                        <div class="bg-brand-cream rounded-lg overflow-hidden group">
                            <div class="relative aspect-[3/4]">
                                <a href="<?php echo esc_url( $product->get_permalink() ); ?>">
                                    <?php echo wp_kses_post( $product->get_image( 'fastest_fj-product-grid', array( 'class' => 'w-full h-full object-cover' ) ) ); ?>
                                </a>
                                <button class="add-to-wishlist in-wishlist absolute top-3 right-3 w-8 h-8 bg-white rounded-full flex items-center justify-center text-red-500 shadow-sm hover:bg-red-500 hover:text-white transition" data-product-id="<?php echo esc_attr( $product->get_id() ); ?>">
                                    <i class="fas fa-heart"></i>
                                </button>
                            </div>
                            <div class="p-4">
                                <h3 class="font-serif font-semibold"><a href="<?php echo esc_url( $product->get_permalink() ); ?>" class="hover:text-brand-gold transition"><?php echo esc_html( $product->get_name() ); ?></a></h3>
                                <p class="text-brand-orange font-bold mt-1"><?php echo wp_kses_post( $product->get_price_html() ); ?></p>
                                <p class="text-green-600 text-xs mt-1">
                                    <?php if ( $product->is_in_stock() ) : ?>
                                        <i class="fas fa-check-circle mr-1"></i><?php esc_html_e( 'In Stock', 'fastest_fj' ); ?>
                                    <?php else : ?>
                                        <i class="fas fa-times-circle mr-1 text-red-500"></i><?php esc_html_e( 'Out of Stock', 'fastest_fj' ); ?>
                                    <?php endif; ?>
                                </p>
                                <a href="<?php echo esc_url( $product->add_to_cart_url() ); ?>" data-product_id="<?php echo esc_attr( $product->get_id() ); ?>" class="ajax_add_to_cart block w-full bg-brand-dark text-white py-2 rounded-full text-sm font-semibold hover:bg-brand-gold transition text-center mt-3">
                                    <?php esc_html_e( 'Add to Cart', 'fastest_fj' ); ?>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="text-center py-16">
                    <div class="w-20 h-20 bg-brand-cream rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="far fa-heart text-gray-300 text-3xl"></i>
                    </div>
                    <h2 class="font-serif text-xl font-bold mb-3"><?php esc_html_e( 'Your Wishlist is Empty', 'fastest_fj' ); ?></h2>
                    <p class="text-gray-500 text-sm mb-6"><?php esc_html_e( 'Start adding your favorite pieces to your wishlist!', 'fastest_fj' ); ?></p>
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="inline-block bg-brand-dark text-white px-8 py-3 rounded-full font-semibold hover:bg-brand-gold transition"><?php esc_html_e( 'Shop Now', 'fastest_fj' ); ?></a>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
get_footer();
