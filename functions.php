<?php
// post thumbnail support
add_theme_support( 'post-thumbnails' );
	
// custom menu support
add_theme_support( 'menus' );
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus( array(
		'header_menu' => 'Header Menu'
	));
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
		$classes[] = 'cat-' . $category->cat_ID . '-id';
		$classes[] = $post->post_type . '-' . $post->post_name;
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

//Register CSS Files
wp_register_style('reset', get_template_directory_uri() . '/css/reset.css', '', false, 'all');
wp_register_style('montserrat', 'http://fonts.googleapis.com/css?family=Montserrat:400,700', array('reset'), NULL, 'all');
wp_register_style('main', get_template_directory_uri() . '/css/main.css', array('reset', 'montserrat'), false, 'all');
wp_register_style('fancybox', get_template_directory_uri() . '/css/fancybox.css', array('main'), false, 'all');

//Register JS Files
wp_register_script('responsiveslider', get_template_directory_uri() . '/js/responsiveslider.min.js', array('jquery'), NULL, true);
wp_register_script('fancybox', get_template_directory_uri() . '/js/fancybox.min.js', array('jquery'), NULL, true);

//Function to render the banner image in header.php
function lp_banner_image() {
	global $post;
	if( !has_post_thumbnail() ) {
		return;
	}
	$banner_id = get_post_thumbnail_id();
	if( !$banner_id ) {
		return;
	}
	$hex = get_post_meta($post->ID, 'banner_color', true);
	if( substr($hex, 0) !== '#' ) {
		$hex = '#' . $hex;
	}
	
	$hex_attr = '';
	if( $hex ) {
		$hex_attr = 'style="background-color:' . $hex . '"';
	}
	$attr = array();
	?>
	<div id="banner" <?php echo $hex_attr;?>>
		<?php echo wp_get_attachment_image( intval($banner_id), 'full', false, $attr); ?>
	</div>
	<?php
}


/* Custom Meta Boxes */
if( is_admin() ):
	require_once('metabox/metabox.class.php');

	/* Banner Color */
	$banner_color = new metabox('banner_color');
	$banner_color->title = 'Banner Color';
	$banner_color->context = 'side';
	$banner_color->priority = 'low';
	$banner_color->page = 'page';
	$banner_color->is_single_value = true;
	$banner_color->html = <<<HEREHTML
<input name="banner_color" type="text" value="" style="width: auto;"></label>
<p>Enter the hex color to match the leflt and right sides of the featured image.</p>
HEREHTML;

add_action('admin_menu', 'create_box');
add_action('save_post', 'save_box');
endif;

/* Secondary Featured Image */
new MFI_Meta_Box( 'secondary_feat_img', 'Secondary Featured Image', '600', '150', 'page' );

function get_secondary_feat_image( $post_id = NULL ) {
	if( !$post_id ) {
		global $post;
		$post_id = $post->ID;
	}
	$meta_id = intval(get_post_meta($post_id, '_secondary_feat_img_thumbnail_id', true) );
	
	if( !$meta_id ) {
		return false;
	}
	
	$meta_data = wp_get_attachment_metadata( $meta_id );
	$post_data = get_post( $meta_id );
	
	$wp_upload = wp_upload_dir();
	$base_upload_dir = $wp_upload[baseurl];
	$src = $base_upload_dir . '/' . $meta_data['file'];
	
	return (object) array(
		'src' => $src,
		'title' => $post_data->post_title,
		'caption' => $post_data->post_excerpt
	);
	
}

include( 'widgets-and-sidebars.php' );