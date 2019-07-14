<?php  
	
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "MovieMania";
	$movieId = $_GET['id'];
	$user_id = $_SESSION['user_id'];

	try{
	    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "DELETE FROM WishedList WHERE user_id=:user_id AND movie_id=:movieId";
	    // use exec() because no results are returned
	    $stmt = $conn->prepare($sql);
	    $stmt->bindValue(':movieId', $movieId);
	    $stmt->bindValue(':user_id', $user_id);
	    $stmt->execute();
	    echo "Movie deleted successfully";
	}
	catch(PDOException $e){
	    echo $e->getMessage();
	}

?>