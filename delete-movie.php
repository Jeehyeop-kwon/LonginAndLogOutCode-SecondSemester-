

<?php 

///////////////////////////////////////////////// delet ///////////

ob_start(); 

$movie_id = $_GET['movie_id'];

//connect

require('include/azureDatabase.php'); 

// set up sql query 

$sql = "DELETE FROM movies WHERE movie_id = :movie_id";

//prepare 

$cmd = $conn->prepare($sql); 

//bind 

$cmd->bindParam(':movie_id', $movie_id, PDO::PARAM_INT);

//execute 

$cmd->execute(); 

// close the connection 

$conn = NULL; 

header('location:movies.php'); 


ob_flush(); 

?>