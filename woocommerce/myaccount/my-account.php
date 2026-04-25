<?php
/**
 * My Account page
 *
 * @package fastest_fj
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="py-10">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar -->
            <div class="lg:w-64 flex-shrink-0">
                <div class="bg-brand-cream rounded-lg p-6 mb-6">
                    <div class="flex items-center gap-3">
                        <?php
                        $current_user = wp_get_current_user();
                        $initials = strtoupper( substr( $current_user->first_name, 0, 1 ) . substr( $current_user->last_name, 0, 1 ) );
                        if ( ! $initials ) {
                            $initials = strtoupper( substr( $current_user->display_name, 0, 1 ) );
                        }
                        ?>
                        <div class="w-14 h-14 bg-brand-gold rounded-full flex items-center justify-center text-white text-xl font-bold"><?php echo esc_html( $initials ); ?></div>
                        <div>
                            <p class="font-semibold"><?php echo esc_html( $current_user->display_name ); ?></p>
                            <p class="text-gray-500 text-xs"><?php echo esc_html( $current_user->user_email ); ?></p>
                        </div>
                    </div>
                </div>

                <?php do_action( 'woocommerce_account_navigation' ); ?>
            </div>

            <!-- Content -->
            <div class="flex-1">
                <?php do_action( 'woocommerce_account_content' ); ?>
            </div>
        </div>
    </div>
</section>
