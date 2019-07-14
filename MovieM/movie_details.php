<?php 

  session_start();

?>

<!DOCTYPE html>
<html>
<head>

  <title>Welcome to Movie Mania</title>
  <?php include 'components/links.php' ?>

  <link rel="stylesheet" href="css/index.css">

</head>
<body>

  <!-- including the navbar -->
  <?php include 'components/navbar.php' ?>

  <div class="container">

    <!-- Portfolio Item Heading -->
    <div id="movieSingle">

    </div>

    <!-- Related movies Row -->
    <h3 class="my-4 heading">Similar Movies</h3>

    <div id="similarMovies" class="row">

    </div>

  </div>
  
  <?php include 'components/footer.php' ?>

     <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/display.js"></script>
    <script>
      getMovie();
      getSimilarMovies();
    </script>

</body>
</html>