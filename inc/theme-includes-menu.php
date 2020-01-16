<?php

// Add admin menu
function setup_theme_admin_menus() {
    add_submenu_page('themes.php', 
        'Theme Includes', 'Theme Includes', 'manage_options', 
        'custom-theme-includes', 'theme_front_page_settings'); 
}
add_action("admin_menu", "setup_theme_admin_menus");

if ( is_admin() ){
	add_action('admin_enqueue_scripts', 'admin_ditto_theme_scripts');
}

// Admin menu scripts
function admin_ditto_theme_scripts($hook) {
	$current_screen = get_current_screen();
	if ( strpos($current_screen->base, 'custom-theme-includes') === false) {
	    return;
	} else {
	    wp_enqueue_style('materialize_css', get_template_directory_uri() . '/inc/materialize-v1.0.0/css/materialize.min.css' );
	    wp_enqueue_script('materialize_js', get_template_directory_uri() . '/inc/materialize-v1.0.0/js/materialize.min.js' );
    }
}

function register_ditto_theme_settings() {
	//register main menu settings
	$dittoSettings = array (
        'dt_owl_switch', 
        'dt_slick_switch',
		'dt_gutenberg_switch',
		'dt_custom_css_switch', 
        'dt_custom_js_switch',
		'dt_materialize_switch',
		'dt_vimeo_switch', 
        'dt_list_switch',
		'dt_login_image_src',
		'dt_duplicator_switch', 
		'dt_user_agent_switch',
		'dt_hide_acf',
		'dt_bootstrap_switch',
		'dt_rellax_switch',
		'dt_google_maps_switch',
		'dt_google_maps_api_key',
        'dt_notify_switch'
	);
	foreach ($dittoSettings as $setting) {
        register_setting( 'custom-theme-main-group', $setting);
    }
}
add_action( 'admin_init', 'register_ditto_theme_settings' );

function ditto_theme_scripts_admin() {
    // WordPress library
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'ditto_theme_scripts_admin' );

function ditto_theme_image_uploader($width, $height ) {

    $default_image = get_template_directory_uri() . '/images/login_default.svg';

    if ( get_option('dt_login_image_src') ) {
        $src = get_option('dt_login_image_src');
        $value = get_option('dt_login_image_src');
    } else {
        $src = $default_image;
        $value = '';
    }

    $text = "Upload";

    // Print HTML field
    echo '
        <div class="upload">
            <img data-src="' . $default_image . '" src="' . $src . '" width="' . $width . 'px" height="' . $height . 'px" />
            <div>
                <input type="hidden" name="dt_login_image_src" value="' . $value . '" />
                <button type="submit" class="upload_image_button btn waves-effect waves-light">' . $text . '</button>
                <button type="submit" class="remove_image_button btn waves-effect waves-light">&times;</button>
            </div>
            <label style="display: block; margin-top: 10px;">Login Image</label>
        </div>
    ';
}

function theme_front_page_settings() {
?>

<div class="cf-admin-wrap" style="padding: 0px 30px 0px 10px;">
    <!-- Title -->
	<div class="admin-header" style="margin-top: 40px; margin-bottom: 50px;">
		<h1 style="font-size: 40px; color: #28a699;">Theme Includes</h1>
	</div>

	<form method="post" action="options.php">

		<?php
			/* Option status */ 
			settings_fields( 'custom-theme-main-group' );
			do_settings_sections( 'custom-theme-main-group' );

			$checked_owl = '';
			$checked_slick = '';
			$checked_css = '';
			$checked_js = '';
			$checked_gutenberg = '';
			$checked_materialize = '';
			$checked_vimeo = '';
			$checked_list = '';
			$checked_duplicator = '';
			$checked_user_agent = '';
			$checked_hide_acf = '';
			$checked_bootstrap = '';
			$checked_rellax = '';
			$checked_gm = '';
			$checked_notify = '';
			if (get_option('dt_owl_switch')) { $checked_owl = 'checked'; }
			if (get_option('dt_slick_switch')) { $checked_slick = 'checked'; }
			if (get_option('dt_custom_css_switch')) { $checked_css = 'checked'; }
			if (get_option('dt_custom_js_switch')) { $checked_js = 'checked'; }
			if (get_option('dt_gutenberg_switch')) { $checked_gutenberg = 'checked'; }
			if (get_option('dt_materialize_switch')) { $checked_materialize = 'checked'; }
			if (get_option('dt_vimeo_switch')) { $checked_vimeo = 'checked'; }
			if (get_option('dt_list_switch')) { $checked_list = 'checked'; }
			if (get_option('dt_duplicator_switch')) { $checked_duplicator = 'checked'; }
			if (get_option('dt_user_agent_switch')) { $checked_user_agent = 'checked'; }
			if (get_option('dt_hide_acf')) { $checked_hide_acf = 'checked'; }
			if (get_option('dt_bootstrap_switch')) { $checked_bootstrap = 'checked'; }
			if (get_option('dt_rellax_switch')) { $checked_rellax = 'checked'; }
			if (get_option('dt_google_maps_switch')) { $checked_gm = 'checked'; }
			if (get_option('dt_notify_switch')) { $checked_notify = 'checked'; }
		?>

	    <div class="api-options row">
            <!-- Vimeo API -->
	    	<div class="vimeo-switch owl-switch col s6 m2">
	    		<label>Enable Vimeo API</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_vimeo_switch" <?php echo $checked_vimeo; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
			<div class="gm-switch col s6 m2">
				<label>Enable Google Maps API</label>
				<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_google_maps_switch" <?php echo $checked_gm; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
			</div>
			<div class="gm-api-key col s12 m8">
				<div class="input-field">
					<label>Google Maps API Key (ACF n' API)</label>
					<input type="text" name="dt_google_maps_api_key" value="<?php echo esc_attr( get_option('dt_google_maps_api_key') ); ?>" />
				</div>
			</div>
	    </div>

	    <div class="divider" style="margin-top: 30px; margin-bottom: 20px;"></div>

	    <div class="sliders-options row">
            <!-- Owl Carousel -->
	    	<div class="owl-switch col s6 m2" style="">
	    		<label>Owl Carousel</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_owl_switch" <?php echo $checked_owl; ?>>
						<span class="lever"></span>
						On
					</label>
					<span class="helper-text" style="display: block; margin-top: 10px">
						<a href="https://owlcarousel2.github.io/OwlCarousel2/" target="_BLANK">Webpage</a>
					</span>
				</div>
	    	</div>
            <!-- Slick Slider -->
	    	<div class="slick-switch col s6 m2">
	    		<label>Slick Slider</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_slick_switch" <?php echo $checked_slick; ?>>
						<span class="lever"></span>
						On
					</label>
					<span class="helper-text" style="display: block; margin-top: 10px">
						<a href="https://kenwheeler.github.io/slick/" target="_BLANK">Webpage</a>
					</span>
				</div>
	    	</div>
            <!-- Bootstrap -->
            <div class="bootstrap-switch col s6 m2">
	    		<label>Bootstrap</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_bootstrap_switch" <?php echo $checked_bootstrap; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
				<span class="helper-text" style="display: block; margin-top: 10px">
					<a href="https://getbootstrap.com/" target="_BLANK">Webpage</a>
				</span>
	    	</div>
            <!-- Materialize -->
	    	<div class="materialize-switch col s6 m2">
	    		<label>Materialize</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_materialize_switch" <?php echo $checked_materialize; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
				<span class="helper-text" style="display: block; margin-top: 10px">
					<a href="https://materializecss.com/" target="_BLANK">Webpage</a>
				</span>
	    	</div>
            <!-- List JS -->
	    	<div class="listjs-switch col s6 m2">
	    		<label>List JS</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_list_switch" <?php echo $checked_list; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
				<span class="helper-text" style="display: block; margin-top: 10px">
					<a href="https://listjs.com/" target="_BLANK">Webpage</a>
				</span>
	    	</div>
			<!-- Rellax -->
	    	<div class="rellaxjs-switch col s6 m2">
	    		<label>Rellax JS</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_rellax_switch" <?php echo $checked_rellax; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
				<span class="helper-text" style="display: block; margin-top: 10px">
					<a href="https://dixonandmoe.com/rellax/" target="_BLANK">Webpage</a>
				</span>
	    	</div>
			<!-- Notify -->
	    	<div class="notifyjs-switch col s6 m2" style="margin-top: 20px;">
	    		<label>Notify JS</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_notify_switch" <?php echo $checked_notify; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
				<span class="helper-text" style="display: block; margin-top: 10px">
					<a href="https://notifyjs.jpillora.com/" target="_BLANK">Webpage</a>
				</span>
	    	</div>
	    </div>

	    <div class="divider" style="margin-top: 30px; margin-bottom: 30px;"></div>

	    <div class="custom-css-js-options row">
            <!-- Custom CSS -->
	    	<div class="custom-css-switch col s6 m2">
	    		<label>Include Custom CSS</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_custom_css_switch" <?php echo $checked_css; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
            <!-- Custom JS -->
	    	<div class="custom-js-switch col s6 m2">
	    		<label>Include Custom JS</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_custom_js_switch" <?php echo $checked_js; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
	    </div>

	    <div class="divider" style="margin-top: 30px; margin-bottom: 30px;"></div>

	    <div class="gutenberg-options row">
            <!-- Gutenberg -->
	    	<div class="gutenberg-switch col s6 m2">
	    		<label>Disable Gutenberg Editor</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_gutenberg_switch" <?php echo $checked_gutenberg; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
            <!-- Duplicator -->
	    	<div class="duplicator-switch col s6 m2">
	    		<label>Duplicate Post Option</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_duplicator_switch" <?php echo $checked_duplicator; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
            <!-- User Agent -->
	    	<div class="user-agent-switch col s6 m2">
	    		<label>User Agent Attributes</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_user_agent_switch" <?php echo $checked_user_agent; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
            <!-- Hide ACF -->
	    	<div class="duplicator-switch col s6 m2">
	    		<label>Hide ACF Admin</label>
	    		<div class="switch" style="margin-top: 10px;">
					<label>
						Off
						<input type="checkbox" name="dt_hide_acf" <?php echo $checked_hide_acf; ?>>
						<span class="lever"></span>
						On
					</label>
				</div>
	    	</div>
	    </div>

	    <div class="divider" style="margin-top: 30px; margin-bottom: 30px;"></div>

	    <?php ditto_theme_image_uploader( $width = 115, $height = 115 ); ?>

	    <button class="btn waves-effect waves-light" type="submit" name="submit" id="submit" style="margin-top: 40px;">
	    	Save Changes
		</button>

	</form>

	<div class="chip-bar" style="margin-top: 30px;">
		<div class="chip">
			<img src="<?php echo get_template_directory_uri() . '/images/pipelon_avatar.jpeg' ?>" alt="Contact Person">
			From Pipelon's Github with <a href="https://github.com/Pipeloncho/ditto-theme" target="_BLANK">love</a>.
		</div>
		<div class="chip">
			Ditto Theme V1.0.5
		</div>
	</div>

</div>



<script type="text/javascript">
	jQuery(window).ready(function(){
		// The "Upload" button
		jQuery('.upload_image_button').click(function(event) {
			event.preventDefault(); 
			var send_attachment_bkp = wp.media.editor.send.attachment;
			var button = jQuery(this);
			wp.media.editor.send.attachment = function(props, attachment) {
				jQuery(button).parent().prev().attr('src', attachment.url);
				jQuery(button).prev().val(attachment.url);
				wp.media.editor.send.attachment = send_attachment_bkp;
			}
			wp.media.editor.open(button);
			return false;
		});

		// The "Remove" button (remove the value from input type='hidden')
		jQuery('.remove_image_button').click(function(event) {
			event.preventDefault(); 
			var answer = confirm('Are you sure?');
			if (answer == true) {
				var src = jQuery(this).parent().prev().attr('data-src');
				jQuery(this).parent().prev().attr('src', src);
				jQuery(this).prev().prev().val('');
			}
			return false;
		});
	});
</script>
<?php } ?>