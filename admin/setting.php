<?php
function wp_violet_register_settings() {
   	add_option( 'wp_violet_narshindi_active', '0');
   	register_setting( 'wp_violet_options_group', 'wp_violet_narshindi_active', 'wp_violet_callback' );

    add_option( 'wp_violet_narshindi_recovered', '0');
   	register_setting( 'wp_violet_options_group', 'wp_violet_narshindi_recovered', 'wp_violet_callback' );

    add_option( 'wp_violet_narshindi_fatal', '0');
   	register_setting( 'wp_violet_options_group', 'wp_violet_narshindi_fatal', 'wp_violet_callback' );
}
add_action( 'admin_init', 'wp_violet_register_settings' );

function wp_violet_register_options_page() {
  add_options_page('Narshandi Corona', 'Narshandi Corona', 'manage_options', 'wp_violet', 'wp_violet_options_page');
}
add_action('admin_menu', 'wp_violet_register_options_page');
?>

<?php function wp_violet_options_page()
{
?>
  <div>
  <?php screen_icon(); ?>
  <h2>Corona cases in Narshindi</h2>
  <form method="post" action="options.php">
	  <?php settings_fields( 'wp_violet_options_group' ); ?>
	  <table>
		  <tr valign="top">
		  	<th scope="row"><label for="wp_violet_narshindi_active">Active cases</label></th>
		  	<td><input type="text" id="wp_violet_narshindi_active" name="wp_violet_narshindi_active" value="<?php echo get_option('wp_violet_narshindi_active'); ?>" /></td>
		  </tr>
		  <tr valign="top">
		  	<th scope="row"><label for="wp_violet_narshindi_recovered">Recovered cases</label></th>
		  	<td><input type="text" id="wp_violet_narshindi_recovered" name="wp_violet_narshindi_recovered" value="<?php echo get_option('wp_violet_narshindi_recovered'); ?>" /></td>
		  </tr>
		  <tr valign="top">
		  	<th scope="row"><label for="wp_violet_narshindi_fatal">Fatal cases</label></th>
		  	<td><input type="text" id="wp_violet_narshindi_fatal" name="wp_violet_narshindi_fatal" value="<?php echo get_option('wp_violet_narshindi_fatal'); ?>" /></td>
		  </tr>
	  </table>
	  <?php  submit_button(); ?>
  </form>
  </div>
<?php
} ?>