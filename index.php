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

<main id="dt_index">
    <section>
        <?= get_template_part('partials/welcomeMessage') ?>
    </section>
</main>

<?php get_footer(); ?>