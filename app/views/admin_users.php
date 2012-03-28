<h2><?php echo $page_title; ?></h2>
<p>

    <?php if( isset($message) ) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

<table>
    <tr><td>Username</td><td>Date Registered</td><td>Action</td></tr>

    <?php foreach( $users as $user ) : ?>
    <tr>
        <td><?php echo $user->username; ?></td><td><?php echo date("M j, Y, g:i a",$user->date_registered); ?></td>
        <td>
            <div class="right">
                <form method="post" action="users/edit">
                    <input type="hidden" name="uid" value="<?php echo $user->user_id; ?>" />
                    <input type="image" src="<?php echo $this->get_template_url(); ?>images/icons/pencil.png" alt="edit user" title="edit user" />
                </form>
            </div>
            <div class="right">
                <form method="post" action="">
                    <input type="hidden" name="c" value="delete" />
                    <input type="hidden" name="uid" value="<?php echo $user->user_id; ?>" />
                    <input type="image" src="<?php echo $this->get_template_url(); ?>images/icons/cross.png" alt="delete user" title="delete user" />
                </form>
            </div>
            <div class="clear"></div>
        </td>
    </tr>
    <?php endforeach; ?>

</table>



</p>