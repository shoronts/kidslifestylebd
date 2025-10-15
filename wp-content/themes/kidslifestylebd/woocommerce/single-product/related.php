<?php

/**
 * Custom Related Products template with Swiper slider markup.
 * Save as: your-theme/woocommerce/single-product/related.php
 */

defined('ABSPATH') || exit;

if (! $related_products) {
	return;
}

global $product;
?>

<div class="related-products">
	<h3 class="product-head my-4"><?php esc_html_e('Related products', 'woocommerce'); ?></h3>
	<div class="swiper-card">
		<div class="slider-products position-relative px-4">
			<div class="swiper related-products-slider swiper position-static most-loved-products-slider bg-white">
				<div class="swiper-wrapper pb-5">
					<?php foreach ($related_products as $related_product) : ?>
						<?php
						$post_object = get_post($related_product->get_id());
						setup_postdata($GLOBALS['post'] = &$post_object);

						$product_link = get_permalink($related_product->get_id());
						$title        = $related_product->get_name();
						$price_html   = $related_product->get_price_html();

						// Main + hover image
						$product_id      = $related_product->get_id();
						$hover_image_id  = get_post_meta($product_id, '_hover_image_id', true);
						$main_image_id   = get_post_thumbnail_id($product_id);
						$main_image      = $main_image_id ? wp_get_attachment_image_src($main_image_id, 'medium') : false;
						$hover_image     = $hover_image_id ? wp_get_attachment_image_src($hover_image_id, 'medium') : $main_image;

						if (!$main_image && !$hover_image) {
							$placeholder = wc_placeholder_img_src();
							$main_image  = [$placeholder];
							$hover_image = [$placeholder];
						}
						?>

						<div class="swiper-slide h-100">
							<div class="product-card h-100">
								<!-- Product Image -->
								<div class="product-img">
									<a href="<?php echo esc_url($product_link); ?>">
										<img src="<?php echo esc_url($main_image[0]); ?>" class="main-img img-fluid" alt="<?php echo esc_attr($title); ?>">
										<img src="<?php echo esc_url($hover_image[0]); ?>" class="hover-img img-fluid" alt="<?php echo esc_attr($title); ?>">
									</a>

									<!-- Overlay Actions -->
									<div class="product-overlay" data-id="<?php echo esc_attr($product_id); ?>">
										<!-- Wishlist -->
										<button class="icon-btn" data-bs-toggle="tooltip" title="Add to Wishlist">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
												<path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
											</svg>
										</button>

										<!-- Add to Cart -->
										<button class="icon-btn add-to-cart-btn single-add-to-cart-btn"
											data-product_id="<?php echo esc_attr($product_id); ?>"
											data-bs-toggle="tooltip"
											data-url="<?php echo admin_url('admin-ajax.php'); ?>"
											title="Add to Cart">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
												<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
											</svg>
										</button>

										<!-- Buy Now (Checkout) -->
										<a title="Buy Now" data-bs-toggle="tooltip" href="<?php echo esc_url(wc_get_checkout_url() . '?add-to-cart=' . $product_id); ?>" class="icon-btn">
											<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
												<path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
											</svg>
										</a>
									</div>
								</div>

								<!-- Product Info -->
								<div class="product-info text-center mt-3">
									<h6 class="product-name"><?php echo esc_html($title); ?></h6>
									<p class="product-price"><?php echo wp_kses_post($price_html); ?></p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
					<?php wp_reset_postdata(); ?>

				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</div>
</div>
<?php
wp_reset_postdata();
?>