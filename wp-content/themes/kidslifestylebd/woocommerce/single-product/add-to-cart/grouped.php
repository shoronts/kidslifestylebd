<?php
/**
 * Template for displaying grouped products using Bootstrap layout.
 * Save as: your-theme/woocommerce/single-product/add-to-cart/grouped.php
 */

defined( 'ABSPATH' ) || exit;

global $product;

$grouped_products = $product->get_children();

if ( empty( $grouped_products ) ) {
	echo '<p>No child products found for this grouped product.</p>';
	return;
}
?>

<div class="container">
	<?php foreach ( $grouped_products as $child_id ) :
		$child = wc_get_product( $child_id );

		if ( ! $child || ! $child->exists() || 'publish' !== $child->get_status() ) {
			continue;
		}
		$product_link = get_permalink( $child_id );
	?>
		<div class="row align-items-center border-top py-3 group-product">
			<div class="col-2">
				<a href="<?php echo esc_url( $product_link ); ?>">
					<?php echo $child->get_image( 'thumbnail', array( 'class' => 'img-fluid' ) ); ?>
				</a>
			</div>
			<div class="col-4">
				<a href="<?php echo esc_url( $product_link ); ?>" class="text-decoration-none product-title">
					<strong><?php echo esc_html( $child->get_name() ); ?></strong>
				</a>
			</div>
			<div class="col-4 text-end product-btn">
				<?php if ( $child->is_type( 'variable' ) ) : ?>
					<a href="<?php echo esc_url( $product_link ); ?>" class="btn btn-sm">Select Option</a>
				<?php elseif ( $child->is_type( 'simple' ) && $child->is_purchasable() && $child->is_in_stock() ) : ?>
					<?php woocommerce_template_loop_add_to_cart( array( 'product' => $child ) ); ?>
				<?php else : ?>
					<span class="text-muted">Unavailable</span>
				<?php endif; ?>
			</div>
			<div class="col-2 text-end product-prices">
				<?php echo $child->get_price_html(); ?>
			</div>
		</div>
	<?php endforeach; ?>
</div>
