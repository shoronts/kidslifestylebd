<?php

/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does happen.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.8.1
 */

defined('ABSPATH') || exit;

if (! wc_coupons_enabled()) {
    return;
}

?>

<div class="row">
    <div class="col-lg-6 col-md-12 col-sm-12">
        <div class="woocommerce-form-coupon-toggle">
            <?php wc_print_notice(apply_filters('woocommerce_checkout_coupon_message', __('Have a coupon?', 'woocommerce') . ' <a href="#" class="showcoupon">' . __('Click here to enter your code', 'woocommerce') . '</a>'), 'notice'); ?>
        </div>

        <form class="checkout_coupon woocommerce-form-coupon" method="post" style="display:none">

            <p class="form-row form-row-first w-75">
                <input type="text" name="coupon_code" class="input-text form-control" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" id="coupon_code" value="" />
            </p>

            <p class="form-row form-row-last w-25">
                <button type="submit" class="button shop-now-btn" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_html_e('Apply coupon', 'woocommerce'); ?></button>
            </p>

            <div class="clear"></div>
        </form>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12"></div>
</div>