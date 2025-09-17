<?php

/**
 * Template Name: Custom Wishlist Page
 */
get_header();
?>
<section id="breadcrumb" class="d-flex align-items-center justify-content-center" style="background-image: url(<?php echo esc_url(get_theme_mod('wc_store_banner_image')); ?>);">
    <div class="breadcrumb-content">
        <h1 class="banner-header">Wishlist</h1>
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item active">
                <a class="text-decoration-none" style="color: #777;" href="<?php echo home_url(); ?>">Home</a>
            </li>
            <li class="breadcrumb-item" aria-current="page">Wishlist</li>
        </ol>
    </div>
</section>

<?php if (is_user_logged_in()) : ?>
    <section id="my-account-sec">
        <div class="container-xl">
            <div class="row">
                <div class="col-lg-3 col-md-12-col-sm-12 py-5">
                    <?php do_action('woocommerce_account_navigation'); ?>
                </div>
                <div class="col-lg-9 col-md-12-col-sm-12 py-5">
                    <div class="woocommerce-MyAccount-content">
                        <?php
                        $user_id = get_current_user_id();
                        $wishlist = get_user_meta($user_id, '_custom_wishlist', true);

                        if (!empty($wishlist) && is_array($wishlist)) {
                            echo '<div class="row g-4 store-product-grid">'; // Bootstrap grid for cards

                            foreach ($wishlist as $product_id) {
                                $product = wc_get_product($product_id);
                                if ($product && $product->is_visible()) {
                                    $product_link = get_permalink($product_id);
                                    $product_image = get_the_post_thumbnail_url($product_id, 'medium') ?: wc_placeholder_img_src();
                                    $price = $product->get_price_html();
                                    $title = $product->get_name();
                                    $discount = '';
                                    $type = $product->get_type();

                                    if ($product->is_on_sale()) {
                                        if ($type === "variable" && $product instanceof WC_Product_Variable) {
                                            $regular = floatval($product->get_variation_regular_price('min', true));
                                            $sale    = floatval($product->get_variation_sale_price('min', true));
                                        } else {
                                            $regular = floatval($product->get_regular_price());
                                            $sale    = floatval($product->get_sale_price());
                                        }

                                        if ($regular > 0 && $sale > 0 && $sale < $regular) {
                                            $total_discount = round((($regular - $sale) / $regular) * 100);
                                            if ($total_discount > 0) {
                                                $discount = '-' . $total_discount . '%';
                                            }
                                        }
                                    }



                                    $stock_status = $product->get_stock_status();
                                    switch ($stock_status) {
                                        case 'instock':
                                            $stock_label = 'Available';
                                            break;
                                        case 'outofstock':
                                            $stock_label = 'Not Available';
                                            break;
                                        case 'onbackorder':
                                            $stock_label = 'On Backorder';
                                            break;
                                        default:
                                            $stock_label = '';
                                            break;
                                    }

                                    $mark_this_new_product = get_post_meta($product->get_id(), 'mark_this_new_product', true);

                        ?>
                                    <div class="col-md-4 col-sm-6" id="product-num-<?php echo $product->get_id() ?>">
                                        <a class="text-decoration-none" href="<?php echo esc_url($product_link); ?>">
                                            <div class="card store-card text-center position-relative h-100">
                                                <div class="card-img p-0">
                                                    <a href="<?php echo esc_url($product_link); ?>">
                                                        <img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy" decoding="async">
                                                    </a>
                                                    <div class="extra-info-box">
                                                        <?php if ($discount) : ?>
                                                            <div class="new-badge discount mb-2"><?php echo esc_html($discount); ?></div>
                                                        <?php endif; ?>
                                                        <?php if ($mark_this_new_product) : ?>
                                                            <div class="new-badge new mb-2"><?php echo esc_html($mark_this_new_product); ?></div>
                                                        <?php endif; ?>
                                                        <?php if ($stock_label) : ?>
                                                            <div class="new-badge stock-out mb-2"><?php echo esc_html($stock_label); ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="my-1 p-0"><?php echo esc_html($title); ?></h6>
                                                    <p class="price text-center"><?php echo $price; ?></p>

                                                    <?php if ($type === 'simple' && $stock_status === 'instock') { ?>
                                                        <a href="<?php echo esc_url(wc_get_checkout_url() . '?add-to-cart=' . $product->get_id()); ?>" class="simple-btn text-decoration-none">Buy Now</a>
                                                    <?php } elseif ($type === 'variable' && $stock_status === 'instock') { ?>
                                                        <a href="<?php echo esc_url($product_link); ?>" class="card-btn text-decoration-none">Select option</a>
                                                    <?php } else { ?>
                                                        <a href="<?php echo esc_url($product_link); ?>" class="simple-btn text-decoration-none">Read more</a>
                                                    <?php } ?>

                                                    <div class="hover-icon position-absolute d-flex flex-column">
                                                        <button class="btn p-0 mb-3 remove-from-wishlist-btn" data-product-id="<?php echo $product->get_id() ?>" type="button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                                                <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z" />
                                                            </svg>
                                                        </button>
                                                        <a href="<?php echo esc_url($product_link); ?>" class="text-black">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                        <?php
                                }
                            }

                            echo '</div>'; // .row
                        } else {
                            echo '<p>Your wishlist is empty.</p>';
                        }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </section>

<?php else : ?>
    <section id="wishlist-page-wrapper">
        <div class="container-xl">
            <div class="d-flex justify-content-center align-items-center flex-column no-product">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                </svg>
                <h1 class="text-center">This wishlist is empty.</h1>
                <p class="text-center">You don't have any products in the wishlist yet. You will find a lot of interesting products on our "Shop" page.</p>
                <a class="see-btn text-uppercase" href="<?php echo get_permalink(wc_get_page_id('shop')); ?>">Return to Shop</a>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>