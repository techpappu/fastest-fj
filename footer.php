<?php
/**
 * The template for displaying the footer
 *
 * @package fastest_fj
 */
?>

    <!-- Newsletter Section -->
    <?php if ( is_front_page() || is_page_template( 'template-fullwidth.php' ) ) : ?>
    <section class="py-12 sm:py-16 bg-white border-t border-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <div class="lg:w-1/2 text-center lg:text-left">
                    <h3 class="font-serif text-2xl sm:text-3xl font-bold mb-2"><?php esc_html_e( 'Join Our Newsletter', 'fastest_fj' ); ?></h3>
                    <p class="text-gray-600 text-sm sm:text-base"><?php esc_html_e( 'Subscribe for exclusive offers and new collection updates.', 'fastest_fj' ); ?></p>
                </div>
                <div class="lg:w-1/2 w-full max-w-md">
                    <?php
                    if ( function_exists( 'mc4wp_show_form' ) ) {
                        mc4wp_show_form();
                    } else {
                    ?>
                    <form class="flex gap-2 newsletter-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                        <input type="hidden" name="action" value="fastest_fj_newsletter">
                        <?php wp_nonce_field( 'fastest_fj_newsletter', 'newsletter_nonce' ); ?>
                        <input type="email" name="email" placeholder="<?php esc_attr_e( 'Enter your email', 'fastest_fj' ); ?>" required class="flex-1 px-4 py-3 border border-gray-200 rounded-full text-sm focus:outline-none focus:border-brand-gold">
                        <button type="submit" class="bg-brand-dark text-white px-6 py-3 rounded-full text-sm font-semibold hover:bg-brand-gold transition whitespace-nowrap"><?php esc_html_e( 'Subscribe', 'fastest_fj' ); ?></button>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Footer -->
    <footer class="bg-brand-dark text-white">
        <!-- Stay Connected Bar -->
        <div class="border-b border-white/10 py-6">
            <div class="container mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm font-semibold"><?php esc_html_e( 'Stay Connected', 'fastest_fj' ); ?></p>
                <div class="flex gap-4">
                    <?php
                    $socials = array(
                        'facebook'  => array( 'icon' => 'fab fa-facebook-f', 'label' => 'Facebook' ),
                        'instagram' => array( 'icon' => 'fab fa-instagram', 'label' => 'Instagram' ),
                        'pinterest' => array( 'icon' => 'fab fa-pinterest-p', 'label' => 'Pinterest' ),
                        'twitter'   => array( 'icon' => 'fab fa-twitter', 'label' => 'Twitter' ),
                        'youtube'   => array( 'icon' => 'fab fa-youtube', 'label' => 'YouTube' ),
                    );
                    foreach ( $socials as $key => $social ) :
                        $url = get_theme_mod( 'fastest_fj_social_' . $key );
                        if ( $url ) :
                    ?>
                    <a href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer" class="w-9 h-9 bg-white/10 rounded-full flex items-center justify-center hover:bg-brand-gold transition" aria-label="<?php echo esc_attr( $social['label'] ); ?>">
                        <i class="<?php echo esc_attr( $social['icon'] ); ?> text-sm"></i>
                    </a>
                    <?php endif; endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Footer Main -->
        <div class="py-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Column 1: Information -->
                    <div>
                        <h4 class="font-serif text-lg font-semibold mb-4 text-brand-gold"><?php esc_html_e( 'Information', 'fastest_fj' ); ?></h4>
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer-1',
                            'container'      => false,
                            'fallback_cb'    => function() {
                                echo '<ul class="space-y-2 text-sm text-white/70">';
                                echo '<li><a href="' . esc_url( get_permalink( get_page_by_path( 'about' ) ) ) . '" class="hover:text-brand-gold transition">' . esc_html__( 'About Us', 'fastest_fj' ) . '</a></li>';
                                echo '<li><a href="' . esc_url( get_permalink( get_page_by_path( 'contact' ) ) ) . '" class="hover:text-brand-gold transition">' . esc_html__( 'Contact Us', 'fastest_fj' ) . '</a></li>';
                                echo '<li><a href="#" class="hover:text-brand-gold transition">' . esc_html__( 'Privacy Policy', 'fastest_fj' ) . '</a></li>';
                                echo '<li><a href="#" class="hover:text-brand-gold transition">' . esc_html__( 'Shipping Policy', 'fastest_fj' ) . '</a></li>';
                                echo '<li><a href="#" class="hover:text-brand-gold transition">' . esc_html__( 'Return & Exchange', 'fastest_fj' ) . '</a></li>';
                                echo '</ul>';
                            },
                            'items_wrap'     => '<ul class="space-y-2 text-sm text-white/70">%3$s</ul>',
                            'link_before'    => '',
                            'link_after'     => '',
                        ) );
                        ?>
                    </div>

                    <!-- Column 2: The Company -->
                    <div>
                        <h4 class="font-serif text-lg font-semibold mb-4 text-brand-gold"><?php esc_html_e( 'The Company', 'fastest_fj' ); ?></h4>
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer-2',
                            'container'      => false,
                            'fallback_cb'    => function() {
                                $shop_page = wc_get_page_permalink( 'shop' );
                                echo '<ul class="space-y-2 text-sm text-white/70">';
                                echo '<li><a href="' . esc_url( $shop_page ) . '" class="hover:text-brand-gold transition">' . esc_html__( 'Shop All', 'fastest_fj' ) . '</a></li>';
                                echo '<li><a href="' . esc_url( $shop_page ) . '" class="hover:text-brand-gold transition">' . esc_html__( 'New Arrivals', 'fastest_fj' ) . '</a></li>';
                                echo '<li><a href="' . esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) . '" class="hover:text-brand-gold transition">' . esc_html__( 'Our Blog', 'fastest_fj' ) . '</a></li>';
                                echo '<li><a href="#" class="hover:text-brand-gold transition">' . esc_html__( 'Careers', 'fastest_fj' ) . '</a></li>';
                                echo '</ul>';
                            },
                            'items_wrap'     => '<ul class="space-y-2 text-sm text-white/70">%3$s</ul>',
                        ) );
                        ?>
                    </div>

                    <!-- Column 3: Campaign -->
                    <div>
                        <h4 class="font-serif text-lg font-semibold mb-4 text-brand-gold"><?php esc_html_e( 'Campaign', 'fastest_fj' ); ?></h4>
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'footer-3',
                            'container'      => false,
                            'fallback_cb'    => function() {
                                echo '<ul class="space-y-2 text-sm text-white/70">';
                                echo '<li><a href="#" class="hover:text-brand-gold transition">' . esc_html__( "Valentine's Collection", 'fastest_fj' ) . '</a></li>';
                                echo '<li><a href="#" class="hover:text-brand-gold transition">' . esc_html__( 'Wedding Season', 'fastest_fj' ) . '</a></li>';
                                echo '<li><a href="#" class="hover:text-brand-gold transition">' . esc_html__( 'Festive Offers', 'fastest_fj' ) . '</a></li>';
                                echo '<li><a href="#" class="hover:text-brand-gold transition">' . esc_html__( 'Clearance Sale', 'fastest_fj' ) . '</a></li>';
                                echo '</ul>';
                            },
                            'items_wrap'     => '<ul class="space-y-2 text-sm text-white/70">%3$s</ul>',
                        ) );
                        ?>
                    </div>

                    <!-- Column 4: Contact -->
                    <div>
                        <h4 class="font-serif text-lg font-semibold mb-4 text-brand-gold"><?php esc_html_e( 'Contact Us', 'fastest_fj' ); ?></h4>
                        <ul class="space-y-3 text-sm text-white/70">
                            <li class="flex items-start gap-3">
                                <i class="fas fa-map-marker-alt text-brand-gold mt-1"></i>
                                <span><?php echo esc_html( get_theme_mod( 'fastest_fj_address', "123 Jewelry Lane, Fashion District\nNew York, NY 10001, USA" ) ); ?></span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-phone text-brand-gold"></i>
                                <span><?php echo esc_html( get_theme_mod( 'fastest_fj_phone', '1-800-123-4567' ) ); ?></span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-envelope text-brand-gold"></i>
                                <span><?php echo esc_html( get_theme_mod( 'fastest_fj_email', 'support@fastest_fj.com' ) ); ?></span>
                            </li>
                            <li class="flex items-center gap-3">
                                <i class="fas fa-clock text-brand-gold"></i>
                                <span><?php echo esc_html( get_theme_mod( 'fastest_fj_hours', 'Mon - Sat: 10AM - 7PM EST' ) ); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-white/10 py-6">
            <div class="container mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-xs text-white/50 text-center sm:text-left">
                    <?php
                    printf(
                        __( 'Copyright %s %s. All Rights Reserved.', 'fastest_fj' ),
                        date( 'Y' ),
                        get_bloginfo( 'name' )
                    );
                    ?>
                </p>
                <div class="flex items-center gap-3">
                    <i class="fab fa-cc-visa text-white/50 text-xl"></i>
                    <i class="fab fa-cc-mastercard text-white/50 text-xl"></i>
                    <i class="fab fa-cc-amex text-white/50 text-xl"></i>
                    <i class="fab fa-cc-paypal text-white/50 text-xl"></i>
                    <i class="fab fa-cc-apple-pay text-white/50 text-xl"></i>
                </div>
            </div>
        </div>
    </footer>

    <!-- Fixed Call Button -->
    <a href="tel:+8809647426916" class="fixed bottom-20 border border-white right-6 w-12 h-12 bg-brand-dark text-white rounded-full shadow-lg flex items-center justify-center hover:bg-brand-gold transition z-40" aria-label="<?php esc_attr_e( 'Call us', 'fastest_fj' ); ?>">
        <i class="fas fa-phone"></i>
    </a>

    <!-- Scroll to Top -->
    <button id="scrollTop" class="scroll-top fixed bottom-6 right-6 w-12 h-12 bg-brand-gold text-white rounded-full shadow-lg flex items-center justify-center hover:bg-brand-orange transition z-40" aria-label="<?php esc_attr_e( 'Scroll to top', 'fastest_fj' ); ?>">
        <i class="fas fa-arrow-up"></i>
    </button>

</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
