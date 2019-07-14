<!DOCTYPE html>
<html>
<head>

	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Welcome to Movie Mania</title>

  <?php include 'components/links.php' ?>

	<link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/login.css">

</head>
<body>
  <!-- including the navbar -->
  <?php include 'components/navbar.php' ?>

  <!-- <? php include 'saveToUsers.php' ?> -->

    <div class="container row container-box">
      <div class="left col-md-8">
        <img src="images/monster-inc.jpg">
      </div>
      <div class="col-md-4" >
        <form class="container" action="saveToUsers.php" method="POST">
          <h2><b>Sign Up</b></h2>
          <?php 
            session_start();
            if(isset($_SESSION['regMsg'])){
          ?>
              <div id="errorMsg" class="alert alert-danger">X Email is already registered!</div>
          <?php
              session_unset();
              session_destroy(); 
            }
          ?>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="username">Username</label>
              <input type="text" class="form-control round" name="username" id="username" placeholder="Username">
            </div>
            <div class="form-group col-md-12">
              <label for="email">Email</label>
              <input type="email" class="form-control round" name="email" id="email" placeholder="Email">
            </div>
            <div class="form-group col-md-12">
              <label for="password">Password</label>
              <input type="password" class="form-control round" name="password" id="password" placeholder="Password">
            </div>
          <div class="form-group col-md-12">
            <label for="contact">Contact no.</label>
            <input type="text" class="form-control round" name="contact" id="contact" placeholder="">
          </div>
         </div>
          <button type="submit" name="submit" class="btn btn-primary round-btn">Sign Up</button>
          <a href="login.php" class="to-right">Log in</a>
        </form>
      </div>
    </div>

  <?php include 'components/footer.php' ?>

</body>
</html>