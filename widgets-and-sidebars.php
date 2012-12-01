<?php 
/* Any custom widgets and sidebars specific to this theme should go here. */

/* Widgets */
global $widget_count;
$widget_count = 1;


/* Sidebars */
if ( function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Featured Projects',
		'before_widget' => '<div id="%1$s" class="widget widget_count">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Services',
		'before_widget' => '<div id="%1$s" class="widget widget_count">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
	register_sidebar(array(
		'name' => 'Recommendations',
		'before_widget' => '<div id="%1$s" class="widget widget_count">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}

// Unregister Default Widgets
function unregister_useless_widgets() {
	unregister_widget('WP_Widget_Pages');
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Archives');
	unregister_widget('WP_Widget_Links');
	unregister_widget('WP_Widget_Meta');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
	unregister_widget('WP_Nav_Menu_Widget');
}
add_action('widgets_init', 'unregister_useless_widgets');