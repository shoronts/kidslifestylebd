<?php
defined('ABSPATH') || exit;

global $product;

?>

<div class="woocommerce-variation-add-to-cart variations_button d-flex align-items-center p-0">
	<?php do_action('woocommerce_before_add_to_cart_button'); ?>

	<?php do_action('woocommerce_before_add_to_cart_quantity'); ?>

	<div class="quantity-wrapper d-flex align-items-center">
		<!-- Minus -->
		<button type="button" class="quantity-minus btn">-</button>

		<!-- WooCommerce Quantity Input -->
		<?php
		woocommerce_quantity_input(array(
			'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
			'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
			'input_value' => isset($_POST['quantity'])
				? wc_stock_amount(wp_unslash($_POST['quantity']))
				: $product->get_min_purchase_quantity(),
		));
		?>

		<!-- Plus -->
		<button type="button" class="quantity-plus btn">+</button>
	</div>

	<!-- Add to Cart -->
	<button type="submit" class="single_add_to_cart_button add-to-cart-btn button btn mx-2 alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>">
		<?php echo esc_html($product->single_add_to_cart_text()); ?>
	</button>

	<!-- Buy Now -->
	<button type="submit" name="buy_now" value="1" class="single_add_to_cart_button button btn alt<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>">
		Buy Now
	</button>

	<?php do_action('woocommerce_after_add_to_cart_button'); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint($product->get_id()); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint($product->get_id()); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
</div>

<!-- ✅ Plus/Minus JS -->
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const minusBtn = document.querySelector('.quantity-minus');
		const plusBtn = document.querySelector('.quantity-plus');
		const qtyInput = document.querySelector('.quantity input.qty');

		if (minusBtn && plusBtn && qtyInput) {
			minusBtn.addEventListener('click', function() {
				let qty = parseInt(qtyInput.value);
				if (qty > 1) qtyInput.value = qty - 1;
			});
			plusBtn.addEventListener('click', function() {
				let qty = parseInt(qtyInput.value);
				qtyInput.value = qty + 1;
			});
		}
	});
</script>