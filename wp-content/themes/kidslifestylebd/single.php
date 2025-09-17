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
    $prev_post = get_previous_post();
    $next_post = get_next_post();
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
            <div class="row">

                <!-- Sidebar (left) -->
                <aside class="sidebar col-lg-4 col-md-12 col-sm-12 d-none d-lg-block bg-light-color border-end p-4 rounded-4 h-100 sticky-top">

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

                <!-- Main Content (right) -->
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="text-center">
                            <h4 class="ghee-kitchen text-uppercase">
                                <?php
                                $categories = get_the_category();
                                if (! empty($categories)) {
                                    $category_names = array_map(fn($cat) => esc_html($cat->name), $categories);
                                    echo implode(', ', $category_names);
                                }
                                ?>
                            </h4>
                            <h3 class="ghee-head my-2"><?php the_title(); ?></h3>
                        </div>

                        <div class="d-flex align-items-center gap-1 gap-md-3 icons justify-content-center mb-3">
                            <p class="m-0 p-0">Posted by</p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                            <p class="m-0 p-0"><?php the_author(); ?></p>
                            <p class="m-0 p-0">On <?php echo get_the_date(); ?></p>
                        </div>

                        <!-- Featured Image -->
                        <div class="p-3">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('full', ['class' => 'img-fluid', 'alt' => get_the_title()]); ?>
                            <?php endif; ?>
                        </div>

                        <!-- Post Content -->
                        <div class="ghee-text my-4 p-3">
                            <?php the_content(); ?>
                        </div>

                        <!-- Tags -->
                        <div class="icon-conainer">
                            <div class="icon-content d-flex align-items-center justify-content-between my-2">
                                <ul class="tags-container d-flex align-items-center list-unstyled flex-wrap">
                                    <?php
                                    $tags = get_the_tags();
                                    if (! empty($tags)) {
                                        foreach ($tags as $tag) { ?>
                                            <li class="me-2 mb-2 border py-2 px-3 d-flex align-items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dot" viewBox="0 0 16 16">
                                                    <path d="M8 9.5a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                                </svg>
                                                <a href="<?php echo get_tag_link($tag->term_id); ?>" class="text-decoration-none text-capitalize text-black fw-bold" style="font-size:12px;">
                                                    <?php echo esc_html($tag->name); ?>
                                                </a>
                                            </li>
                                    <?php }
                                    } ?>
                                </ul>
                            </div>
                        </div>

                        <!-- Social Share Icons -->
                        <div class="d-flex align-items-center gap-2 flex-wrap my-4">
                            <!-- Include your social icons here (Facebook, X, Pinterest, etc.) -->
                        </div>

                        <!-- Previous / Next Navigation -->
                        <div class="horizental-line my-4">
                            <div class="d-flex align-items-center justify-content-between w-100">
                                <?php if (!empty($prev_post)) : ?>
                                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="btn btn-outline-primary">← <?php echo esc_html(get_the_title($prev_post->ID)); ?></a>
                                <?php endif; ?>
                                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn btn-outline-secondary">All Posts</a>
                                <?php if (!empty($next_post)) : ?>
                                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="btn btn-outline-primary"><?php echo esc_html(get_the_title($next_post->ID)); ?> →</a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Comments Template -->
                        <?php comments_template(); ?>
                    <?php endwhile;
                    endif; ?>
                </div>
            </div>
        </div>
    </section>

</main>
<!-- The Footer -->
<?php get_footer(); ?>