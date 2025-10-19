<?php

/**
 * The main template file for Kids Life Style BD
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Kids Life Style BD
 */
?>
<!-- The Header -->
<?php get_header(); ?>
<!-- The Body -->
<main id="main-body">
    <?php
    $logo_id_or_url = get_theme_mod('blog_breadcrumb');
    $blog_breadcrumb_url = "";
    if ($logo_id_or_url && (is_numeric($logo_id_or_url) || filter_var($logo_id_or_url, FILTER_VALIDATE_URL))) {
        if (is_numeric($logo_id_or_url)) {
            $blog_breadcrumb_url = wp_get_attachment_url($logo_id_or_url);
        } else {
            $blog_breadcrumb_url = esc_url($logo_id_or_url);
        }
    }
    ?>
    <section class="pt-4">
        <div id="contact-page-banner" class="container-fluid page-banner">
            <div class="px-2 px-lg-4">
                <div class="banner-content h-100 rounded-3" style="background-image: url('<?php echo $blog_breadcrumb_url; ?>');">
                    <div class="text-center py-4">
                        <h2 class="mb-3">Blogs</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex justify-content-center align-items-center">
                                <li class="breadcrumb-item"><a href="<?php echo esc_url(home_url()); ?>" class="text-decoration-none">Home</a></li>
                                <li class="breadcrumb-item">Blogs</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blogs" class="section-padding px-4">
        <div class="container-fluid">
            <div class="d-lg-none d-md-none py-3">
                <button class="shop-now-btn" data-bs-toggle="offcanvas" data-bs-target="#blogSidebar">
                    <svg class="main-color" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M19,2H5A3,3,0,0,0,2,5V6.17a3,3,0,0,0,.25,1.2l0,.06a2.81,2.81,0,0,0,.59.86L9,14.41V21a1,1,0,0,0,.47.85A1,1,0,0,0,10,22a1,1,0,0,0,.45-.11l4-2A1,1,0,0,0,15,19V14.41l6.12-6.12a2.81,2.81,0,0,0,.59-.86l0-.06A3,3,0,0,0,22,6.17V5A3,3,0,0,0,19,2ZM13.29,13.29A1,1,0,0,0,13,14v4.38l-2,1V14a1,1,0,0,0-.29-.71L5.41,8H18.59ZM20,6H4V5A1,1,0,0,1,5,4H19a1,1,0,0,1,1,1Z"></path>
                    </svg>
                    <span>Filter</span>
                </button>
            </div>

            <div class="container-fluid">
                <div class="row">

                    <!-- Sidebar -->
                    <aside class="sidebar col-lg-4 col-md-4 d-none d-lg-block bg-light-color border-end p-4 rounded-4">

                        <!-- Search -->
                        <div class="blog-search mb-5">
                            <?php get_search_form(); ?>
                        </div>

                        <!-- Recent Posts -->
                        <h5 class="fw-bold mb-3">Recent Post</h5>
                        <ul class="list-unstyled recent-post">
                            <?php
                            $recent_posts = wp_get_recent_posts(['numberposts' => 3]);
                            foreach ($recent_posts as $post) :
                                $thumb = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
                            ?>
                                <li class="card-list mb-3">
                                    <a href="<?php echo get_permalink($post['ID']); ?>" class="text-decoration-none d-block py-2">
                                        <div class="post-card d-flex">
                                            <div class="img me-2">
                                                <img class="set-img rounded-2" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($post['post_title']); ?>">
                                            </div>
                                            <div class="content">
                                                <p class="text-muted small"><?php echo get_the_date('M d, Y', $post['ID']); ?></p>
                                                <h5><?php echo esc_html($post['post_title']); ?></h5>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>

                        <!-- Categories -->
                        <h5 class="fw-bold mt-4 mb-3">Categories</h5>
                        <ul class="tags flex-wrap">
                            <?php
                            $categories = get_categories();
                            foreach ($categories as $category) {
                                $category_link = get_category_link($category->term_id);
                                echo '<li class="mb-3"><a href="' . esc_url($category_link) . '" class="text-decoration-none">' . esc_html($category->name) . '</a></li>';
                            }
                            ?>
                        </ul>

                        <!-- Tags -->
                        <h5 class="fw-bold mt-4 mb-3">Tags</h5>
                        <ul class="tags flex-wrap">
                            <?php
                            $tags = get_tags();
                            foreach ($tags as $tag) {
                                $tag_link = get_tag_link($tag->term_id);
                                echo '<li class="mb-3"><a href="' . esc_url($tag_link) . '" class="text-decoration-none">' . esc_html($tag->name) . '</a></li>';
                            }
                            ?>
                        </ul>
                    </aside>

                    <!-- Blog Content -->
                    <div id="news" class="col-lg-8 col-md-12 col-sm-12 p-0 ps-lg-4">
                        <div class="row g-4 align-items-stretch">
                            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                                    <div class="col-lg-4 col-md-6 col-12 h-100">
                                        <a href="<?php the_permalink(); ?>" class="news-card d-flex flex-column justify-content-start align-items-start">
                                            <div class="card-img mb-3">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top rounded-2 set-img']); ?>
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-body">
                                                <p class="text-muted mb-2 small">By <?php the_author(); ?> • <?php echo get_the_date('M d, Y'); ?></p>
                                                <h5 class="card-title mb-2"><?php the_title(); ?></h5>
                                                <p class="card-text text-truncate-3 mb-3"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                                <a href="<?php the_permalink(); ?>" class="shop-now-btn">Read More</a>
                                            </div>
                                        </a>
                                    </div>
                                <?php endwhile;
                            else : ?>
                                <p>No posts found.</p>
                            <?php endif; ?>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-5 d-flex justify-content-center align-items-center">
                            <?php
                            the_posts_pagination([
                                'mid_size'  => 2,
                                'prev_text' => __('« Prev'),
                                'next_text' => __('Next »'),
                                'screen_reader_text' => ' ',
                                'before_page_number' => '',
                                'after_page_number'  => '',
                                'type' => 'list'
                            ]);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Offcanvas Sidebar for Mobile -->
    <div class="offcanvas offcanvas-start py-5 px-3 overflow-y-scroll" tabindex="-1" id="blogSidebar">
        <!-- Search -->
        <div class="blog-search mb-5">
            <?php get_search_form(); ?>
        </div>

        <!-- Recent Posts -->
        <h5 class="fw-bold mb-3">Recent Post</h5>
        <ul class="list-unstyled recent-post">
            <?php
            $recent_posts = wp_get_recent_posts(['numberposts' => 3]);
            foreach ($recent_posts as $post) :
                $thumb = get_the_post_thumbnail_url($post['ID'], 'thumbnail');
            ?>
                <li class="card-list mb-3">
                    <a href="<?php echo get_permalink($post['ID']); ?>" class="text-decoration-none d-block py-2">
                        <div class="post-card d-flex">
                            <div class="img me-2">
                                <img class="set-img rounded-2" src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($post['post_title']); ?>">
                            </div>
                            <div class="content">
                                <p class="text-muted small"><?php echo get_the_date('M d, Y', $post['ID']); ?></p>
                                <h5><?php echo esc_html($post['post_title']); ?></h5>
                            </div>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>

        <!-- Categories -->
        <h5 class="fw-bold mt-4 mb-3">Categories</h5>
        <ul class="tags flex-wrap">
            <?php
            $categories = get_categories();
            foreach ($categories as $category) {
                $category_link = get_category_link($category->term_id);
                echo '<li class="mb-3"><a href="' . esc_url($category_link) . '" class="text-decoration-none">' . esc_html($category->name) . '</a></li>';
            }
            ?>
        </ul>

        <!-- Tags -->
        <h5 class="fw-bold mt-4 mb-3">Tags</h5>
        <ul class="tags flex-wrap">
            <?php
            $tags = get_tags();
            foreach ($tags as $tag) {
                $tag_link = get_tag_link($tag->term_id);
                echo '<li class="mb-3"><a href="' . esc_url($tag_link) . '" class="text-decoration-none">' . esc_html($tag->name) . '</a></li>';
            }
            ?>
        </ul>
    </div>
</main>
<!-- The Footer -->
<?php get_footer(); ?>