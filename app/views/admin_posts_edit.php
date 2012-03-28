<h2><?php echo $page_title; ?></h2>
<p>

    <?php if( isset($message) ) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

	<form method="post" action="">
    <input type="hidden" name="c" value="submit" />
	<input type="hidden" name="pid" value="<?php echo $post->id; ?>" />
    <table>
        <tr><td>Title:</td><td><input type="text" name="title" size="64" value="<?php echo $post->title; ?>" /></td></tr>
        <tr><td>Permalink Slug:</td><td><input type="text" name="slug" size="64" value="<?php echo $post->slug; ?>" /></td></tr>
		<tr><td>Category:</td>
			<td>
				<select name="cid">
					<?php foreach( $categories as $key=>$cat ) : ?>
						<option value="<?php echo $key; ?>"
							<?php if( $post->cat_id == $key ) echo 'SELECTED="SELECTED"'; ?> >
							<?php echo $cat->name; ?>
						</option>
						<?php if( count($cat->children) > 0 ) : ?>
							<?php foreach( $cat->children as $sub ) : ?>
								<option value="<?php echo $sub->cat_id; ?>" 
									<?php if( $post->cat_id == $sub->cat_id ) echo 'SELECTED="SELECTED"'; ?> >
									|-- <?php echo $sub->name; ?>
								</option>
							<?php endforeach; ?>
						<?php endif; ?>
					<?php endforeach; ?>
				</select>
			</td>
		</tr>
        <tr><td colspan="2">Post:</td></tr>
		<tr><td colspan="2"><textarea name="post" rows="16" cols="80"><?php echo $post->post; ?></textarea></td></tr>
        <tr><td></td><td><input type="submit" value="Edit Post" /></td></tr>
    </table>
</form>

</p>