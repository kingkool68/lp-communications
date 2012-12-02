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

<?php
wp_enqueue_style('main');
wp_head(); ?>
</head>
<?php
function add_grid_class($classes) {
		$classes[] = 'grid';
		return $classes;
}
if(isset($_GET['grid'])) {
	add_filter('body_class','add_grid_class');
}
?>
<body <?php body_class(); ?>>
<div id="header" class="holder">
	<a id="top" href="#content">Skip to Content</a>
	<a href="<?php echo get_site_url();?>"><img src="<?php echo get_template_directory_uri()?>/img/linda-purpura-communications-logo.png" alt="Linda Purpura Communications"></a>
	<ul id="social-media">
		<li class="email"><a href="#">Email</a></li>
		<li class="facebook"><a href="#">Facebook</a></li>
		<li class="twitter"><a href="#">Twitter</a></li>
		<li class="google-plus"><a href="#">Google+</a></li>
	</ul>
	<?php 
	$nav_name = 'header_menu';
    if (
		( $locations = get_nav_menu_locations() ) &&
		isset( $locations[ $nav_name ] )
	) {
		$nav = wp_get_nav_menu_object( $locations[ $nav_name ] );
		$nav_items = wp_get_nav_menu_items( $nav->term_id );
		$nav_list = '<div id="nav">';
		$nav_list .= '<ul>';
		
		$halfway = ceil(count($nav_items)/2) + 1;
		$num = 1;
		$class = '';
		foreach ( (array) $nav_items as $key => $nav_item ) {
			if( $num == $halfway ) {
				$nav_list .= '</ul><ul>';
			}
			$title = $nav_item->title;
			$url = $nav_item->url;
			$nav_list .= '<li class="' . $class . '"><a href="' . $url . '">' . $title . '</a></li>';
			$num++;
		}
		$nav_list .= '</ul></div>';
		echo $nav_list;
	}
	?>
</div>

<?php lp_banner_image(); //Defined in functions.php ?>
