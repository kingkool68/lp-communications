<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<title>
<?php if ( is_tag() ) {
			echo 'Tag Archive for &quot;'.$tag.'&quot; | '; bloginfo( 'name' );
		} elseif ( is_archive() ) {
			wp_title(); echo ' Archive | '; bloginfo( 'name' );
		} elseif ( is_search() ) {
			echo 'Search for &quot;'.wp_specialchars($s).'&quot; | '; bloginfo( 'name' );
		} elseif ( is_home() ) {
			bloginfo( 'name' ); echo ' | '; bloginfo( 'description' );
		}  elseif ( is_404() ) {
			echo 'Error 404 Not Found | '; bloginfo( 'name' );
		} else {
			echo wp_title( ' | ', false, right ); bloginfo( 'name' );
		} ?>
</title>
<meta charset="<?php bloginfo( 'charset' ); ?>" >
<link rel="index" title="<?php bloginfo( 'name' ); ?>" href="<?php echo get_option('home'); ?>/" >
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" >
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" >
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" >
<link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>/css/main.css" >
<?php wp_head(); ?>
</head>
<?php
if(isset($_GET['grid'])) {
	add_filter('body_class','add_grid_class');
	function add_grid_class($classes, $class) {
		$classes[] = 'grid';
		return $classes;
	}
}
?>
<body <?php body_class(); ?>>
<a id="top" href="#content">Skip to Content</a>
<div id="header"></div>
