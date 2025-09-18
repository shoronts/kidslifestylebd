<?php

namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Css_Filter;
use Elementor\Modules\DynamicTags\Module as TagsModule;

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
        // Contact Info Section
        $this->start_controls_section('contact_us_info', [
            'label' => esc_html__('Contact Info', 'kidslifestylebd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'contact_us_info_list',
            [
                'label' => esc_html__('Contact Info List', 'kidslifestylebd'),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'list_type',
                        'label' => esc_html__('Type', 'kidslifestylebd'),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            'address' => esc_html__('Address', 'kidslifestylebd'),
                            'email'   => esc_html__('Email', 'kidslifestylebd'),
                            'phone'   => esc_html__('Phone', 'kidslifestylebd'),
                        ],
                        'default' => 'address',
                        'placeholder' => esc_html__('Select type', 'kidslifestylebd'),
                    ],
                    [
                        'name' => 'list_content',
                        'label' => esc_html__('Content', 'kidslifestylebd'),
                        'type' => Controls_Manager::TEXT,
                        'default' => esc_html__('Sample content', 'kidslifestylebd'),
                        'placeholder' => esc_html__('Enter contact content', 'kidslifestylebd'),
                    ],
                ],
                'title_field' => '{{{ list_content }}}',
            ]
        );

        $this->end_controls_section();

        // Contact Form Section
        $this->start_controls_section('contact_form', [
            'label' => esc_html__('Contact Form', 'kidslifestylebd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'form_title',
            [
                'label' => esc_html__('Form Title', 'kidslifestylebd'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Let’s Talk', 'kidslifestylebd'),
            ]
        );

        $this->add_control(
            'form_description',
            [
                'label' => esc_html__('Form Description', 'kidslifestylebd'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Turpis nunc eget lorem dolor sed.consectetur adipiscing elit...', 'kidslifestylebd'),
            ]
        );

        // Dropdown for Contact Form 7 forms
        $this->add_control(
            'contact_form_7',
            [
                'label' => esc_html__('Select Contact Form', 'kidslifestylebd'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_cf7_forms(),
                'default' => '',
                'description' => esc_html__('Choose a Contact Form 7 form to display.', 'kidslifestylebd'),
            ]
        );

        $this->end_controls_section();

        // Google Map Section
        $this->start_controls_section('contact_map', [
            'label' => esc_html__('Google Map', 'kidslifestylebd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'map_address',
            [
                'label' => esc_html__('Address', 'kidslifestylebd'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Dhaka, Bangladesh',
                'placeholder' => 'Enter location',
                'dynamic' => [
                    'active' => true,
                    'categories' => [TagsModule::POST_META_CATEGORY],
                ],
            ]
        );

        $this->add_control(
            'map_zoom',
            [
                'label' => esc_html__('Zoom'),
                'type' => Controls_Manager::SLIDER,
                'default' => ['size' => 13],
                'range' => ['px' => ['min' => 1, 'max' => 20]],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Fetch all Contact Form 7 forms
     */
    private function get_cf7_forms()
    {
        $forms = [];
        if (class_exists('WPCF7')) {
            $cf7_posts = get_posts([
                'post_type' => 'wpcf7_contact_form',
                'numberposts' => -1,
            ]);
            if ($cf7_posts) {
                foreach ($cf7_posts as $form) {
                    $forms[$form->ID] = $form->post_title;
                }
            }
        }
        return $forms;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $info_list = $settings['contact_us_info_list'];

        $map_address = $settings['map_address'];
        $map_zoom = $settings['map_zoom']['size'];
        $map_src = 'https://maps.google.com/maps?q=' . rawurlencode($map_address) . '&z=' . absint($map_zoom) . '&output=embed';
?>
        <section class="section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Contact Info & Map -->
                        <div>
                            <div class="map-wrap mb-4">
                                <iframe
                                    title="<?php echo esc_attr($map_address); ?>"
                                    src="<?php echo esc_url($map_src); ?>"
                                    loading="lazy"
                                    allowfullscreen>
                                </iframe>
                            </div>

                            <ul class="list-unstyled row">
                                <?php foreach ($info_list as $item): ?>
                                    <li class="col-sm-4">
                                        <div class="d-flex justify-content-center align-items-center flex-column text-center py-4">
                                            <?php
                                            switch ($item['list_type']) {
                                                case 'address':
                                                    echo '
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-geo-alt main-color mb-2 fs-3" viewBox="0 0 16 16">
                                                    <path d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"/>
                                                    <path d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                                    </svg>';
                                                    echo '<span>' . esc_html($item['list_content']) . '</span>';
                                                    break;

                                                case 'email':
                                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-envelope main-color mb-2 fs-3" viewBox="0 0 16 16">
                                                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"/>
                                                    </svg>';
                                                    echo '<a href="mailto:' . esc_attr($item['list_content']) . '" class="text-muted text-decoration-none">' . esc_html($item['list_content']) . '</a>';
                                                    break;

                                                case 'phone':
                                                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-telephone main-color mb-2 fs-3" viewBox="0 0 16 16">
                                                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                                                    </svg>';
                                                    echo '<a href="tel:' . esc_attr($item['list_content']) . '" class="text-muted text-decoration-none">' . esc_html($item['list_content']) . '</a>';
                                                    break;

                                                default:
                                                    echo '<span>' . esc_html($item['list_content']) . '</span>';
                                                    break;
                                            }
                                            ?>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div>
                            <div class="mb-5">
                                <h2><?php echo esc_html($settings['form_title']); ?></h2>
                                <p><?php echo esc_html($settings['form_description']); ?></p>
                            </div>
                            <?php
                            if (!empty($settings['contact_form_7'])) {
                                echo do_shortcode('[contact-form-7 id="' . esc_attr($settings['contact_form_7']) . '"]');
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
    }
}
