<?php
/**
 * Header.
 *
 * @package ditto_theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>

  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page"> <!-- +Page container -->

  <header id="header-wrapper">
    <div class="container">
      <nav class="navbar navbar-expand-lg" id="PR-navbar">
        <?php if (has_custom_logo()): ?>
          <?php the_custom_logo(); ?>
        <?php else: ?>
          <a class="navbar-brand mr-auto" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="url"><?php bloginfo( 'name' ); ?></a>
        <?php endif ?>
        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <div class="PR-hamburguer">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
          </div>
        </button>
        <?php
          wp_nav_menu([
            'menu'            => 'main_menu',
            'theme_location'  => 'main_menu',
            'container'       => 'div',
            'container_id'    => 'navbarCollapse',
            'container_class' => 'collapse navbar-collapse',
            'menu_id'         => 'main_menu',
            'menu_class'      => 'navbar-nav ml-auto',
          ]);
        ?>   
      </nav>
    </div>
  </header>