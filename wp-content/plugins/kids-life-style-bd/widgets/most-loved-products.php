<?php

namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_Query;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Most_Loved_Products extends Widget_Base
{

    public function get_name()
    {
        return 'most_loved_products';
    }

    public function get_title()
    {
        return esc_html__('Most Loved Products', 'healthyeatsbd');
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

        $this->start_controls_section('most_loved_products', [
            'label' => esc_html__('Most Loved Products', 'healthyeatsbd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control(
            'image',
            [
                'label' => esc_html__('Choose Image', 'healthyeatsbd'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control('show_slider', [
            'label' => esc_html__('Show in Slider', 'healthyeatsbd'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'healthyeatsbd'),
            'label_off' => esc_html__('Hide', 'healthyeatsbd'),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->add_control('product_count', [
            'label' => esc_html__('Number of Products', 'healthyeatsbd'),
            'type' => Controls_Manager::NUMBER,
            'default' => 8,
        ]);

        $this->add_control('product_filter', [
            'label' => esc_html__('Filter Products', 'healthyeatsbd'),
            'type' => Controls_Manager::SELECT,
            'default' => 'default',
            'options' => [
                'default' => esc_html__('Default sorting', 'healthyeatsbd'),
                'new'     => esc_html__('New Arrivals', 'healthyeatsbd'),
                'popularity' => esc_html__('Sort by Popularity', 'healthyeatsbd'),
                'rating'  => esc_html__('Sort by Rating', 'healthyeatsbd'),
                'price_asc' => esc_html__('Price: Low to High', 'healthyeatsbd'),
                'price_desc' => esc_html__('Price: High to Low', 'healthyeatsbd'),
            ],
        ]);

        $this->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'healthyeatsbd'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('SEE ALL', 'healthyeatsbd'),
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => esc_html__('Button URL', 'healthyeatsbd'),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'healthyeatsbd'),
                'default' => [
                    'url' => '#',
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $image = $settings['image']['url'];
        $count = $settings['product_count'];
        $filter   = $settings['product_filter'] ?? 'default';

        $button_text = !empty($settings['button_text']) ? $settings['button_text'] : 'SEE ALL';
        $button_link = $settings['button_link']['url'] ?? '#';


        $args = [
            'post_type'      => 'product',
            'posts_per_page' => $count,
            'post_status'    => 'publish',
        ];

        // Add sorting or filtering based on the control value
        switch ($filter) {
            case 'new':
                // Filter only products marked as new
                $args['meta_query'] = [
                    [
                        'key'     => 'mark_this_new_product',
                        'value'   => 'New',
                        'compare' => '=',
                    ],
                ];
                // Optional: newest products first
                $args['orderby'] = 'date';
                $args['order']   = 'DESC';
                break;

            case 'popularity':
                // Sort by popularity (total_sales)
                $args['meta_key'] = 'total_sales';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'DESC';
                break;

            case 'rating':
                // Sort by average rating
                $args['meta_key'] = '_wc_average_rating';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'DESC';
                break;

            case 'price_asc':
                $args['meta_key'] = '_price';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'ASC';
                break;

            case 'price_desc':
                $args['meta_key'] = '_price';
                $args['orderby']  = 'meta_value_num';
                $args['order']    = 'DESC';
                break;

            case 'default':
            default:
                // Default sorting: use WooCommerce default (or your choice)
                break;
        }

        $products = new WP_Query($args);
?>

        <section id="home-product-card-section" class="py-5">
            <div class="container">
                <div class="loved-product text-center mb-5">
                    <img src="<?php echo esc_url($image); ?>" class="img-fluid" alt="lovedImage" decoding="async" loading="lazy">
                </div>
                <?php if (isset($settings['show_slider']) && $settings['show_slider'] === 'yes') : ?>
                    <div class="slider-products position-relative px-4">
                        <div class="swiper position-static most-loved-products-slider">
                            <div class="swiper-wrapper mb-5">
                                <?php
                                if ($products->have_posts()) :
                                    while ($products->have_posts()) : $products->the_post();
                                        global $product;
                                        $product_id = $product->get_id();
                                        $product_link = get_permalink();
                                        $product_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium')[0] ?? wc_placeholder_img_src();
                                        $price = $product->get_price_html();
                                        $title = get_the_title();
                                        $discount = '';
                                        $type = $product->get_type();

                                        if ($product->is_on_sale()) {
                                            if ($product->is_type('variable')) {
                                                $regular = floatval($product->get_variation_regular_price());
                                                $sale    = floatval($product->get_variation_sale_price());
                                            } else {
                                                $regular = floatval($product->get_regular_price());
                                                $sale    = floatval($product->get_sale_price());
                                            }

                                            if ($regular > 0 && $sale > 0) {
                                                $total_discount = round((($regular - $sale) / $regular) * 100);
                                                if ($total_discount > 0) {
                                                    $discount = '-' . $total_discount . '%';
                                                }
                                            }
                                        }

                                        $stock_status = $product->get_stock_status();
                                        switch ($stock_status) {
                                            case 'instock':
                                                $stock_label = 'Available';
                                                break;
                                            case 'outofstock':
                                                $stock_label = 'Not Available';
                                                break;
                                            case 'onbackorder':
                                                $stock_label = 'On Backorder';
                                                break;
                                            default:
                                                $stock_label = '';
                                                break;
                                        }

                                        $mark_this_new_product = get_post_meta($product->get_id(), 'mark_this_new_product', true);
                                ?>
                                        <div class="swiper-slide bd-transparent">
                                            <div class="card text-center position-relative">
                                                <div class="card-img">
                                                    <img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($title); ?>"
                                                        decoding="async" loading="lazy" style="width: 100%; height: 100%;">
                                                </div>
                                                <div class="extra-info-box">
                                                    <?php if ($discount) : ?>
                                                        <div class="new-badge discount mb-2"><?php echo esc_html($discount); ?></div>
                                                    <?php endif; ?>
                                                    <?php if ($mark_this_new_product) : ?>
                                                        <div class="new-badge new mb-2"><?php echo esc_html($mark_this_new_product); ?></div>
                                                    <?php endif; ?>
                                                    <?php if ($stock_label) : ?>
                                                        <div class="new-badge stock-out mb-2"><?php echo esc_html($stock_label); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                                <h4 class="product-title my-1 p-0">
                                                    <a href="<?php echo esc_url($product_link); ?>" class="text-decoration-none text-black">
                                                        <?php echo esc_html($title); ?>
                                                    </a>
                                                </h4>
                                                <p class="price text-center mb-2 p-0"><?php echo wp_kses_post($price); ?></p>

                                                <?php if ($type === 'simple' && $stock_status === 'instock') { ?>
                                                    <a href="<?php echo esc_url(wc_get_checkout_url() . '?add-to-cart=' . $product->get_id()); ?>" class="simple-btn">Buy Now</a>
                                                <?php } elseif ($type === 'variable' && $stock_status === 'instock') { ?>
                                                    <a href="<?php echo esc_url($product_link); ?>" class="card-btn">select option</a>
                                                <?php } else { ?>
                                                    <a href="<?php echo esc_url($product_link); ?>" class="simple-btn">read more</a>
                                                <?php } ?>

                                                <div class="hover-icon position-absolute d-flex flex-column">
                                                    <a href="<?php echo esc_url($product_link); ?>" class="text-black">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search mb-3" viewBox="0 0 16 16">
                                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                                        </svg>
                                                    </a>
                                                    <button class="add-to-wishlist-btn btn p-0" type="button" data-product-id="<?php echo get_the_ID(); ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                            fill="currentColor" class="bi bi-heart default" viewBox="0 0 16 16">
                                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878
                                                            1.4 3.053c-.523 1.023-.641 2.5.314
                                                            4.385.92 1.815 2.834 3.989 6.286
                                                            6.357 3.452-2.368 5.365-4.542
                                                            6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878
                                                            10.4.28 8.717 2.01zM8 15C-7.333
                                                            4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3
                                                            3 0 0 1 .176-.17C12.72-3.042 23.333 4.867
                                                            8 15" />
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" class="loading d-none">
                                                            <radialGradient id="a5" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)">
                                                                <stop offset="0" stop-color="#FF156D"></stop>
                                                                <stop offset=".3" stop-color="#FF156D" stop-opacity=".9"></stop>
                                                                <stop offset=".6" stop-color="#FF156D" stop-opacity=".6"></stop>
                                                                <stop offset=".8" stop-color="#FF156D" stop-opacity=".3"></stop>
                                                                <stop offset="1" stop-color="#FF156D" stop-opacity="0"></stop>
                                                            </radialGradient>
                                                            <circle transform-origin="center" fill="none" stroke="url(#a5)" stroke-width="15" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70">
                                                                <animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform>
                                                            </circle>
                                                            <circle transform-origin="center" fill="none" opacity=".2" stroke="#FF156D" stroke-width="15" stroke-linecap="round" cx="100" cy="100" r="70"></circle>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check-lg complete d-none" viewBox="0 0 16 16">
                                                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                    endwhile;
                                    wp_reset_postdata();
                                endif;
                                ?>
                            </div>
                            <div class="swiper-pagination"></div>
                            <!-- Scroll Buttons and Pagination -->
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="no-slider-products row store-product-grid">
                        <?php
                        if ($products->have_posts()) :
                            while ($products->have_posts()) : $products->the_post();
                                global $product;

                                $product_link = get_permalink();
                                $product_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium')[0] ?? wc_placeholder_img_src();
                                $price = $product->get_price_html();
                                $title = get_the_title();
                                $discount = '';
                                $type = $product->get_type();

                                if ($product->is_on_sale()) {
                                    if ($product->is_type('variable')) {
                                        $regular = floatval($product->get_variation_regular_price());
                                        $sale    = floatval($product->get_variation_sale_price());
                                    } else {
                                        $regular = floatval($product->get_regular_price());
                                        $sale    = floatval($product->get_sale_price());
                                    }

                                    if ($regular > 0 && $sale > 0) {
                                        $total_discount = round((($regular - $sale) / $regular) * 100);
                                        if ($total_discount > 0) {
                                            $discount = '-' . $total_discount . '%';
                                        }
                                    }
                                }

                                $stock_status = $product->get_stock_status();
                                switch ($stock_status) {
                                    case 'instock':
                                        $stock_label = 'Available';
                                        break;
                                    case 'outofstock':
                                        $stock_label = 'Not Available';
                                        break;
                                    case 'onbackorder':
                                        $stock_label = 'On Backorder';
                                        break;
                                    default:
                                        $stock_label = '';
                                        break;
                                }

                                $mark_this_new_product = get_post_meta($product->get_id(), 'mark_this_new_product', true);
                        ?>
                                <div class="col-md-3 col-sm-12 mb-3">
                                    <a class="text-decoration-none" href="<?php echo esc_url($product_link); ?>">
                                        <div class="card store-card text-center position-relative h-100">
                                            <div class="card-img p-0">
                                                <a href="<?php echo esc_url($product_link); ?>">
                                                    <img src="<?php echo esc_url($product_image); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy" decoding="async">
                                                </a>
                                                <div class="extra-info-box">
                                                    <?php if ($discount) : ?>
                                                        <div class="new-badge discount mb-2"><?php echo esc_html($discount); ?></div>
                                                    <?php endif; ?>
                                                    <?php if ($mark_this_new_product) : ?>
                                                        <div class="new-badge new mb-2"><?php echo esc_html($mark_this_new_product); ?></div>
                                                    <?php endif; ?>
                                                    <?php if ($stock_label) : ?>
                                                        <div class="new-badge stock-out mb-2"><?php echo esc_html($stock_label); ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <h6 class="my-1 p-0"><?php echo esc_html($title); ?></h6>
                                                <p class="price text-center"><?php echo $price; ?></p>

                                                <?php if ($type === 'simple' && $stock_status === 'instock') { ?>
                                                    <a href="<?php echo esc_url(wc_get_checkout_url() . '?add-to-cart=' . $product->get_id()); ?>" class="simple-btn">Buy Now</a>
                                                <?php } elseif ($type === 'variable' && $stock_status === 'instock') { ?>
                                                    <a href="<?php echo esc_url($product_link); ?>" class="card-btn">select option</a>
                                                <?php } else { ?>
                                                    <a href="<?php echo esc_url($product_link); ?>" class="simple-btn">read more</a>
                                                <?php } ?>

                                                <div class="hover-icon position-absolute d-flex flex-column">
                                                    <a href="<?php echo esc_url($product_link); ?>" class="text-black">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-search mb-3" viewBox="0 0 16 16">
                                                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                                        </svg>
                                                    </a>
                                                    <button class="add-to-wishlist-btn btn p-0" type="button" data-product-id="<?php echo get_the_ID(); ?>">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"
                                                            fill="currentColor" class="bi bi-heart default" viewBox="0 0 16 16">
                                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878
                                                            1.4 3.053c-.523 1.023-.641 2.5.314
                                                            4.385.92 1.815 2.834 3.989 6.286
                                                            6.357 3.452-2.368 5.365-4.542
                                                            6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878
                                                            10.4.28 8.717 2.01zM8 15C-7.333
                                                            4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3
                                                            3 0 0 1 .176-.17C12.72-3.042 23.333 4.867
                                                            8 15" />
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" class="loading d-none">
                                                            <radialGradient id="a5" cx=".66" fx=".66" cy=".3125" fy=".3125" gradientTransform="scale(1.5)">
                                                                <stop offset="0" stop-color="#FF156D"></stop>
                                                                <stop offset=".3" stop-color="#FF156D" stop-opacity=".9"></stop>
                                                                <stop offset=".6" stop-color="#FF156D" stop-opacity=".6"></stop>
                                                                <stop offset=".8" stop-color="#FF156D" stop-opacity=".3"></stop>
                                                                <stop offset="1" stop-color="#FF156D" stop-opacity="0"></stop>
                                                            </radialGradient>
                                                            <circle transform-origin="center" fill="none" stroke="url(#a5)" stroke-width="15" stroke-linecap="round" stroke-dasharray="200 1000" stroke-dashoffset="0" cx="100" cy="100" r="70">
                                                                <animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="360;0" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform>
                                                            </circle>
                                                            <circle transform-origin="center" fill="none" opacity=".2" stroke="#FF156D" stroke-width="15" stroke-linecap="round" cx="100" cy="100" r="70"></circle>
                                                        </svg>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-check-lg complete d-none" viewBox="0 0 16 16">
                                                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div>
                <?php endif; ?>
                <div class="btn-box d-flex align-content-center mt-5 justify-content-center">
                    <a href="<?php echo esc_url($button_link); ?>" class="see-btn">
                        <?php echo esc_html($button_text); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="30" fill="currentColor"
                            class="bi bi-arrow-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1
                .708-.708l4 4a.5.5 0 0 1 0
                .708l-4 4a.5.5 0 0 1-.708-.708L13.293
                8.5H1.5A.5.5 0 0 1 1 8"
                                stroke="currentColor" stroke-width="1.5" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

<?php
    }
}
