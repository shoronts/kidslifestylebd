<?php

/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
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
<section id="my-account-sec">
    <div class="container-xl">
        <div class="row">
            <div class="col-lg-3 col-md-12-col-sm-12 py-5">
                <?php do_action('woocommerce_account_navigation'); ?>
            </div>
            <div class="col-lg-9 col-md-12-col-sm-12 py-5">
                <div class="woocommerce-MyAccount-content">
                    <?php
                    /**
                     * My Account content.
                     *
                     * @since 2.6.0
                     */
                    do_action('woocommerce_account_content');
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>