<?php 

$page_title = null;
$page_title = 'Login';

require('include/header.php');

?>

	<form class="w3-container " method="post" action="validate.php">
		<fieldset class="w3-margin-top form-group">
			<label for="username" >Email:</label>
			<input name="username" required type="email" >
		</fieldset>
		<fieldset class="form-group">
			<label for="password" class="col-sm-2">Password:</label>
			<input name="password" required type="password">
		</fieldset>
		<button type="submit" class="">Log In</button>
    </form>

<?php require('include/footer.php'); ?>