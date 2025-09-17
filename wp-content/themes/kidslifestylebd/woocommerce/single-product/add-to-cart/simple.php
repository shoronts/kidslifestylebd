<?php
defined( 'ABSPATH' ) || exit;
global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // Show stock status.
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart d-flex align-items-center" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype="multipart/form-data">
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php do_action( 'woocommerce_before_add_to_cart_quantity' ); ?>

		<div class="quantity-wrapper d-flex align-items-center me-2">
			<button type="button" class="quantity-minus btn btn-outline-secondary">-</button>

			<?php
			woocommerce_quantity_input( array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(),
			) );
			?>

			<button type="button" class="quantity-plus btn btn-outline-secondary">+</button>
		</div>

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button shop-now-btn button btn me-2">
			<?php echo esc_html( $product->single_add_to_cart_text() ); ?>
		</button>

		<!-- Optional: Buy Now -->
		<button type="submit" name="buy_now" value="1" class="single_add_to_cart_button shop-now-btn button btn">
			Buy Now
		</button>

        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>

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
