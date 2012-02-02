<?php
/*
Plugin Name: Marzo Negro Ribbon
Plugin URI: http://wordpress.org/extend/plugins/marzo-negro-ribbon/
Description: When activated, this plugin will put a #MarzoNegro or #BlackMarch ribbon on the top right corner of your website.
Author: Rafael Poveda - RaveN
Version: 1.0
License: GPLv2
Author URI: http://mecus.es/author/raven/

Based in stop-sopa-ribbon from Konstantin Kovshenin

*/


function render_marzo_negro_ribbon() {
	$language = get_option( 'marzo_negro_language' );
	if ( 'es' == $language ){
		$url = 'https://www.facebook.com/marzonegro';
		$ribbon_url = plugins_url( 'marzo-negro-ribbon.png', __FILE__ );
		$alt = 'Marzo Negro';
	} elseif ( 'en' == $language ) {
		$url = 'https://www.facebook.com/pages/Black-March/231497276929161';
		$ribbon_url = plugins_url( 'black-march-ribbon.png', __FILE__ );
		$alt = 'Black March';
	}
	echo "<a target='_blank' class='marzo-negro-ribbon' href='{$url}'><img src='{$ribbon_url}' alt='{$alt}' style='position: fixed; top: 0; right: 0; z-index: 100000; cursor: pointer;' /></a>";
}
add_action( 'wp_footer', 'render_marzo_negro_ribbon' );
add_option( 'marzo_negro_language', 'es');


add_action( 'admin_menu', 'marzo_negro_create_menu' );

function marzo_negro_create_menu() {
	//create new menu
	add_submenu_page( 'options-general.php', 'Marzo Negro Settings', 'Marzo Negro', 'administrator', __FILE__, 'marzo_negro_page' );

	//call register settings function
	add_action( 'admin_init', 'register_marzo_negro_settings' );
}


function register_marzo_negro_settings() {
	//register our settings
	register_setting( 'marzo_negro_settings_group', 'marzo_negro_language' );
}

function marzo_negro_page() {
?>
<div class="wrap">
<h2>Marzo Negro / Black March settings</h2>
<form method="post" action="options.php">
    <?php settings_fields( 'marzo_negro_settings_group' ); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row"><label for="marzo_negro_language">Select your language</label></th>
        <td>
        	<select name="marzo_negro_language">
        		<?php $language = get_option('marzo_negro_language'); ?>
				<option value="en"<?php if ( 'en' == $language ) echo " selected='selected'"; ?>>English</option>
				<option value="es"<?php if ( 'es' == $language ) echo " selected='selected'"; ?>>Spanish</option>
			</select>

        </td>
        </tr>
        <tr>
        	<th scope="row">Spanish (default)</th>
        	<td>
        		<a href="https://www.facebook.com/marzonegro" target="_blank"><img src="<?php echo plugins_url( 'marzo-negro-ribbon.png', __FILE__ ); ?>"></a>
        	</td>
        </tr>
        <tr>
        	<th scope="row">English</th>
        	<td>
        		<a href="https://www.facebook.com/pages/Black-March/231497276929161" target="_blank"><img src="<?php echo plugins_url( 'black-march-ribbon.png', __FILE__ ); ?>"></a>
        	</td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
</form>
</div>

<?php } 