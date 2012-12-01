<?php
// post thumbnail support
add_theme_support( 'post-thumbnails' );
	
// custom menu support
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
	  		  'header_menu' => 'Header Menu',
	  		  'sidebar_menu' => 'Sidebar Menu',
	  		  'footer_menu' => 'Footer Menu'
	  	)
	);
}
	
// Removes Trackbacks from the comment cout
add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $count ) {
	if ( ! is_admin() ) {
		global $id;
		$comments_by_type = &separate_comments(get_comments('status=approve&post_id=' . $id));
		return count($comments_by_type['comment']);
	} else {
		return $count;
	}
}
	
// category id in body and post class
function category_id_class($classes) {
	global $post;
	foreach((get_the_category($post->ID)) as $category)
		$classes [] = 'cat-' . $category->cat_ID . '-id';
		return $classes;
}
	add_filter('post_class', 'category_id_class');
	add_filter('body_class', 'category_id_class');

//Nice Search URL
function txfx_nice_search() {
    if ( is_search() && strpos($_SERVER['REQUEST_URI'], '/wp-admin/') === false && strpos($_SERVER['REQUEST_URI'], '/search/') === false ) {
        wp_redirect(get_bloginfo('home') . '/search/' . str_replace(' ', '+', str_replace('%20', '+', get_query_var('s'))) . '/');
        exit();
    }
}
add_action('template_redirect', 'txfx_nice_search');

function replace_pluses_with_spaces($s) {
	return str_replace('+', ' ', $s);
}
add_filter('get_search_query', 'replace_pluses_with_spaces');
?>