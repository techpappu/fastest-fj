<?php

/**
 * Template Name: Cartflow
 *
 * @package fastest_fj
 */

if (! defined('ABSPATH')) {
	exit;
}



$post_id            = get_queried_object_id();
$hero_title         = fastest_fj_cartflow_get('hero_title', $post_id);
$hero_subtitle      = fastest_fj_cartflow_get('hero_subtitle', $post_id);
$show_alert         = '1' === fastest_fj_cartflow_get('show_alert', $post_id);
$alert_text         = fastest_fj_cartflow_get('alert_text', $post_id);
$phone_number       = fastest_fj_cartflow_get('phone_number', $post_id);
$show_scarcity      = '1' === fastest_fj_cartflow_get('show_scarcity', $post_id);
$scarcity_title     = fastest_fj_cartflow_get('scarcity_title', $post_id);
$scarcity_desc      = fastest_fj_cartflow_get('scarcity_desc', $post_id);
$benefits_title     = fastest_fj_cartflow_get('benefits_title', $post_id);
$testimonials_title = fastest_fj_cartflow_get('testimonials_title', $post_id);
$faq_title          = fastest_fj_cartflow_get('faq_title', $post_id);
$guarantee_title    = fastest_fj_cartflow_get('guarantee_title', $post_id);
$guarantee_desc     = fastest_fj_cartflow_get('guarantee_desc', $post_id);
$final_cta_title    = fastest_fj_cartflow_get('final_cta_title', $post_id);
$final_cta_desc     = fastest_fj_cartflow_get('final_cta_desc', $post_id);
$cta_button         = fastest_fj_cartflow_get('cta_button', $post_id);
$show_sticky        = '1' === fastest_fj_cartflow_get('show_sticky', $post_id);
$sticky_bar         = fastest_fj_cartflow_get('sticky_bar', $post_id);
$footer_text        = fastest_fj_cartflow_get('footer_text', $post_id);
$badges             = fastest_fj_cartflow_parse_lines(fastest_fj_cartflow_get('badges', $post_id), array('icon', 'title', 'desc'));
$benefits           = fastest_fj_cartflow_parse_lines(fastest_fj_cartflow_get('benefits', $post_id), array('icon', 'title', 'desc'));
$testimonials       = fastest_fj_cartflow_parse_lines(fastest_fj_cartflow_get('testimonials', $post_id), array('name', 'loc', 'stars', 'text'));
$faq_items          = fastest_fj_cartflow_parse_lines(fastest_fj_cartflow_get('faqs', $post_id), array('q', 'a'));
$phone_href         = preg_replace('/[^0-9+]/', '', $phone_number);
$product_name       = get_the_title($post_id);
$product_image      = get_the_post_thumbnail_url($post_id, 'large');
$product_ids        = fastest_fj_cartflow_product_ids($post_id);
$default_product_id = fastest_fj_cartflow_get('default_product_id', $post_id);
$gallery_image_ids  = array();

if (class_exists('WooCommerce') && $default_product_id) {
	$gallery_product = wc_get_product($default_product_id);

	if ($gallery_product) {
		$gallery_image_ids = $gallery_product->get_gallery_image_ids();

		// If no gallery images exist, use featured image
		if (empty($gallery_image_ids)) {
			$featured_image_id = $gallery_product->get_image_id();

			if ($featured_image_id) {
				$gallery_image_ids = [$featured_image_id];
			}
		}

		$gallery_image_ids = array_slice(
			array_filter(array_map('absint', $gallery_image_ids)),
			0,
			3
		);
	}
}

if (! $footer_text) {
	$footer_text = '© ' . date_i18n('Y') . ' ' . get_bloginfo('name') . ' — সর্বস্বত্ব সংরক্ষিত';
}

$cartflow_order_cta = function ($direction = 'down', $wrap_class = 'mt-7') use ($cta_button) {
	$icon = 'up' === $direction ? 'fa-arrow-up' : 'fa-arrow-down';
?>
	<div class="<?php echo esc_attr($wrap_class); ?> text-center">
		<a href="#order-form" class="inline-flex animate-pulse items-center justify-center rounded-full bg-brand-orange px-10 py-4 text-lg font-bold text-white transition hover:bg-brand-gold hover:text-white">
			<?php echo esc_html($cta_button); ?> <i class="fas <?php echo esc_attr($icon); ?> ml-2" aria-hidden="true"></i>
		</a>
	</div>
<?php
};
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<style id="fastest-fj-critical-logo-css">
		.custom-logo-link{display:block;width:150px;max-width:150px}
		.custom-logo-link .custom-logo{display:block;width:100%;height:auto;max-height:80px;object-fit:contain}
	</style>
	<?php wp_head(); ?>
</head>

<body <?php body_class('font-sans'); ?>>
	<?php wp_body_open(); ?>

	<?php if ($show_alert && $alert_text) : ?>
		<div class="bg-brand-gold px-3 py-1.5 text-center text-[13px] font-semibold text-white"><?php echo wp_kses_post($alert_text); ?></div>
	<?php endif; ?>

	<header class="sticky top-0 z-50 border-b border-[#f0ebe3] bg-white py-3">
		<div class="container mx-auto px-4 flex items-center justify-center md:justify-between">
			<?php
			if (has_custom_logo()) { ?>
				<div class="max-w-[150px]">
					<?php the_custom_logo(); ?>
				</div>
			<?php
			} else {
			?>
				<a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-2 no-underline">
					<div class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-gold text-base text-white"><i class="fas fa-gem" aria-hidden="true"></i></div>
					<div>
						<div class="font-serif text-xl font-bold leading-none text-brand-text"><?php bloginfo('name'); ?></div>
						<div class="text-[9px] uppercase tracking-[0.2em] text-brand-gold"><?php bloginfo('description'); ?></div>
					</div>
				</a>
			<?php
			}; ?>

			<?php if ($phone_number) : ?>
				<a href="tel:<?php echo esc_attr($phone_href); ?>" class="hidden sm:flex items-center gap-2 text-sm font-semibold text-brand-gold hover:text-brand-orange transition">
					<i class="fas fa-phone-alt" aria-hidden="true"></i>
					<span><?php echo esc_html($phone_number); ?></span>
				</a>
			<?php endif; ?>
		</div>
	</header>

	<main>
		<section class="bg-brand-dark py-5">
			<div class="container mx-auto px-4 text-center">
				<h2 class="font-serif text-2xl sm:text-3xl text-white font-bold mb-4">
					<?php echo esc_html($final_cta_title); ?>
				</h2>
				<p class="text-white/70 text-sm mb-6">
					<?php echo esc_html($final_cta_desc); ?>
				</p>
				<?php $cartflow_order_cta('down', 'mt-0'); ?>

			</div>
		</section>
		<section class="bg-brand-dark pb-3">
			<div class="container mx-auto px-4">
				<div class="mx-auto grid max-w-5xl grid-cols-1 items-center gap-4 rounded-[14px] border border-white/10 bg-white/5 p-3 shadow-[0_18px_46px_rgba(0,0,0,0.24)] sm:p-5 lg:grid-cols-[minmax(260px,0.9fr)_minmax(0,1.1fr)] lg:gap-7">

					<div class="relative overflow-hidden rounded-[10px] border border-white/10 bg-white/10">
						<div class="absolute left-3 top-3 z-10 rounded-full bg-brand-gold px-3 py-1 text-[10px] font-extrabold uppercase tracking-wide text-white shadow-[0_6px_16px_rgba(0,0,0,0.2)]">
							<?php esc_html_e('Featured Product', 'fastest_fj'); ?>
						</div>
						<?php if ($product_image) : ?>
							<img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($product_name); ?>" class="aspect-square w-full object-cover">
						<?php else : ?>
							<div class="flex aspect-square w-full items-center justify-center text-center text-white">
								<div>
									<i class="fas fa-gem mb-2.5 block text-[44px] text-brand-gold" aria-hidden="true"></i>
									<span class="block px-5 font-serif text-[21px] font-bold leading-tight"><?php echo esc_html($product_name); ?></span>
								</div>
							</div>
						<?php endif; ?>
					</div>

					<div class="min-w-0 rounded-[12px] bg-brand-dark p-4 text-center lg:p-5 lg:text-left">

						<div class="mb-3 flex flex-wrap justify-center gap-2 lg:justify-start">
							<span class="inline-flex items-center gap-1 rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-xs font-bold leading-none text-brand-gold">
								<i class="fas fa-star text-[11px]" aria-hidden="true"></i>
								<?php esc_html_e('Customer Favorite', 'fastest_fj'); ?>
							</span>
							<span class="inline-flex items-center gap-1 rounded-full border border-white/10 bg-white/10 px-3 py-1.5 text-xs font-bold leading-none text-brand-orange">
								<i class="fas fa-truck text-[11px]" aria-hidden="true"></i>
								<?php esc_html_e('Fast Delivery', 'fastest_fj'); ?>
							</span>
						</div>

						<h2 class="m-0 font-serif text-[28px] font-extrabold leading-tight text-white sm:text-[34px]">
							<?php echo esc_html($product_name); ?>
						</h2>
						<p class="mt-3 text-[13px] leading-6 text-white/70 sm:text-sm sm:leading-7">
							<?php esc_html_e('Premium quality, carefully packed, and ready for cash on delivery anywhere in Bangladesh.', 'fastest_fj'); ?>
						</p>

						<div class="mt-4 grid grid-cols-3 gap-1.5 sm:gap-2">
							<div class="flex min-h-9 items-center justify-center gap-1.5 rounded-lg border border-white/10 bg-white/10 px-1.5 py-1.5 text-center sm:min-h-10 sm:px-2">
								<i class="fas fa-shield-alt text-xs text-brand-gold sm:text-sm" aria-hidden="true"></i>
								<span class="whitespace-nowrap text-[10px] font-extrabold leading-tight text-white sm:text-[11px]"><?php esc_html_e('Original', 'fastest_fj'); ?></span>
							</div>
							<div class="flex min-h-9 items-center justify-center gap-1.5 rounded-lg border border-white/10 bg-white/10 px-1.5 py-1.5 text-center sm:min-h-10 sm:px-2">
								<i class="fas fa-money-bill-wave text-xs text-brand-gold sm:text-sm" aria-hidden="true"></i>
								<span class="whitespace-nowrap text-[10px] font-extrabold leading-tight text-white sm:text-[11px]"><?php esc_html_e('COD', 'fastest_fj'); ?></span>
							</div>
							<div class="flex min-h-9 items-center justify-center gap-1.5 rounded-lg border border-white/10 bg-white/10 px-1.5 py-1.5 text-center sm:min-h-10 sm:px-2">
								<i class="fas fa-undo text-xs text-brand-gold sm:text-sm" aria-hidden="true"></i>
								<span class="whitespace-nowrap text-[10px] font-extrabold leading-tight text-white sm:text-[11px]"><?php esc_html_e('Easy Return', 'fastest_fj'); ?></span>
							</div>
						</div>
						<div class="mt-5 flex justify-center">
							<a href="#order-form" class="inline-flex items-center justify-center gap-2 rounded-full bg-brand-orange px-6 py-3 text-sm font-extrabold text-white shadow-[0_10px_20px_rgba(232,145,58,0.22)] transition hover:-translate-y-0.5 hover:bg-brand-gold hover:text-white">
								<?php echo esc_html($cta_button); ?>
								<i class="fas fa-arrow-down" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</section>
		<?php if (! empty($gallery_image_ids)) : ?>
			<section class="bg-brand-white my-2 sm:my-4">
				<div class="container mx-auto px-4">
					<div class="mx-auto grid max-w-5xl grid-cols-3 gap-2 sm:gap-4">
						<?php foreach ($gallery_image_ids as $image_id) : ?>
							<div class="overflow-hidden rounded-[10px] border border-white/10 bg-white/10 shadow-[0_12px_28px_rgba(0,0,0,0.18)]">
								<?php
								echo wp_get_attachment_image(
									$image_id,
									'medium_large',
									false,
									array(
										'class' => 'aspect-square w-full object-cover transition duration-500 hover:scale-105',
										'alt'   => esc_attr($product_name),
									)
								);
								?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
				<?php $cartflow_order_cta('down'); ?>
			</section>
		<?php endif; ?>
		<?php if ($testimonials) : ?>
			<section class="bg-brand-dark py-10 sm:py-14">
				<div class="container mx-auto px-4 max-w-4xl">
					<h2 class="relative mb-6 text-center font-serif text-2xl font-bold text-white after:mx-auto after:mt-2.5 after:block after:h-[3px] after:w-[60px] after:rounded-sm after:bg-brand-gold after:content-['']"><?php echo esc_html($testimonials_title); ?></h2>
					<div class="mb-7 grid grid-cols-1 gap-3.5 sm:grid-cols-3">
						<?php foreach ($testimonials as $testimonial) : ?>
							<?php
							$stars   = max(1, min(5, absint($testimonial['stars'])));
							$initial = function_exists('mb_substr') ? mb_substr($testimonial['name'], 0, 1) : substr($testimonial['name'], 0, 1);
							?>
							<div class="rounded-xl border border-white/10 bg-white/10 p-[18px] shadow-[0_14px_34px_rgba(0,0,0,0.18)]">
								<div class="mb-2 text-xs text-brand-gold">
									<?php for ($star = 1; $star <= 5; $star++) : ?>
										<i class="fas fa-star<?php echo $star > $stars ? '-half-alt' : ''; ?>" aria-hidden="true"></i>
									<?php endfor; ?>
								</div>
								<p class="mb-2.5 text-[13px] italic leading-6 text-white/75">"<?php echo esc_html($testimonial['text']); ?>"</p>
								<div class="flex items-center gap-2.5">
									<div class="flex h-9 w-9 items-center justify-center rounded-full bg-brand-gold text-sm font-bold text-white"><?php echo esc_html($initial); ?></div>
									<div>
										<div class="text-[13px] font-bold text-white"><?php echo esc_html($testimonial['name']); ?></div>
										<div class="text-[11px] text-white/55"><i class="fas fa-map-marker-alt mr-1 text-xs text-brand-gold" aria-hidden="true"></i><?php echo esc_html($testimonial['loc']); ?></div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<?php $cartflow_order_cta('down'); ?>
				</div>
			</section>
		<?php endif; ?>

		<?php if (class_exists('WooCommerce') && ! empty($product_ids)) : ?>
			<?php
			$cartflow_products = new WP_Query(
				array(
					'post_type'      => 'product',
					'post_status'    => 'publish',
					'post__in'       => $product_ids,
					'orderby'        => 'post__in',
					'posts_per_page' => count($product_ids),
				)
			);
			?>
			<?php if ($cartflow_products->have_posts()) : ?>
				<section class="bg-brand-cream py-10 sm:py-14">
					<div class="container mx-auto px-4">
						<div class="mb-8 text-center">
							<h2 class="font-serif text-2xl font-bold text-brand-dark sm:text-3xl">
								<?php esc_html_e('Check Some of Our Best Selling Products', 'fastest_fj'); ?>
							</h2>
							<p class="mx-auto mt-2 max-w-xl text-sm text-gray-600">
								<?php esc_html_e('Grab as many as you like before they\'re gone!', 'fastest_fj'); ?>
							</p>
						</div>

						<div class="grid grid-cols-2 gap-4 sm:gap-6 lg:grid-cols-4">
							<?php
							while ($cartflow_products->have_posts()) :
								$cartflow_products->the_post();
								global $product;
								$product = wc_get_product(get_the_ID());

								if (! $product || ! $product->is_visible()) {
									continue;
								}

								wc_get_template_part('content', 'product');
							endwhile;
							?>
						</div>
					</div>
				</section>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>

		<?php if ($faq_items) : ?>
			<section class="bg-brand-dark py-10 sm:py-14">
				<div class="container mx-auto px-4 max-w-2xl">
					<h2 class="relative mb-6 text-center font-serif text-2xl font-bold text-white after:mx-auto after:mt-2.5 after:block after:h-[3px] after:w-[60px] after:rounded-sm after:bg-brand-gold after:content-['']"><?php echo esc_html($faq_title); ?></h2>
					<div>
						<?php foreach ($faq_items as $faq) : ?>
							<details class="group mb-2 overflow-hidden rounded-[10px] border border-white/10 bg-white/10 shadow-[0_12px_28px_rgba(0,0,0,0.14)]">
								<summary class="flex cursor-pointer list-none items-center justify-between px-[18px] py-3.5 text-[13px] font-semibold text-white [&::-webkit-details-marker]:hidden"><?php echo esc_html($faq['q']); ?> <i class="fas fa-chevron-down text-[11px] text-brand-gold transition duration-300 group-open:rotate-180" aria-hidden="true"></i></summary>
								<div class="px-[18px] pb-3.5 text-[13px] leading-7 text-white/70"><?php echo esc_html($faq['a']); ?></div>
							</details>
						<?php endforeach; ?>
					</div>
					<?php $cartflow_order_cta('down'); ?>
				</div>
			</section>
		<?php endif; ?>

		<section class="bg-brand-cream py-10 sm:py-14">
			<div class="container mx-auto px-4 text-center max-w-2xl">
				<h1 class="font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-brand-text mb-3 leading-snug">
					<?php echo esc_html($hero_title); ?>
				</h1>

				<?php if ($hero_subtitle) : ?>
					<p class="text-gray-600 text-sm sm:text-base"><?php echo esc_html($hero_subtitle); ?></p>
				<?php endif; ?>

				<?php if ($badges) : ?>
					<div class="mt-8 mb-6 grid grid-cols-2 gap-2.5 sm:grid-cols-4">
						<?php foreach ($badges as $badge) : ?>
							<div class="rounded-[10px] border border-[#f0ebe3] bg-brand-cream px-2.5 py-3.5 text-center transition duration-200 hover:-translate-y-0.5 hover:border-brand-gold hover:shadow-[0_4px_12px_rgba(201,169,97,0.15)]">
								<i class="fas <?php echo esc_attr($badge['icon']); ?> mb-1.5 block text-[22px] text-brand-gold" aria-hidden="true"></i>
								<span class="block text-xs font-bold text-brand-text"><?php echo esc_html($badge['title']); ?></span>
								<span class="text-[10px] text-gray-500"><?php echo esc_html($badge['desc']); ?></span>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
				<?php $cartflow_order_cta('down'); ?>
			</div>
		</section>

		<?php if ($show_scarcity && ($scarcity_title || $scarcity_desc)) : ?>
			<section class="container mx-auto mt-5 px-4">
				<div class="relative mb-6 overflow-hidden rounded-xl bg-brand-dark p-5 text-center text-white before:absolute before:inset-0 before:bg-[repeating-linear-gradient(45deg,transparent,transparent_10px,rgba(201,169,97,0.05)_10px,rgba(201,169,97,0.05)_20px)]">
					<?php if ($scarcity_title) : ?>
						<h3 class="relative mb-1.5 font-serif text-[1.1rem] font-bold"><?php echo esc_html($scarcity_title); ?></h3>
					<?php endif; ?>
					<?php if ($scarcity_desc) : ?>
						<p class="relative text-[13px] text-white/85 [&_strong]:text-brand-gold"><?php echo wp_kses_post($scarcity_desc); ?></p>
					<?php endif; ?>
				</div>
			</section>
		<?php endif; ?>

		<section id="order-form" class="py-6 sm:py-10">
			<div class="container mx-auto px-4 max-w-3xl">
				<?php
				while (have_posts()) :
					the_post();

					if (trim(get_the_content())) {
						the_content();
					} else {
						echo do_shortcode('[cartflow-custom page-id="' . absint($post_id) . '"]');
					}
				endwhile;
				?>
			</div>
		</section>

		<?php if ($benefits) : ?>
			<section class="bg-brand-cream py-10 sm:py-14">
				<div class="container mx-auto px-4 max-w-4xl">
					<h2 class="relative mb-6 text-center font-serif text-2xl font-bold text-brand-dark after:mx-auto after:mt-2.5 after:block after:h-[3px] after:w-[60px] after:rounded-sm after:bg-brand-gold after:content-['']"><?php echo esc_html($benefits_title); ?></h2>
					<div class="mb-7 grid grid-cols-2 gap-3 sm:grid-cols-4">
						<?php foreach ($benefits as $benefit) : ?>
							<div class="rounded-[10px] border border-gray-200 bg-white px-3 py-4 text-center">
								<span class="mx-auto mb-2 flex h-11 w-11 items-center justify-center rounded-full bg-brand-cream text-brand-gold">
									<i class="fas <?php echo esc_attr($benefit['icon']); ?> block text-lg leading-none" aria-hidden="true"></i>
								</span>
								<div class="text-[13px] font-bold text-brand-text"><?php echo esc_html($benefit['title']); ?></div>
								<div class="mt-0.5 text-[11px] text-gray-500"><?php echo esc_html($benefit['desc']); ?></div>
							</div>
						<?php endforeach; ?>
					</div>
					<?php $cartflow_order_cta('up'); ?>
				</div>
			</section>
		<?php endif; ?>

		<section class="py-10 sm:py-14">
			<div class="container mx-auto px-4 max-w-2xl">
				<div class="mb-7 rounded-[14px] border-2 border-brand-gold bg-brand-cream px-5 py-7 text-center">
					<div class="mb-3 inline-flex h-16 w-16 items-center justify-center rounded-full border-[3px] border-brand-gold bg-white text-[28px] text-brand-gold"><i class="fas fa-shield-alt" aria-hidden="true"></i></div>
					<h3 class="mb-2 font-serif text-[1.3rem] font-bold text-brand-dark"><?php echo esc_html($guarantee_title); ?></h3>
					<p class="mx-auto max-w-[480px] text-[13px] leading-7 text-gray-600"><?php echo esc_html($guarantee_desc); ?></p>
				</div>
				<?php $cartflow_order_cta('up'); ?>
			</div>
		</section>
	</main>

	<footer class="bg-brand-dark py-6 text-center text-xs text-white/60 <?php echo $show_sticky ? 'mb-12' : ''; ?> [&_a]:text-brand-gold">
		<div class="container mx-auto px-4">
			<p><?php echo wp_kses_post($footer_text); ?></p>
			<?php if ($phone_number) : ?>
				<p class="mt-1"><a href="tel:<?php echo esc_attr($phone_href); ?>"><i class="fas fa-phone-alt mr-1" aria-hidden="true"></i><?php echo esc_html($phone_number); ?></a></p>
			<?php endif; ?>
		</div>
	</footer>

	<?php if ($show_sticky && $sticky_bar) : ?>
		<div class="fixed inset-x-0 bottom-0 z-40 flex items-center justify-center gap-2 bg-brand-dark px-4 py-2.5 text-center text-[13px] font-semibold text-white">
			<span><?php echo wp_kses_post($sticky_bar); ?></span>
		</div>
	<?php endif; ?>

	<?php wp_footer(); ?>
</body>

</html>
