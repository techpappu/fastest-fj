<?php
/**
 * Template Name: About Page
 *
 * @package fastest_fj
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Hero Banner -->
    <section class="relative h-[300px] sm:h-[400px] overflow-hidden">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail( 'full', array( 'class' => 'absolute inset-0 w-full h-full object-cover' ) ); ?>
        <?php else : ?>
            <img src="https://images.unsplash.com/photo-1617038220319-276d3cfab638?w=1600&h=600&fit=crop" alt="About" class="absolute inset-0 w-full h-full object-cover">
        <?php endif; ?>
        <div class="absolute inset-0 bg-black/40"></div>
        <div class="relative z-10 container mx-auto px-4 h-full flex items-center justify-center text-center">
            <div>
                <p class="text-brand-gold text-sm tracking-widest uppercase mb-3"><?php esc_html_e( 'Our Story', 'fastest_fj' ); ?></p>
                <h1 class="font-serif text-4xl sm:text-5xl text-white font-bold mb-3"><?php the_title(); ?></h1>
            </div>
        </div>
    </section>

    <!-- Content -->
    <div class="container mx-auto px-4 py-10">
        <div class="max-w-4xl mx-auto">
            <div class="entry-content">
                <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
            </div>
        </div>
    </div>

    <!-- Stats -->
    <section class="py-16 bg-brand-cream">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 max-w-4xl mx-auto text-center">
                <div>
                    <p class="font-serif text-3xl font-bold text-brand-gold">40+</p>
                    <p class="text-gray-500 text-sm"><?php esc_html_e( 'Years Experience', 'fastest_fj' ); ?></p>
                </div>
                <div>
                    <p class="font-serif text-3xl font-bold text-brand-gold">50K+</p>
                    <p class="text-gray-500 text-sm"><?php esc_html_e( 'Happy Customers', 'fastest_fj' ); ?></p>
                </div>
                <div>
                    <p class="font-serif text-3xl font-bold text-brand-gold">450+</p>
                    <p class="text-gray-500 text-sm"><?php esc_html_e( 'Unique Designs', 'fastest_fj' ); ?></p>
                </div>
                <div>
                    <p class="font-serif text-3xl font-bold text-brand-gold">100%</p>
                    <p class="text-gray-500 text-sm"><?php esc_html_e( 'Handcrafted', 'fastest_fj' ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <p class="text-brand-gold text-sm tracking-widest uppercase mb-2"><?php esc_html_e( 'Our Principles', 'fastest_fj' ); ?></p>
                <h2 class="font-serif text-3xl sm:text-4xl font-bold"><?php esc_html_e( 'What We Stand For', 'fastest_fj' ); ?></h2>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <div class="bg-brand-cream p-8 rounded-lg text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-gem text-brand-gold text-2xl"></i>
                    </div>
                    <h3 class="font-serif text-lg font-semibold mb-2"><?php esc_html_e( 'Quality First', 'fastest_fj' ); ?></h3>
                    <p class="text-gray-500 text-sm"><?php esc_html_e( 'Every gemstone is hand-selected and certified. We use only conflict-free diamonds and ethically sourced materials.', 'fastest_fj' ); ?></p>
                </div>
                <div class="bg-brand-cream p-8 rounded-lg text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-hands text-brand-gold text-2xl"></i>
                    </div>
                    <h3 class="font-serif text-lg font-semibold mb-2"><?php esc_html_e( 'Handcrafted', 'fastest_fj' ); ?></h3>
                    <p class="text-gray-500 text-sm"><?php esc_html_e( 'Each piece is meticulously crafted by skilled artisans with decades of experience in traditional jewelry making.', 'fastest_fj' ); ?></p>
                </div>
                <div class="bg-brand-cream p-8 rounded-lg text-center hover:shadow-lg transition">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-leaf text-brand-gold text-2xl"></i>
                    </div>
                    <h3 class="font-serif text-lg font-semibold mb-2"><?php esc_html_e( 'Sustainable', 'fastest_fj' ); ?></h3>
                    <p class="text-gray-500 text-sm"><?php esc_html_e( 'Committed to eco-friendly practices, recycled metals, and responsible sourcing throughout our supply chain.', 'fastest_fj' ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-brand-dark">
        <div class="container mx-auto px-4 text-center">
            <h2 class="font-serif text-3xl sm:text-4xl text-white font-bold mb-4"><?php esc_html_e( 'Start Your Jewelry Journey', 'fastest_fj' ); ?></h2>
            <p class="text-white/80 text-sm max-w-lg mx-auto mb-8"><?php esc_html_e( 'Discover our handcrafted collection or work with our designers to create a custom piece.', 'fastest_fj' ); ?></p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="bg-brand-orange hover:bg-brand-gold text-white px-8 py-3 rounded-full font-semibold transition"><?php esc_html_e( 'Shop Collection', 'fastest_fj' ); ?></a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>" class="border-2 border-white text-white hover:bg-white hover:text-brand-text px-8 py-3 rounded-full font-semibold transition"><?php esc_html_e( 'Contact Us', 'fastest_fj' ); ?></a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
