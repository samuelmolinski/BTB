<div id="mint_wc">
<?php while ( have_posts() ) : the_post(); ?>

	<?php woocommerce_get_template_part( 'content', 'single-product' ); ?>

<?php endwhile; // end of the loop. ?>
</div>