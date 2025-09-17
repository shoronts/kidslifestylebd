<?php

/**
 * Custom WooCommerce Cart Page
 *
 * Save this as: yourtheme/woocommerce/cart/cart.php
 */

defined('ABSPATH') || exit;

get_header('shop');

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

<section id="cart-section" class="py-5">
	<div class="container-xl">
		<div class="row">
			<div class="col-lg-8 col-md-12 col-sm-12">
				<form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
					<?php do_action('woocommerce_before_cart_table'); ?>

					<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents border-0" cellspacing="0">
						<thead>
							<tr>
								<th class="product-remove"><?php esc_html_e('Remove', 'woocommerce'); ?></th>
								<th class="product-thumbnail"><?php esc_html_e('Image', 'woocommerce'); ?></th>
								<th class="product-name"><?php esc_html_e('Product', 'woocommerce'); ?></th>
								<th class="product-price"><?php esc_html_e('Price', 'woocommerce'); ?></th>
								<th class="product-quantity"><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
								<th class="product-subtotal"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
							</tr>
						</thead>
						<tbody>
							<?php do_action('woocommerce_before_cart_contents'); ?>

							<?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
								$_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
								$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

								if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) :
									$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
							?>
									<tr class="woocommerce-cart-form__cart-item mb-3 position-relative <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
										<td class="bg-white product-remove">
											<?php
											echo apply_filters(
												'woocommerce_cart_item_remove_link',
												sprintf(
													'<a href="%s" id="deleteProduct" class="delete-btn" aria-label="%s">
														<svg xmlns="http://www.w3.org/2000/svg" width="17" height="22" viewBox="0 0 17 22" fill="none">
															<path d="M10.9849 21H6.01515C3.76592 21 1.89157 19.2613 1.74163 17.0213L1.0026 6.152C0.959754 5.53333 1.45244 5 2.08436 5H14.9263C15.5476 5 16.0402 5.52267 15.9974 6.14133L15.2584 17.0213C15.1084 19.2613 13.2341 21 10.9849 21Z" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M6 16V9" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M11 9V16" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M1 2H16" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
															<path d="M9 2V1" stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
														</svg>
													</a>',
													esc_url(wc_get_cart_remove_url($cart_item_key)),
													esc_attr(sprintf(__('Remove %s', 'woocommerce'), $_product->get_name()))
												),
												$cart_item_key
											);
											?>
										</td>
										<td class="bg-white product-thumbnail">
											<?php
											$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);
											if (!$product_permalink) {
												echo $thumbnail;
											} else {
												printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail);
											}
											?>
										</td>
										<td class="bg-white product-name">
											<?php
											if (!$product_permalink) {
												echo wp_kses_post($_product->get_name());
											} else {
												echo wp_kses_post(sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()));
											}
											echo wc_get_formatted_cart_item_data($cart_item);
											if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
												echo '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>';
											}
											?>
											<?php
											echo apply_filters(
												'woocommerce_cart_item_remove_link',
												sprintf(
													'<p class="mb-0 mobile-title"><a href="%s" class="remove" aria-label="%s">&times;</a></p>',
													esc_url(wc_get_cart_remove_url($cart_item_key)),
													esc_attr(sprintf(__('Remove %s', 'woocommerce'), $_product->get_name()))
												),
												$cart_item_key
											);
											?>
										</td>
										<td class="bg-white product-price">
											<p class="mb-0 mobile-title"><?php esc_html_e('Price', 'woocommerce'); ?></p>
											<?php echo WC()->cart->get_product_price($_product); ?>
										</td>
										<td class="bg-white product-quantity quantity-wrapper cart-product-quantity">
											<p class="mb-0 mobile-title"><?php esc_html_e('Quantity', 'woocommerce'); ?></p>
											<div class="d-flex align-items-center">
												<button type="button" class="quantity-minus btn">-</button>
												<?php
												if ($_product->is_sold_individually()) {
													$min = 1;
													$max = 1;
												} else {
													$min = 0;
													$max = $_product->get_max_purchase_quantity();
												}
												echo woocommerce_quantity_input(array(
													'input_name'  => "cart[{$cart_item_key}][qty]",
													'input_value' => $cart_item['quantity'],
													'max_value'   => $max,
													'min_value'   => $min,
												), $_product, false);
												?>
												<button type="button" class="quantity-plus btn">+</button>
											</div>
										</td>
										<td class="bg-white product-subtotal">
											<p class="mb-0 mobile-title"><?php esc_html_e('Subtotal', 'woocommerce'); ?></p>
											<?php echo WC()->cart->get_product_subtotal($_product, $cart_item['quantity']); ?>
										</td>
									</tr>
							<?php endif;
							endforeach; ?>

							<?php do_action('woocommerce_cart_contents'); ?>

							<tr class="copun-box">
								<td colspan="6" class="actions">
									<?php if (wc_coupons_enabled()) : ?>
										<div class="coupon my-4 w-100 d-flex align-items-center">
											<input autocomplete="off" type="text" name="coupon_code" class="input-text form-control w-50 me-2 border-2 p-2" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" />
											<button style="font-size: 14px;" type="submit" class="button comments-btn fw-normal text-uppercase p-3" name="apply_coupon"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></button>
										</div>
									<?php endif; ?>
									<button type="submit" class="button d-none" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>">
										<?php esc_html_e('Update cart', 'woocommerce'); ?>
									</button>

									<?php do_action('woocommerce_cart_actions'); ?>
									<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
								</td>
							</tr>

							<?php do_action('woocommerce_after_cart_contents'); ?>
						</tbody>
					</table>
					<?php do_action('woocommerce_after_cart_table'); ?>
				</form>
			</div>
			<div class="col-lg-4 col-md-12 col-sm-12">
				<div class="cart-collaterals p-4">
					<?php do_action('woocommerce_cart_collaterals'); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer('shop'); ?>
<script>
	document.addEventListener('DOMContentLoaded', () => {
		let debounceTimer;

		// Event delegation for plus/minus buttons
		document.addEventListener('click', function(e) {
			if (e.target.matches('.quantity-plus')) {
				const input = e.target.closest('.quantity-wrapper').querySelector('input.qty');
				input.value = parseInt(input.value) + 1;
				input.dispatchEvent(new Event('change', {
					bubbles: true
				}));
			}

			if (e.target.matches('.quantity-minus')) {
				const input = e.target.closest('.quantity-wrapper').querySelector('input.qty');
				let qty = parseInt(input.value);
				if (qty > 1) {
					input.value = qty - 1;
					input.dispatchEvent(new Event('change', {
						bubbles: true
					}));
				}
			}
		});

		// Debounce for quantity input changes
		document.addEventListener('change', function(e) {
			if (e.target.matches('.woocommerce-cart-form input.qty')) {
				clearTimeout(debounceTimer);
				debounceTimer = setTimeout(() => {
					document.querySelector('button[name="update_cart"]').click();
				}, 1000);
			}
		});
	});
</script>