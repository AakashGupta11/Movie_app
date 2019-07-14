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

    <div class="container row container-box">
      <div class="left col-md-8">
        <img src="images/minions.jpg">
      </div>
      <div class="login-div col-md-4" >
        <form action="loginDB.php" method="POST">
          <h2><b>Login</b></h2>
          <?php 
            session_start();
            if(isset($_SESSION['logMsg'])){
          ?>
              <div id="errorMsg" class="alert alert-danger">X Email or Password is incorrect!</div>
          <?php
              unset($_SESSION['logMsg']);
            }
          ?>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="email">Email</label>
              <input type="email" class="form-control round" name="email" id="email" value="<?php if(isset($_SESSION['email'])){ echo $_SESSION['email']; } else echo ''?>" placeholder="Email">
            </div>
            <div class="form-group col-md-12">
              <label for="password">Password</label>
              <input type="password" class="form-control round" name="password" id="password" placeholder="Password">
            </div>
          </div>
          <button type="submit" name="submit" class="btn btn-primary round-btn">Sign in</button>
          <a href="registration.php" class="to-right">Sign Up</a>
        </form>
      </div>
    </div>

  <?php include 'components/footer.php' ?>

</body>
</html>