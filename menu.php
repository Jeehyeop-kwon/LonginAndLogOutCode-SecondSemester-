<?php ob_start();

// authentication check
require_once('auth.php');

// set the page title
$page_title = null;
$page_title = 'Main Menu';

// embed the header
require('include/header.php');
?>

<main class="w3-container">

   <ul class="w3-ul w3-large ">
      <li><a href="movies.php" title="Movies">Movies</a></li>
      <li><a href="books.php" title="Books">Books</a></li>
   </ul>
</main>

<?php 
// embed footer
require_once('include/footer.php');
ob_flush();
?>