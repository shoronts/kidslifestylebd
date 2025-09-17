<?php

/**
 * Kids Life Style BD: Customizer
 *
 * @package WordPress
 * @subpackage STIT
 * @since Kids Life Style BD 1.0
 */

function stit_setup()
{
    /*
    * Make theme available for translation.
    * Translations can be filed in the /languages/ directory.
    * If you're building a theme based on kidslifestylebd, use a find and replace
    * to change 'kidslifestylebd' to the name of your theme in all the template files.
    */
    load_theme_textdomain('kidslifestylebd', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
    * Let WordPress manage the document title.
    * By adding theme support, we declare that this theme does not use a
    * hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
    */
    add_theme_support('title-tag');

    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    */
    add_theme_support('post-thumbnails');

    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);

    //Enable custom header
    add_theme_support('custom-header');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support('custom-logo', [
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ]);

    /**
     * Enable suporrt for Post Formats
     *
     * see: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support('post-formats', [
        'image',
        'audio',
        'video',
        'gallery',
        'quote',
    ]);

    // Add support for Block Styles.
    add_theme_support('wp-block-styles');

    // Add support for full and wide align images.
    add_theme_support('align-wide');

    // Add support for editor styles.
    add_theme_support('editor-styles');

    // Add support for responsive embedded content.
    add_theme_support('responsive-embeds');

    // remove_theme_support('widgets-block-editor');
};

add_action('after_setup_theme', 'stit_setup');

// Disable Gutenberg and Keep the Classic Editor in WordPress
add_filter('use_block_editor_for_post', '__return_false');
add_filter('use_block_editor_for_post_type', '__return_false');

// Make Blogs 30 And Add Readmore Btn

function hebd_read_more($more) {
    global $post;
    if ($post->post_type == 'program') {
        return ' ...';
    }
    // else {
    //     return ' <a class="read-more-btn" href="' . get_permalink($post->ID) . '">' . 'Read More' . '</a>';
    // }
}
add_filter('excerpt_more', 'hebd_read_more');

function hebd_excerpt_lenght($length)
{
    return 30;
}
add_filter('excerpt_length', 'hebd_excerpt_lenght', 999);


// Add Blogs Pagenation
function hebd_blogs_pagenation() {
    global $wp_query;

    $max = $wp_query->max_num_pages;

    if ($max <= 1) return; // No pagination needed if only one page

    $current = max(1, get_query_var('paged')); // Current page

    // Pagination arguments
    $args = array(
        'base'      => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
        'format'    => '?paged=%#%',
        'total'     => $max,
        'current'   => $current,
        'prev_text' => 'Previous',
        'next_text' => 'Next',
        'type'      => 'array'
    );

    $links = paginate_links($args);

    if (is_array($links)) {
        echo '<nav aria-label="Page navigation example">';
        echo '<ul class="pagination justify-content-center">';

        foreach ($links as $link) {
            // Current page
            if (strpos($link, 'current') !== false) {
                $link = str_replace('<span class="page-numbers current">', '<a class="page-link current">', $link);
                $link = str_replace('</span>', '</a>', $link);
                echo '<li class="page-item active">' . $link . '</li>';
            } else {
                // Add Bootstrap class to other links
                $link = str_replace('<a', '<a class="page-link"', $link);
                echo '<li class="page-item">' . $link . '</li>';
            }
        }

        echo '</ul>';
        echo '</nav>';
    }

    // Optional: show page info
    echo '<p class="pages fs-6 text-uppercase mt-3 text-center">Page ' . $current . ' of ' . $max . '</p>';
}
