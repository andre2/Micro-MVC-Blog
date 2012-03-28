<h2>Sign In</h2>

<?php if( isset($message) ) : ?>
	<p><?php echo $message; ?></p>
<?php endif; ?>

<p>
	<form method="post" action="<?php echo _BASEURL_; ?>signin" >
	<input type="text" name="username" value="Username" /><br/>
	<input type="password" name="password" value="Password" /><br/>
	<input type="submit" value="Sign In" />
	</form>
</p>