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
    global $product;
    ?>

    <main id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
        <div class="container mx-auto px-4 py-10">
            <?php wc_print_notices(); ?>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">

                <!-- Product Images -->
                <div>
                    <?php
                    $attachment_ids = $product->get_gallery_image_ids();
                    $featured_id    = $product->get_image_id();
                    if ( $featured_id ) {
                        array_unshift( $attachment_ids, $featured_id );
                    }
                    ?>
                    <div class="product-gallery">
                        <div class="bg-brand-cream rounded-lg overflow-hidden mb-4 aspect-[2/2]">
                            <?php
                            if ( $featured_id ) {
                                echo wp_get_attachment_image( $featured_id, 'fastest_fj-product-single', false, array(
                                    'id'    => 'main-product-image',
                                    'class' => 'w-full h-full object-contain',
                                ) );
                            }
                            ?>
                        </div>
                        <?php if ( count( $attachment_ids ) > 1 ) : ?>
                        <div class="grid grid-cols-4 gap-3">
                            <?php foreach ( $attachment_ids as $index => $attachment_id ) : ?>
                                <button class="thumbnail <?php echo $index === 0 ? 'active' : ''; ?> aspect-square rounded-lg overflow-hidden border-2 <?php echo $index === 0 ? 'border-brand-gold' : 'border-transparent'; ?> hover:border-brand-gold transition" data-image="<?php echo esc_url( wp_get_attachment_image_url( $attachment_id, 'fastest_fj-product-single' ) ); ?>">
                                    <?php echo wp_get_attachment_image( $attachment_id, 'thumbnail', false, array( 'class' => 'w-full h-full object-cover' ) ); ?>
                                </button>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Product Summary -->
                <div class="summary entry-summary">
                    <div class="product-summary">
                        <!-- Meta & Badges -->
                        <div class="flex items-center gap-2 mb-2 flex-wrap">
                            <?php if ( $product->is_on_sale() ) : ?>
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded font-semibold"><?php esc_html_e( 'SALE', 'fastest_fj' ); ?></span>
                            <?php endif; ?>
                            <?php
                            $created = strtotime( $product->get_date_created() );
                            if ( ( time() - $created ) < 30 * DAY_IN_SECONDS ) :
                            ?>
                                <span class="bg-brand-orange text-white text-xs px-2 py-1 rounded font-semibold"><?php esc_html_e( 'NEW', 'fastest_fj' ); ?></span>
                            <?php endif; ?>
                            <?php if ( $product->get_average_rating() > 0 ) : ?>
                                <div class="flex text-yellow-400 text-xs">
                                    <?php echo wc_get_rating_html( $product->get_average_rating() ); ?>
                                </div>
                                <span class="text-gray-500 text-xs">(<?php echo esc_html( $product->get_review_count() ); ?> <?php esc_html_e( 'Reviews', 'fastest_fj' ); ?>)</span>
                            <?php endif; ?>
                        </div>

                        <!-- Title -->
                        <h1 class="text-1xl font-bold"><?php the_title(); ?></h1>
                        <!-- Price -->
                        <div class="flex items-center gap-3 mb-6">
                            <span class="text-brand-orange font-bold text-1xl"><?php echo wp_kses_post( $product->get_price_html() ); ?></span>
                            <?php if ( $product->is_on_sale() && $product->get_regular_price() ) :
                                $saved = floatval( $product->get_regular_price() ) - floatval( $product->get_sale_price() );
                                if ( $saved > 0 ) : ?>
                                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded font-semibold">
                                    <?php printf( __( 'Save %s', 'fastest_fj' ), wc_price( $saved ) ); ?>
                                </span>
                            <?php endif; endif; ?>
                        </div>
                        <!-- Add to Cart -->
                        <?php
                        if ( ! $product->is_type( 'variable' ) ) {
                            $link = sprintf(
                                '<a href="%s" class="buy-now-button w-full bg-brand-gold text-white py-2 rounded-full text-sm font-semibold hover:bg-brand-dark transition text-center block !text-white mt-2">%s</a>',
                                esc_url( add_query_arg( 'add-to-cart', $product->get_id(), wc_get_checkout_url() ) ),
                                esc_html__( 'Buy Now', 'fastest_fj' )
                            );
                            echo $link;
                        } else{
                            woocommerce_template_single_add_to_cart();
                        } ?> 

                        <!-- Short Description -->
                        <?php if ( $product->get_short_description() ) : ?>
                            <p class="text-gray-500 text-sm mb-4"><?php echo wp_kses_post( $product->get_short_description() ); ?></p>
                        <?php endif; ?>
                           

                        <!-- Description -->
                        <div class="text-gray-600 text-sm leading-relaxed mb-6">
                            <?php the_content(); ?>
                        </div>

                        

                        <!-- Product Meta -->
                        <div class="space-y-2 text-sm text-gray-500 border-t border-gray-100 pt-4 mt-6">
                            <p><span class="font-semibold text-brand-text"><?php esc_html_e( 'SKU:', 'fastest_fj' ); ?></span> <?php echo esc_html( $product->get_sku() ? $product->get_sku() : __( 'N/A', 'fastest_fj' ) ); ?></p>
                            <p><span class="font-semibold text-brand-text"><?php esc_html_e( 'Category:', 'fastest_fj' ); ?></span> <?php echo wp_kses_post( wc_get_product_category_list( $product->get_id(), ', ' ) ); ?></p>
                            <?php if ( wc_get_product_tag_list( $product->get_id() ) ) : ?>
                                <p><span class="font-semibold text-brand-text"><?php esc_html_e( 'Tags:', 'fastest_fj' ); ?></span> <?php echo wp_kses_post( wc_get_product_tag_list( $product->get_id(), ', ' ) ); ?></p>
                            <?php endif; ?>
                            <p class="flex items-center gap-2 pt-2">
                                <span class="font-semibold text-brand-text"><?php esc_html_e( 'Share:', 'fastest_fj' ); ?></span>
                                <span class="flex gap-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>" target="_blank" class="w-8 h-8 bg-brand-cream rounded-full flex items-center justify-center text-gray-500 hover:text-brand-gold transition"><i class="fab fa-facebook-f text-xs"></i></a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( get_permalink() ); ?>&text=<?php echo esc_attr( get_the_title() ); ?>" target="_blank" class="w-8 h-8 bg-brand-cream rounded-full flex items-center justify-center text-gray-500 hover:text-brand-gold transition"><i class="fab fa-twitter text-xs"></i></a>
                                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url( get_permalink() ); ?>&media=<?php echo esc_url( get_the_post_thumbnail_url() ); ?>&description=<?php echo esc_attr( get_the_title() ); ?>" target="_blank" class="w-8 h-8 bg-brand-cream rounded-full flex items-center justify-center text-gray-500 hover:text-brand-gold transition"><i class="fab fa-pinterest-p text-xs"></i></a>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Product Tabs -->
            <div class="mt-16">
                <?php
                $product_tabs = apply_filters( 'woocommerce_product_tabs', array() );
                if ( isset( $product_tabs['reviews'] ) ) {
                    unset( $product_tabs['reviews'] );
                }
                if ( ! empty( $product_tabs ) ) : ?>
                    <div class="custom-product-tabs mb-12">
                        <div class="border-b border-gray-200">
                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500" role="tablist">
                                <?php $i = 0; foreach ( $product_tabs as $key => $tab ) : ?>
                                    <li class="mr-2" role="presentation">
                                        <button class="tab-button inline-block p-4 border-b-2 rounded-t-lg hover:text-brand-gold hover:border-brand-gold transition-colors <?php echo $i === 0 ? 'border-brand-gold text-brand-gold' : 'border-transparent'; ?>" 
                                                id="tab-title-<?php echo esc_attr( $key ); ?>" 
                                                data-target="#tab-<?php echo esc_attr( $key ); ?>" 
                                                type="button" role="tab" 
                                                aria-controls="tab-<?php echo esc_attr( $key ); ?>" 
                                                aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>">
                                            <?php echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ) ); ?>
                                        </button>
                                    </li>
                                <?php $i++; endforeach; ?>
                            </ul>
                        </div>
                        <div class="tab-content mt-6">
                            <?php $i = 0; foreach ( $product_tabs as $key => $tab ) : ?>
                                <div class="tab-pane <?php echo $i === 0 ? 'block' : 'hidden'; ?>" 
                                     id="tab-<?php echo esc_attr( $key ); ?>" 
                                     role="tabpanel" 
                                     aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                                    <div class="text-gray-600 text-sm leading-relaxed">
                                        <?php
                                        if ( isset( $tab['callback'] ) ) {
                                            call_user_func( $tab['callback'], $key, $tab );
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php $i++; endforeach; ?>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const tabButtons = document.querySelectorAll('.custom-product-tabs .tab-button');
                            const tabPanes = document.querySelectorAll('.custom-product-tabs .tab-pane');

                            tabButtons.forEach(button => {
                                button.addEventListener('click', () => {
                                    tabButtons.forEach(btn => {
                                        btn.classList.remove('border-brand-gold', 'text-brand-gold');
                                        btn.classList.add('border-transparent');
                                        btn.setAttribute('aria-selected', 'false');
                                    });

                                    tabPanes.forEach(pane => {
                                        pane.classList.remove('block');
                                        pane.classList.add('hidden');
                                    });

                                    button.classList.remove('border-transparent');
                                    button.classList.add('border-brand-gold', 'text-brand-gold');
                                    button.setAttribute('aria-selected', 'true');

                                    const targetId = button.getAttribute('data-target');
                                    const targetPane = document.querySelector(targetId);
                                    if (targetPane) {
                                        targetPane.classList.remove('hidden');
                                        targetPane.classList.add('block');
                                    }
                                });
                            });
                        });
                    </script>
                <?php endif; ?>

                <?php 
                remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
                do_action('woocommerce_after_single_product_summary');
                ?>
            </div>
        </div>
    </main>

<?php endwhile; ?>

<?php
get_footer();
