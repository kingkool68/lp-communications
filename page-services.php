<?php get_header(); ?>
<div id="content" role="main" class="holder">
	<?php if  (have_posts() ): while (have_posts()) : the_post(); ?>
	<div class="body">
	<?php the_content(); ?>
	</div>
	
	<?php endwhile; endif; ?>
	<h1><?php the_title(); ?></h1>
	<div id="services" class="clearfix">
		<?php dynamic_sidebar( 'Services' ); ?>
	</div>
</div>
<?php get_footer(); ?>