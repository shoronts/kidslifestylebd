<?php

/**
 * The Template for displaying product archives (shop page).
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer) will need
 * to copy the new files to your theme to maintain compatibility. When this occurs the version of the template
 * file will be bumped and the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     8.6.0
 */

defined('ABSPATH') || exit;

get_header('shop');

?>
<main id="main-body">

    <section class="pt-4">
        <div id="page-banner" class="container-fluid page-banner">
            <div class="px-2 px-lg-4">
                <div class="banner-content h-100 rounded-3" style="background-image: url('<?php echo esc_url(get_theme_mod('wc_store_banner_image')); ?>');">
                    <div class="text-center py-4">
                        <h2 class="mb-3">Store</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex justify-content-center align-items-center">
                                <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url()); ?>" class="text-decoration-none">Home</a></li>
                                <li class="breadcrumb-item">Store</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="shop" class="section-padding px-4">
        <div class="container-fluid">
            <!-- Mobile button to open sidebar -->
            <div class="d-lg-none d-md-none py-3">
                <button class="shop-now-btn" data-bs-toggle="offcanvas" data-bs-target="#blogSidebar">
                    <svg class="main-color" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" id="filters">
                        <path d="M19,2H5A3,3,0,0,0,2,5V6.17a3,3,0,0,0,.25,1.2l0,.06a2.81,2.81,0,0,0,.59.86L9,14.41V21a1,1,0,0,0,.47.85A1,1,0,0,0,10,22a1,1,0,0,0,.45-.11l4-2A1,1,0,0,0,15,19V14.41l6.12-6.12a2.81,2.81,0,0,0,.59-.86l0-.06A3,3,0,0,0,22,6.17V5A3,3,0,0,0,19,2ZM13.29,13.29A1,1,0,0,0,13,14v4.38l-2,1V14a1,1,0,0,0-.29-.71L5.41,8H18.59ZM20,6H4V5A1,1,0,0,1,5,4H19a1,1,0,0,1,1,1Z">
                        </path>
                    </svg>
                    <span>Filter</span>
                </button>
            </div>

            <div class="container-fluid">
                <div class="row">

                    <!-- Sidebar (visible on lg+, offcanvas on sm) -->
                    <nav class="sidebar col-lg-3 col-md-4  d-none d-lg-block bg-light-color border-end p-4 rounded-4">
                        <h4 class="mb-2">Filter</h4>

                        <div class="accordion" id="shopAccordion">
                            <!-- Availability Accordion -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h4>Availability</h4>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne">
                                    <div class="accordion-body">
                                        <div class="form-check mb-3 d-flex justify-content-between align-items-center">
                                            <div>
                                                <input class="form-check-input" type="checkbox" value="in-stock" id="inStock">
                                                <label class="form-check-label" for="inStock">In Stock</label>
                                            </div>
                                            <span class="badge">12</span>
                                        </div>
                                        <div class="form-check d-flex justify-content-between align-items-center">
                                            <div>
                                                <input class="form-check-input" type="checkbox" value="out-of-stock" id="outStock">
                                                <label class="form-check-label" for="outStock">Out of Stock</label>
                                            </div>
                                            <span class="badge">12</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Accordion -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <h4>Price</h4>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                    aria-labelledby="headingTwo">
                                    <div class="accordion-body">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="mb-3"> Under BDT 300</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="mb-3"> BDT 300 - 500</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="mb-3"> BDT 500 +</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Material Accordion -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button d-flex justify-content-between align-items-center"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree"
                                        aria-expanded="true"
                                        aria-controls="collapseThree">
                                        <h4 class="mb-0">Material</h4>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree">
                                    <div class="accordion-body">

                                        <!-- Materials List with Counts -->
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="matCotton" value="cotton">
                                                <label class="form-check-label" for="matCotton">Cotton</label>
                                            </div>
                                            <span class="badge bg-light text-dark">12</span>
                                        </div>

                                        <div class="form-check d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="matPolyester" value="polyester">
                                                <label class="form-check-label" for="matPolyester">Polyester</label>
                                            </div>
                                            <span class="badge bg-light text-dark">5</span>
                                        </div>

                                        <div class="form-check d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="matWool" value="wool">
                                                <label class="form-check-label" for="matWool">Wool</label>
                                            </div>
                                            <span class="badge bg-light text-dark">7</span>
                                        </div>

                                        <div class="form-check d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="matVelvet" value="velvet">
                                                <label class="form-check-label" for="matVelvet">Velvet</label>
                                            </div>
                                            <span class="badge bg-light text-dark">3</span>
                                        </div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="matPlush" value="plush">
                                                <label class="form-check-label" for="matPlush">Plush</label>
                                            </div>
                                            <span class="badge bg-light text-dark">4</span>
                                        </div>
                                        <div class="form-check d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <input class="form-check-input" type="checkbox" id="matFoam" value="foam">
                                                <label class="form-check-label" for="matFoam">Foam</label>
                                            </div>
                                            <span class="badge bg-light text-dark">2</span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Color Accordion -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button d-flex justify-content-between align-items-center"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour"
                                        aria-expanded="true"
                                        aria-controls="collapseFour">
                                        <h4>Color</h4>
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse show"
                                    aria-labelledby="headingFour">
                                    <div class="accordion-body d-flex flex-wrap gap-2">

                                        <!-- Color Swatches -->
                                        <div class="color-swatch bg-primary"></div>
                                        <div class="color-swatch bg-danger"></div>
                                        <div class="color-swatch bg-success"></div>
                                        <div class="color-swatch bg-warning"></div>
                                        <div class="color-swatch bg-info"></div>
                                        <div class="color-swatch bg-dark"></div>
                                        <div class="color-swatch bg-secondary"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </nav>

                    <!-- Offcanvas Sidebar for Mobile -->
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="blogSidebar">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title">Filter</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                        </div>
                        <div class="offcanvas-body">
                            <div class="accordion" id="shopAccordion">
                                <!-- Availability Accordion -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <h4>Availability</h4>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne">
                                        <div class="accordion-body">
                                            <div class="form-check mb-3 d-flex justify-content-between align-items-center">
                                                <div>
                                                    <input class="form-check-input" type="checkbox" value="in-stock" id="inStock">
                                                    <label class="form-check-label" for="inStock">In Stock</label>
                                                </div>
                                                <span class="badge">12</span>
                                            </div>
                                            <div class="form-check d-flex justify-content-between align-items-center">
                                                <div>
                                                    <input class="form-check-input" type="checkbox" value="out-of-stock" id="outStock">
                                                    <label class="form-check-label" for="outStock">Out of Stock</label>
                                                </div>
                                                <span class="badge">12</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price Accordion -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            <h4>Price</h4>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo">
                                        <div class="accordion-body">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="mb-3"> Under BDT 300</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="mb-3"> BDT 300 - 500</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox">
                                                <label class="mb-3"> BDT 500 +</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Material Accordion -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button d-flex justify-content-between align-items-center"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree"
                                            aria-expanded="true"
                                            aria-controls="collapseThree">
                                            <h4 class="mb-0">Material</h4>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree">
                                        <div class="accordion-body">

                                            <!-- Materials List with Counts -->
                                            <div class="form-check d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <input class="form-check-input" type="checkbox" id="matCotton" value="cotton">
                                                    <label class="form-check-label" for="matCotton">Cotton</label>
                                                </div>
                                                <span class="badge bg-light text-dark">12</span>
                                            </div>

                                            <div class="form-check d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <input class="form-check-input" type="checkbox" id="matPolyester" value="polyester">
                                                    <label class="form-check-label" for="matPolyester">Polyester</label>
                                                </div>
                                                <span class="badge bg-light text-dark">5</span>
                                            </div>

                                            <div class="form-check d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <input class="form-check-input" type="checkbox" id="matWool" value="wool">
                                                    <label class="form-check-label" for="matWool">Wool</label>
                                                </div>
                                                <span class="badge bg-light text-dark">7</span>
                                            </div>

                                            <div class="form-check d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <input class="form-check-input" type="checkbox" id="matVelvet" value="velvet">
                                                    <label class="form-check-label" for="matVelvet">Velvet</label>
                                                </div>
                                                <span class="badge bg-light text-dark">3</span>
                                            </div>
                                            <div class="form-check d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <input class="form-check-input" type="checkbox" id="matPlush" value="plush">
                                                    <label class="form-check-label" for="matPlush">Plush</label>
                                                </div>
                                                <span class="badge bg-light text-dark">4</span>
                                            </div>
                                            <div class="form-check d-flex justify-content-between align-items-center mb-2">
                                                <div>
                                                    <input class="form-check-input" type="checkbox" id="matFoam" value="foam">
                                                    <label class="form-check-label" for="matFoam">Foam</label>
                                                </div>
                                                <span class="badge bg-light text-dark">2</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Color Accordion -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button d-flex justify-content-between align-items-center"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseFour"
                                            aria-expanded="true"
                                            aria-controls="collapseFour">
                                            <h4>Color</h4>
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse show"
                                        aria-labelledby="headingFour">
                                        <div class="accordion-body d-flex flex-wrap gap-2">

                                            <!-- Color Swatches -->
                                            <div class="color-swatch bg-primary"></div>
                                            <div class="color-swatch bg-danger"></div>
                                            <div class="color-swatch bg-success"></div>
                                            <div class="color-swatch bg-warning"></div>
                                            <div class="color-swatch bg-info"></div>
                                            <div class="color-swatch bg-dark"></div>
                                            <div class="color-swatch bg-secondary"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Products Content -->
                    <div id="news" class="col-lg-9 col-md-12 col-sm-12 p-0 ps-lg-4">
                        <?php if (woocommerce_product_loop()) : ?>
                            <div class="row g-4">
                                <?php while (have_posts()) : the_post();
                                    global $product; ?>
                                    <div class="col-lg-4 col-md-6 col-12">
                                        <div class="product-card">
                                            <div class="product-img">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php
                                                    $product_id = get_the_ID();
                                                    $hover_image_id = get_post_meta($product_id, '_hover_image_id', true);
                                                    $main_image_id = get_post_thumbnail_id($product_id);
                                                    $main_image    = $main_image_id ? wp_get_attachment_image_src($main_image_id, 'medium') : false;
                                                    $hover_image   = $hover_image_id ? wp_get_attachment_image_src($hover_image_id, 'medium') : $main_image;
                                                    if (!$main_image && !$hover_image) {
                                                        $placeholder = wc_placeholder_img_src();
                                                        $main_image  = [$placeholder];
                                                        $hover_image = [$placeholder];
                                                    }
                                                    ?>

                                                    <img src="<?php echo esc_url($main_image[0]); ?>" class="main-img img-fluid" alt="<?php the_title_attribute(); ?>">
                                                    <img src="<?php echo esc_url($hover_image[0]); ?>" class="hover-img img-fluid" alt="<?php the_title_attribute(); ?>">
                                                </a>

                                                <div class="product-overlay" data-id="<?php echo get_the_ID(); ?>">
                                                    <button class="icon-btn" data-bs-toggle="tooltip" title="Add to Wishlist">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                                        </svg>
                                                    </button>
                                                    <button class="icon-btn add-to-cart-btn"
                                                        data-product_id="<?php echo get_the_ID(); ?>"
                                                        data-url="<?php echo admin_url('admin-ajax.php'); ?>"
                                                        data-bs-toggle="tooltip"
                                                        title="Add to Cart">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                                        </svg>
                                                    </button>
                                                    <a title="Buy Now" data-bs-toggle="tooltip" href="<?php echo esc_url(wc_get_checkout_url() . '?add-to-cart=' . $product->get_id()); ?>" class="icon-btn">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="product-info text-center mt-3">
                                                <h6 class="product-name"><?php the_title(); ?></h6>
                                                <p class="product-price"><?php echo $product->get_price_html(); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php else : ?>
                            <p class="text-center">No products found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php
get_footer('shop');
