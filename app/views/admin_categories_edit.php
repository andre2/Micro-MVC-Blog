<h2><?php echo $page_title; ?></h2>
<p>

	<?php if( isset($message) ) : ?>
		<p><?php echo $message; ?></p>
	<?php endif; ?>

	<form method="post" action="">
	<input type="hidden" name="c" value="submit" />
	<input type="hidden" name="cid" value="<?php echo $curcat->cat_id; ?>" />
	<table>
	<tr>
	<td>Name:</td><td><input type="text" name="name" value="<?php echo $curcat->name; ?>" /></td>
	</tr>
	<tr>
	<td>Slug:</td><td><input type="text" name="slug" value="<?php echo $curcat->slug; ?>" /></td>
	</tr><tr>
	<td>Parent:</td> 
	<td>
		<select name="parent">
			<option value="0">none</option>
			
			<?php foreach( $categories as $key=>$cat ) : ?>
			
				<option value="<?php echo $key; ?>"
				<?php if( $curcat->parent_id == $key ) echo 'SELECTED="SELECTED"'; ?> >
					<?php echo $cat->name; ?>
				</option>
				
				<?php if( count($cat->children) > 0 ) : ?>
					<?php foreach( $cat->children as $sub ) : ?>
						<option value="<?php echo $sub->cat_id; ?>" disabled="disabled">
							|-- <?php echo $sub->name; ?>
						</option>
					<?php endforeach; ?>
				<?php endif; ?>
					
			<?php endforeach; ?>
			
		</select>
	</td>
	</tr><tr>
	<td></td><td><input type="submit" value="Submit Changes" /></td>
	</tr>
	</table>
	</form>

</p>