<?php ob_start();

// authentication check
require_once('auth.php');

// set page title
$page_title = null;
$page_title = 'Movie Details';

// embed the header
require_once('include/header.php');

// initialize variables
$movie_id = null;
$title = null;
$length = null;
$year = null;
$url = null;


// check the url for a movie_id parameter and store the value in a variable if we find one
if (empty($_GET['movie_id']) == false) {
	$movie_id = $_GET['movie_id'];

	// connect
	require_once('include/azureDatabase.php');
	
	// write the sql query
	$sql = "SELECT * FROM movies WHERE movie_id = :movie_id";
	
	// execute the query and store the results
	$cmd = $conn->prepare($sql);
	$cmd->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);
	$cmd->execute();
	$movies = $cmd->fetchAll();
	
	// populate the fields for the selected movie from the query result
	foreach ($movies as $movie) {
		$title = $movie['title'];
		$length = $movie['length'];
		$year = $movie['year'];
		$url = $movie['url'];
	}
	
	// disconnect
	$conn = null;
}

?>

	<div class="w3-container">
	    <form method="post" action="save-movie.php">
	        <fieldset class="form-group">
	            <label for="title"">Title:</label>
	            <input name="title" id="title" required value="<?php echo $title; ?>" />
	        </fieldset>
	         <fieldset class="form-group">
	            <label for="year" ">Year:</label>
	            <input name="year" id="year" required type="number" value="<?php echo $year; ?>" />
	        </fieldset>
	         <fieldset class="form-group">
	            <label for="length" >Length:</label>
	            <input name="length" id="length" required type="number" value="<?php echo $length; ?>" />
	        </fieldset>
	         <fieldset class="form-group">
	            <label for="url" >URL:</label>
	            <input name="url" id="url" required type="url" value="<?php echo $url; ?>" />
	        </fieldset>
	        <input name="movie_id" type="hidden" value="<?php echo $movie_id; ?>" />
	        <button type="submit" >Submit</button>
	    </form>
	</div>

<?php // embed footer
require_once('include/footer.php'); 
ob_flush(); ?>