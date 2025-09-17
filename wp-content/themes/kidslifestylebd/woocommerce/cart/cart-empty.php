<?php

/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined('ABSPATH') || exit;

/*
 * @hooked wc_empty_cart_message - 10
 */
?>
<main id="main-body">
	<section class="pt-4">
		<div id="page-banner" class="container-fluid page-banner">
			<div class="px-2 px-lg-4">
				<div class="banner-content h-100 rounded-3" style="background-image: url('<?php echo esc_url(get_theme_mod('wc_store_banner_image')); ?>');">
					<div class="text-center py-4">
						<h2 class="mb-3">Kids Life Style BD</h2>
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 d-flex justify-content-center align-items-center">
								<li class="breadcrumb-item">
									<a class="text-black" href="<?php echo esc_url(wc_get_cart_url()); ?>">Cart</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">
									<a class="text-black text-decoration-none" href="<?php echo esc_url(wc_get_checkout_url()); ?>">Checkout</a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Order complete</li>
							</ol>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="empty-cart-sec py-5">
		<div class="container-xl">
			<div class="d-flex justify-content-center align-items-center flex-column">
				<div class="w-100">
					<?php do_action('woocommerce_cart_is_empty'); ?>
				</div>
				<?php if (wc_get_page_id('shop') > 0) : ?>
					<p class="return-to-shop">
						<a class="shop-now-btn button wc-backward<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
							<?php echo esc_html(apply_filters('woocommerce_return_to_shop_text', __('Return to shop', 'woocommerce'))); ?>
						</a>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</section>
</main>
<?php get_footer('shop'); ?>