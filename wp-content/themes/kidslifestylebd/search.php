<?php

/**
 * The Search template file for Kids Life Style BD
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
    <section>
        <div class="hero-container d-flex align-items-center justify-content-center"
            style="background-image: url(<?php echo $blog_breadcrumb_url; ?>);">
            <div class="hero-content">
                <h1 class="banner-header">Search</h1>
                <div class="d-flex gap-2 justify-content-center">
                    <p class="banner-home">
                        <a class="text-decoration-none text-black" href="<?php echo esc_url(home_url()); ?>">Home</a>
                    </p>
                    <span>/</span>
                    <p class="banner-store">Search</p>
                </div>
            </div>
        </div>
    </section>
    <!-- All Search -->
    <section>
        <div class="blog-container">
            <?php if (have_posts()) : ?>
                <div class="blog-content row align-items-stretch">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="col-12 col-md-4 my-4">
                            <div class="card blog-card h-100 border rounded">
                                <div class="card-img-wrapper">
                                    <div class="date-stamp">
                                        <div class="date-day">
                                            <?php echo get_the_date('j'); ?>
                                        </div>
                                        <div class="date-month mb-0">
                                            <?php echo get_the_date('F'); ?>
                                        </div>
                                    </div>
                                    <div class="card-img-box">
                                        <?php
                                        $thumbnail_id = get_post_thumbnail_id();
                                        $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'post-thumbnails');
                                        if ($thumbnail_url) {
                                        ?>
                                            <img class="card-img-top" src="<?php echo esc_url($thumbnail_url[0]); ?>" alt="<?php echo esc_attr(get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true)); ?>">
                                        <?php
                                        }
                                        ?>
                                        <div class="category-tags">
                                            <span class="category-tag p-1">
                                                <?php
                                                $categories = get_the_category();
                                                if (! empty($categories)) {
                                                    foreach ($categories as $category) {
                                                        echo esc_html($category->name) . ', ';
                                                    }
                                                }
                                                ?>
                                                <!-- <?php
                                                        $tags = get_the_tags();
                                                        if (! empty($tags)) {
                                                            foreach ($tags as $tag) {
                                                                echo esc_html($tag->name) . ', ';
                                                            }
                                                        }
                                                        ?> -->
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php the_title(); ?></h5>
                                    <div class="icons d-flex align-items-center justify-content-center gap-2 my-3 text-center">
                                        <p class="m-0 p-0">By</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                            <path fill-rule="evenodd"
                                                d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                                        </svg>
                                        <p class="m-0 p-0">Kids Life Style BD</p>
                                        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-chat-left" viewBox="0 0 16 16">
                                            <path
                                                d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-share" viewBox="0 0 16 16">
                                            <path
                                                d="M13.5 1a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.5 2.5 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5m-8.5 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m11 5.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3" />
                                        </svg> -->
                                    </div>
                                    <p class="card-text"><?php the_excerpt(); ?></p>
                                    <a href="<?php the_permalink(); ?>" class="continue-reading raf-tag">CONTINUE READING</a>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <div style="height: 400px;" class="d-flex flex-column justify-content-center align-items-center">
                    <p class="fs-1">No Blogs Found</p>
                </div>
            <?php endif; ?>

            <?php
            global $wp_query;
            $big = 999999999;
            $pagination_links = paginate_links(array(
                'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                'format'    => '?paged=%#%',
                'current'   => max(1, get_query_var('paged')),
                'total'     => $wp_query->max_num_pages,
                'type'      => 'array',
                'prev_text' => 'Previous',
                'next_text' => 'Next',
            ));

            if (!empty($pagination_links)) :
            ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php foreach ($pagination_links as $link) : ?>
                            <li class="page-item<?php echo strpos($link, 'current') !== false ? ' active' : ''; ?>">
                                <?php
                                echo str_replace('page-numbers', 'page-link', $link);
                                ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            <?php endif; ?>
        </div>
    </section>
</main>
<!-- The Footer -->
<?php get_footer(); ?>