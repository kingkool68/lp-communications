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


class Recommendation extends WP_Widget {
	/**
	* Declares the Recommendation class.
	*
	*/
	function Recommendation(){
		$widget_ops = array('description' => 'Recommendation widget for the clients page.' );
		$this->WP_Widget('Recommendation','Recommendation', $widget_ops);
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
		echo preg_replace('/widget_count/i', 'position-' . $this->widget_count, $before_widget);
		$instance['title'] = preg_replace('/\|/', '<br>', $instance['title']);
		//$instance['blurb'] = '<span class="quote opening">&ldquo;</span>' . $instance['blurb'] . '<span class="quote closing">&rdquo;</span>';
		?>
		
		<?php if( $instance['profile_icon'] ): ?>
			<img class="author" src="<?php echo $instance['profile_icon'];?>" alt="<?php echo $instance['title']; ?>" title="<?php echo $instance['title']; ?>">
		<?php endif; ?>
		
		<?php 
		$cite = '<strong>' . $instance['title'] . '</strong>, ' . $instance['job_title'];
		?>
		<i class="left-triangle"></i>
		<div class="callout lifted speech-bubble-left">
			<blockquote>
				<span class="quote opening">&ldquo;</span>
				<?php echo wpautop( $instance['blurb'] ); ?>
				<span class="quote closing">&rdquo;</span>
			</blockquote>
			<cite><?php echo $cite; ?></cite>
		</div>
		
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
		$instance['job_title'] = strip_tags(stripslashes($new_instance['job_title']));
		$instance['blurb'] = $new_instance['blurb'];
		$instance['profile_icon'] = strip_tags(stripslashes($new_instance['profile_icon']));

		return $instance;
	}

	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){
	  
		$title = htmlspecialchars($instance['title']);
		$job_title = htmlspecialchars($instance['job_title']);
		$blurb = htmlspecialchars($instance['blurb']);
		$profile_icon = htmlspecialchars($instance['profile_icon']);
		  
	?>
	  
		<p><label for="<?php echo $this->get_field_id('title');?>">Name</label>
		<input id="<?php echo $this->get_field_id('title')?>" name="<?php echo $this->get_field_name('title');?>" class="widefat" type="text" value="<?php echo $title;?>"></p>
	  	
		<p><label for="<?php echo $this->get_field_id('job_title');?>">Job Title</label>
		<input id="<?php echo $this->get_field_id('job_title')?>" name="<?php echo $this->get_field_name('job_title');?>" class="widefat" type="text" value="<?php echo $job_title;?>"></p>
		
		<p><label for="<?php echo $this->get_field_id('blurb');?>">Blurb</label>
		<textarea id="<?php echo $this->get_field_id('blurb')?>" name="<?php echo $this->get_field_name('blurb');?>" class="widefat" cols="20" rows="5" type="text"><?php echo $blurb;?></textarea></p>
		
		<p><label for="<?php echo $this->get_field_id('profile_icon');?>">Profile Icon Link</label>
		<input id="<?php echo $this->get_field_id('profile_icon')?>" name="<?php echo $this->get_field_name('profile_icon');?>" class="widefat" type="text" value="<?php echo $profile_icon;?>"></p>
		
	<?php
	}

}// END class


/* Register the Widget Classes with WordPress */
function register_our_widgets() {
	register_widget('Featured_Project');
	register_widget('Service');
	register_widget('Recommendation');
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
		'before_widget' => '<div class="widget widget_count">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
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