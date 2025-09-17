<?php

/**
 * Custom WooCommerce Checkout Page with Bootstrap
 *
 * Save this as: your-theme/woocommerce/checkout/form-checkout.php
 */

defined('ABSPATH') || exit;

// If checkout registration is disabled and not logged in, show a message.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
	echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
	return;
}
?>
<section class="pt-4">
	<div id="page-banner" class="container-fluid page-banner">
		<div class="px-2 px-lg-4">
			<div class="banner-content h-100 rounded-3" style="background-image: url('<?php echo esc_url(get_theme_mod('wc_store_banner_image')); ?>');">
				<div class="text-center py-4">
					<h2 class="mb-3">Kids Life Style BD</h2>
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 d-flex justify-content-center align-items-center">
							<li class="breadcrumb-item">
								<a class="text-black text-decoration-none" href="<?php echo esc_url(wc_get_cart_url()); ?>">Cart</a>
							</li>
							<li class="breadcrumb-item" aria-current="page">
								<a class="text-black" href="<?php echo esc_url(wc_get_checkout_url()); ?>">Checkout</a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Order complete</li>
						</ol>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="checkout-section" class="py-5">
	<div class="container-xl">

		<?php do_action('woocommerce_before_checkout_form', $checkout); ?>

		<form name="checkout" method="post" class="checkout woocommerce-checkout"
			action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

			<div class="row">
				<div class="col-lg-6 col-md-12 mb-4">
					<?php if ($checkout->get_checkout_fields()) : ?>

						<?php do_action('woocommerce_checkout_before_customer_details'); ?>

						<div class="row">
							<div class="col-12">
								<?php do_action('woocommerce_checkout_billing'); ?>
							</div>

							<div class="col-12 mt-4">
								<?php do_action('woocommerce_checkout_shipping'); ?>
							</div>
						</div>

						<?php do_action('woocommerce_checkout_after_customer_details'); ?>

					<?php endif; ?>
				</div>

				<div class="col-lg-6 col-md-12">
					<div class="card p-4 order-history-box">
						<h4 class="mb-3"><?php esc_html_e('Your Order', 'woocommerce'); ?></h4>
						<?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

						<?php do_action('woocommerce_checkout_before_order_review'); ?>

						<div id="order_review" class="woocommerce-checkout-review-order">
							<?php do_action('woocommerce_checkout_order_review'); ?>
						</div>

						<?php do_action('woocommerce_checkout_after_order_review'); ?>
					</div>
				</div>
			</div>
		</form>

		<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
	</div>
</section>