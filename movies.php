<?php ob_start();

// authentication check
require_once('auth.php');

// set the page title
$page_title = null;
$page_title = 'Movies';

// embed the header
require_once('include/header.php');

// connect
require_once('include/azureDatabase.php');

// write the sql query
$sql = "SELECT * FROM movies";

// execute the query and store the results
$cmd = $conn->prepare($sql);
$cmd->execute();
$movies = $cmd->fetchAll();

// start the html display table
	echo '<a href="movie.php" title="Add a New Movie">Add a New Movie</a>
			<table class="table table-striped table-hover">
				<thead>
					<th>Title</th>
					<th>Year</th>
					<th>Length</th>
					<th>URL</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody>';

// loop through the results and show each movie in a new row and each value in a new column
foreach ($movies as $movie) {
	echo '<tr>
			<td>' . $movie['title'] . '</td>
			<td>' . $movie['year'] . '</td>
			<td>' . $movie['length'] . '</td>
			<td><a href="' . $movie['url'] . '">' . $movie['url'] . '</a></td>
			<td><a href="movie.php?movie_id=' . $movie['movie_id'] . '">Edit</a></td>
			<td><a href="delete-movie.php?movie_id=' . $movie['movie_id'] . '" 
			onclick="return confirm(\'Are you sure you want to delete this movie?\');">Delete</td></tr>';
}

	// close the table and body
	echo '</tbody></table>';

	// disconnect
	$conn = null;

	// embed footer
	require_once('include/footer.php');
	ob_flush();
?>

