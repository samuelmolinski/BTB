<?php
	
	class Mint_Content_Loop_Widget extends WP_Widget
	{
		public function __construct()
		{
			parent::__construct('mint_content_loop_widget', 'Mint :: Content Loop', array('description' => 'Use this widget to loop over contnet and show your latest items.'));
		}

		public function widget($args, $instance)
		{

			$title  = (isset($instance['title'])) ? $instance['title'] : "";
			$post_type = (isset($instance['post_type'])) ? $instance['post_type'] : "";
			#$taxonomy  = (isset($instance['taxonomy'])) ? $instance['taxonomy'] : "";
			$posts_per_page  = (isset($instance['posts_per_page'])) ? $instance['posts_per_page'] : 5;
			$thumbnails  = (isset($instance['thumbnails'])) ? true : false;
			$date  = (isset($instance['date'])) ? true : false;
			$excerpt  = (isset($instance['excerpt'])) ? true : false;
			$titles  = (isset($instance['titles'])) ? true : false;

			if ($titles || $date || $excerpt)
			{
				$w = $h = 50;
			}
			else
			{
				$w = $h = 69;
			}
			?>
				<div class="mint-latest mint-latest-widget">
					<h4 class="footer-widget-title"><?php echo $title; ?></h4>
					<?php query_posts('posts_per_page='. $posts_per_page . '&post_type=' . $post_type); ?>
					<?php while(have_posts()) : the_post(); ?>
						
						<div class="media mint-latest-item">
							<?php if ($thumbnails) : ?>
								<?php if (has_post_thumbnail()) : ?>
									<div class="pull-left">
										 <a href="<?php the_permalink(); ?>"><img src='<?php echo MintUtils::thumb( get_the_ID() , $w, $h); ?>' /></a>
									</div>
								<?php endif; ?>
							<?php endif; ?>

							<?php if ($titles || $date || $excerpt) : ?> 
								<div class="media-body">
									<?php if ($titles) : ?>
										<h6 class="mint-latest-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
									<?php endif; ?>
									<?php if ($date) : ?>
										<small class="mint-latest-date"><?php echo get_the_date('F d, Y'); ?></small>
									<?php endif; ?>
									<?php if ($excerpt) : ?>
										<p class="mint-latest-excerpt"><?php echo wp_trim_words( get_the_excerpt(), 10, null ); ?></p>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						</div>

					<?php endwhile; wp_reset_query(); ?>
				</div>
			<?php
		}

		public function form($instance)
		{	
			$title  = (isset($instance['title'])) ? $instance['title'] : "";
			$post_type = (isset($instance['post_type'])) ? $instance['post_type'] : "";
			#$taxonomy  = (isset($instance['taxonomy'])) ? $instance['taxonomy'] : "";
			$posts_per_page  = (isset($instance['posts_per_page'])) ? $instance['posts_per_page'] : 5;
			$thumbnails  = (isset($instance['thumbnails'])) ? true : false;
			$date  = (isset($instance['date'])) ? true : false;
			$excerpt  = (isset($instance['excerpt'])) ? true : false;
			$titles  = (isset($instance['titles'])) ? true : false;

			?>

					<p>
						<label for="<?php echo $this->get_field_id('title'); ?>">Title</label>
						<input type="text" class='widefat' id="<?php echo $this->get_field_id('title'); ?>" value="<?php echo $title; ?>" name="<?php echo $this->get_field_name('title') ?>">
					</p>

					<p>
						<label for="<?php echo $this->get_field_id('post_type'); ?>">Post Type</label>
						<?php $post_types = get_post_types(); ?>
						<select class='widefat' name="<?php echo $this->get_field_name('post_type'); ?>" id="<?php echo $this->get_field_id('post_type'); ?>">
							<?php foreach($post_types as $tp)
							{
								echo "<option ".selected( $post_type, $tp, false )." value='".$tp."'>".$tp."</option>";
							}

							?>
						</select>
					</p>
				

					<p>
						<label for="<?php echo $this->get_field_id('posts_per_page'); ?>">Limit</label>
						<input class='widefat'  type="number" id="<?php echo $this->get_field_id('posts_per_page'); ?>" placeholder="5" value="<?php echo $posts_per_page; ?>" name="<?php echo $this->get_field_name('posts_per_page'); ?>" />
					</p>

					<p>
						<input type="checkbox" <?php checked( $thumbnails ); ?> id="<?php echo $this->get_field_id('thumbnails'); ?>" name="<?php echo $this->get_field_name('thumbnails'); ?>" />
						<label for="<?php echo $this->get_field_id('thumbnails');?>">Thumbnails</label>
					</p>
					<p>
						<input type="checkbox" <?php checked( $date ); ?> id="<?php echo $this->get_field_id('date'); ?>" name="<?php echo $this->get_field_name('date'); ?>" />
						<label for="<?php echo $this->get_field_id('date');?>">Show Date</label>
					</p>

					<p>
						<input type="checkbox" <?php checked( $excerpt ); ?> id="<?php echo $this->get_field_id('excerpt'); ?>" name="<?php echo $this->get_field_name('excerpt'); ?>" />
						<label for="<?php echo $this->get_field_id('excerpt');?>">Show Excerpts</label>
					</p>

					<p>
						<input type="checkbox" <?php checked( $titles ); ?> id="<?php echo $this->get_field_id('titles'); ?>" name="<?php echo $this->get_field_name('titles'); ?>" />
						<label for="<?php echo $this->get_field_id('titles');?>">Show Titles</label>
					</p>
				
			<?php
		}
	}

	if (!function_exists('mint_register_content_loop_widget'))
	{
		function mint_register_content_loop_widget()
		{
			register_widget( 'Mint_Content_Loop_Widget' );
		}
	}
	
	add_action( 'widgets_init', 'mint_register_content_loop_widget' );