<?php
/*** +Theme Includes ***/
include_once 'inc/theme-includes-menu.php';
include_once 'inc/theme-includes.php';
include_once 'inc/dt-post-duplicator.php';
include_once 'inc/dt-user-agent.php';
/*** +Theme Includes ***/

/*** +Register Theme Scripts ***/
function ditto_theme_scripts() {
  wp_enqueue_style( 'core', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'ditto_theme_scripts');
/*** -Register Theme Scripts ***/

/*** +Register Navigation Menus ***/
function ditto_theme_navigation_menus() {
  $locations = array(
    'main_menu' => __( 'Main Menu', 'text_domain' )
  );
  register_nav_menus( $locations );
}
add_action( 'init', 'ditto_theme_navigation_menus' );
/*** -Register Navigation Menus ***/

/*** +Theme support ***/
add_theme_support( 'custom-logo' );
/*** +Theme support ***/
