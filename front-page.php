<?php
wp_enqueue_script('responsiveslider');
wp_enqueue_script('fancybox');
wp_enqueue_style('fancybox');
get_header();
?>
<div id="content" role="main" class="holder">
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
<script>
jQuery(document).ready(function($) {
	$(".rslides").wrap('<div class="slider"/>').responsiveSlides({
		auto: true,             // Boolean: Animate automatically, true or false
		speed: 1000,            // Integer: Speed of the transition, in milliseconds
		timeout: 8000,          // Integer: Time between slide transitions, in milliseconds
		pager: true,           // Boolean: Show pager, true or false
		pause: true,           // Boolean: Pause on hover, true or false
		pauseControls: true    // Boolean: Pause when hovering controls, true or false
	});
	
	$('#featured-projects a').click(function(e) {
		var vidID = this.href.match(/v=(\w+)/);
		vidID = vidID[1];
		if( vidID && $(window).width() > 480 ) {
			e.preventDefault();
			$.fancybox.open([{
				type: 'iframe',
            	href : 'http://www.youtube.com/embed/' + vidID + '?autoplay=1',                
            	title : ''
        	}]);
		}
	});
});
</script>
<?php get_footer(); ?>