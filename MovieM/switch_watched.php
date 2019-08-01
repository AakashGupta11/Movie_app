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

	    //fetching data from WishedList
	    $stmt = $conn->prepare("SELECT * FROM WishedList WHERE user_id='$user_id' AND movie_id='$movieId'");
	    $stmt->execute();
	    $row = $stmt->fetch();

	    $movieId = $row['movie_id'];
		$imdbId = $row['imdb_id'];
		$runtime = $row['runtime'];
		$poster = $row['poster_path'];
		$title = $row['title'];
		$overview = $row['overview'];

		//Adding movie to WatchedList
		$sql = "SELECT * FROM WatchedList WHERE movie_id='$movieId' AND user_id='$user_id'";
	    $stmt = $conn->prepare($sql);
	    $stmt->execute();
	    $cnt = $stmt->rowCount();
	    if($cnt == 0){
	    	$sql = "INSERT INTO WatchedList (user_id, movie_id, imdb_id, runtime, poster_path, title, overview)
		    VALUES ('$user_id', '$movieId', '$imdbId', '$runtime', '$poster', '$title', '$overview')";
		    // use exec() because no results are returned
		    $conn->exec($sql);
		    echo "Movie Switched to Watched :)";
	    }
	    else
	    	echo "Record already existed";

	    //Deleting movie from WishedList
	    $sql = "DELETE FROM WishedList WHERE user_id=:user_id AND movie_id=:movieId";
	    // use exec() because no results are returned
	    $stmt = $conn->prepare($sql);
	    $stmt->bindValue(':movieId', $movieId);
	    $stmt->bindValue(':user_id', $user_id);
	    $stmt->execute();
	}
	catch(PDOException $e){
	    echo $e->getMessage();
	}

?>