<?php ob_start();

// auth check
require_once('auth.php');

// header
$page_title = null;
$page_title = 'Saving your Book...';
require_once('include/header.php');

// save form inputs into variables
$title = $_POST['title'];
$author = $_POST['author'];
$year = $_POST['year'];
$page = $_POST['page'];
$genres = $_POST['genres'];
$book_id = $_POST['book_id'];

// create a variable to indicate if the form data is ok to save or not
$ok = true;

// check each value
if (empty($title)) {
	// notify the user
	echo 'Title is required<br />';
	
	// change $ok to false so we know not to save
	$ok = false;
}
if (empty($author)) {
	// notify the user
	echo 'Author is required<br />';
	
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

if (empty($page)) {
	// notify the user
	echo 'Page is required<br />';
	
	// change $ok to false so we know not to save
	$ok = false;
}
elseif (is_numeric($page) == false) {
	echo 'Page is invalid<br />';
	$ok = false;
}


if (empty($genres)) {
	// notify the user
	echo 'Genres are required<br />';
	
	// change $ok to false so we know not to save
	$ok = false;
}

if ($ok == true) {
	// connect to the database
	require_once('include/localDatabase.php');
	
	if (empty($book_id)) {
		// set up the SQL INSERT command
		$sql = "INSERT INTO books (title, author, year, page, genres) VALUES (:title, :author, :year, :page, :genres)";
	}
	else {
		// set up the SQL UPDATE command to modify the existing movie
		$sql = "UPDATE books SET title = :title, author = :author, year = :year, page = :page, genres = :genres WHERE book_id = :book_id";
	}
	
	// create a command object and fill the parameters with the form values
	$cmd = $conn->prepare($sql);
	$cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
	$cmd->bindParam(':author', $author, PDO::PARAM_STR, 50);
	$cmd->bindParam(':year', $year, PDO::PARAM_INT);
	$cmd->bindParam(':page', $page, PDO::PARAM_INT);
	$cmd->bindParam(':genres', $genres, PDO::PARAM_STR, 100);
	
	// fill the movie_id if we have one
	if (!empty($book_id)) {
		$cmd->bindParam(':movie_id', $book_id, PDO::PARAM_INT);
	}
	
	// execute the command
	$cmd->execute();
	
	// disconnect from the database
	$conn = null;
	
	// show confirmation
	header('location: books.php');
}

require_once('include/footer.php');
ob_flush();
?>
