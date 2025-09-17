<?php

/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.2.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_lost_password_form');
?>
<section id="breadcrumb" class="d-flex align-items-center justify-content-center" style="background-image: url(<?php echo esc_url(get_theme_mod('wc_store_banner_image')); ?>);">
    <div class="breadcrumb-content">
        <h1 class="banner-header fs-1">My Account</h1>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item active">
                <a class="text-decoration-none" style="color: #777;" href="<?php echo home_url(); ?>">Home</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">My Account</li>
        </ol>
    </div>
</section>
<section class="py-5" id="lost-pass-sec">
    <div class="container-xl">
        <form method="post" class="woocommerce-ResetPassword lost_reset_password">

            <p class="hints"><?php echo apply_filters('woocommerce_lost_password_message', esc_html__('Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce')); ?></p>
            <hr>
            <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first w-100">
                <label for="user_login"><?php esc_html_e('Username or email', 'woocommerce'); ?>&nbsp;<span class="required" aria-hidden="true">*</span><span class="screen-reader-text"><?php esc_html_e('Required', 'woocommerce'); ?></span></label>
                <input class="woocommerce-Input woocommerce-Input--text input-text form-control w-100" type="text" name="user_login" id="user_login" autocomplete="username" required aria-required="true" />
            </p>

            <div class="clear"></div>

            <?php do_action('woocommerce_lostpassword_form'); ?>

            <p class="woocommerce-form-row form-row">
                <input type="hidden" name="wc_reset_password" value="true" />
                <button type="submit" class="w-100 see-btn p-3 fw-semibold woocommerce-Button button<?php echo esc_attr(wc_wp_theme_get_element_class_name('button') ? ' ' . wc_wp_theme_get_element_class_name('button') : ''); ?>" value="<?php esc_attr_e('Reset password', 'woocommerce'); ?>"><?php esc_html_e('Reset password', 'woocommerce'); ?></button>
            </p>

            <?php wp_nonce_field('lost_password', 'woocommerce-lost-password-nonce'); ?>

        </form>
    </div>
</section>
<?php
do_action('woocommerce_after_lost_password_form');
