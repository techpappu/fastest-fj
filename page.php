<?php
/**
 * The template for displaying all pages
 *
 * @package fastest_fj
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-10">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="mb-8 text-center">
                    <?php the_title( '<h1 class="font-serif text-3xl sm:text-4xl font-bold mb-4">', '</h1>' ); ?>
                </header>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mb-8 rounded-lg overflow-hidden max-w-4xl mx-auto">
                        <?php the_post_thumbnail( 'large', array( 'class' => 'w-full h-auto' ) ); ?>
                    </div>
                <?php endif; ?>

                <div class="entry-content max-w-4xl mx-auto prose prose-lg">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
