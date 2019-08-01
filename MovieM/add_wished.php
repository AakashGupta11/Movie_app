<?php  
	
	session_start();
    if(!isset($_SESSION['user_id'])){
      echo "Please login first :(";
    }
    else{
		$str = $_POST['data'];
		$arr = preg_split ("/\,/", $str);

		$movieId = intval($arr[0]);
		$imdbId = $arr[1];
		$runtime = intval($arr[2]);
		$poster = $arr[3];
		$title = addslashes($_POST['title']);
		$overview = addslashes($_POST['overview']);
		$user_id = $_SESSION['user_id'];

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "MovieMania";
		try{
		    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql = "SELECT * FROM WishedList WHERE movie_id='$movieId' AND user_id='$user_id'";
		    $stmt = $conn->prepare($sql);
		    $stmt->execute();
		    $cnt = $stmt->rowCount();
		    if($cnt == 0){
		    	$sql = "INSERT INTO WishedList (user_id, movie_id, imdb_id, runtime, poster_path, title, overview)
			    VALUES ('$user_id', '$movieId', '$imdbId', '$runtime', '$poster', '$title', '$overview')";
			    // use exec() because no results are returned
			    $conn->exec($sql);
			    echo "New record created successfully";
		    }
			else
		    	echo "Record already existed";
		}
		catch(PDOException $e){
		    echo $e->getMessage();
		}
	}

?>