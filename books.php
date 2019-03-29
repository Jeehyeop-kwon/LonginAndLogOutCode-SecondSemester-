<?php ob_start();

// authentication check
require_once('auth.php');

// set the page title
$page_title = null;
$page_title = 'Books';

// embed the header
require_once('include/header.php');

// connect
require_once('include/azureDatabase.php');

// write the sql query
$sql = "SELECT * FROM books";

// execute the query and store the results
$cmd = $conn->prepare($sql);
$cmd->execute();
$books = $cmd->fetchAll();

// start the html display table
	echo '<a href="book.php" title="Add a New Book">Add a New Book</a>
			<table class="table table-striped table-hover">
				<thead>
					<th>Title</th>
					<th>Author</th>
					<th>Originally published(year)</th>
					<th>Page</th>
					<th>genres</th>
					<th>Edit</th>
					<th>Delete</th>
				</thead>
				<tbody>';

// loop through the results and show each book in a new row and each value in a new column
foreach ($books as $book) {
	echo '<tr>
			<td>' . $book['title'] . '</td>
			<td>' . $book['author'] . '</td>
			<td>' . $book['year'] . '</td>
			<td>' . $book['page'] . '</td>
			<td>' . $book['genres'] . '</td>
			<td><a href="book.php?book_id=' . $book['book_id'] . '">Edit</a></td>
			<td><a href="delete-book.php?book_id=' . $book['book_id'] . '" 
			onclick="return confirm(\'Are you sure you want to delete this book?\');">Delete</td></tr>';
}

	// close the table and body
	echo '</tbody></table>';

	// disconnect
	$conn = null;

	// embed footer
	require_once('include/footer.php');
	ob_flush();
?>

