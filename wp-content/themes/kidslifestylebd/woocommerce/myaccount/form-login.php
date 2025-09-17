<?php

/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.9.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

do_action('woocommerce_before_customer_login_form'); ?>
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
<section class="py-5" id="login-register-section">
    <div class="container-xl">
        <?php
        $registration_enabled = get_option('woocommerce_enable_myaccount_registration') === 'yes';
        $allow_regisration_box = $registration_enabled ? '' : 'account-box';
        ?>

        <div class="<?php echo esc_attr($allow_regisration_box); ?>">
            <div class="u-columns row" id="customer_login">

                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="u-column1 form-box" id="login-form">
                        <h2 class="title"><?php esc_html_e('Login', 'woocommerce'); ?></h2>

                        <form class="woocommerce-form woocommerce-form-login login w-100" method="post" novalidate>
                            <?php do_action('woocommerce_login_form_start'); ?>

                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="username"><?php esc_html_e('Username or email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="username" id="username" autocomplete="username" value="<?php echo (! empty($_POST['username']) && is_string($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" required />
                            </p>

                            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                <label for="password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                <input class="woocommerce-Input woocommerce-Input--text input-text form-control" type="password" name="password" id="password" autocomplete="current-password" required />
                            </p>

                            <?php do_action('woocommerce_login_form'); ?>

                            <p class="form-row w-100">
                                <?php wp_nonce_field('woocommerce-login', 'woocommerce-login-nonce'); ?>
                                <button type="submit" class="woocommerce-button button woocommerce-form-login__submit see-btn w-100 p-3 fw-semibold" name="login" value="<?php esc_attr_e('Log in', 'woocommerce'); ?>"><?php esc_html_e('Log in', 'woocommerce'); ?></button>
                            </p>


                            <div class="d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                                        <input class="woocommerce-form__input woocommerce-form__input-checkbox form-check-input mb-0" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e('Remember me', 'woocommerce'); ?></span>
                                    </label>
                                </div>
                                <p class="woocommerce-LostPassword lost_password">
                                    <a href="<?php echo esc_url(wp_lostpassword_url()); ?>"><?php esc_html_e('Lost your password?', 'woocommerce'); ?></a>
                                </p>
                            </div>

                            <?php do_action('woocommerce_login_form_end'); ?>
                        </form>
                    </div>
                    <div class="mobile-divider">
                        <span>OR</span>
                    </div>
                    <?php if ('yes' === get_option('woocommerce_enable_myaccount_registration')) : ?>
                        <div class="u-column2 form-box d-none" id="registration-form">
                            <h2 class="title"><?php esc_html_e('Register', 'woocommerce'); ?></h2>

                            <form method="post" class="woocommerce-form woocommerce-form-register register" <?php do_action('woocommerce_register_form_tag'); ?>>
                                <?php do_action('woocommerce_register_form_start'); ?>

                                <?php if ('no' === get_option('woocommerce_registration_generate_username')) : ?>
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="reg_username"><?php esc_html_e('Username', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                        <input type="text" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="username" id="reg_username" autocomplete="username" value="<?php echo (! empty($_POST['username'])) ? esc_attr(wp_unslash($_POST['username'])) : ''; ?>" required />
                                    </p>
                                <?php endif; ?>

                                <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                    <label for="reg_email"><?php esc_html_e('Email address', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                    <input type="email" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="email" id="reg_email" autocomplete="email" value="<?php echo (! empty($_POST['email'])) ? esc_attr(wp_unslash($_POST['email'])) : ''; ?>" required />
                                </p>

                                <?php if ('no' === get_option('woocommerce_registration_generate_password')) : ?>
                                    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                                        <label for="reg_password"><?php esc_html_e('Password', 'woocommerce'); ?>&nbsp;<span class="required">*</span></label>
                                        <input type="password" class="woocommerce-Input woocommerce-Input--text input-text form-control" name="password" id="reg_password" autocomplete="new-password" required />
                                    </p>
                                <?php else : ?>
                                    <p><?php esc_html_e('A link to set a new password will be sent to your email address.', 'woocommerce'); ?></p>
                                <?php endif; ?>

                                <?php do_action('woocommerce_register_form'); ?>

                                <p class="woocommerce-form-row form-row">
                                    <?php wp_nonce_field('woocommerce-register', 'woocommerce-register-nonce'); ?>
                                    <button type="submit" class="woocommerce-Button woocommerce-button button woocommerce-form-register__submit see-btn w-100 p-3 fw-semibold" name="register" value="<?php esc_attr_e('Register', 'woocommerce'); ?>"><?php esc_html_e('Register', 'woocommerce'); ?></button>
                                </p>

                                <?php do_action('woocommerce_register_form_end'); ?>
                            </form>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="login-to-register text-center">
                        <p>Registering for this site allows you to access your order status and history. Just fill in the fields below, and we'll get a new account set up for you in no time. We will only ask you for information necessary to make the purchase process faster and easier.</p>
                        <button id="log-reg" type="button">Register</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php do_action('woocommerce_after_customer_login_form'); ?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const log_box = document.querySelector("#login-form");
        const reg_box = document.querySelector("#registration-form");
        const toggleBtn = document.querySelector("#log-reg");

        toggleBtn.addEventListener("click", e => {
            e.preventDefault();

            if (toggleBtn.innerText.toLowerCase() === "register") {
                toggleBtn.innerText = "Login";
                log_box.classList.add("d-none");
                reg_box.classList.remove("d-none");
            } else {
                toggleBtn.innerText = "Register";
                log_box.classList.remove("d-none");
                reg_box.classList.add("d-none");
            }
        });
    });
</script>