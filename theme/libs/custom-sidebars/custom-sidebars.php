<?php
/**
 * This file will allow users to create their own sidebars and asign them on pages
 */

if (!defined('ABSPATH')) die();

global $lsc_context;
if (empty($lsc_context)) {
	$lsc_context = array('page');
}

class LemonsCustomSidebars 
{
	public static function addMenuPage()
	{
		add_submenu_page( 'themes.php', 'Sidebars', 'Sidebars', 'manage_options', 'lemons-sidebars', array('LemonsCustomSidebars', 'renderPage') );
	}
	public static function _toKey($name)
	{
		return strtolower(preg_replace("/[^\w]/Usi", "_",trim($name) ) );
	}
	public static function actions()
	{
		$sidebars = get_option('LemonsCustomSidebars');


		switch ($_POST['lsc_action']) {
			case 'create_sidebar':
				if (!$sidebars) update_option('LemonsCustomSidebars', array() );

				$sidebars[ self::_toKey($_POST['lsc_name']) ] = array('name' => $_POST['lsc_name']);
				update_option( 'LemonsCustomSidebars',  $sidebars);
				break;
			case 'delete_sidebar':
				unset($sidebars[$_POST['lsc_key']]);
				update_option('LemonsCustomSidebars', $sidebars);
			break;
			
			default:
				# code...
				break;
		}
	}
	public static function createSidebars()
	{
		$sidebars = get_option('LemonsCustomSidebars');
		if ($sidebars)
		{
			foreach($sidebars as $k => $sidebar)
			{
				register_sidebar( array(
					'name' => $sidebar['name'],
					'id'   => $k,
					'description' => 'Sidebar ID: '. $k,
					'class' => '',
					'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h4 class="sidebar-widget-title">',
					'after_title' => '</h4>'
				) );
			}
		}
	
	}

	public static function addMetaBoxes()
	{
		global $lsc_context;
		foreach($lsc_context as $context) {
			add_meta_box( 'lemons-sidebars', 'Sidebar', array('LemonsCustomSidebars', 'createMetabox'), $context ); 
		}
	}
	public static function createMetabox( $post )
	{
		$sidebars = get_option('LemonsCustomSidebars');
		
		?>
			<select name="lsc_sidebar">
				<option value="none">None</option>
				<?php foreach($sidebars as $k => $sidebar)
					{
						echo "<option ".selected( get_post_meta($post->ID, '_lsc_sidebar', true ), $k )."value='".$k."'>".$sidebar['name']."</option>";
					}
				?>
			</select>
		<?php

		wp_nonce_field( 'lsc_save_sidebar', 'lsc_nonce' );

	}

	public function saveMetabox($post_id)
	{
		if ( ! isset( $_POST['lsc_nonce'] ) )
    		return $post_id;

    	if ( ! wp_verify_nonce( $_POST['lsc_nonce'], 'lsc_save_sidebar' ) )
     		 return $post_id;
   

     	update_post_meta($post_id, '_lsc_sidebar', esc_attr($_POST['lsc_sidebar']) );
	}
	public static function renderPage()
	{
		$sidebars = get_option('LemonsCustomSidebars');
		?>
			<div class="wrap">
				<h2>Custom Sidebars</h2>
				<?php if (!$sidebars) { ?>
					<div class='updated'><p><?php _e('No custom sidebars were made.', 'Mint'); ?></p></div>
				<?php } else { ?>
					<table class='widefat'>
						<thead>
							<th>Sidebar</th>
							<th>Class</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php foreach($sidebars as  $k => $sidebar) { ?>
							<tr>
								<th><?php echo $sidebar['name']; ?></th>
								<th><?php echo $k; ?></th>
								<th>
									<form onsubmit="javascript:return confirm('Are you sure you want to delete this sidebar?');" method="post" action="">
										<input type="hidden" name="lsc_action" value="delete_sidebar">
										<input type="hidden" name="lsc_key" value="<?php echo $k; ?>">
										<input type="submit" class="button button-secondary" value="Remove">
									</form>
								</th>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				<?php } ?>
				<br>
				<hr>
				<br>
				<form method="post" action="">
					<input type="text" name="lsc_name" value="" placeholder="Sidebar Name" />
					<input type="hidden" name="lsc_action" value="create_sidebar" />
					<input type="submit" class="button button-primary" value="+ Add Sidebar">
				</form>
			</div>
		<?php
	}
}

LemonsCustomSidebars::createSidebars();

add_action('admin_menu', array('LemonsCustomSidebars', 'addMenuPage'));
add_action('add_meta_boxes', array('LemonsCustomSidebars', 'addMetaBoxes'));
add_action('save_post', array('LemonsCustomSidebars', 'saveMetabox'));
if (isset($_POST['lsc_action'])) {
	LemonsCustomSidebars::actions();
}

