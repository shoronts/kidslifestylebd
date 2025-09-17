<?php

/**
 * Kids Life Style BD: Customizer
 *
 * @package WordPress
 * @subpackage stit
 * @since Kids Life Style BD 1.0
 */

// Add Theme Customizer
function stit_header_customizer($wp_customize)
{
    // Add Header Logo Customizer Section
    $wp_customize->add_section("stit_header_area", array(
        "title"       => __("Header info", "kidslifestylebd"),
        "description" => "Click “Add New Image” to upload an image file from your computer. Your theme works best with an image with a header size of 1000 x 250 pixels — you'll be able to crop your image once you upload it for a perfect fit."
    ));

    // Header Logo Setting
    $wp_customize->add_setting("stit_logo", array(
        "default" => get_template_directory_uri() . "/assets/media/logo.png",
    ));

    // Header Logo Control
    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, "stit_logo", array(
        "label"        => "Upload The Logo",
        "section"      => "stit_header_area",
        "description"  => "To change the current logo please upload a new one.",
        "flex_width"   => true,
        "flex_height"  => true,
    )));

    // Topbar Email Setting
    $wp_customize->add_setting("stit_topbar_email", array(
        'default'           => ''
    ));

    // Topbar Email Control
    $wp_customize->add_control('stit_topbar_email', array(
        'label'        => __('Topbar Email', 'kidslifestylebd'),
        'description'  => __('To change the topbar email.', 'kidslifestylebd'),
        'section'      => 'stit_header_area',
    ));
    
    // Topbar Phone Number Setting
    $wp_customize->add_setting("stit_topbar_phone", array(
        'default'           => ''
    ));

    // Topbar Phone Number Control
    $wp_customize->add_control('stit_topbar_phone', array(
        'label'        => __('Topbar Phone Number', 'kidslifestylebd'),
        'description'  => __('To change the topbar phone number.', 'kidslifestylebd'),
        'section'      => 'stit_header_area',
    ));
}
function stit_footer_customizer($wp_customize)
{
    // Add Footer Info Customizer Section
    $wp_customize->add_section("stit_footer_area", array(
        "title"       => __("Footer Info", "kidslifestylebd"),
        "description" => "Manage the footer information here."
    ));

    // Email
    $wp_customize->add_setting("stit_footer_email", array(
        'default' => '',
    ));

    // Email Control
    $wp_customize->add_control("stit_footer_email", array(
        "label"        => "Email",
        "description"  => "Please use the Email.",
        "section"      => "stit_footer_area",
    ));

    // Phone Number
    $wp_customize->add_setting("stit_footer_phone", array(
        'default' => '',
    ));

    // Phone Number Control
    $wp_customize->add_control("stit_footer_phone", array(
        "label"        => "Phone Number",
        "description"  => "Please use the phone number.",
        "section"      => "stit_footer_area",
    ));

    // Footer Hour Setting
    $wp_customize->add_setting("stit_footer_address", array(
        'default'           => ''
    ));

    // Footer Hour Control (Footer Editor)
    $wp_customize->add_control('stit_footer_address', array(
        'type'          => 'textarea',
        'label'        => __('Contact Address', 'kidslifestylebd'),
        'description'  => __('To change the current address info.', 'kidslifestylebd'),
        'section'      => 'stit_footer_area',
    ));

    // Footer Copyright Setting
    $wp_customize->add_setting("stit_footer_copyright", array(
        'default' => '&copy; Copyright 2025 | <a href="https://squaretechit.com/">Square Tech IT</a>',
    ));

    // Footer Copyright Control
    $wp_customize->add_control("stit_footer_copyright", array(
        "label"        => "Copyright Text",
        "description"  => "To change the current copyright info.",
        "section"      => "stit_footer_area",
    ));
}
function stit_blog_customizer($wp_customize)
{
    // Add blog breadcrumb
    $wp_customize->add_section("stit_blog_area", array(
        "title"       => __("Blog Info", "kidslifestylebd"),
        "description" => "Manage the blog information here."
    ));
    // Add Blog Logo Customizer Section
    $wp_customize->add_section("stit_blog_area", array(
        "title"       => __("Blog info", "kidslifestylebd"),
        "description" => "Click “Add New Image” to upload an image file from your computer. Your theme works best with an image with a Blog size of 1000 x 250 pixels — you'll be able to crop your image once you upload it for a perfect fit."
    ));

    // Blog Logo Setting
    $wp_customize->add_setting("blog_breadcrumb", array(
        "default" => get_template_directory_uri() . "/assets/media/blog_hero_banner.webp",
    ));

    // Blog Logo Control
    $wp_customize->add_control(new WP_Customize_Cropped_Image_Control($wp_customize, "blog_breadcrumb", array(
        "label"        => "Upload The Breadcrumb",
        "section"      => "stit_blog_area",
        "description"  => "To change the current breadcrumb please upload a new one.",
        "flex_width"   => true,
        "flex_height"  => true,
    )));
}
function woocomerce_customizer($wp_customize) {
    // Add a new section under the existing WooCommerce panel
    $wp_customize->add_section('woocommerce_store_banner_section', array(
        'title'    => __('Store Banner Image', 'kidslifestylebd'),
        'panel'    => 'woocommerce',
        'priority' => 160,
    ));

    // Add setting for the image upload
    $wp_customize->add_setting('wc_store_banner_image', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // Add image upload control
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'wc_store_banner_image', array(
        'label'    => __('Upload Banner Image', 'kidslifestylebd'),
        'section'  => 'woocommerce_store_banner_section',
        'settings' => 'wc_store_banner_image',
    )));

    // Add setting for the banner title
}
function stit_social_links( $wp_customize ) {

    // Social Links Section
    $wp_customize->add_section('stit_social_links', array(
        'title'    => __('Social Links', 'kidslifestylebd'),
        'priority' => 35,
    ));

    // Facebook
    $wp_customize->add_setting('stit_facebook_link', array(
        'default' => 'https://facebook.com/', // default link
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('stit_facebook_link', array(
        'label'   => __('Facebook URL', 'kidslifestylebd'),
        'section' => 'stit_social_links',
        'type'    => 'url'
    ));

    // Twitter
    $wp_customize->add_setting('stit_twitter_link', array(
        'default' => 'https://twitter.com/', // default link
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('stit_twitter_link', array(
        'label'   => __('Twitter URL', 'kidslifestylebd'),
        'section' => 'stit_social_links',
        'type'    => 'url'
    ));

    // LinkedIn
    $wp_customize->add_setting('stit_linkedin_link', array(
        'default' => 'https://linkedin.com/', // default link
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('stit_linkedin_link', array(
        'label'   => __('LinkedIn URL', 'kidslifestylebd'),
        'section' => 'stit_social_links',
        'type'    => 'url'
    ));
    
    // Pinterest
    $wp_customize->add_setting('stit_pinterest_link', array(
        'default' => 'https://www.pinterest.com/', // default link
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('stit_pinterest_link', array(
        'label'   => __('Pinterest URL', 'kidslifestylebd'),
        'section' => 'stit_social_links',
        'type'    => 'url'
    ));

    // Instagram
    $wp_customize->add_setting('stit_instagram_link', array(
        'default' => 'https://instagram.com/', // default link
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('stit_instagram_link', array(
        'label'   => __('Instagram URL', 'kidslifestylebd'),
        'section' => 'stit_social_links',
        'type'    => 'url'
    ));

}

add_action('customize_register', 'stit_social_links');

add_action("customize_register", "stit_header_customizer");
add_action("customize_register", "stit_footer_customizer");
add_action("customize_register", "stit_blog_customizer");
add_action('customize_register', 'woocomerce_customizer');

add_theme_support('editor-styles');
add_theme_support('wp-block-styles');
add_theme_support('align-wide');