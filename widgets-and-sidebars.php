<?php 
/* Any custom widgets and sidebars specific to this theme should go here. */

/* Widgets */
global $widget_count;
$widget_count = 1;

class Featured_Project extends WP_Widget {
	/**
	* Declares the Featured_Project class.
	*
	*/
	function Featured_Project(){
		$widget_ops = array('description' => 'Featured Project widget for the homepage.' );
		$this->WP_Widget('Featured_Project','Featured Project', $widget_ops);
		$this->widget_count = 1;
	}

	/**
	* Displays the Widget
	*
	*/
	function widget($args, $instance){
		global $widget_count;
		extract($args);
	
		# Before the widget
		if( $instance['video'] == 'true' ) {
			$before_widget = preg_replace('/class="/i', 'class="video ', $before_widget);
		}
		echo preg_replace('/widget_count/i', 'position-' . $this->widget_count, $before_widget);
		$instance['title'] = preg_replace('/\|/', '<br>', $instance['title']); 
		?>
		<h2><a href="<?php echo $instance['link']?>"><?php echo $instance['title']?></a></h2>
		<div class="blurb">
			<?php echo wpautop( $instance['blurb'] ); ?>
		</div>
		
		<a href="<?php echo $instance['link']?>" class="icon"><img src="<?php echo $instance['link_icon']?>"></a>
		<?php
		# After the widget
		echo $after_widget;
		$this->widget_count++;
	}

	/**
	* Saves the widgets settings.
	*
	*/
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['blurb'] = $new_instance['blurb'];
		$instance['link'] = strip_tags(stripslashes($new_instance['link']));
		$instance['link_icon'] = strip_tags(stripslashes($new_instance['link_icon']));
		$instance['video'] = strip_tags(stripslashes($new_instance['video']));

		return $instance;
	}

	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){
	  
		$title = htmlspecialchars($instance['title']);
		$blurb = htmlspecialchars($instance['blurb']);
		$link = htmlspecialchars($instance['link']);
		$link_icon = htmlspecialchars($instance['link_icon']);
		$video = htmlspecialchars($instance['video']);
		  
	?>
	  
		<p><label for="<?php echo $this->get_field_id('title');?>">Title</label>
		<input id="<?php echo $this->get_field_id('title')?>" name="<?php echo $this->get_field_name('title');?>" class="widefat" type="text" value="<?php echo $title;?>"></p>
	  
		<p><label for="<?php echo $this->get_field_id('blurb');?>">Blurb</label>
		<textarea id="<?php echo $this->get_field_id('blurb')?>" name="<?php echo $this->get_field_name('blurb');?>" class="widefat" cols="20" rows="5" type="text"><?php echo $blurb;?></textarea></p>
	  
		<p><label for="<?php echo $this->get_field_id('link');?>">Link</label>
		<input id="<?php echo $this->get_field_id('link')?>" name="<?php echo $this->get_field_name('link');?>" class="widefat" type="text" value="<?php echo $link;?>"></p>
		
		<p><label for="<?php echo $this->get_field_id('link_icon');?>">Link Icon</label>
		<input id="<?php echo $this->get_field_id('link_icon')?>" name="<?php echo $this->get_field_name('link_icon');?>" class="widefat" type="text" value="<?php echo $link_icon;?>"></p>
		
		<p><label for="<?php echo $this->get_field_id('video');?>">Is this a video? <input type="checkbox" name="<?php echo $this->get_field_name('video') ;?>" value="true" <?php checked( $video, 'true' ); ?>></label></p>
		
	<?php
	}

}// END class


class Service extends WP_Widget {
	/**
	* Declares the Services class.
	*
	*/
	function Service(){
		$widget_ops = array('description' => 'Services widget for the Services page.' );
		$this->WP_Widget('Service','Service', $widget_ops);
		$this->widget_count = 1;
		$this->number_of_list_items = 3;
	}

	/**
	* Displays the Widget
	*
	*/
	function widget($args, $instance){
		global $widget_count;
		extract($args);
		
		$lis = '';
		for( $i = 1; $i <= $this->number_of_list_items; $i++ ):
			if( $instance['item' . $i] ) {
				$lis .= '<li><span>' . $instance['item' . $i] . '</span></li>';
			}
		endfor;
	
		# Before the widget
		$odd = '';
		if( $this->widget_count % 2 ) {
			$odd = ' odd';
		}
		echo preg_replace('/widget_count/i', 'position-' . $this->widget_count . $odd, $before_widget);
		$instance['title'] = preg_replace('/\|/', '<br>', $instance['title']); 
		?>
		<h2><?php echo $instance['title']?></h2>
		<?php if( $icon = $instance['icon'] ) { ?>
			<img class="icon" alt="" src="<?php echo $icon ?>">
		<?php } ?>
		<div class="blurb">
			<?php echo wpautop( $instance['blurb'] ); ?>
		</div>
		
		<?php if( $lis ): ?>
		<ul>
			<?php echo $lis; ?>
		</ul>
		<?php endif; ?>
		
		<?php
		# After the widget
		echo $after_widget;
		$this->widget_count++;
	}

	/**
	* Saves the widgets settings.
	*
	*/
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		$instance['blurb'] = $new_instance['blurb'];
		$instance['icon'] = strip_tags(stripslashes($new_instance['icon']));
		for( $i = 1; $i <= $this->number_of_list_items; $i++ ):
			$instance['item' . $i] = strip_tags(stripslashes($new_instance['item' . $i]));
		endfor;

		return $instance;
	}

	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){
	  
		$title = htmlspecialchars($instance['title']);
		$blurb = htmlspecialchars($instance['blurb']);
		$icon = htmlspecialchars($instance['icon']);

	?>
	  
		<p><label for="<?php echo $this->get_field_id('title');?>">Title</label>
		<input id="<?php echo $this->get_field_id('title')?>" name="<?php echo $this->get_field_name('title');?>" class="widefat" type="text" value="<?php echo $title;?>"></p>
	  
		<p><label for="<?php echo $this->get_field_id('blurb');?>">Blurb</label>
		<textarea id="<?php echo $this->get_field_id('blurb')?>" name="<?php echo $this->get_field_name('blurb');?>" class="widefat" cols="20" rows="5" type="text"><?php echo $blurb;?></textarea></p>
		
		<p><label for="<?php echo $this->get_field_id('icon');?>">Icon</label>
		<input id="<?php echo $this->get_field_id('icon')?>" name="<?php echo $this->get_field_name('icon');?>" class="widefat" type="text" value="<?php echo $icon;?>"></p>
		
		<?php
		for( $i = 1; $i <= $this->number_of_list_items; $i++ ):
			$item = htmlspecialchars($instance['item' . $i]);
			$item_name = 'item' . $i;
		?>
			<p><label for="<?php echo $this->get_field_id($item_name);?>">Item <?php echo $i ?></label> <input name="<?php echo $this->get_field_name($item_name) ;?>" class="widefat" type="text" value="<?php echo $item;?>" id="<?php echo $this->get_field_id($item_name);?>"></p>
		<?php endfor; ?> 
		
	<?php
	}

}// END class



/* Register the Widget Classes with WordPress */
function register_our_widgets() {
	register_widget('Featured_Project');
	register_widget('Service');
}
add_action('widgets_init', 'register_our_widgets');


/* Sidebars */
if ( function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Featured Projects',
		'before_widget' => '<div class="callout widget_count">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	));
	register_sidebar(array(
		'name' => 'Services',
		'before_widget' => '<div class="callout speech-bubble-bottom widget_count">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
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