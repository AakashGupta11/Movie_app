<?php  

	if(isset($_POST['submit'])){
		session_start();
		$servername = "localhost";
		$name = "root";
		$pass = "";
		$dbname = "MovieMania";

		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$contact = $_POST['contact'];

		try{
		    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $name, $pass);
		    // set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $sql = "SELECT * FROM Users WHERE email='$email'";
		    $stmt = $conn->prepare($sql);
		    $stmt->execute();
		    $cnt = $stmt->rowCount();
		    if($cnt == 0){
		    	$sql = "INSERT INTO Users (username, email, password, contact)
			    VALUES ('$username', '$email', '$password', '$contact')";
			    // use exec() because no results are returned
			    $conn->exec($sql);
			    $_SESSION['name'] = $username;
			    $_SESSION['email'] = $email;
			    header('location: login.php');
		    }
		    else{
		    	$_SESSION['regMsg'] = 'Unsuccessful';
		    	header('location: registration.php');
		    }
		}
		catch(PDOException $e){
		    echo $e->getMessage();
		}
	}
?>