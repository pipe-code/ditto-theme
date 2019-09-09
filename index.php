<?php
/**
 * Default index.
 *
 * @package ditto_theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>

<section class="section-footer-wrapper">
    <?= get_template_part('partials/welcomeMessage') ?>
</section>

<?php get_footer(); ?>