<?php  

	if(isset($_POST['submit'])){
		session_start();
		$servername = "localhost";
		$name = "root";
		$pass = "";
		$dbname = "MovieMania";

		$email = $_POST['email'];
		$password = $_POST['password'];

		try{
		    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $name, $pass);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql = "SELECT * FROM Users WHERE email='$email' AND password='$password'";
		    $stmt = $conn->prepare($sql);
		    $stmt->execute();
		    $cnt = $stmt->rowCount();
		    $row = $stmt->fetch();
		    if($cnt == 1){
		    	$_SESSION['user_id'] = $row['user_id'];
			    header('location: index.php');
		    }
		    else{
		    	$_SESSION['logMsg'] = 'Unsuccessful';
		    	header('location: login.php');
		    }
		}
		catch(PDOException $e){
		    echo $e->getMessage();
		}
	}
?>