<?php if( isset($message) ) : ?>
	<p><?php echo $message; ?></p>
<?php else : ?>

	<h3><?php echo $post->title; ?></h3>
	<i>By <?php echo $post->author; ?> on <?php echo date( 'F j, Y, g:i a', $post->date_posted ); ?></i>
	<p><?php echo nl2br($post->post); ?></p>

<?php endif; ?>