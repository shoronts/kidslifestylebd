<?php
/**
 * Kids Life Style BD: Nav Menu
 *
 * @package WordPress
 * @subpackage STIT
 * @since Kids Life Style BD 1.0
 */

 // Add Dynamic Menu
function register_my_menus() {
    register_nav_menus(
        array(
            'main_menu'    => __( 'Main Menu', 'kidslifestylebd' ),
            'footer_menu_left'  => __( 'Footer Menu One', 'kidslifestylebd' ),
            'footer_menu_right'  => __( 'Footer Menu Tow', 'kidslifestylebd' ),
        )
    );
}
add_action( 'init', 'register_my_menus' );


// Waker Menu Properties
function stit_nav_description($item_output, $item, $args){
    if( !empty ($item->description)){
        $item_output = str_replace($args->link_after . '</a>', '<span class="walker_nav">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output);
    }
    return $item_output;
}
add_filter("walker_nav_menu_start_el", "stit_nav_description", 10, 3);