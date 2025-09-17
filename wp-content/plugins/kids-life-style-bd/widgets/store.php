<?php

namespace KidsLifeStyleBD\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_Query;

if (!defined('ABSPATH')) exit;

class Store extends Widget_Base
{

    public function get_name()
    {
        return 'store';
    }

    public function get_title()
    {
        return esc_html__('Store', 'healthyeatsbd');
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
        $this->start_controls_section('store_settings', [
            'label' => esc_html__('Store Settings', 'healthyeatsbd'),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ]);

        $this->add_control('product_count', [
            'label' => esc_html__('Number of Products', 'healthyeatsbd'),
            'type' => Controls_Manager::NUMBER,
            'default' => 8,
        ]);

        $this->add_control('product_columns', [
            'label' => esc_html__('Columns (Desktop)', 'healthyeatsbd'),
            'type' => Controls_Manager::SELECT,
            'default' => '4',
            'options' => [
                '2' => '2',
                '3' => '3',
                '4' => '4',
            ],
        ]);

        $this->add_control('show_filters', [
            'label' => esc_html__('Show Filters', 'healthyeatsbd'),
            'type' => \Elementor\Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'healthyeatsbd'),
            'label_off' => esc_html__('Hide', 'healthyeatsbd'),
            'return_value' => 'yes',
            'default' => 'yes',
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $count = $settings['product_count'];
        $columns = $settings['product_columns'];

        $args = [
            'post_type' => 'product',
            'posts_per_page' => $count,
            'post_status' => 'publish',
        ];

        $loop = new \WP_Query($args);
?>
        <?php if ($settings['show_filters'] === 'yes') : ?>
            <section id="store-option-section">
                <div class="container">
                    <div class="option-container text-center">
                        <div class="option-content row g-3 align-content-center">
                            <!-- Categories -->
                            <div class="col-12 col-md-6 col-lg">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle main-dropdown d-flex justify-content-between align-items-center"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        CATEGORIES
                                    </button>
                                    <ul class="dropdown-menu category-filter" style="width: 100%;">
                                        <?php
                                        $terms = get_terms(['taxonomy' => 'product_cat', 'hide_empty' => false]);
                                        foreach ($terms as $term) {
                                            echo '<li><a class="dropdown-item category-item" data-term_id="' . esc_attr($term->term_id) . '" href="#">' . esc_html($term->name) . '</a></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- Stock Status -->
                            <div class="col-12 col-md-6 col-lg">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle main-dropdown d-flex justify-content-between align-items-center"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        STOCK STATUS
                                    </button>
                                    <ul class="dropdown-menu" style="width: 100%;">
                                        <li><a class="dropdown-item" href="#">On sale</a></li>
                                        <li><a class="dropdown-item" href="#">In stock</a></li>
                                        <li><a class="dropdown-item" href="#">On backorder</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Sort By -->
                            <div class="col-12 col-md-6 col-lg">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle main-dropdown d-flex justify-content-between align-items-center"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        SORT BY
                                    </button>
                                    <ul class="dropdown-menu" style="width: 100%;">
                                        <li><a class="dropdown-item sort-option" data-sort="default" href="#">Default sorting</a></li>
                                        <li><a class="dropdown-item sort-option" data-sort="popularity" href="#">Sort by popularity</a></li>
                                        <li><a class="dropdown-item sort-option" data-sort="rating" href="#">Sort by average rating</a></li>
                                        <li><a class="dropdown-item sort-option" data-sort="new" href="#">Sort by latest</a></li>
                                        <li><a class="dropdown-item sort-option" data-sort="price_asc" href="#">Sort by price: low to high</a></li>
                                        <li><a class="dropdown-item sort-option" data-sort="price_desc" href="#">Sort by price: high to low</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Price Filter (kept as-is) -->
                            <div class="col-12 col-md-6 col-lg">
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle main-dropdown d-flex justify-content-between align-items-center"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span>FILTER BY PRICE</span>
                                        <span class="price-range-text" id="priceRangeText">৳0 - ৳932</span>
                                    </button>
                                    <ul class="dropdown-menu" style="width: 100%;">
                                        <div class="price-range-container">
                                            <div class="slider-container">
                                                <input type="range" class="form-range slider" min="0" max="932" value="0" id="minRange" />
                                                <input type="range" class="form-range slider" min="0" max="932" value="932" id="maxRange" />
                                                <div class="slider-track"></div>
                                                <div class="slider-range" id="sliderRange"></div>
                                                <div class="slider-thumb" id="minThumb"></div>
                                                <div class="slider-thumb" id="maxThumb"></div>
                                            </div>
                                            <div class="price-labels d-flex justify-content-between mt-2">
                                                <span>৳ <span id="minValue">0</span></span>
                                                <span>৳ <span id="maxValue">932</span></span>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg text-center">
                                <button class="filter-btn">FILTER</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Products Grid -->
        <section class="my-5">
            <div class="container-xl">
                <div class="row store-product-grid" id="store-product-grid">
                    <?php if ($loop->have_posts()) : ?>
                        <?php while ($loop->have_posts()) : $loop->the_post();
                            global $product;
                            $product_link = get_permalink();
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium')[0] ?? wc_placeholder_img_src();
                            $price = $product->get_price_html();
                            $title = get_the_title();
                        ?>
                            <div class="col-md-<?php echo esc_attr(12 / intval($columns)); ?> mb-4">
                                <div class="card store-card text-center position-relative h-100">
                                    <div class="card-img p-0">
                                        <a href="<?php echo esc_url($product_link); ?>">
                                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" loading="lazy">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="my-1 p-0">
                                            <a href="<?php echo esc_url($product_link); ?>" class="text-black">
                                                <?php echo esc_html($title); ?>
                                            </a>
                                        </h6>
                                        <p class="price text-center"><?php echo $price; ?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;
                        wp_reset_postdata(); ?>
                    <?php else : ?>
                        <p><?php esc_html_e('No products found.', 'healthyeatsbd'); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <!-- Sorting Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.sort-option').forEach(function(item) {
                    item.addEventListener('click', function(e) {
                        e.preventDefault();

                        const sortBy = this.getAttribute('data-sort');
                        const grid = document.getElementById('store-product-grid');

                        grid.innerHTML = '<p>Loading...</p>';

                        fetch('<?php echo admin_url('admin-ajax.php'); ?>?action=filter_products_by_sort&sort=' + sortBy)
                            .then(response => response.text())
                            .then(html => {
                                grid.innerHTML = html;
                            })
                            .catch(err => {
                                grid.innerHTML = '<p>Error loading products.</p>';
                                console.error(err);
                            });
                    });
                });
            });
        </script>
<?php
    }
}

add_action('wp_ajax_filter_products_by_sort', 'filter_products_by_sort_callback');
add_action('wp_ajax_nopriv_filter_products_by_sort', 'filter_products_by_sort_callback');

function filter_products_by_sort_callback()
{
    $sort = $_GET['sort'] ?? 'default';

    $args = [
        'post_type' => 'product',
        'posts_per_page' => 8,
        'post_status' => 'publish',
    ];

    switch ($sort) {
        case 'popularity':
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'rating':
            $args['meta_key'] = '_wc_average_rating';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
        case 'new':
            $args['orderby'] = 'date';
            $args['order'] = 'DESC';
            break;
        case 'price_asc':
            $args['meta_key'] = '_price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'ASC';
            break;
        case 'price_desc':
            $args['meta_key'] = '_price';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
            break;
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            global $product;
            $title = get_the_title();
            $link = get_permalink();
            $price_html = $product->get_price_html();
            $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium')[0] ?? wc_placeholder_img_src();

            echo '<div class="col-md-3 mb-4">';
            echo '<a href="' . esc_url($link) . '" class="text-decoration-none">';
            echo '<div class="card store-card text-center position-relative h-100">';
            echo '<div class="card-img"><img src="' . esc_url($image) . '" alt="' . esc_attr($title) . '"></div>';
            echo '<h6 class="my-1 p-0">' . esc_html($title) . '</h6>';
            echo '<p class="price text-center mb-2 p-0">' . $price_html . '</p>';
            echo '</div></a></div>';
        }
        wp_reset_postdata();
    } else {
        echo '<p>No products found.</p>';
    }

    wp_die();
}
