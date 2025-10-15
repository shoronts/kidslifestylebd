<?php

namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Direct_Checkout_Widget extends Widget_Base {

    public function get_name() {
        return 'direct_checkout_widget';
    }

    public function get_title() {
        return __( 'Direct Checkout', 'kidslifestylebd' );
    }

    public function get_icon() {
        return 'eicon-cart';
    }

    public function get_categories() {
        return [ 'kids_life_style_bd' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [ 'label' => __( 'Checkout Settings', 'kidslifestylebd' ) ]
        );

        $this->add_control(
            'product_id',
            [
                'label' => __( 'Select Product', 'kidslifestylebd' ),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_products(),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    }

    private function get_products() {
        $products = wc_get_products(['limit' => -1]);
        $options = [];
        foreach ($products as $product) {
            $options[$product->get_id()] = $product->get_name();
        }
        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $product_id = $settings['product_id'];

        if ( ! $product_id ) {
            echo '<p>Please select a product in the widget settings.</p>';
            return;
        }

        $product = wc_get_product( $product_id );

        echo '<div class="direct-checkout-wrapper" data-product-id="' . esc_attr($product_id) . '">';

        if ( $product->is_type('variable') ) {
            $this->render_variation_selector($product);
        } else {
            $this->render_simple_product_checkout($product_id);
        }

        echo '</div>';
    }

    private function render_simple_product_checkout($product_id) {
        // Empty cart and add product
        WC()->cart->empty_cart();
        WC()->cart->add_to_cart($product_id);

        // Display checkout
        echo '<div id="checkout-container">';
        echo do_shortcode('[woocommerce_checkout]');
        echo '</div>';
    }

    private function render_variation_selector($product) {
        $variations = $product->get_available_variations();
        if (empty($variations)) {
            echo '<p>No variations available.</p>';
            return;
        }

        $default_variation_id = $variations[0]['variation_id'];

        echo '<div class="variation-selector container my-5">';
        echo '<h3>Select Your Product</h3>';
        echo '<form id="variation-select-form">';

        foreach ($variations as $index => $variation) {
            $variation_id = $variation['variation_id'];
            $variation_obj = wc_get_product($variation_id);
            $is_checked = $index === 0 ? 'checked' : '';
            $image_url = $variation_obj->get_image_id() ? wp_get_attachment_image_url($variation_obj->get_image_id(), 'thumbnail') : wc_placeholder_img_src();

            echo '<label class="variation-option">';
            echo '<input type="radio" name="variation_id" value="' . esc_attr($variation_id) . '" ' . $is_checked . '>';
            echo '<div class="variation-card">';
            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($variation_obj->get_name()) . '">';
            echo '<div class="variation-info">';
            echo '<strong>' . esc_html($variation_obj->get_name()) . '</strong>';
            echo '<p>' . wc_price($variation_obj->get_price()) . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</label>';
        }

        echo '</form>';
        echo '<div id="checkout-container" style="margin-top:20px;"></div>';
        echo '</div>';

        // Optimized JS + CSS
        ?>
        <script>
        jQuery(function($){
            const checkoutContainer = $('#checkout-container');

            function loadCheckout(variationId){
                checkoutContainer.html('<p>Loading checkout...</p>');

                $.post('<?php echo admin_url('admin-ajax.php'); ?>', {
                    action: 'kidslifestylebd_load_checkout',
                    variation_id: variationId
                }, function(response){
                    if(response.success){
                        checkoutContainer.html(response.data);
                    } else {
                        checkoutContainer.html('<p>Error loading checkout.</p>');
                    }
                });
            }

            // Load first variation on page load
            loadCheckout(<?php echo intval($default_variation_id); ?>);

            // Handle variation change
            $('input[name="variation_id"]').on('change', function(){
                loadCheckout($(this).val());
            });
        });
        </script>
        <style>
        .variation-selector { margin-bottom: 30px; }
        .variation-option { display: block; border: 1px solid #ddd; border-radius: 10px; padding: 10px; margin-bottom: 10px; cursor: pointer; transition: all 0.3s ease; }
        .variation-option input { display: none; }
        .variation-option input:checked + .variation-card { border: 2px solid #f36; background: #fff8fb; }
        .variation-card { display: flex; align-items: center; gap: 15px; }
        .variation-card img { width: 60px; height: 60px; border-radius: 5px; object-fit: cover; }
        .variation-info p { margin: 0; color: #666; }
        </style>
        <?php
    }
}

// AJAX handler to load checkout for variable products
add_action('wp_ajax_kidslifestylebd_load_checkout', 'kidslifestylebd_load_checkout');
add_action('wp_ajax_nopriv_kidslifestylebd_load_checkout', 'kidslifestylebd_load_checkout');

function kidslifestylebd_load_checkout() {
    if ( empty($_POST['variation_id']) ) {
        wp_send_json_error('No variation ID provided');
    }

    $variation_id = intval($_POST['variation_id']);

    WC()->cart->empty_cart();
    WC()->cart->add_to_cart( $variation_id );

    ob_start();
    echo do_shortcode('[woocommerce_checkout]');
    wp_send_json_success( ob_get_clean() );
}
