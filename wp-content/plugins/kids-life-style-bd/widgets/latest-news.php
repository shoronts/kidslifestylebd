<?php

namespace KidsLifeStyleBD\Widgets;

if (! defined('ABSPATH')) exit; // Exit if accessed directly

class LatestNews extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'latest_news';
    }

    public function get_title()
    {
        return esc_html__('Latest News', 'kidslifestylebd');
    }

    public function get_icon()
    {
        return 'eicon-posts-grid';
    }

    public function get_categories()
    {
        return ['kids_life_style_bd'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Blog Settings', 'kidslifestylebd'),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'kidslifestylebd'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Latest News', 'kidslifestylebd'),
                'placeholder' => esc_html__('Type your title here', 'kidslifestylebd'),
            ]
        );
        
        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'kidslifestylebd'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'kidslifestylebd'),
                'placeholder' => esc_html__('Type your description here', 'kidslifestylebd'),
            ]
        );

        $this->add_control(
            'select_blog_posts',
            [
                'label'       => __('Select Blog Posts', 'kidslifestylebd'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'multiple'    => true,
                'options'     => $this->get_blog_posts_options(),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Fetch all blog posts for the select options
     */
    private function get_blog_posts_options()
    {
        $options = [];

        $posts = get_posts([
            'post_type'      => 'post',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        if (! empty($posts)) {
            foreach ($posts as $post) {
                $options[$post->ID] = $post->post_title;
            }
        }

        return $options;
    }

    protected function render()
    {
        $settings       = $this->get_settings_for_display();
        $selected_posts = $settings['select_blog_posts'];

        if (! empty($selected_posts)) {
            $query = new \WP_Query([
                'post_type' => 'post',
                'post__in'  => $selected_posts,
                'orderby'   => 'post__in',
            ]);

            if ($query->have_posts()) {
?>
                <section id="news" class="py-3 py-lg-5">
                    <div class="container">
                        <div class="heading text-left mb-4 mb-lg-5">
                            <h2 class="mb-2"><?php echo esc_html($settings["title"]); ?></h2>
                            <p><?php echo esc_html($settings["description"]); ?></p>
                        </div>
                        <div class="swiper news-swiper">
                            <div class="swiper-wrapper mb-5 mb-lg-0">
                                <?php
                                while ($query->have_posts()) {
                                    $query->the_post();
                                ?>
                                    <div class="swiper-slide h-100">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                            <div class="news-card d-flex flex-column justify-content-start align-items-start">
                                                <div class="card-img mb-3">
                                                    <?php if (has_post_thumbnail()) { ?>
                                                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>" class="card-img-top rounded-4" alt="<?php the_title_attribute(); ?>">
                                                    <?php } ?>
                                                </div>
                                                <div class="card-body h-100">
                                                    <p class="text-muted mb-2 small">
                                                        <?php echo esc_html__('By', 'kidslifestylebd'); ?> <?php the_author(); ?> • <?php echo get_the_date('M d, Y'); ?>
                                                    </p>
                                                    <h5 class="card-title mb-2"><?php the_title(); ?></h5>
                                                    <p class="card-text text-truncate-3 mb-3">
                                                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                                                    </p>
                                                </div>
                                                <a href="<?php the_permalink(); ?>" class="shop-now-btn">
                                                    <?php echo esc_html__('Read More', 'kidslifestylebd'); ?>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>

                            <!-- Pagination -->
                            <div class="swiper-pagination mt-3 pt-5 d-block d-lg-none d-md-none"></div>
                        </div>
                    </div>
                </section>
<?php
                wp_reset_postdata();
            }
        } else {
            echo '<p>' . __('No blog posts selected.', 'kidslifestylebd') . '</p>';
        }
    }
}
