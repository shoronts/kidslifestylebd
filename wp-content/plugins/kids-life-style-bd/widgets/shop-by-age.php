<?php

namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if (!defined('ABSPATH')) exit;

class ShopByAge extends Widget_Base
{
    public function get_name()
    {
        return 'shopbyage';
    }

    public function get_title()
    {
        return esc_html__('Shop By Age', 'kidslifestylebd');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_categories()
    {
        return ['kids_life_style_bd'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section('content_section', [
            'label' => esc_html__('Age Cards', 'kidslifestylebd'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'kidslifestylebd'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Shop By Age', 'kidslifestylebd'),
                'placeholder' => esc_html__('Type your title here', 'kidslifestylebd'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control('age_image', [
            'label' => esc_html__('Card Image', 'kidslifestylebd'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ]);

        $repeater->add_control('age_title', [
            'label' => esc_html__('Age Title', 'kidslifestylebd'),
            'type' => Controls_Manager::TEXT,
            'default' => '0 - 12',
        ]);

        $repeater->add_control('age_description', [
            'label' => esc_html__('Description', 'kidslifestylebd'),
            'type' => Controls_Manager::TEXT,
            'default' => 'Months',
        ]);

        $repeater->add_control('age_link', [
            'label' => esc_html__('Link', 'kidslifestylebd'),
            'type' => Controls_Manager::URL,
            'placeholder' => esc_html__('https://your-link.com', 'kidslifestylebd'),
        ]);

        $this->add_control('age_cards', [
            'label' => esc_html__('Age Cards', 'kidslifestylebd'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{ age_title }}}',
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        if (empty($settings['age_cards'])) {
            echo '<p>' . esc_html__('Please add some age cards.', 'kidslifestylebd') . '</p>';
            return;
        }
?>
        <section id="age" class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="heading">
                        <h2 class="section-title"><?php echo esc_html($settings["title"]); ?></h2>
                    </div>
                    <div class="row">
                        <div class="swiper age-swiper">
                            <div class="swiper-wrapper mb-5">
                                <?php foreach ($settings['age_cards'] as $index => $card): ?>
                                    <style>
                                        .grid-banner-block-image.card-age<?php echo $index; ?>::before {
                                            -webkit-mask-image: url('<?php echo esc_url($card['age_image']['url']); ?>');
                                            mask-image: url('<?php echo esc_url($card['age_image']['url']); ?>');
                                        };
                                    </style>
                                    <div class="swiper-slide d-flex justify-content-center flex-column align-items-center">
                                        <a class="text-black age-card-link" href="<?php echo esc_url($card['age_link']['url']); ?>">
                                            <div class="grid-banner-block-image card-age<?php echo $index; ?>">
                                                <img class="grid-banner-image img-fluid"
                                                    src="<?php echo get_template_directory_uri() . "/assets/media/shop-by-age.png" ?>"
                                                    loading="lazy" decoding="async"
                                                    alt="<?php echo esc_attr($card['age_title']); ?>">
                                            </div>
                                            <div class="grid-banner-content">
                                                <div class="grid-banner-inner text-center">
                                                    <h4 class="main-title"><?php echo esc_html($card['age_title']); ?></h4>
                                                    <p class="description"><?php echo esc_html($card['age_description']); ?></p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="swiper-pagination pt-4"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
