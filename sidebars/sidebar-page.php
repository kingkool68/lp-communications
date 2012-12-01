<?php
  if($post->post_parent) {
  	$parent = get_page($post->post_parent);
  	$children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0&sort_column=menu_order");
  }
  else {
  	$parent = get_page($post->ID);
  	$children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0&sort_column=menu_order");
  }
  
  if ($children):
?>
<h2><?php echo $parent->post_title; ?></h2>
<ul>
  <?php echo $children; ?>
</ul>

<?php endif; ?>