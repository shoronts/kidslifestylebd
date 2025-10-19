<?php

namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WC_Product;

if (!defined('ABSPATH')) exit;

class NewArrivals extends Widget_Base
{
    public function get_name()
    {
        return 'newarrivals';
    }

    public function get_title()
    {
        return esc_html__('New Arrivals', 'kidslifestylebd');
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
            'label' => esc_html__('Products', 'kidslifestylebd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'kidslifestylebd'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('New Arrivals', 'kidslifestylebd'),
                'placeholder' => esc_html__('Type your title here', 'kidslifestylebd'),
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'kidslifestylebd'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'kidslifestylebd'),
                'placeholder' => esc_html__('Type your description here', 'kidslifestylebd'),
            ]
        );

        $this->add_control('products', [
            'label' => esc_html__('Select Products', 'kidslifestylebd'),
            'type' => Controls_Manager::SELECT2,
            'multiple' => true,
            'label_block' => true,
            'options' => $this->get_all_products(),
        ]);

        $this->end_controls_section();
    }

    /**
     * Get all WooCommerce products for selector
     */
    private function get_all_products()
    {
        $args = [
            'post_type' => 'product',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        ];

        $products = get_posts($args);
        $options = [];

        foreach ($products as $product) {
            $options[$product->ID] = $product->post_title;
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
            'limit'   => -1,
        ]);

?>
        <section class="py-3 py-lg-5">
            <div class="container">
                <div class="text-center mb-4 mb-lg-5">
                    <h3 class="section-title"><?php echo esc_html($settings["title"]); ?></h3>
                    <p><?php echo esc_html($settings["description"]); ?></p>
                </div>
                <div class="swiper newarrival-swiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($products as $product):
                            $main_img = wp_get_attachment_image_src($product->get_image_id(), 'large');
                            $gallery  = $product->get_gallery_image_ids();
                            $hover_img = !empty($gallery) ? wp_get_attachment_image_src($gallery[0], 'large') : $main_img;
                            $link = get_permalink($product->get_id());
                        ?>
                            <div class="swiper-slide">
                                <div class="product-card">
                                    <div class="product-img">
                                        <a href="<?php echo esc_url($link); ?>">
                                            <!-- Main Image -->
                                            <img src="<?php echo esc_url($main_img[0]); ?>" alt="<?php echo esc_attr($product->get_name()); ?>" class="main-img img-fluid">
                                            <!-- Hover Image -->
                                            <img src="<?php echo esc_url($hover_img[0]); ?>" alt="<?php echo esc_attr($product->get_name()); ?>" class="hover-img img-fluid">
                                        </a>
                                        <!-- Overlay Icons -->
                                        <div class="product-overlay" data-id="<?php echo get_the_ID(); ?>">
                                            <button class="icon-btn" data-bs-toggle="tooltip" title="Add to Wishlist">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                                                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314" />
                                                </svg>
                                            </button>
                                            <a href="<?php echo esc_url($product->add_to_cart_url()); ?>"
                                                class="icon-btn add_to_cart_button"
                                                data-quantity="1"
                                                data-url="<?php echo admin_url('admin-ajax.php'); ?>"
                                                data-product_id="<?php echo esc_attr($product->get_id()); ?>"
                                                data-product_sku="<?php echo esc_attr($product->get_sku()); ?>"
                                                data-bs-toggle="tooltip"
                                                title="Add to Cart"
                                                rel="nofollow">
                                                <span class="d-none"><?php esc_html_e('Add to Cart', 'kidslifestylebd'); ?></span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                                </svg>
                                            </a>
                                            <form method="post" action="<?php echo esc_url(wc_get_checkout_url()); ?>">
                                                <input type="hidden" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" />
                                                <button type="submit"
                                                    title="<?php esc_attr_e('Buy Now', 'kidslifestylebd'); ?>"
                                                    class="icon-btn d-block"
                                                    data-bs-toggle="tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                                        class="bi bi-bag" viewBox="0 0 16 16">
                                                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Product Info -->
                                    <div class="product-info text-center mt-3">
                                        <h6 class="product-name"><?php echo esc_html($product->get_name()); ?></h6>
                                        <p class="product-price"><?php echo $product->get_price_html(); ?></p>
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
