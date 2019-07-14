<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <img style="width:50px; height: 50px;" src="images/movie_mania.jpg">
      <a class="navbar-brand" href="#">Movie Mania</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchText">
        <button class="btn btn-outline-success my-2 my-sm-0" onClick="searchMovies()" type="button">Search</button>
      </form>
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

  <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="js/display.js"></script>
</body>
</html>