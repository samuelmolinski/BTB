<?php
	
	global $PORTFOLIO_SC_COLS;
	(int)$cols = (!isset($PORTFOLIO_SC_COLS)) ? MintOptions::get("portfolio-columns") : $PORTFOLIO_SC_COLS;

	$img_width = 470;
	$img_height = 290;

	if($cols == 2)
	{
		$img_width = 470;
		$img_height = 290;
	}

	if($cols == 3)
	{
		$img_width = 315;
		$img_height = 250;
	}

	if($cols == 4)
	{
		$img_width = 235;
		$img_height = 250;
	}

?>

<?php if (have_posts()) { ?>
	<?php while (have_posts()) : ?>
		<?php 
			the_post(); 
			$post_terms = wp_get_post_terms(get_the_ID(), 'portfolio-category');

			$filters = array();
			if(is_array($post_terms))
			{
				foreach($post_terms as $filter)
				{
					$filters[] = $filter->slug;
				}
			}
		?>
		<div data-filter-class='<?php echo json_encode($filters); ?>' <?php post_class("mint-portfolio mint-portfolio-item"); ?>>
			<div class="portfolio-body">
				<div class="portfolio-body-actions">
					<a href="<?php the_permalink(); ?>"><i class="icon-link animate"></i></a>
					<a class="colorbox" href="<?php echo MintUtils::thumb(get_the_ID(), 0, 0, false);  ?>"><i class="icon-eye animate"></i></a>
				</div>
				<a href="<?php the_permalink(); ?>"><img class="portfolio-image" <?php mint_get_retina( get_the_ID(), $img_width, $img_height ); ?> src="<?php echo MintUtils::thumb(get_the_ID(), $img_width, $img_height); ?>" alt="" /></a>
			</div>
			<div class="portfolio-caption animate">
				<h4 class="portfolio-title portfolio-caption-title"><a class="hcolor" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<small class="portfolio-categories portfolio-caption-categories">
					<?php 
		
					if(is_array($post_terms))
					{
						foreach ($post_terms as $term) {
                
							?><span><?php echo $term->name;?></span><?php

						}
					}
					?>
				</small>
			</div>
		</div>

	<?php endwhile; ?>
<?php } else { } ?>