<?php 

  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: login.php');
  }

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

  <!-- Page Content -->
  <div class="container">
    <br />
    <h2 id="head" class="heading"></h2>
    <div class="row" id="showWished">
    
    </div>
    

  </div>
  
  <?php include 'components/footer.php' ?>

     <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/display.js"></script>
    <script>
      showWished();
    </script>

</body>
</html>