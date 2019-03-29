<?php ob_start();

// authentication check
require_once('auth.php');

// set page title
$page_title = null;
$page_title = 'Book Details';

// embed the header
require_once('include/header.php');

// initialize variables
$book_id = null;
$title = null;
$author = null;
$year = null;
$page = null;
$genres = null;
			


// check the url for a movie_id parameter and store the value in a variable if we find one
if (empty($_GET['book_id']) == false) {
	$book_id = $_GET['book_id'];

	// connect
	require_once('include/azureDatabase.php');
	
	// write the sql query
	$sql = "SELECT * FROM books WHERE book_id = :book_id";
	
	// execute the query and store the results
	$cmd = $conn->prepare($sql);
	$cmd->bindParam(':book_id', $book_id, PDO::PARAM_INT);
	$cmd->execute();
	$books = $cmd->fetchAll();
	
	// populate the fields for the selected movie from the query result
	foreach ($books as $book) {
		$title = $book['title'];
		$author = $book['author'];
		$year = $book['year'];
		$page = $book['page'];
		$genres = $book['genres'];
	}
	
	// disconnect
	$conn = null;
}

?>

	<div class="w3-container">
	    <form method="post" action="save-book.php">
	        <fieldset class="form-group">
	            <label for="title"">Title:</label>
	            <input name="title" id="title" required value="<?php echo $title; ?>" />
	        </fieldset>
	        <fieldset class="form-group">
	            <label for="author"">Author:</label>
	            <input name="author" id="author" required value="<?php echo $author; ?>" />
	        </fieldset>
	         <fieldset class="form-group">
	            <label for="year" ">Year:</label>
	            <input name="year" id="year" required type="number" value="<?php echo $year; ?>" />
	        </fieldset>
	         <fieldset class="form-group">
	            <label for="page" >Page:</label>
	            <input name="page" id="page" required type="number" value="<?php echo $page; ?>" />
	        </fieldset>
	         <fieldset class="form-group">
	            <label for="genres" >Genres:</label>
	            <input name="genres" id="genres" required value="<?php echo $genres; ?>" />
	        </fieldset>
	        <input name="book_id" type="hidden" value="<?php echo $book_id; ?>" />
	        <button type="submit" >Submit</button>
	    </form>
	</div>

<?php // embed footer
require_once('include/footer.php'); 
ob_flush(); ?>