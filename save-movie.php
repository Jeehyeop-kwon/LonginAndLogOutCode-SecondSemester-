<?php ob_start();

// auth check
require_once('auth.php');

// header
$page_title = null;
$page_title = 'Saving your Movie...';
require_once('include/header.php');

// save form inputs into variables
$title = $_POST['title'];
$year = $_POST['year'];
$length = $_POST['length'];
$url = $_POST['url'];
$movie_id = $_POST['movie_id'];

// create a variable to indicate if the form data is ok to save or not
$ok = true;

// check each value
if (empty($title)) {
	// notify the user
	echo 'Title is required<br />';
	
	// change $ok to false so we know not to save
	$ok = false;
}

if (empty($year)) {
	// notify the user
	echo 'Year is required<br />';
	
	// change $ok to false so we know not to save
	$ok = false;
}
elseif (is_numeric($year) == false) {
	echo 'Year is invalid<br />';
	$ok = false;
}

if (empty($length)) {
	// notify the user
	echo 'Title is required<br />';
	
	// change $ok to false so we know not to save
	$ok = false;
}
elseif (is_numeric($length) == false) {
	echo 'Length is invalid<br />';
	$ok = false;
}

if (empty($url)) {
	// notify the user
	echo 'URL is required<br />';
	
	// change $ok to false so we know not to save
	$ok = false;
}

if ($ok == true) {
	// connect to the database
	require_once('include/azureDatabase.php');
	
	if (empty($movie_id)) {
		// set up the SQL INSERT command
		$sql = "INSERT INTO movies (title, year, length, url) VALUES (:title, :year, :length, :url)";
	}
	else {
		// set up the SQL UPDATE command to modify the existing movie
		$sql = "UPDATE movies SET title = :title, year = :year, length = :length, url = :url WHERE movie_id = :movie_id";
	}
	
	// create a command object and fill the parameters with the form values
	$cmd = $conn->prepare($sql);
	$cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
	$cmd->bindParam(':year', $year, PDO::PARAM_INT);
	$cmd->bindParam(':length', $length, PDO::PARAM_INT);
	$cmd->bindParam(':url', $url, PDO::PARAM_STR, 100);
	
	// fill the movie_id if we have one
	if (!empty($movie_id)) {
		$cmd->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
	}
	
	// execute the command
	$cmd->execute();
	
	// disconnect from the database
	$conn = null;
	
	// show confirmation
	header('location: movies.php');
}

require_once('include/footer.php');
ob_flush();
?>
