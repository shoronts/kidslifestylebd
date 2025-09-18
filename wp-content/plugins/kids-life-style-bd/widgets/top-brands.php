<?php
namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class KidsLifestyle_Top_Brands_Widget extends Widget_Base {

    public function get_name() {
        return 'kidslifestyle_top_brands';
    }

    public function get_title() {
        return __( 'Top Brands', 'kidslifestylebd' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'kids_life_style_bd' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Top Brands', 'kidslifestylebd' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Section Title
        $this->add_control(
            'section_title',
            [
                'label' => __( 'Section Title', 'kidslifestylebd' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Top Brands', 'kidslifestylebd' ),
            ]
        );

        // Repeater for Brand Logos
        $repeater = new Repeater();

        $repeater->add_control(
            'brand_logo',
            [
                'label' => __( 'Brand Logo', 'kidslifestylebd' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'brand_link',
            [
                'label' => __( 'Brand Link', 'kidslifestylebd' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://example.com', 'kidslifestylebd' ),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->add_control(
            'brands',
            [
                'label' => __( 'Brands', 'kidslifestylebd' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [],
                'title_field' => '{{{ brand_logo.url }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <section class="py-3 py-lg-5">
            <div class="container">
                <div class="heading text-center mb-4">
                    <h2 class="section-title"><?php echo esc_html( $settings['section_title'] ); ?></h2>
                </div>
                <div class="row px-3 px-lg-0">
                    <!-- Swiper -->
                    <div class="swiper brands-swiper">
                        <div class="swiper-wrapper mb-5">
                            <?php foreach ( $settings['brands'] as $brand ) : 
                                $link_open = $brand['brand_link']['url'] ? '<a href="' . esc_url( $brand['brand_link']['url'] ) . '" class="text-decoration-none" target="_blank" rel="nofollow">' : '';
                                $link_close = $brand['brand_link']['url'] ? '</a>' : '';
                                ?>
                                <div class="swiper-slide">
                                    <?php echo $link_open; ?>
                                        <div class="slide-item text-center">
                                            <img src="<?php echo esc_url( $brand['brand_logo']['url'] ); ?>" class="img-fluid w-50" loading="lazy" alt="brand-logo">
                                        </div>
                                    <?php echo $link_close; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php
    }

}