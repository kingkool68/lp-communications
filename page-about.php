<?php get_header(); ?>
<div id="content" role="main" class="holder">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php
	$secondary_featured_image = get_secondary_feat_image();
	if( $img = $secondary_featured_image ) {
		?>
		<div class="bio">
			<img src="<?php echo $img->src;?>">
			<?php echo wpautop($img->caption); ?>
		</div>
		<?php
	}
	?>
	<div class="body"><?php the_content(); ?></div>
	<?php endwhile; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>