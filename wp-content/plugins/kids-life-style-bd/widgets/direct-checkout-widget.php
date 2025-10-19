<?php

namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (! defined('ABSPATH')) exit;

class Direct_Checkout_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'direct_checkout_widget';
    }

    public function get_title()
    {
        return __('Direct Checkout', 'kidslifestylebd');
    }

    public function get_icon()
    {
        return 'eicon-cart';
    }

    public function get_categories()
    {
        return ['kids_life_style_bd'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_content',
            ['label' => __('Checkout Settings', 'kidslifestylebd')]
        );

        $this->add_control(
            'product_id',
            [
                'label' => __('Select Product', 'kidslifestylebd'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_products(),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    }

    private function get_products()
    {
        $products = wc_get_products(['limit' => -1]);
        $options = [];
        foreach ($products as $product) {
            $options[$product->get_id()] = $product->get_name();
        }
        return $options;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $product_id = $settings['product_id'];

        if (! $product_id) {
            echo '<p>Please select a product in the widget settings.</p>';
            return;
        }

        $product = wc_get_product($product_id);

        echo '<div class="direct-checkout-wrapper" data-product-id="' . esc_attr($product_id) . '">';

        if ($product->is_type('variable')) {
            $this->render_variation_selector($product);
        }

        echo '<div id="checkout-container" style="margin-top:20px;"></div>';
        echo '</div>';
    }

    private function render_variation_selector($product)
    {
        $variations = $product->get_available_variations();
        if (empty($variations)) return;

        echo '<p class="mb-3 fs-4 fw-bold">Your Products</p>';
        echo '<div class="variation-selector d-flex flex-column border">';
        foreach ($variations as $index => $variation) {
            $variation_obj = wc_get_product($variation['variation_id']);
            $is_checked = $index === 0 ? 'checked' : '';
            $image_url = $variation_obj->get_image_id() ? wp_get_attachment_image_url($variation_obj->get_image_id(), 'thumbnail') : wc_placeholder_img_src();
            $attrs_json = esc_attr(wp_json_encode($variation['attributes']));

            echo '<label class="variation-option border p-3 d-flex justify-content-between align-items-center">';
            echo '<div class="d-flex align-items-center">';
            echo '<input class="form-check-input" type="radio" name="variation_id" value="' . esc_attr($variation['variation_id']) . '" data-attributes="' . $attrs_json . '" ' . $is_checked . '>';
            echo '<img src="' . esc_url($image_url) . '" width="60" height="60" class="mx-3" />';
            echo '<div>';
            echo '<p class="fw-bold">' . esc_html($variation_obj->get_name()) . '</p>';
            $attributes = $variation_obj->get_attributes();

            foreach ($attributes as $attribute_name => $attribute_value) {
                echo '<p class="text-muted">' . wc_attribute_label($attribute_name) . ':' . esc_html($attribute_value) . '</p>';
            }
            echo '</div>';
            echo '</div>';
            echo '<p>' . wc_price($variation_obj->get_price()) . '</p>';
            echo '</label>';
        }
        echo '</div>';
    }
}
