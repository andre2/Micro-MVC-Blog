<h2><?php echo $page_title; ?></h2>
<p>

    <?php if( isset($message) ) : ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>

<form method="post" action="">
    <input type="hidden" name="c" value="submit" />
    <table>
        <tr><td>Username:</td><td><input type="text" name="username" /></td></tr>
        <tr><td>Email:</td><td><input type="text" name="email" /></td></tr>
        <tr><td>Password:</td><td><input type="password" name="password" /></td></tr>
        <tr>
            <td>Validated:</td>
            <td>
                <select name="validated">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
        </tr>
        <tr><td></td><td><input type="submit" value="Add User" /></td></tr>
    </table>
</form>

</p>