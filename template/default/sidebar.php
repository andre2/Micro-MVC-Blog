<div class="span3">

<ul>
	<li><a href="<?php echo _BASEURL_; ?>">Home</a></li>
	<?php if( ! isset($authenticated) ) : ?>
		<li><a href="<?php echo _BASEURL_; ?>register">Register</a></li>
	<?php else : ?>
		<li><a href="<?php echo _BASEURL_; ?>dashboard">Dashboard</a></li>
		<li><a href="<?php echo _BASEURL_; ?>signout">Sign Out</a></li>
	<?php endif; ?>
</ul>

<?php if( ! isset($authenticated) ) : ?>
	<form method="post" action="<?php echo _BASEURL_; ?>signin" >
	<input type="text" name="username" value="Username" /><br/>
	<input type="password" name="password" value="password" /><br/>
	<input type="submit" value="Sign In" />
	</form>
<?php else : ?>
	logged in
<?php endif; ?>

</div>