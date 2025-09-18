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
        <section class="pt-4">
            <div id="page-banner" class="container-fluid page-banner">
                <div class="px-2 px-lg-4">
                    <div class="banner-content h-100 rounded-3" style="background-image: url('<?php echo esc_url($settings['breadcrumb_image']['url']); ?>');">
                        <div class="text-center py-4">
                            <h2 class="mb-3"><?php echo esc_html($settings['breadcrumb_title']); ?></h2>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0 d-flex justify-content-center align-items-center">
                                    <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url()); ?>" class="text-decoration-none">Home</a></li>
                                    <li class="breadcrumb-item"><?php echo esc_html($settings['breadcrumb_text']); ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
