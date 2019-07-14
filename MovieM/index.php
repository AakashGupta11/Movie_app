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
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <img style="width:50px; height: 50px;" src="images/movie_mania.jpg">
      <a class="navbar-brand" href="#">Movie Mania</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="watched_list.php">Watched List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="wished_list.php">Wished List</a>
          </li>
          <?php
          session_start();
            if(isset($_SESSION['user_id'])){
              ?>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
              </li>
              <?php
            }
            else{
              ?>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Log In</a>
              </li>
              <?php
            }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="contact_us.php">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- <div id="message"></div> -->

  <!-- Jumbotron Header -->
    <header class="jumbotron my-4 custom-jumbo">
      <h1 class="display-3 disp-custom">Search for the Movie</h1>
      <!-- Search form -->
      <form id="searchForm">
        <div class="active-cyan-4 mb-4">
          <input id="searchText" class="form-control" type="text" placeholder="Search" aria-label="Search"><br />
          <a href="#" onClick="searchMovies()" class="btn btn-primary btn-lg btn-custom">Search</a>
        </div>
      </form>
    </header>

    <div class="container">

      <h2 class="heading">Upcoming Movies</h2>
      <div id="upcoming" class="row text-center">

	    </div>

      <h2 class="heading">Popular Movies</h2>
      <div id="top-rated" class="row text-center">

	    </div>
    </div>

    <?php include 'components/footer.php' ?>

     <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
	  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/display.js"></script>
    <script>
    	getUpcoming();
    	getTopRated();
    </script>

</body>
</html>