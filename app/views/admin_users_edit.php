<h2><?php echo $page_title; ?></h2>
<p>

    <?php if( isset($message) ) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

<form method="post" action="">
    <input type="hidden" name="c" value="submit" />
    <input type="hidden" name="uid" value="<?php echo $user->user_id; ?>" />
    <table>
        <tr><td>Username:</td><td><input type="text" name="username" value="<?php echo $user->username; ?>" /></td></tr>
        <tr><td>Email:</td><td><input type="text" name="email" value="<?php echo $user->email; ?>" /></td></tr>
        <!--<tr><td>Password:</td><td><input type="password" name="password" value="password" /></td></tr>-->
        <tr>
            <td>Validated:</td>
            <td>
                <select name="validated">
                    <?php if( $user->validated ) : ?>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    <?php else : ?>
                        <option value="1">Yes</option>
                        <option value="0" selected="selected">No</option>
                    <?php endif; ?>
                </select>
            </td>
        </tr>
        <tr><td></td><td><input type="submit" value="Apply Changes" /></td></tr>
    </table>
</form>

</p>