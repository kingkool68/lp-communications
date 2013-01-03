<?php get_header(); ?>
<div id="content" role="main" class="holder">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<h1><?php the_title(); ?></h1>
	<div class="body">
		<?php the_content(); ?>
	</div>
	<?php endwhile; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>