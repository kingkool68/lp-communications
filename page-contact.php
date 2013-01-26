<?php

function lp_send_mail() {
	if( !empty( $_POST['body'] ) ) {
		wp_die('We have detected you\'re not a human.');
	}
	
	if( !isset($_POST['your-email']) && !isset($_POST['message']) ) { 
		return false;
	}
	
	$to = 'info@lp-communications.com, linda@mintedprose.com';
	$subject = 'Message from your contact form';
	$from = sanitize_email( $_POST['your-email'] );
	$message = wpautop( sanitize_text_field( $_POST['message'] ) );
	$headers = 'From: ' . $from . "\r\n";
	
	add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
	return wp_mail( $to, $subject, $message, $headers );
}

function add_email_body_class( $class ) {
	$class[] = 'email-sent';
	return $class;
}


if( isset( $_GET['sent'] ) ) {
	$sent = lp_send_mail();
	if( $sent === TRUE ) {
		$sent_message = 'Thank you. Your message has been sent.';
	}
	add_filter('body_class', 'add_email_body_class'); 
}

get_header();
?>
<div id="content" role="main" class="holder">
	<?php if  (have_posts() ): while (have_posts()) : the_post(); ?>
	
	<?php if( $sent ) : ?>
		<p class="sent"><?php echo $sent_message;?></p>
	<?php endif; ?>
	
	<form action="?sent" method="post" id="contact-form">
		<label for="your-email">Your Email Address</label>
		<input type="email" name="your-email" id="your-email" value="<?php echo esc_attr( $_POST['your-email'] );?>">
		
		<label for="body" style="display:none;">If you're a human, leave this field blank</label>
		<textarea name="body" id="body" style="display:none;"></textarea>
		
		<label for="message">Message</label>
		<textarea id="message" name="message" rows="15"><?php echo $_POST['message'];?></textarea>
		<?php if( !isset( $_GET['sent'] ) ) { ?>
		<input type="submit" class="submit" value="Send Email">
		<?php } ?>
	</form>
	
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>
	
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>