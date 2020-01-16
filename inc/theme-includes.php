<?php

/*** +Disable Gutenberg ***/
if (get_option('dt_gutenberg_switch')) {
	add_filter('use_block_editor_for_post', '__return_false', 10);
	add_filter('use_block_editor_for_post_type', '__return_false', 10);	
}
/*** -Disable Gutenberg ***/

/*** +Options ***/
function ditto_theme_options_scripts(){

	// jQuery 3.2.1
	wp_enqueue_script('jquery321', get_template_directory_uri() . '/inc/bootstrap-v4.3.1/jquery-3.2.1.min.js', array('jquery'), '3.2.1', true);

	if (get_option('dt_vimeo_switch')) {
		wp_enqueue_script('vimeo_api', 'https://player.vimeo.com/api/player.js');
	}
	if (get_option('dt_google_maps_switch') && get_option('dt_google_maps_api_key') != '') {
		wp_enqueue_script('google_maps_api', 'https://maps.googleapis.com/maps/api/js?key='.get_option('dt_google_maps_api_key'));
	}
    if (get_option('dt_bootstrap_switch')) {
		wp_enqueue_style('bootstrap_css', get_template_directory_uri() . '/inc/bootstrap-v4.3.1/bootstrap.min.css');
        wp_enqueue_script('popper_js', get_template_directory_uri() . '/inc/bootstrap-v4.3.1/popper.min.js', array('jquery'), '1.14.7', true);
        wp_enqueue_script('bootstrap_js', get_template_directory_uri() . '/inc/bootstrap-v4.3.1/bootstrap.min.js', array('jquery'), '4.3.1', true);
	}
	if (get_option('dt_materialize_switch')) {
		wp_enqueue_style('public_materialize_css', get_template_directory_uri() . '/inc/materialize-v1.0.0/css/materialize.min.css');
	    wp_enqueue_script('public_materialize_js', get_template_directory_uri() . '/inc/materialize-v1.0.0/js/materialize.min.js', array('jquery'), '1.0.0', true);
	}
	if (get_option('dt_slick_switch')) {
		wp_enqueue_style('slick_css', get_template_directory_uri() . '/inc/slick-v1.8.1/css/slick.css');
	    wp_enqueue_script('slick_js', get_template_directory_uri() . '/inc/slick-v1.8.1/js/slick.min.js', array('jquery'), '1.8.1', true);
	}
	if (get_option('dt_owl_switch')) {
		wp_enqueue_style('owl_css', get_template_directory_uri() . '/inc/owl-v2.3.4/css/owl.carousel.min.css');
		wp_enqueue_style('owl_default_theme_css', get_template_directory_uri() . '/inc/owl-v2.3.4/css/owl.theme.default.min.css');
	    wp_enqueue_script('owl_js', get_template_directory_uri() . '/inc/owl-v2.3.4/js/owl.carousel.min.js', array('jquery'), '2.3.4', true);
	}
	if (get_option('dt_list_switch')) {
	    wp_enqueue_script('list_js', get_template_directory_uri() . '/inc/listjs-v1.5.0/list.min.js');
    }
	if (get_option('dt_custom_css_switch')) {
		wp_enqueue_style('custom_css', get_template_directory_uri() . '/inc/custom/css/custom.css');
	}
	if (get_option('dt_custom_js_switch')) {
		wp_enqueue_script('custom_js', get_template_directory_uri() . '/inc/custom/js/custom.js', array('jquery'), '1.0', true);
	}
	if (get_option('dt_rellax_switch')) {
		wp_enqueue_script('rellax_js', get_template_directory_uri() . '/inc/rellax-1.7.1/rellax.min.js', array('jquery'), '1.7.1', true);
	}
	if (get_option('dt_notify_switch')) {
		wp_enqueue_script('notify_js', get_template_directory_uri() . '/inc/notify/notify.min.js', array('jquery'), '1.0.0', true);
	}
}
add_action('wp_enqueue_scripts', 'ditto_theme_options_scripts');
/*** -Options ***/

/*** +Login Styles ***/
function custom_theme_login_styles() { ?>
	<?php if (get_option('dt_login_image_src') != ''): ?>
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
		    	loginImg.src = "<?php echo get_option('dt_login_image_src') ?>";
		    	loginImg.alt = "Custom login image";
		    	document.querySelector('#login h1').appendChild(loginImg);
			});
	    </script>
	<?php endif ?>
<?php }
add_action( 'login_enqueue_scripts', 'custom_theme_login_styles' );
/*** -Login Styles ***/

/*** +Hide ACF ***/
if (get_option('dt_hide_acf')) {
	add_filter('acf/settings/show_admin', '__return_false');
}
/*** -Hide ACF ***/

/*** +ACF Maps API Key ***/
if (get_option('dt_google_maps_api_key') != '') {
	function dt_acf_maps() {
	    acf_update_setting('google_api_key', get_option('dt_google_maps_api_key'));
	}
	add_action('acf/init', 'dt_acf_maps');	
}
/*** -ACF Maps API Key ***/
?>