<?php get_header(); ?>
<div id="content" role="main">
	<?php if  (have_posts() ): while (have_posts()) : the_post(); ?>
	<div class="intro">
		<?php the_content(); ?>
	</div>
	<?php endwhile; endif; ?>
	<h1>Featured Projects</h1>
	<div id="featured-projects" class="clearfix">
		<?php dynamic_sidebar( 'Featured Projects' ); ?>
	</div>
</div>
<?php get_footer(); ?>