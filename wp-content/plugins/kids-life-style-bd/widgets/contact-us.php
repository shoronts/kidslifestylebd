<?php

namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) exit;

class ContactUs extends Widget_Base
{

    public function get_name()
    {
        return 'contact_us';
    }

    public function get_title()
    {
        return esc_html__('Contact Us', 'kidslifestylebd');
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
        $this->start_controls_section('contact_us_company_info', [
            'label' => esc_html__('COMPANY INFO', 'kidslifestylebd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'kidslifestylebd'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('COMPANY INFO', 'kidslifestylebd'),
                'placeholder' => esc_html__('Type your title here', 'kidslifestylebd'),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'kidslifestylebd'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('Healthy Eats collects pure and fresh groceries directly from core farmers and serve you to your door', 'kidslifestylebd'),
                'placeholder' => esc_html__('Type your description here', 'kidslifestylebd'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('contact_us_info', [
            'label' => esc_html__('CONTACT INFO', 'kidslifestylebd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'contact_us_info_list',
            [
                'label' => esc_html__('Contact Info', 'kidslifestylebd'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'list_icon',
                        'label' => esc_html__('Icon', 'kidslifestylebd'),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'default' => [
                            'value' => 'fas fa-star',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'name' => 'list_content',
                        'label' => esc_html__('Content', 'kidslifestylebd'),
                        'type' => \Elementor\Controls_Manager::WYSIWYG,
                        'default' => esc_html__('List Content', 'kidslifestylebd'),
                        'show_label' => false,
                    ],
                ],
                'default' => [
                    [
                        'list_text' => esc_html__('Text #1', 'kidslifestylebd'),
                        'list_content' => esc_html__('Item content for Title #1.', 'kidslifestylebd'),
                    ]
                ],
                'title_field' => esc_html__('List Item', 'kidslifestylebd'),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section('contact_form', [
            'label' => esc_html__('CONTACT FORM', 'kidslifestylebd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'form_title',
            [
                'label' => esc_html__('Title', 'kidslifestylebd'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('SEND US AN EMAIL', 'kidslifestylebd'),
                'placeholder' => esc_html__('Type your title here', 'kidslifestylebd'),
            ]
        );

        $this->add_control(
            'short_code',
            [
                'label' => esc_html__('Short Code', 'kidslifestylebd'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'default' => esc_html__('', 'kidslifestylebd'),
                'placeholder' => esc_html__('Type your short code here', 'kidslifestylebd'),
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $info_list = $settings['contact_us_info_list'];
?>
        <section class="py-5">
            <div class="container-xl">
                <div class="contact-content row g-5">
                    <div class="info-container col-12 col-lg-6 border-end p-md-5">
                        <div class="company-info-content">
                            <h2 class="section-title"><?php echo esc_html($settings["title"]); ?></h2>
                            <hr class="horizental">
                            <p class="mb-4 section-text"><?php echo $settings["description"]; ?></p>
                            <h2 class="section-title">CONTACT US</h2>
                            <hr class="horizental">

                            <div class="about-us row g-5 py-4 align-items-center justify-content-between">
                                <?php foreach ($info_list as $item) : ?>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="info-item w-100">
                                            <div class="d-flex align-items-center gap-2">
                                                <?php
                                                \Elementor\Icons_Manager::render_icon(
                                                    $item['list_icon'],
                                                    ['aria-hidden' => 'true', 'class' => 'contact-icon', 'style' => 'width: 48px; height: 48px; fill: #D1D1D1;']
                                                );
                                                ?>
                                                <div class="info-content"><?php echo $item["list_content"]; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-container col-12 col-lg-6 border-start p-md-5">
                        <h2 class="section-title"><?php echo $settings["form_title"]; ?></h2>
                        <hr class="horizental my-3">
                        <?php
                        if (!empty($settings['short_code'])) {
                            echo do_shortcode($settings['short_code']);
                        };
                        ?>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
};
