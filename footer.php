<?php
/**
 * Footer template.
 *
 * @package ditto_theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<footer id="footer-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                © Ditto Theme <?= date('Y') ?>
            </div>
        </div>
    </div>
</footer>

</div> <!-- -Page container -->
<?php wp_footer(); ?>
</body>
</html>