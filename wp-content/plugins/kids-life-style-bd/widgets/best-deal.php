<?php

namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if (!defined('ABSPATH')) exit;

class BestDeal extends Widget_Base
{
    public function get_name()
    {
        return 'bestdeal';
    }

    public function get_title()
    {
        return esc_html__('Best Deal', 'kidslifestylebd');
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
            'label' => esc_html__('Best Deal Cards', 'kidslifestylebd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        // Repeater
        $repeater = new Repeater();

        $repeater->add_control('card_image', [
            'label' => esc_html__('Card Image', 'kidslifestylebd'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ]);

        $repeater->add_control('card_title', [
            'label' => esc_html__('Card Title', 'kidslifestylebd'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Card Title', 'kidslifestylebd'),
        ]);

        $repeater->add_control('card_description', [
            'label' => esc_html__('Card Description', 'kidslifestylebd'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => esc_html__('Card Description', 'kidslifestylebd'),
        ]);

        $repeater->add_control('card_link', [
            'label' => esc_html__('Button Link', 'kidslifestylebd'),
            'type' => Controls_Manager::URL,
            'placeholder' => esc_html__('https://your-link.com', 'kidslifestylebd'),
        ]);

        $this->add_control('cards', [
            'label' => esc_html__('Cards', 'kidslifestylebd'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ card_title }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['cards'])) {
            echo '<p>' . esc_html__('Please add some cards.', 'kidslifestylebd') . '</p>';
            return;
        }
?>
        <section id="cards" class="py-3">
            <div class="container">
                <div class="swiper card-swiper" id="card-swiper">
                    <div class="swiper-wrapper mb-5">
                        <?php foreach ($settings['cards'] as $card): ?>
                            <div class="swiper-slide">
                                <div class="grid-banner-block-image">
                                    <img class="grid-banner-image img-fluid"
                                        src="<?php echo esc_url($card['card_image']['url']); ?>"
                                        loading="lazy"
                                        alt="<?php echo esc_attr($card['card_title']); ?>">
                                </div>
                                <div class="grid-banner-content">
                                    <div class="grid-banner-inner d-flex flex-column">
                                        <h3 class="main-title"><?php echo esc_html($card['card_title']); ?></h3>
                                        <p class="description"><?php echo esc_html($card['card_description']); ?></p>
                                        <div class="button-wrapper">
                                            <a href="<?php echo esc_url($card['card_link']['url']); ?>"
                                                class="shop-now-btn">
                                                <?php esc_html_e('Shop now', 'kidslifestylebd'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>
<?php
    }
}
