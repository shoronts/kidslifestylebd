<?php

/**
 * Kids Life Style BD: Enqueue Public Styles and Scripts
 *
 * @package WordPress
 * @subpackage Kids Life Style BD
 * @since Kids Life Style BD 1.0
 */

function stit_custom_css_js()
{
    // Main Theme Stylesheet
    wp_enqueue_style("stit-style", get_stylesheet_uri());

    // Google Fonts
    wp_enqueue_style("stit-fonts", "https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap", array(), null);

    // Bootstrap CSS and JS
    wp_enqueue_style("bootstrap", get_template_directory_uri() . "/assets/css/bootstrap.min.css", array(), "5.3.2");
    wp_enqueue_script("bootstrap", get_template_directory_uri() . "/assets/js/bootstrap.min.js", array('jquery'), "5.3.2", true);

    // Custom CSS
    wp_enqueue_style("desk", get_template_directory_uri() . "/assets/css/desk.css", array(), "1.0");
    wp_enqueue_style("responsive", get_template_directory_uri() . "/assets/css/responsive.css", array(), "1.0");

    // Swiper CSS and JS
    wp_enqueue_style("swiper", get_template_directory_uri() . "/assets/css/swiper.css", array(), "11.2.10");
    wp_enqueue_script("swiper", get_template_directory_uri() . "/assets/js/swiper.js", array(), "11.2.10", true);

    // Custom JS
    wp_enqueue_script("main", get_template_directory_uri() . "/assets/js/main.js", array('jquery'), "1.0", true);
}
add_action("wp_enqueue_scripts", "stit_custom_css_js");