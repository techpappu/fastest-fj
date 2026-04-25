<?php
/**
 * Template Name: Contact Page
 *
 * @package fastest_fj
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Breadcrumb -->
    <section class="bg-brand-cream py-6">
        <div class="container mx-auto px-4">
            <div class="flex items-center gap-2 text-sm text-gray-600">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-brand-gold transition"><?php esc_html_e( 'Home', 'fastest_fj' ); ?></a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-brand-gold"><?php the_title(); ?></span>
            </div>
        </div>
    </section>

    <section class="py-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h1 class="font-serif text-3xl sm:text-4xl font-bold mb-3"><?php the_title(); ?></h1>
                <?php if ( get_the_content() ) : ?>
                    <div class="text-gray-600 text-sm max-w-lg mx-auto"><?php the_content(); ?></div>
                <?php else : ?>
                    <p class="text-gray-600 text-sm max-w-lg mx-auto"><?php esc_html_e( "We'd love to hear from you. Whether you have a question about our jewelry, need styling advice, or want to discuss a custom piece.", 'fastest_fj' ); ?></p>
                <?php endif; ?>
            </div>

            <div class="flex flex-col lg:flex-row gap-10 max-w-6xl mx-auto">
                <!-- Contact Info -->
                <div class="lg:w-1/3">
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-brand-cream rounded-full flex items-center justify-center text-brand-gold flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-serif font-semibold mb-1"><?php esc_html_e( 'Visit Our Store', 'fastest_fj' ); ?></h3>
                                <p class="text-gray-600 text-sm"><?php echo nl2br( esc_html( get_theme_mod( 'fastest_fj_address', "123 Jewelry Lane, Fashion District\nNew York, NY 10001, USA" ) ) ); ?></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-brand-cream rounded-full flex items-center justify-center text-brand-gold flex-shrink-0">
                                <i class="fas fa-phone text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-serif font-semibold mb-1"><?php esc_html_e( 'Call Us', 'fastest_fj' ); ?></h3>
                                <p class="text-gray-600 text-sm"><?php esc_html_e( 'Toll Free:', 'fastest_fj' ); ?> <a href="tel:<?php echo esc_attr( get_theme_mod( 'fastest_fj_phone', '1-800-123-4567' ) ); ?>" class="text-brand-gold hover:underline"><?php echo esc_html( get_theme_mod( 'fastest_fj_phone', '1-800-123-4567' ) ); ?></a></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-brand-cream rounded-full flex items-center justify-center text-brand-gold flex-shrink-0">
                                <i class="fas fa-envelope text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-serif font-semibold mb-1"><?php esc_html_e( 'Email Us', 'fastest_fj' ); ?></h3>
                                <p class="text-gray-600 text-sm"><a href="mailto:<?php echo esc_attr( get_theme_mod( 'fastest_fj_email', 'support@fastest_fj.com' ) ); ?>" class="text-brand-gold hover:underline"><?php echo esc_html( get_theme_mod( 'fastest_fj_email', 'support@fastest_fj.com' ) ); ?></a></p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-brand-cream rounded-full flex items-center justify-center text-brand-gold flex-shrink-0">
                                <i class="fas fa-clock text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-serif font-semibold mb-1"><?php esc_html_e( 'Business Hours', 'fastest_fj' ); ?></h3>
                                <p class="text-gray-600 text-sm"><?php echo esc_html( get_theme_mod( 'fastest_fj_hours', 'Mon - Sat: 10AM - 7PM EST' ) ); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:w-2/3">
                    <div class="bg-brand-cream rounded-lg p-6 sm:p-8">
                        <h2 class="font-serif text-xl font-bold mb-6"><?php esc_html_e( 'Send a Message', 'fastest_fj' ); ?></h2>
                        <?php
                        if ( shortcode_exists( 'contact-form-7' ) ) {
                            echo do_shortcode( '[contact-form-7 title="Contact form 1"]' );
                        } elseif ( shortcode_exists( 'wpforms' ) ) {
                            echo do_shortcode( '[wpforms id="1"]' );
                        } else {
                        ?>
                        <form class="grid grid-cols-1 sm:grid-cols-2 gap-4" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
                            <input type="hidden" name="action" value="fastest_fj_contact_form">
                            <?php wp_nonce_field( 'fastest_fj_contact', 'contact_nonce' ); ?>
                            <div>
                                <label class="text-sm font-semibold mb-1 block"><?php esc_html_e( 'First Name *', 'fastest_fj' ); ?></label>
                                <input type="text" name="first_name" required class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand-gold transition bg-white">
                            </div>
                            <div>
                                <label class="text-sm font-semibold mb-1 block"><?php esc_html_e( 'Last Name *', 'fastest_fj' ); ?></label>
                                <input type="text" name="last_name" required class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand-gold transition bg-white">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold mb-1 block"><?php esc_html_e( 'Email Address *', 'fastest_fj' ); ?></label>
                                <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand-gold transition bg-white">
                            </div>
                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold mb-1 block"><?php esc_html_e( 'Subject *', 'fastest_fj' ); ?></label>
                                <select name="subject" class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand-gold transition bg-white">
                                    <option><?php esc_html_e( 'General Inquiry', 'fastest_fj' ); ?></option>
                                    <option><?php esc_html_e( 'Product Question', 'fastest_fj' ); ?></option>
                                    <option><?php esc_html_e( 'Custom Order Request', 'fastest_fj' ); ?></option>
                                    <option><?php esc_html_e( 'Order Status', 'fastest_fj' ); ?></option>
                                </select>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="text-sm font-semibold mb-1 block"><?php esc_html_e( 'Message *', 'fastest_fj' ); ?></label>
                                <textarea name="message" rows="5" required class="w-full px-4 py-3 border border-gray-200 rounded-lg text-sm focus:outline-none focus:border-brand-gold transition bg-white resize-none" placeholder="<?php esc_attr_e( 'How can we help you?', 'fastest_fj' ); ?>"></textarea>
                            </div>
                            <div class="sm:col-span-2">
                                <button type="submit" class="bg-brand-dark text-white px-8 py-3 rounded-full font-semibold hover:bg-brand-gold transition"><?php esc_html_e( 'Send Message', 'fastest_fj' ); ?></button>
                            </div>
                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 max-w-3xl">
            <div class="text-center mb-10">
                <h2 class="font-serif text-3xl font-bold mb-2"><?php esc_html_e( 'Frequently Asked Questions', 'fastest_fj' ); ?></h2>
                <p class="text-gray-600 text-sm"><?php esc_html_e( 'Quick answers to common questions', 'fastest_fj' ); ?></p>
            </div>
            <div class="space-y-4">
                <?php
                $faqs = array(
                    array(
                        __( 'What is your return policy?', 'fastest_fj' ),
                        __( 'We offer a 30-day return policy on all unworn items in their original condition with tags attached. Returns are free - we\'ll provide a prepaid shipping label.', 'fastest_fj' ),
                    ),
                    array(
                        __( 'Do you offer custom jewelry design?', 'fastest_fj' ),
                        __( 'Yes! Our master jewelers can create custom pieces based on your vision. Contact us to schedule a consultation and bring your dream jewelry to life.', 'fastest_fj' ),
                    ),
                    array(
                        __( 'How do I care for my jewelry?', 'fastest_fj' ),
                        __( 'Store pieces separately in a soft pouch, clean regularly with a soft cloth, avoid exposure to harsh chemicals, and bring pieces in annually for professional cleaning.', 'fastest_fj' ),
                    ),
                    array(
                        __( 'Are your diamonds conflict-free?', 'fastest_fj' ),
                        __( 'Absolutely. All our diamonds are ethically sourced and comply with the Kimberley Process. We also offer lab-grown diamonds as a sustainable alternative.', 'fastest_fj' ),
                    ),
                    array(
                        __( 'Do you ship internationally?', 'fastest_fj' ),
                        __( 'Yes, we ship to over 50 countries worldwide. International shipping rates and delivery times vary by location. All international orders are fully insured.', 'fastest_fj' ),
                    ),
                );
                foreach ( $faqs as $index => $faq ) :
                ?>
                <details class="bg-brand-cream rounded-lg p-4 cursor-pointer group" <?php echo $index === 0 ? 'open' : ''; ?>>
                    <summary class="font-semibold text-sm flex items-center justify-between list-none"><?php echo esc_html( $faq[0] ); ?> <i class="fas fa-chevron-down text-xs text-gray-400 transition-transform group-open:rotate-180"></i></summary>
                    <p class="text-gray-600 text-sm mt-3"><?php echo esc_html( $faq[1] ); ?></p>
                </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
