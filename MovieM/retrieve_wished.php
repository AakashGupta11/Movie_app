<?php  
	
	session_start();
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "MovieMania";
	$user_id = $_SESSION['user_id'];
	// try{
	//     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//     $stmt = $conn->prepare("SELECT * FROM WatchedList WHERE user_id=:id");
	//     $stmt->execute(array(':id' => 1));
	//     $arr = array();
	//     $cnt = 0
	//     $result = $stmt->fetchAll();
	//     foreach($result as $row){
	//     	$cnt++;
	//     	array_push($arr, $row['movie_id']);
	//     	array_push($arr, $row['imdb_id']);
	//     	array_push($arr, $row['poster_path']);
	//     	array_push($arr, $row['title']);
	//     	array_push($arr, $row['overview']);
	    		
	//     }
	//     array_unshift($arr, $cnt);
	//     echo json_encode($arr, JSON_FORCE_OBJECT);
	// }
	// catch(PDOException $e){
	//     echo $e->getMessage();
	// }

	$con = mysqli_connect($servername,$username,$password, $dbname);
	if(!$con){
		die("not connected to mysql".mysqli_connect_error());
	}
	$query = "SELECT * FROM WishedList WHERE user_id=".$user_id;
	$result = mysqli_query($con, $query);
	$arr = array();
	$cnt = 0;
	$runtime = 0;
	while($row = $result->fetch_assoc()){
		$cnt++;
		$runtime += $row['runtime'];
		array_push($arr, $row['poster_path']);
		array_push($arr, $row['movie_id']);
    	array_push($arr, $row['title']);
    	array_push($arr, $row['overview']);
	}
	array_unshift($arr, $runtime);
	array_unshift($arr, $cnt);
	echo json_encode($arr, JSON_FORCE_OBJECT);
?>