<?php
	return;
	class Mint_Twitter_Widget extends WP_Widget
	{
		public function __construct()
		{
			parent::__construct('mint_twitter_widget', 'Mint :: Twitter', array('description' => 'Use this widget to show your latest tweets. Works with the new 1.1 API too.'));
		}

		public function update( $new_instance, $old_instance ) {
			// Save widget options
			$instance = array_merge($old_instance, filter_var_array($new_instance, FILTER_SANITIZE_SPECIAL_CHARS));
			return $instance;
		}

		public function form($instance)
		{	
			extract($instance);
			echo "<a href='#'>Click here to get the required keys!</a>";	
			?>
				<div class="widefat">
					<p>
						<label for="<?php echo $this->get_field_id('consumer_key'); ?>">Consumer Key</label>
						<input id="<?php echo $this->get_field_id('consumer_key'); ?>" type="text" name="<?php echo $this->get_field_name('consumer_key'); ?>" value="<?php echo $consumer_key; ?>" />
					</p>
				</div>
			<?php
		}
	}

	if (!function_exists('mint_register_twitter_widget'))
	{
		function mint_register_twitter_widget()
		{
			register_widget( 'Mint_Twitter_Widget' );
		}
	}
	
	add_action( 'widgets_init', 'mint_register_twitter_widget' );