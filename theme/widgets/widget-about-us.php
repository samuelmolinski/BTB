<?php
	
	class Mint_About_Us_Widget extends WP_Widget
	{
		public function __construct()
		{
			parent::__construct('mint_about_us_widget', 'Mint :: About Us', array('description' => 'Use this widget to show your about us details'));
		}

		public function update( $new_instance, $old_instance ) {
			// Save widget options
			$instance = array_merge($old_instance, filter_var_array($new_instance, FILTER_SANITIZE_SPECIAL_CHARS));
			return $instance;
		}

		
		public function widget($instance, $args)
		{
			extract($args);
			$title     = (isset($args['title']))     ? $args['title']     : false;
			$html_text = (isset($args['html_text'])) ? $args['html_text'] : false;
			$email     = (isset($args['email']))     ? $args['email']     : false;
			$phone     = (isset($args['phone']))     ? $args['phone']     : false;
			$fax       = (isset($args['fax']))       ? $args['fax']       : false;
			$address   = (isset($args['address']))   ? $args['address']   : false;

			?>
			<div class="mint-information">
				
				<div class="mint-information-box media">
				<?php if ($title) : ?>
					<h4 class="footer-widget-title"><?php echo $title; ?></h4>
				<?php endif; ?>

				<?php if ($html_text) :?>
					<div class="textwidget"><?php echo $html_text; ?></div>
					<div class="space10">&nbsp;</div>
				<?php endif; ?>
				</div>
				<?php if ($email) : ?>
				<div class="mint-information-box media">
					<i class="icon-mail pull-left"></i>
					<p class="media-body">
						<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
					</p>
				</div>
				<?php endif; ?>
				
				<?php if ($phone || $fax) :?>
				<div class="mint-information-box media">
					<i class="icon-phone pull-left"></i>
					<p class="media-body"><?php echo $phone; echo "<br />"; ?> <?php echo $fax; ?></p>
				</div>
				<?php endif; ?>

				<?php if ($address) : ?>
				<div class="mint-information-box media">
					<i class="icon-location pull-left"></i>
					<p class="media-body"><?php echo $address; ?></p>
				</div>
				<?php endif; ?>
			</div>
			<?php
		}

		public function form($instance)
		{	
			extract($instance);
			$title     = (isset($instance['title']))     ? $instance['title']     : "";
			$html_text = (isset($instance['html_text'])) ? $instance['html_text'] : "";
			$email     = (isset($instance['email']))     ? $instance['email']     : "";
			$phone     = (isset($instance['phone']))     ? $instance['phone']     : "";
			$fax       = (isset($instance['fax']))       ? $instance['fax']       : "";
			$address   = (isset($instance['address']))   ? $instance['address']   : "";
			?>
				<div class="widefat">
					<p>
						<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
						<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" type="text" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>" />
					</p>
					<p>
						<label for="<?php echo $this->get_field_id('html_text'); ?>">Text</label>
						<textarea class="widefat" id="<?php echo $this->get_field_id('html_text'); ?>" name="<?php echo $this->get_field_name('html_text'); ?>"><?php echo $html_text; ?></textarea>
					</p>
					<p>
						<label for="<?php echo $this->get_field_id('email'); ?>">E-Mail</label>
						<input class="widefat" id="<?php echo $this->get_field_id('email'); ?>" type="text" name="<?php echo $this->get_field_name('email'); ?>" value="<?php echo $email; ?>" />
					</p>

					<p>
						<label for="<?php echo $this->get_field_id('phone'); ?>">Phone</label>
						<input class="widefat" id="<?php echo $this->get_field_id('phone'); ?>" type="text" name="<?php echo $this->get_field_name('phone'); ?>" value="<?php echo $phone; ?>" />
					</p>

					<p>
						<label for="<?php echo $this->get_field_id('fax'); ?>">Fax</label>
						<input class="widefat" id="<?php echo $this->get_field_id('fax'); ?>" type="text" name="<?php echo $this->get_field_name('fax'); ?>" value="<?php echo $fax; ?>" />
					</p>

					<p>
						<label for="<?php echo $this->get_field_id('address'); ?>">Address</label>
						<input class="widefat" id="<?php echo $this->get_field_id('address'); ?>" type="text" name="<?php echo $this->get_field_name('address'); ?>" value="<?php echo $address; ?>" />
					</p>
				</div>
			<?php
		}
	}

	if (!function_exists('mint_register_about_us_widget'))
	{
		function mint_register_about_us_widget()
		{
			register_widget( 'Mint_About_Us_Widget' );
		}
	}
	
	add_action( 'widgets_init', 'mint_register_about_us_widget' );