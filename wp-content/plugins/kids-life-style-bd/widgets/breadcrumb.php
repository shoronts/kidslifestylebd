<?php

namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit;

class Breadcrumb extends Widget_Base
{

    public function get_name()
    {
        return 'breadcrumb';
    }

    public function get_title()
    {
        return esc_html__('breadcrumb', 'kidslifestylebd');
    }

    public function get_icon()
    {
        return 'eicon-banner';
    }

    public function get_categories()
    {
        return ['kids_life_style_bd'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section('breadcrumb_content', [
            'label' => esc_html__('Breadcrumb Content', 'kidslifestylebd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('breadcrumb_image', [
            'label' => esc_html__('Background Image', 'kidslifestylebd'),
            'type'  => Controls_Manager::MEDIA,
            'default' => [
                'url' => \Elementor\Utils::get_placeholder_image_src(),
            ],
        ]);

        $this->add_control('breadcrumb_title', [
            'label' => esc_html__('Title', 'kidslifestylebd'),
            'type'  => Controls_Manager::TEXT,
            'default' => esc_html__('Title', 'kidslifestylebd'),
        ]);

        $this->add_control('breadcrumb_text', [
            'label' => esc_html__('Subtitle', 'kidslifestylebd'),
            'type'  => Controls_Manager::TEXT,
            'default' => esc_html__('Sub Title', 'kidslifestylebd'),
        ]);

        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();
?>
        <section id="breadcrumb" class="d-flex align-items-center justify-content-center" style="background-image: url(<?php echo esc_url($settings['breadcrumb_image']['url']); ?>);">
            <div class="breadcrumb-content">
                <h1 class="banner-header"><?php echo esc_html($settings['breadcrumb_title']); ?></h1>
                <div class="d-flex gap-2 justify-content-center">
                    <p class="banner-home">
                        <a class="text-decoration-none text-black" href="<?php echo esc_url(home_url()); ?>">Home</a>
                    </p>
                    <span>/</span>
                    <p class="banner-store"><?php echo esc_html($settings['breadcrumb_text']); ?></p>
                </div>
            </div>
        </section>
<?php
    }
}
