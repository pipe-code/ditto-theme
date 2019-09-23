<?php

/*** +Disable Gutenberg ***/
if (get_option('ct_gutenberg_switch')) {
	add_filter('use_block_editor_for_post', '__return_false', 10);
	add_filter('use_block_editor_for_post_type', '__return_false', 10);	
}
/*** -Disable Gutenberg ***/

/*** +Options ***/
function custom_theme_options_scripts(){

	if (get_option('ct_vimeo_switch')) {
		wp_enqueue_script('Vimeo_API', 'https://player.vimeo.com/api/player.js');
    }
    if (get_option('ct_bootstrap_switch')) {
		wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/inc/bootstrap-v4.3.1/bootstrap.min.css');
        wp_enqueue_script('jquery321', get_template_directory_uri() . '/inc/bootstrap-v4.3.1/jquery-3.2.1.min.js', array('jquery'), '3.2.1', true);
        wp_enqueue_script('popper_js', get_template_directory_uri() . '/inc/bootstrap-v4.3.1/popper.min.js', array('jquery'), '1.14.7', true);
        wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/inc/bootstrap-v4.3.1/bootstrap.min.js', array('jquery'), '4.3.1', true);
	}
	if (get_option('ct_materialize_switch')) {
		wp_enqueue_style('public_materialize_css', get_template_directory_uri() . '/inc/materialize-v1.0.0/css/materialize.min.css');
	    wp_enqueue_script('public_materialize_js', get_template_directory_uri() . '/inc/materialize-v1.0.0/js/materialize.min.js', array('jquery'), '1.0.0', true);
	}
	if (get_option('ct_slick_switch')) {
		wp_enqueue_style('slick_css', get_template_directory_uri() . '/inc/slick-v1.8.1/css/slick.css');
	    wp_enqueue_script('slick_js', get_template_directory_uri() . '/inc/slick-v1.8.1/js/slick.min.js', array('jquery'), '1.8.1', true);
	}
	if (get_option('ct_owl_switch')) {
		wp_enqueue_style('owl_css', get_template_directory_uri() . '/inc/owl-v2.3.4/css/owl.carousel.min.css');
		wp_enqueue_style('owl_default_theme_css', get_template_directory_uri() . '/inc/owl-v2.3.4/css/owl.theme.default.min.css');
	    wp_enqueue_script('owl_js', get_template_directory_uri() . '/inc/owl-v2.3.4/js/owl.carousel.js', array('jquery'), '2.3.4', true);
	}
	if (get_option('ct_list_switch')) {
	    wp_enqueue_script('list_js', get_template_directory_uri() . '/inc/listjs-v1.5.0/list.min.js');
    }
	if (get_option('ct_custom_css_switch')) {
		wp_enqueue_style('custom_css', get_template_directory_uri() . '/inc/custom/css/custom.css');
	}
	if (get_option('ct_custom_js_switch')) {
		wp_enqueue_script('custom_js', get_template_directory_uri() . '/inc/custom/js/custom.js', array('jquery'), '1.0', true);
	}
}
add_action('wp_enqueue_scripts', 'custom_theme_options_scripts');
/*** -Options ***/

/*** +Login Styles ***/
function custom_theme_login_styles() { ?>
	<?php if (get_option('ct_login_image_src') != ''): ?>
		<style type="text/css">
	        #login h1 a, .login h1 a {
	            display: none;
	        }
	        #login h1 img {
	        	width: 100%;
	        	max-width: 240px;
	        }
	    </style>
	    <script type="text/javascript">
	    	document.addEventListener("DOMContentLoaded", function(event) { 
				let loginImg = document.createElement("img");
		    	loginImg.src = "<?php echo get_option('ct_login_image_src') ?>";
		    	loginImg.alt = "Custom login image";
		    	document.querySelector('#login h1').appendChild(loginImg);
			});
	    </script>
	<?php endif ?>
<?php }
add_action( 'login_enqueue_scripts', 'custom_theme_login_styles' );
/*** -Login Styles ***/

/*** +Hide ACF ***/
if (get_option('ditto_hide_acf')) {
	add_filter('acf/settings/show_admin', '__return_false');
}
/*** -Hide ACF ***/
?>