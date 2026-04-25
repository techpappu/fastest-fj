<?php
/**
 * The template for displaying all single posts
 *
 * @package fastest_fj
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container mx-auto px-4 py-10 max-w-4xl">
        <?php while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!-- Header -->
                <header class="mb-8">
                    <?php
                    $categories = get_the_category();
                    if ( ! empty( $categories ) ) :
                    ?>
                        <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ); ?>" class="bg-brand-gold text-white text-xs px-3 py-1 rounded-full font-semibold mb-4 inline-block hover:bg-brand-orange transition">
                            <?php echo esc_html( $categories[0]->name ); ?>
                        </a>
                    <?php endif; ?>

                    <?php the_title( '<h1 class="font-serif text-3xl sm:text-4xl font-bold mb-4">', '</h1>' ); ?>

                    <div class="flex items-center gap-4 text-gray-500 text-sm">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-brand-cream rounded-full flex items-center justify-center text-brand-gold font-bold text-xs">
                                <?php echo esc_html( strtoupper( substr( get_the_author_meta( 'display_name' ), 0, 1 ) ) ); ?>
                            </div>
                            <span class="font-semibold text-brand-text"><?php the_author(); ?></span>
                        </div>
                        <span>|</span>
                        <span><i class="far fa-calendar mr-1"></i><?php echo get_the_date(); ?></span>
                        <span>|</span>
                        <span><i class="far fa-clock mr-1"></i><?php echo esc_html( fastest_fj_reading_time() ); ?></span>
                    </div>
                </header>

                <!-- Featured Image -->
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="mb-8 rounded-lg overflow-hidden">
                        <?php the_post_thumbnail( 'fastest_fj-blog', array( 'class' => 'w-full aspect-[2/1] object-cover' ) ); ?>
                    </div>
                <?php endif; ?>

                <!-- Content -->
                <div class="entry-content article-content">
                    <?php the_content(); ?>
                </div>

                <!-- Tags -->
                <?php
                $tags = get_the_tags();
                if ( $tags ) :
                ?>
                    <div class="flex flex-wrap gap-2 py-6 border-t border-b border-gray-100 mt-8">
                        <span class="text-sm font-semibold mr-2"><?php esc_html_e( 'Tags:', 'fastest_fj' ); ?></span>
                        <?php foreach ( $tags as $tag ) : ?>
                            <a href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" class="bg-brand-cream text-brand-text text-xs px-3 py-1 rounded-full hover:bg-brand-gold hover:text-white transition"><?php echo esc_html( $tag->name ); ?></a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <!-- Author -->
                <div class="flex items-center gap-4 py-8">
                    <div class="w-16 h-16 bg-brand-cream rounded-full flex items-center justify-center text-brand-gold font-bold text-xl flex-shrink-0">
                        <?php echo esc_html( strtoupper( substr( get_the_author_meta( 'display_name' ), 0, 2 ) ) ); ?>
                    </div>
                    <div>
                        <h3 class="font-serif font-semibold"><?php the_author(); ?></h3>
                        <p class="text-gray-500 text-sm"><?php echo esc_html( get_the_author_meta( 'description' ) ); ?></p>
                    </div>
                </div>

                <!-- Related Posts -->
                <?php
                $related = new WP_Query( array(
                    'category__in'   => wp_get_post_categories( get_the_ID() ),
                    'posts_per_page' => 3,
                    'post__not_in'   => array( get_the_ID() ),
                ) );
                if ( $related->have_posts() ) :
                ?>
                    <div class="py-8 border-t border-gray-100">
                        <h3 class="font-serif text-xl font-bold mb-6"><?php esc_html_e( 'Related Articles', 'fastest_fj' ); ?></h3>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <?php while ( $related->have_posts() ) : $related->the_post(); ?>
                                <a href="<?php the_permalink(); ?>" class="group">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <div class="aspect-[4/3] rounded-lg overflow-hidden mb-3">
                                            <?php the_post_thumbnail( 'fastest_fj-blog', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition duration-500' ) ); ?>
                                        </div>
                                    <?php endif; ?>
                                    <h4 class="font-serif font-semibold text-sm group-hover:text-brand-gold transition"><?php the_title(); ?></h4>
                                    <p class="text-gray-500 text-xs mt-1"><?php echo get_the_date(); ?></p>
                                </a>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Comments -->
                <?php if ( comments_open() || get_comments_number() ) : ?>
                    <div class="py-8 border-t border-gray-100">
                        <?php comments_template(); ?>
                    </div>
                <?php endif; ?>
            </article>
        <?php endwhile; ?>
    </div>
</main>

<?php
get_footer();
