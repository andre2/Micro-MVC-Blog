<h2><?php echo $page_title; ?></h2>
<p>

	<?php if( isset($message) ) : ?>
		<p><?php echo $message; ?></p>
	<?php endif; ?>
		
	<table>
	<?php foreach( $categories as $key=>$cat ) : ?>
	
		<tr>
			<td><?php echo $cat->name; ?></td>
			<td>
				<div class="right">
					<form method="post" action="edit">
					<input type="hidden" name="cid" value="<?php echo $key; ?>" />
					<input type="image" src="<?php echo $this->get_template_url(); ?>images/icons/pencil.png" alt="edit category" title="edit category" />
					</form>
				</div>
				<div class="right">
					<form method="post" action="">
						<input type="hidden" name="c" value="delete" />
						<input type="hidden" name="cid" value="<?php echo $key; ?>" />
						<input type="image" src="<?php echo $this->get_template_url(); ?>images/icons/cross.png" alt="delete post" title="delete post" />
					</form>
				</div>
				<div class="clear"></div>
			</td>
		</tr>
		
		<?php if( count($cat->children) > 0 ) : ?>
			<?php foreach( $cat->children as $sub ) : ?>
                <tr>
                    <td>|-- <?php echo $sub->name; ?></td>
                    <td>
						<div class="right">
							<form method="post" action="edit">
							<input type="hidden" name="cid" value="<?php echo $sub->cat_id; ?>" />
							<input type="image" src="<?php echo $this->get_template_url(); ?>images/icons/pencil.png" alt="edit category" title="edit category" />
							</form>
						</div>
						<div class="right">
							<form method="post" action="">
								<input type="hidden" name="c" value="delete" />
								<input type="hidden" name="cid" value="<?php echo $sub->cat_id; ?>" />
								<input type="image" src="<?php echo $this->get_template_url(); ?>images/icons/cross.png" alt="delete post" title="delete post" />
							</form>
						</div>
						<div class="clear"></div>
                    </td>
                </tr>
			<?php endforeach; ?>
		<?php endif; ?>
			
	<?php endforeach; ?>
	</table>

</p>