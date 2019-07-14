<?php 

  session_start();

?>

<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Welcome to Movie Mania</title>

  <?php include 'components/links.php' ?>

	<link rel="stylesheet" href="css/index.css">

</head>
<body>
  <!-- including the navbar -->
  <?php include 'components/navbar.php' ?>

    <div class="container">
      <br />
      <h2 class="heading" id="head"></h2>
      <div id="searchedMovies" class="row text-center">

	    </div>

    </div>

  <?php include 'components/footer.php' ?>

     <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/display.js"></script>
    <script>
    	getMovies();
    </script>

</body>
</html>