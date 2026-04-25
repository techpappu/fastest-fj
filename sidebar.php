<?php
/**
 * The sidebar for the blog
 *
 * @package fastest_fj
 */

if ( ! is_active_sidebar( 'blog-sidebar' ) ) {
    // Default sidebar content
    ?>
    <div class="space-y-8">
        <!-- Search -->
        <div class="bg-brand-cream rounded-lg p-6">
            <h4 class="font-serif text-lg font-semibold mb-4"><?php esc_html_e( 'Search', 'fastest_fj' ); ?></h4>
            <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative">
                <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search...', 'fastest_fj' ); ?>" class="w-full px-4 py-2 border border-gray-200 rounded-full text-sm focus:outline-none focus:border-brand-gold transition pr-10">
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-brand-gold"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <!-- Recent Posts -->
        <div class="bg-brand-cream rounded-lg p-6">
            <h4 class="font-serif text-lg font-semibold mb-4"><?php esc_html_e( 'Recent Posts', 'fastest_fj' ); ?></h4>
            <div class="space-y-3">
                <?php
                $recent_posts = get_posts( array( 'numberposts' => 4 ) );
                foreach ( $recent_posts as $post ) :
                    setup_postdata( $post );
                ?>
                <a href="<?php the_permalink(); ?>" class="flex gap-3 group">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="w-14 h-14 rounded-lg overflow-hidden flex-shrink-0">
                            <?php the_post_thumbnail( 'thumbnail', array( 'class' => 'w-full h-full object-cover' ) ); ?>
                        </div>
                    <?php endif; ?>
                    <div>
                        <h5 class="text-sm font-semibold group-hover:text-brand-gold transition line-clamp-2"><?php echo esc_html( get_the_title() ); ?></h5>
                        <p class="text-gray-500 text-xs"><?php echo get_the_date(); ?></p>
                    </div>
                </a>
                <?php endforeach; wp_reset_postdata(); ?>
            </div>
        </div>

        <!-- Categories -->
        <div class="bg-brand-cream rounded-lg p-6">
            <h4 class="font-serif text-lg font-semibold mb-4"><?php esc_html_e( 'Categories', 'fastest_fj' ); ?></h4>
            <ul class="space-y-2">
                <?php
                wp_list_categories( array(
                    'title_li'   => '',
                    'show_count' => true,
                    'echo'       => 1,
                ) );
                ?>
            </ul>
        </div>
    </div>
    <?php
    return;
}
?>

<aside class="widget-area">
    <?php dynamic_sidebar( 'blog-sidebar' ); ?>
</aside>
