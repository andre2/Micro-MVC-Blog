<h2><?php echo $page_title; ?></h2>
<p>

    <?php if( isset($message) ) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

<table>
    <tr>
        <td>Title</td><td>Date Posted</td><td>Actions</td>
    </tr>
    <?php foreach( $posts as $post ) : ?>
    <tr>
        <td><?php echo $post->title; ?></td>
		<td><?php echo date( 'F j, Y, g:i a', $post->date_posted ); ?></td>
        <td>
			<div class="right">
                <form method="post" action="posts/edit">
                    <input type="hidden" name="pid" value="<?php echo $post->id; ?>" />
                    <input type="image" src="<?php echo $this->get_template_url(); ?>images/icons/pencil.png" alt="edit post" title="edit post" />
                </form>
            </div>
            <div class="right">
                <form method="post" action="">
                    <input type="hidden" name="c" value="delete" />
                    <input type="hidden" name="pid" value="<?php echo $post->id; ?>" />
                    <input type="image" src="<?php echo $this->get_template_url(); ?>images/icons/cross.png" alt="delete post" title="delete post" />
                </form>
            </div>
            <div class="clear"></div>
		</td>
    </tr>
    <?php endforeach; ?>
</table>

</p>