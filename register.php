<?php 

$page_title = null;
$page_title = 'User Registration';

require_once('include/header.php');?>

<main class="container">

	<form class="w3-container" method="post" action="save-registration.php">
		<fieldset class="w3-margin-top form-group">
			<label for="username" >Email:</label>
			<input name="username" required type="email" />
		</fieldset>
		<fieldset class="form-group">
			<label for="password" >Password:</label>
			<input name="password" required type="password" />
		</fieldset>
		<fieldset class="form-group">
			<label for="confirm" >Confirm Password:</label>
			<input name="confirm" required type="password" />
		</fieldset>
		<button type="submit">Submit</button>
	</form>
</main>

<?php require_once('include/footer.php'); ?>
