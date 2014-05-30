<?php
$PORTFOLIOSUB_SC_COLS = 0;
/* Portfolio Shortcode for Visual Composer */ 
if (!function_exists('mint_vc_portfoliosub_sc'))
{
	function mint_vc_portfoliosub_sc($atts, $content = null)
	{
		extract(shortcode_atts( array(
			'layout' => 'extended',
			'columns' => 4,
			'posts_per_page' => 4,
			'show_filter' => false,
			'show_cats' => false,
			'category'    => 'all'
		) , $atts));

		global $PORTFOLIOSUB_SC_COLS;
		$PORTFOLIOSUB_SC_COLS = $columns;

		$content = wpb_js_remove_wpautop($content);

		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

		$args = array(
			'posts_per_page' => (int)$posts_per_page,
			'post_type' => 'portfolio',
			'paged'   => $paged
		);

		
		
		if (isset($category) && $category != "all") 
		{
			$category = array(
				'tax_query' => array(
					array(
						'taxonomy' => 'portfolio-category',
						'field'    => 'term_id',
						'terms'    => $category
					)
				)
			);
		}
		else
		{
			$category = array();
		}


		$args = array_merge($args, $category);
		
		query_posts($args);

		global $wp_query;
		$GLOBALS["custom_wp_query"] = $wp_query;

		ob_start();

		?>
		
		<div class="all-portfolio-wrapper">
			<?php if($show_filter) : ?>
			<div id="filters" class="pull-right portfolio-categories">
			<a data-filter="all" href="#">All</a>
				<?php

$term_id = get_queried_object()->term_id;
$taxonomy_name = 'portfolio-category';
$termchildren = get_term_children( $term_id, $taxonomy_name );

foreach ( $termchildren as $child ) {
	$term = get_term_by( 'id', $child, $taxonomy_name );
	
	?>
	<a data-filter="<?php echo $term->name; ?>" href="#"><?php echo $term->name; ?></a>
<?php
}
					?>
					
			</div>
			<div class="clearfix"></div>
			<div class="space15">&nbsp;</div>
			<?php endif; ?>

			<div class="portfolio-layout <?php if($show_cats) : ?> catsnone <?php endif; ?> portfolio-layout-<?php echo $layout; ?>" data-mint-columns="<?php echo $columns; ?>" data-mint-layout="<?php echo $layout; ?>">
				<?php
					if($layout == "simple")
					{
						get_template_part( "pages/portfolio", "simple" );
					}

					if($layout == "extended")
					{
						get_template_part( "pages/portfolio", "extended" );
					}
				?>
			</div>

		</div>

		<?php
		$html = ob_get_clean();
		wp_reset_query();
		return $html;
	}
}

add_shortcode( 'portfoliosub', 'mint_vc_portfoliosub_sc' );




if (!function_exists('mint_register_portfoliosub_vc_mapper'))
{

	function mint_register_portfoliosub_vc_mapper()
	{
		if (function_exists('wpb_map'))
		{
			$cats = array('All Categories' => 'all');

			if (!defined('POLYLANG_VERSION'))
			{
				$categories = get_terms('portfolio-category', array('hide_empty' => false, ));
			}
			else
			{
				global $polylang;
				$lang = $polylang->curlang->slug;	
				$categories = get_terms("portfolio-category", array('lang' => $lang, 'hide_empty' => false) );
			}

			foreach($categories as $c)
			{
				$cats[ $c->name ] = $c->term_id;

			}

				$portfolio_per_page = array();
				$i = 2;

				while($i < 21)
				{
					$portfolio_per_page[$i] = $i;
					$i++;
				}

			wpb_map(
				array(
					'name'     => 'Mint - Portfolio Subcategory',
					'base'     => 'portfoliosub',
					'class'    => '',
					'controls' => 'full',
					'icon'     => 'mint-icon-portfolio',
					'category' => __('Content', 'js_composer'),
					'params'   => array(

						array(
		 					'type' => 'dropdown',
		 					'holder' => 'div',
		 					'class' => '',
		 					'heading' => 'Show from category',
		 					'param_name' => 'category',
		 					'value' => $cats,
		 					'description' => 'Select category whit subcategory to display on this page.'
		 				),

		 				array(
		 					'type' => 'checkbox',
		 					'holder' => 'div',
		 					'class' => '',
		 					'heading' => 'Display subcategories?',
		 					'param_name' => 'show_filter',
		 					'value' => array("Yes" => "yes"),
		 				
		 				),

						array(
							'type'        => 'dropdown',
							'holder'      => 'div',
							'class'       => '',
							'heading'     => 'Portfolio Layout',
							'param_name'  => 'layout',
							'value'       => array(
								'Simple' => 'simple',
								'Extended' => 'extended'
							),
							'description' => 'Select the portfolio layout style.'
		 				),

		 				array(
		 					'type' => 'dropdown',
		 					'holder' => 'div',
		 					'class' => '',
		 					'heading' => 'Portfolio Columns',
		 					'param_name' => 'columns',
		 					'value' => array(
		 						'2 Columns' => 2,
		 						'3 Columns' => 3,
		 						'4 Columns' => 4
		 					),
		 					'description' => 'Select how many columns per row'
		 				),

		 				array(
		 					'type' => 'dropdown',
		 					'holder' => 'div',
		 					'class' => '',
		 					'heading' => 'Portfolio Items per page',
		 					'param_name' => 'posts_per_page',
		 					'value' => $portfolio_per_page,
		 					'description' => 'Select how many item per page.'
		 				),
		 				 array(
		 					'type' => 'checkbox',
		 					'holder' => 'div',
		 					'class' => '',
		 					'heading' => 'Hide Categories Breadcrumb?',
		 					'param_name' => 'show_cats',
		 					'value' => array("Yes" => "yes"),
		 					'description' => 'If you want you can hide the categories from Breadcrumb.'
		 				),
		 				
					)
				)
			);
		}
	}

}

add_action('init', 'mint_register_portfoliosub_vc_mapper');