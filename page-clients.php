<?php get_header(); ?>
<div id="content" role="main" class="holder">
	<?php if  (have_posts() ): while (have_posts()) : the_post(); ?>
	<?php the_content(); ?>
	
	<h1><?php the_title(); ?></h1>
	<div id="recommendations">
		<?php dynamic_sidebar( 'Recommendations' ); ?>
	</div>
	
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>