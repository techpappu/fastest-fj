<?php
/**
 * The header for our theme
 *
 * @package fastest_fj
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

    <!-- Top Bar -->
    <div class="bg-brand-dark text-white text-xs py-2">
        <div class="container mx-auto px-4 flex justify-between items-center">
            <p class="hidden sm:block">
                <?php
                $free_shipping_amount = get_option( 'woocommerce_free_shipping_min_amount', '500' );
                printf(
                    __( 'Free Shipping on Orders Over %s | 30-Day Returns', 'fastest_fj' ),
                    wc_price( $free_shipping_amount )
                );
                ?>
            </p>
            <div class="flex items-center gap-4 mx-auto sm:mx-0">
                <a href="tel:<?php echo esc_attr( get_theme_mod( 'fastest_fj_phone', '1-800-123-4567' ) ); ?>" class="hover:text-brand-gold transition">
                    <i class="fas fa-phone mr-1"></i> <?php echo esc_html( get_theme_mod( 'fastest_fj_phone', '1-800-123-4567' ) ); ?>
                </a>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header id="masthead" class="sticky top-0 z-50 bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between gap-4">
                <!-- Mobile Menu Button -->
                <button id="mobileMenuBtn" class="lg:hidden text-brand-text text-xl" aria-label="<?php esc_attr_e( 'Open menu', 'fastest_fj' ); ?>">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Logo -->
                <?php
                if ( has_custom_logo() ) {
                    the_custom_logo();
                } else {
                    ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2 flex-shrink-0" rel="home">
                        <div class="w-10 h-10 bg-brand-gold rounded-full flex items-center justify-center">
                            <i class="fas fa-gem text-white text-lg"></i>
                        </div>
                        <div class="">
                            <h1 class="font-serif lg:text-2xl text-xl font-bold text-brand-text leading-none"><?php bloginfo( 'name' ); ?></h1>
                            <p class="text-[10px] tracking-widest text-brand-gold uppercase"><?php bloginfo( 'description' ); ?></p>
                        </div>
                    </a>
                    <?php
                }
                ?>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-8" aria-label="<?php esc_attr_e( 'Primary', 'fastest_fj' ); ?>">
                    <?php
                    wp_nav_menu( array(
                        'theme_location'  => 'primary',
                        'menu_id'         => 'primary-menu',
                        'container'       => false,
                        'fallback_cb'     => false,
                        'items_wrap'      => '%3$s',
                        'walker'          => new fastest_fj_Walker_Nav(),
                    ) );
                    ?>
                </nav>

                <!-- Header Icons -->
                <div class="flex items-center gap-3 sm:gap-5">
                    <!-- Search -->
                    <div class="relative hidden md:block">
                        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>" class="relative">
                            <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search jewelry...', 'fastest_fj' ); ?>" class="pl-4 pr-10 py-2 border border-gray-200 rounded-full text-sm w-48 focus:outline-none focus:border-brand-gold transition" value="<?php echo get_search_query(); ?>">
                            <input type="hidden" name="post_type" value="product">
                            <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-brand-gold" aria-label="<?php esc_attr_e( 'Search', 'fastest_fj' ); ?>">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                    <button class="md:hidden text-brand-text hover:text-brand-gold transition" aria-label="<?php esc_attr_e( 'Search', 'fastest_fj' ); ?>" onclick="document.querySelector('.mobile-search').classList.toggle('hidden')"><i class="fas fa-search text-lg"></i></button>

                    <!-- Account -->
                    <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="text-brand-text hover:text-brand-gold transition hidden sm:block" aria-label="<?php esc_attr_e( 'My Account', 'fastest_fj' ); ?>">
                        <i class="far fa-user text-lg"></i>
                    </a>

                    <!-- Wishlist -->
                    <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'wishlist' ) ) ); ?>" class="text-brand-text hover:text-brand-gold transition relative" aria-label="<?php esc_attr_e( 'Wishlist', 'fastest_fj' ); ?>">
                        <i class="far fa-heart text-lg"></i>
                        <span class="header-cart-count wishlist-count"><?php echo esc_html( fastest_fj_get_wishlist_count() ); ?></span>
                    </a>

                    <!-- Cart -->
                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="text-brand-text hover:text-brand-gold transition relative" aria-label="<?php esc_attr_e( 'Cart', 'fastest_fj' ); ?>">
                        <i class="fas fa-shopping-bag text-lg"></i>
                        <span class="header-cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
                    </a>
                </div>
            </div>

            <!-- Mobile Search -->
            <div class="mobile-search hidden mt-4 md:hidden">
                <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search jewelry...', 'fastest_fj' ); ?>" class="w-full px-4 py-2 border border-gray-200 rounded-full text-sm focus:outline-none focus:border-brand-gold transition">
                    <input type="hidden" name="post_type" value="product">
                </form>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="mobile-menu fixed inset-y-0 left-0 z-50 w-80 bg-white shadow-xl lg:hidden overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="font-serif text-xl font-bold"><?php esc_html_e( 'Menu', 'fastest_fj' ); ?></h2>
                    <button id="closeMobileMenu" class="text-2xl text-brand-text" aria-label="<?php esc_attr_e( 'Close menu', 'fastest_fj' ); ?>"><i class="fas fa-times"></i></button>
                </div>
                <nav aria-label="<?php esc_attr_e( 'Mobile', 'fastest_fj' ); ?>">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'mobile',
                        'container'      => false,
                        'fallback_cb'    => function() {
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'container'      => false,
                                'items_wrap'     => '<nav class="flex flex-col gap-4">%3$s</nav>',
                            ) );
                        },
                        'items_wrap'     => '<nav class="flex flex-col gap-4">%3$s</nav>',
                        'walker'         => new fastest_fj_Walker_Mobile(),
                    ) );
                    ?>
                    <div class="border-t border-gray-100 pt-4 mt-4">
                        <a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="text-lg py-2 flex items-center gap-2"><i class="far fa-user"></i> <?php esc_html_e( 'My Account', 'fastest_fj' ); ?></a>
                    </div>
                </nav>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div id="mobileMenuOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"></div>
    </header>

    <?php
    /**
     * Custom Walker for Primary Navigation
     */
    class fastest_fj_Walker_Nav extends Walker_Nav_Menu {
        public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
            $classes = implode( ' ', $item->classes );
            $active  = in_array( 'current-menu-item', $item->classes ) || in_array( 'current-menu-parent', $item->classes );
            $output .= '<a href="' . esc_url( $item->url ) . '" class="text-sm font-semibold pb-1 border-b-2 transition ' . ( $active ? 'text-brand-gold border-brand-gold' : 'hover:text-brand-gold border-transparent hover:border-brand-gold' ) . '">' . esc_html( $item->title ) . '</a>';
        }
    }

    /**
     * Custom Walker for Mobile Navigation
     */
    class fastest_fj_Walker_Mobile extends Walker_Nav_Menu {
        public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
            $active = in_array( 'current-menu-item', $item->classes );
            $output .= '<a href="' . esc_url( $item->url ) . '" class="text-lg py-2 border-b border-gray-100 ' . ( $active ? 'font-semibold text-brand-gold' : '' ) . '">' . esc_html( $item->title ) . '</a>';
        }
    }
    ?>
