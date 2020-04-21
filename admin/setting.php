<?php
function wp_violet_register_settings() {
	$items = ['palash', 'narshindi', 'sadar', 'raypur', 'shibpur', 'monohordi', 'belab', 'bangladesh', 'world'];
	foreach ($items as $item) {
		$key_active = 'wp_violet_'.$item.'_active';
		$key_recovered = 'wp_violet_'.$item.'_recovered';
		$key_fatal = 'wp_violet_'.$item.'_fatal';

		add_option( $key_active, '0');
	   	register_setting( 'wp_violet_options_group', $key_active, 'wp_violet_callback' );
	    add_option( $key_recovered, '0');
	   	register_setting( 'wp_violet_options_group', $key_recovered, 'wp_violet_callback' );
	    add_option( $key_fatal, '0');
	   	register_setting( 'wp_violet_options_group', $key_fatal, 'wp_violet_callback' );
	}
}
add_action( 'admin_init', 'wp_violet_register_settings' );

function wp_violet_register_options_page() {
  add_options_page('Corona Update', 'Corona Update', 'manage_options', 'wp_violet', 'wp_violet_options_page');
}
add_action('admin_menu', 'wp_violet_register_options_page');
?>

<?php 
function wp_violet_options_page()
{
?>
  <div>
  <?php screen_icon(); ?>
  <form method="post" action="options.php">
	  <?php settings_fields( 'wp_violet_options_group' ); ?>

<?php
$items = ['palash', 'narshindi', 'sadar', 'raypur', 'shibpur', 'monohordi', 'belab', 'bangladesh', 'world'];

foreach($items as $item){
	$key_active = 'wp_violet_'.$item.'_active';
	$key_recovered = 'wp_violet_'.$item.'_recovered';
	$key_fatal = 'wp_violet_'.$item.'_fatal';
?>

<h2>Corona cases in <?php echo ucfirst($item); ?></h2>
	  <table>
		  <tr valign="top">
		  	<th scope="row"><label for="<?php echo $key_active; ?>">Active cases</label></th>
		  	<td><input type="text" id="<?php echo $key_active; ?>" name="<?php echo $key_active; ?>" value="<?php echo get_option($key_active); ?>" /></td>
		  </tr>
		  <tr valign="top">
		  	<th scope="row"><label for="<?php echo $key_recovered; ?>">Recovered cases</label></th>
		  	<td><input type="text" id="<?php echo $key_recovered; ?>" name="<?php echo $key_recovered; ?>" value="<?php echo get_option($key_recovered); ?>" /></td>
		  </tr>
		  <tr valign="top">
		  	<th scope="row"><label for="<?php echo $key_fatal; ?>">Fatal cases</label></th>
		  	<td><input type="text" id="<?php echo $key_fatal; ?>" name="<?php echo $key_fatal; ?>" value="<?php echo get_option($key_fatal); ?>" /></td>
		  </tr>
	  </table>

<?php
}
?>
	  <?php  submit_button(); ?>
  </form>
  </div>
<?php
}