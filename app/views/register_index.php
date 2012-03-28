<h2>Register</h2>

<?php if( isset($message) ) : ?>
	<p><?php echo $message; ?></p>
<?php endif; ?>

<p>
	<form method="post" action="">
	<input type="hidden" name="c" value="go" />
	<input type="hidden" name="t" value="<?php echo $token; ?>" />
	<input type="text" name="username" value="Username" /><br/>
	<input type="text" name="email" value="Email" /><br/>
	<input type="password" name="password" value="password" /><br/>
	<input type="password" name="vpassword" value="password" /><br/>
	<input type="submit" value="Register" />
	</form>
</p>