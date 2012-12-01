<div id="sidebar" role="complementary">
  <?php
/* If this is a 404 page */
	if (is_404()) {
		include ('sidebars/sidebar-404.php');
	}

/* If this is a page */
	if (is_page()) {
		include ('sidebars/sidebar-page.php');
	}

/* If this is a category archive */
	elseif (is_category()) {
		include ('sidebars/sidebar-category.php');
	}

/* If this is an author page */
	elseif (is_author()) {
		include ('sidebars/sidebar-author.php');
	}
  
/* If this is a daily archive */ 
	elseif (is_day()) {
	include ('sidebars/sidebar-daily.php');
	}

/* If this is a monthly archive */ 
	elseif (is_month()) {
		include ('sidebars/sidebar-monthly.php');
	}

/* If this is a yearly archive */
	elseif (is_year() && !is_category()) {
		include ('sidebars/sidebar-yearly.php');
	}

/* If this is a general archive */
	elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		include ('sidebars/sidebar-archive.php');
	}

/* If this is a search page */
	elseif (is_search()) {
		include ('sidebars/sidebar-search.php');
	}

/*If this is a single page*/
	if (is_attachment()) {
		include ('sidebars/sidebar-attachment.php');
	}
	elseif (is_single()) { 
			include ('sidebars/sidebar-single.php');
	}
/*If this is the front page*/
	if (is_front_page()) {
		include ('sidebars/sidebar-frontpage.php');
	}
?>
</div>
