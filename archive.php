<?php
/**
 * The template for displaying archive pages
 *
 * @package fastest_fj
 */

get_header();
?>

<section class="bg-brand-cream py-10">
    <div class="container mx-auto px-4 text-center">
        <?php the_archive_title( '<h1 class="font-serif text-3xl sm:text-4xl font-bold mb-2">', '</h1>' ); ?>
        <?php the_archive_description( '<p class="text-gray-600 text-sm max-w-xl mx-auto">', '</p>' ); ?>
    </div>
</section>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-10">
        <div class="flex flex-col lg:flex-row gap-10">
            <!-- Content -->
            <div class="lg:w-3/4">
                <?php if ( have_posts() ) : ?>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article <?php post_class( 'bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition' ); ?>>
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a href="<?php the_permalink(); ?>" class="block aspect-[4/3] overflow-hidden">
                                        <?php the_post_thumbnail( 'fastest_fj-blog', array( 'class' => 'w-full h-full object-cover hover:scale-105 transition duration-500' ) ); ?>
                                    </a>
                                <?php endif; ?>
                                <div class="p-6">
                                    <div class="flex items-center gap-3 text-gray-500 text-xs mb-2">
                                        <span><i class="far fa-calendar mr-1"></i><?php echo get_the_date(); ?></span>
                                        <span><i class="far fa-clock mr-1"></i><?php echo esc_html( fastest_fj_reading_time() ); ?></span>
                                    </div>
                                    <h2 class="font-serif text-xl font-semibold mb-2">
                                        <a href="<?php the_permalink(); ?>" class="hover:text-brand-gold transition"><?php the_title(); ?></a>
                                    </h2>
                                    <p class="text-gray-600 text-sm line-clamp-3"><?php echo wp_kses_post( get_the_excerpt() ); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="inline-block mt-4 text-brand-gold text-sm font-semibold hover:underline">
                                        <?php esc_html_e( 'Read More', 'fastest_fj' ); ?> <i class="fas fa-arrow-right text-xs ml-1"></i>
                                    </a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-10">
                        <?php
                        the_posts_pagination( array(
                            'mid_size'  => 2,
                            'prev_text' => '<i class="fas fa-chevron-left"></i>',
                            'next_text' => '<i class="fas fa-chevron-right"></i>',
                        ) );
                        ?>
                    </div>
                <?php else : ?>
                    <p class="text-gray-500 text-center py-10"><?php esc_html_e( 'No posts found.', 'fastest_fj' ); ?></p>
                <?php endif; ?>
            </div>

            <!-- Sidebar -->
            <aside class="lg:w-1/4">
                <?php get_sidebar(); ?>
            </aside>
        </div>
    </div>
</main>

<?php
get_footer();
