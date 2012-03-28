<h2><?php echo $blog_title; ?></h2>
<?php foreach($posts as $post): ?>
	<h3><a href="<?php echo _BASEURL_,'blog/post/',$post->slug; ?>"><?php echo $post->title; ?></a></h3>
	<i>By <?php echo $post->author; ?> on <?php echo date( 'F j, Y, g:i a', $post->date_posted ); ?></i>
	<p><?php echo nl2br($post->post); ?></p>
<?php endforeach; ?>