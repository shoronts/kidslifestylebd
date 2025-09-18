<?php

namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

class ShopCategory extends Widget_Base
{

    public function get_name()
    {
        return 'shopcategory';
    }

    public function get_title()
    {
        return esc_html__('Shop By Category', 'kidslifestylebd');
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
            'label' => esc_html__('Shop Categories', 'kidslifestylebd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'kidslifestylebd'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Shop By Category', 'kidslifestylebd'),
                'placeholder' => esc_html__('Type your title here', 'kidslifestylebd'),
            ]
        );

        $this->add_control('categories', [
            'label' => esc_html__('Select Categories', 'kidslifestylebd'),
            'type' => Controls_Manager::SELECT2,
            'multiple' => true,
            'label_block' => true,
            'options' => $this->get_all_product_categories(),
        ]);

        $this->end_controls_section();
    }

    /**
     * Get all WooCommerce product categories
     */
    private function get_all_product_categories()
    {
        $categories = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => true,
        ]);

        $options = [];
        foreach ($categories as $cat) {
            $options[$cat->term_id] = $cat->name;
        }

        return $options;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['categories'])) {
            echo '<p>' . esc_html__('Please select categories to display.', 'kidslifestylebd') . '</p>';
            return;
        }

        $categories = get_terms([
            'taxonomy' => 'product_cat',
            'include' => $settings['categories'],
            'hide_empty' => true,
        ]);

        if (empty($categories)) {
            return;
        }
?>
        <section id="category" class="py-5">
            <div class="container">
                <div class="py-4">
                    <h2 class="section-title"><?php echo esc_html($settings["title"]); ?></h2>
                </div>
                <div class="row g-4">
                    <div class="swiper category-swiper">
                        <div class="swiper-wrapper mb-5">
                            <?php foreach ($categories as $category):
                                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                                $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : wc_placeholder_img_src();
                                $link = get_term_link($category);
                            ?>
                                <div class="swiper-slide">
                                    <a href="<?php echo esc_url($link); ?>" class="text-center text-decoration-none">
                                        <div class="slide-item">
                                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
                                        </div>
                                        <div>
                                            <h5 class="dark-color"><?php echo esc_html($category->name); ?></h5>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
