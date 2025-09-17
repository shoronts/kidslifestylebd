<?php

/**
 * Kids Life Style BD: Contact Form 7 Configurations
 *
 * @package WordPress
 * @subpackage STIT
 * @since Kids Life Style BD 1.0
 */

// Disable Auto-P Tag Wrapping
add_filter('wpcf7_autop_or_not', '__return_false');


function remove_extra_tags($content) {
    $content = preg_replace('/<p[^>]*>|<\/p>|<span[^>]*>|<\/span>/', '', $content);
    return $content;
}
add_filter('wpcf7_form_elements', 'remove_extra_tags');