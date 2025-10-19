<?php

namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_Query;

if (!defined('ABSPATH')) exit;

class HomeHero extends Widget_Base
{

    public function get_name()
    {
        return 'homehero';
    }

    public function get_title()
    {
        return esc_html__('Home Hero (Products)', 'kidslifestylebd');
    }

    public function get_icon()
    {
        return 'eicon-products';
    }

    public function get_categories()
    {
        return ['kids_life_style_bd'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Hero Products', 'kidslifestylebd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('products', [
            'label' => esc_html__('Select Products', 'kidslifestylebd'),
            'type'  => Controls_Manager::SELECT2,
            'multiple' => true,
            'label_block' => true,
            'options' => $this->get_all_products(),
        ]);

        $this->end_controls_section();
    }

    /**
     * Get all WooCommerce products for the dropdown
     */
    private function get_all_products()
    {
        if (!class_exists('WooCommerce')) {
            return [];
        }

        $products = wc_get_products([
            'limit' => -1,
            'status' => 'publish',
        ]);

        $options = [];
        foreach ($products as $product) {
            $options[$product->get_id()] = $product->get_name();
        }
        return $options;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['products'])) {
            echo '<p>' . esc_html__('Please select products to display.', 'kidslifestylebd') . '</p>';
            return;
        }

        $products = wc_get_products([
            'include' => $settings['products'],
            'status' => 'publish',
        ]);

        if (empty($products)) {
            return;
        }
?>
        <section class="hero-section">
            <div class="container">
                <div class="swiper hero-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($products as $product):
                            $product_id      = $product->get_id();
                        ?>
                            <div class="swiper-slide">
                                <div class="d-flex flex-column flex-md-row-reverse">
                                    <!-- Image -->
                                    <div class="w-100 w-md-50 banner-right">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <img class="img-fluid"
                                                src="<?php echo esc_url(wp_get_attachment_url($product->get_image_id())); ?>"
                                                alt="<?php echo esc_attr($product->get_name()); ?>">
                                        </div>
                                    </div>
                                    <!-- Content -->
                                    <div class="w-100 w-md-50 d-flex justify-content-center align-items-center">
                                        <div class="pb-4 pb-lg-0 d-flex flex-column justify-content-sm-center align-items-center">
                                            <div class="d-flex flex-column align-items-center align-items-md-start">
                                                <h4 class="text-uppercase fs-6 dark-color mb-2 mb-lg-4">
                                                    <?php esc_html_e('Special Offer', 'kidslifestylebd'); ?>
                                                </h4>
                                                <h1 class="text dark-color mb-2 mb-lg-4">
                                                    <?php echo esc_html($product->get_name()); ?>
                                                </h1>
                                                <p class="fs-6 text dark-color mb-2 mb-lg-4">
                                                    <?php echo $product->get_price_html(); ?>
                                                </p>

                                                <!-- Buttons -->
                                                <div class="d-flex gap-2 flex-wrap">
                                                    <!-- Details -->
                                                    <a class="shop-now-btn btn"
                                                        href="<?php echo esc_url($product->get_permalink()); ?>">
                                                        <?php esc_html_e('Details', 'kidslifestylebd'); ?>
                                                    </a>

                                                    <!-- Add to Cart -->
                                                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                                        class="btn btn-outline-success add_to_cart_button"
                                                        data-quantity="1"
                                                        data-url="<?php echo admin_url('admin-ajax.php'); ?>"
                                                        data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                                                        data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
                                                        rel="nofollow">
                                                        <?php esc_html_e('Add to Cart', 'kidslifestylebd'); ?>
                                                    </a>

                                                    <!-- Buy Now -->
                                                    <a href="<?php echo esc_url(wc_get_checkout_url() . '?add-to-cart=' . $product_id); ?>"
                                                        class="btn btn-warning">
                                                        <?php esc_html_e('Buy Now', 'kidslifestylebd'); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}