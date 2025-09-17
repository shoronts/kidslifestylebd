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
<main>
    <?php the_content(); ?>
</main>
<!-- The Footer -->
<?php get_footer(); ?>