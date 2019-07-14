//function to know whether movie has been released or not
function isReleased(date){
  var today = new Date();
  var t = new Date(today.getFullYear()+','+(today.getMonth()+1)+','+today.getDate());
  var r = new Date(date);
  return t > r;
}

//function to convert minutes into days, hours and minutes
function getWatchedTime(time){
  s = '';
  if(Math.floor((time/60)/24) > 0)
      s += Math.floor((time/60)/24) + " Days ";
  if(Math.floor((time/60)%24) > 0)
      s += Math.floor((time/60)%24) + " Hrs ";
  if(time%60 > 0)
      s += time%60 + " Mins";
  return s;
}

// function to display all the upcoming movies
function getUpcoming(){
  axios.get('https://api.themoviedb.org/3/movie/upcoming?api_key=7719d9fc54bec69adbe2d6cee6d93a0d&language=en-US&page=1')
  .then((response) => {
    console.log(response);
    let movies = response.data.results;
    let output = '';
    $.each(movies, (index, movie) => {
      if(movie.poster_path != null){
        output += `
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-100">
            <img class="card-img-top img-height" src="https://image.tmdb.org/t/p/original${movie.poster_path}" alt="" onClick="getMovieId(${movie.id})">
            <div class="card-footer"> `+
              (isReleased(movie.release_date) ? `<a href="#" onClick="addMovie(${movie.id}, ${1})" class="btn btn-primary btn-sm" style="float:left">+ Watched</a>  
                <a href="#" onClick="addMovie(${movie.id}, ${0})" class="btn btn-primary btn-sm" style="float:right">+ Wished</a>` : 
                `<a href="#" onClick="addMovie(${movie.id}, ${0})" class="btn btn-primary btn-sm">+ Wished</a>`)
              +`
            </div>
          </div>
        </div>
      </div>
        `
      }
    });
    $('#upcoming').html(output);
  })
  .catch((err) => {
    console.log(err.message);
  });
}

// function to display all the popular movies
function getTopRated(){
  axios.get('https://api.themoviedb.org/3/movie/top_rated?api_key=7719d9fc54bec69adbe2d6cee6d93a0d&language=en-US&page=1')
  .then((response) => {
    console.log(response);
    let movies = response.data.results;
    let output = '';
    $.each(movies, (index, movie) => {
      if(movie.poster_path != null){
        output += `
        <div class="col-lg-3 col-md-6 mb-4">
          <div class="card h-100">
            <img class="card-img-top img-height" src="https://image.tmdb.org/t/p/original${movie.poster_path}" alt="" onClick="getMovieId(${movie.id})">
            <div class="card-footer">
              <a href="#" onClick="addMovie(${movie.id}, ${1})" class="btn btn-primary btn-sm" style="float:left">+ Watched</a>
              <a href="#" onClick="addMovie(${movie.id}, ${0})" class="btn btn-primary btn-sm" style="float:right">+ Wished</a>
            </div>
          </div>
        </div>
      </div>
        `
      }
    });
    $('#top-rated').html(output);
  })
  .catch((err) => {
    console.log(err.message);
  });
}

//function which get called when any movie is searched
function searchMovies(){
  let searchText = $('#searchText').val();
  sessionStorage.setItem('searchText', searchText);
  window.location.href = 'show_movies.php';
  return false;
}

//function which get called to display all the movie list according to search text
function getMovies(){
  searchText = sessionStorage.getItem('searchText');
  axios.get('https://api.themoviedb.org/3/search/movie?api_key=7719d9fc54bec69adbe2d6cee6d93a0d&query='+searchText)
  .then((response) => {
    console.log(response);
    let movies = response.data.results;
    let output = '';
    if(movies.length != 0){
      output = '<h2 class="heading">Your Movies!!</h2>';
      $('#head').html(output);
      output = '';
      $.each(movies, (index, movie) => {
        if(movie.poster_path != null){
          output += `
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
              <img class="card-img-top img-height" src="https://image.tmdb.org/t/p/original${movie.poster_path}" alt="" onClick="getMovieId(${movie.id})">
              <div class="card-footer">`+
              (isReleased(movie.release_date) ? `<a href="#" onClick="addMovie(${movie.id}, ${1})" class="btn btn-primary btn-sm" style="float:left">+ Watched</a>  
                <a href="#" onClick="addMovie(${movie.id}, ${0})" class="btn btn-primary btn-sm" style="float:right">+ Wished</a>` : 
                `<a href="#" onClick="addMovie(${movie.id}, ${0})" class="btn btn-primary btn-sm">+ Wished</a>`)
              +`
              </div>
            </div>
          </div>
          `
        }
      });
    }
    else
      output += '<h2 class="heading">No movies Found :(</h2>';
    $('#searchedMovies').html(output);
  })
  .catch((err) => {
    console.log(err.message);
  });
}

//function to store movieID and redirect to movie.php page
function getMovieId(movieId){
  sessionStorage.setItem('movieId', movieId);
  window.location.href = 'movie_details.php';
  return false;
}

//function to display all the details of a movie
// function getMovie(){
//   movieId = sessionStorage.getItem('movieId');
//   axios.get('https://api.themoviedb.org/3/movie/'+movieId+'?api_key=7719d9fc54bec69adbe2d6cee6d93a0d&language=en-US')
//   .then((response) => {
//     imdbId = response.data.imdb_id;
//     axios.get('http://www.omdbapi.com?apikey=c1c12a90&i='+imdbId)
//     .then((response1) => {
//       console.log(response1);
//       let movie = response1.data;
//       let output = '';
//       const dict = {
//         'Jan': 1,
//         'Feb': 2,
//         'Mar': 3,
//         'Apr': 4,
//         'May': 5,
//         'Jun': 6,
//         'Jul': 7,
//         'Aug': 8,
//         'Sep': 9,
//         'Oct': 10,
//         'Nov': 11,
//         'Dec': 12
//       };
//       var arr = movie.Released.split(" ");
//       var today = new Date();
//       var t = new Date(today.getFullYear()+','+(today.getMonth()+1)+','+today.getDay());
//       var r = new Date(arr[2]+','+dict[arr[1]]+','+arr[0]);
//       if(movie.Poster != null){
//           output += `
//           <h1 class="my-4 heading">${movie.Title}</h1>

//           <div class="row">

//             <div class="col-md-5">
//               <img style="" class="img-fluid" src="${movie.Poster}" alt="">
//             </div>

//             <div class="col-md-7">
//               <ul class="list-group">
//                 <li class="list-group-item"><strong>Genre: </strong>${movie.Genre}</li>
//                 <li class="list-group-item"><strong>Released: </strong>${movie.Released}</li>
//                 <li class="list-group-item"><strong>Rated: </strong>${movie.Rated}</li>
//                 <li class="list-group-item"><strong>IMDB Rating: </strong>${movie.imdbRating}</li>
//                 <li class="list-group-item"><strong>Director: </strong>${movie.Director}</li>
//                 <li class="list-group-item"><strong>Writer: </strong>${movie.Writer}</li>
//                 <li class="list-group-item"><strong>Actors: </strong>${movie.Actors}</li>
//               </ul>
//               <li class="list-group-item"><strong>Overview: </strong>${movie.Plot}</li>
//               <a href="http://imdb.com/title/${movie.imdbID}" target="blank" class="btn btn-primary">View IMDB</a> `+
//               (t > r ? `<a href="" onClick="addMovie(${movieId}, ${1})" class="btn btn-primary">Add to Watched</a> ` : ``)
//               +`
//               <a href="" onClick="addMovie(${movieId}, ${0})" class="btn btn-primary">Add to Wished</a>
//             </div>

//           </div>
//           `
//         }
//       $('#movieSingle').html(output);
//     })
//     .catch((err) => {
//       console.log(err.message);
//     });
//   })
//   .catch((err) => {
//     console.log(err.message);
//   });
// }


function getMovie(){
  movieId = sessionStorage.getItem('movieId');
  axios.get('https://api.themoviedb.org/3/movie/'+movieId+'?api_key=7719d9fc54bec69adbe2d6cee6d93a0d&language=en-US')
  .then((response) => {
    imdbId = response.data.imdb_id;
    axios.get('http://www.omdbapi.com?apikey=c1c12a90&i='+imdbId)
    .then((response1) => {
      console.log(response1);
      let movie = response1.data;
      let output = '';
      const dict = {
        'Jan': 1,
        'Feb': 2,
        'Mar': 3,
        'Apr': 4,
        'May': 5,
        'Jun': 6,
        'Jul': 7,
        'Aug': 8,
        'Sep': 9,
        'Oct': 10,
        'Nov': 11,
        'Dec': 12
      };
      var arr = movie.Released.split(" ");
      var today = new Date();
      var t = new Date(today.getFullYear()+','+(today.getMonth()+1)+','+today.getDay());
      var r = new Date(arr[2]+','+dict[arr[1]]+','+arr[0]);
      if(movie.Poster != null){
          output += `
          <h1 class="my-4 heading">${movie.Title}</h1>

          <div class="row">

            <div class="col-md-5">
              <img style="" class="img-fluid" src="${movie.Poster}" alt="">
            </div>

            <div class="col-md-7">
              <ul class="list-group">
                <li class="list-group-item"><strong>Genre: </strong>${movie.Genre}</li>
                <li class="list-group-item"><strong>Released: </strong>${movie.Released}</li>
                <li class="list-group-item"><strong>Rated: </strong>${movie.Rated}</li>
                <li class="list-group-item"><strong>IMDB Rating: </strong>${movie.imdbRating}</li>
                <li class="list-group-item"><strong>Director: </strong>${movie.Director}</li>
                <li class="list-group-item"><strong>Writer: </strong>${movie.Writer}</li>
                <li class="list-group-item"><strong>Actors: </strong>${movie.Actors}</li>
              </ul>
              <li class="list-group-item"><strong>Overview: </strong>${movie.Plot}</li>
              <a href="http://imdb.com/title/${movie.imdbID}" target="blank" class="btn btn-primary">View IMDB</a> 
              <a href="" onClick="addMovie(${movieId}, ${1})" class="btn btn-primary">Add to Watched</a> 
              <a href="" onClick="addMovie(${movieId}, ${0})" class="btn btn-primary">Add to Wished</a>
            </div>

          </div>
          `
        }
      $('#movieSingle').html(output);
    })
    .catch((err) => {
      console.log(err.message);
    });
  })
  .catch((err) => {
    console.log(err.message);
  });
}

//function to display similar movies
function getSimilarMovies(){
  movieId = sessionStorage.getItem('movieId');
  axios.get('https://api.themoviedb.org/3/movie/'+movieId+'/recommendations?api_key=7719d9fc54bec69adbe2d6cee6d93a0d&language=en-US&page=1')
  .then((response) => {
    console.log(response);
    let movies = response.data.results;
    let output = '';
    let len = movies.length > 4 ? 4 : movies.length;
    if(movies.length > 0){
      for(i = 0 ; i < len ; i++){
        movie = movies[i];
        if(movie.poster_path != null){
          output += `
          <div class="col-lg-3 col-md-6 mb-4">
            <div class="card h-100">
              <img class="card-img-top img-height" src="https://image.tmdb.org/t/p/original${movie.poster_path}" alt="" onClick="getMovieId(${movie.id})">
              <div class="card-footer">
                <a href="#" onClick="addMovie(${movie.id}, ${1})" class="btn btn-primary btn-sm" style="float:left">+ Watched</a>
                <a href="#" onClick="addMovie(${movie.id}, ${0})" class="btn btn-primary btn-sm" style="float:right">+ Wished</a>
              </div>
            </div>
          </div>
          `
        }
      }
    }
    else
      output += '<h4 class="heading">No Similar Movies Found :(</h4>'
    $('#similarMovies').html(output);
  })
  .catch((err) => {
    console.log(err.message);
  });
}

//function to display all the watched movies
function showWatched(){
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function() {
    if (this.readyState == 4 && this.status == 200) {
      data = JSON.parse(this.responseText);
        console.log(data);
        len = parseInt(data[0]);
        runtime = getWatchedTime(parseInt(data[1]));
        console.log(runtime);
        output = '';
        i = 2;
        if(len > 0){
          output += `Movies you have Watched!!<br /> Time Spend: ${runtime}`;
          $('#head').html(output);
          output = '';
          while(len--){
            poster = data[i++];
            id = data[i++];
            title = data[i++];
            overview = data[i++];
            output += `
              <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card h-100">
                  <img class="card-img-top img-height" src="https://image.tmdb.org/t/p/original${poster}" alt="" onClick="getMovieId(${id})">
                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="#">${title}</a>
                    </h4>
                    <p class="card-text">${overview}</p>
                    <a href="#" onClick="removeWatched(${id})" class="btn btn-primary">Remove Watched</a>
                  </div>
                </div>
              </div>
            `
          }
        }
        else{
          output += `
            <h1 class="my-4">You don't have watched any Movies :(</h1>
          `
        }
        $('#showWatched').html(output);
    }
  };
  xmlhttp.open("GET","retrieve_watched.php", false);
  xmlhttp.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
  xmlhttp.send();
}

//function to display all movies in wish list
function showWished(){
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onload = function() {
    if (this.readyState == 4 && this.status == 200) {
      data = JSON.parse(this.responseText);
        // $('#showWatched').html(data[1]);
        console.log(data);
        len = parseInt(data[0]);
        output = '';
        i = 2;
        runtime = 0
        if(len > 0){
          output += `Movies in your Wish list!!`;
          $('#head').html(output);
          output = '';
          while(len--){
            poster = data[i++];
            id = data[i++];
            title = data[i++];
            overview = data[i++];
            output += `
              <div class="col-lg-4 col-sm-6 mb-4">
                <div class="card h-100">
                  <img class="card-img-top img-height" src="https://image.tmdb.org/t/p/original${poster}" alt="" onClick="getMovieId(${id})">
                  <div class="card-body">
                    <h4 class="card-title">
                      <a href="#">${title}</a>
                    </h4>
                    <p class="card-text">${overview}</p>
                    <a href="#" onClick="removeWished(${id})" class="btn btn-primary btn-sm" style="float:left;">Remove Watched</a>
                    <a href="#" onClick="switchWatched(${id})" class="btn btn-primary btn-sm" style="float:right;">Switch Watched</a>
                  </div>
                </div>
              </div>
            `
          }
        }
        else{
          output += `
            <h1 class="my-4">You don't have movies in Wish list :(</h1>
          `
        }
        $('#showWished').html(output);
    }
  };
  xmlhttp.open("GET","retrieve_wished.php", false);
  xmlhttp.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
  xmlhttp.send();
}

// function to add movie to DB
function addMovie(movieId, w){
  sessionStorage.setItem('movieId', movieId);
  if(w == 1)
    addToWatched();
  else
    addToWished();
}

//function to add movie to watched list
function addToWatched(){
    movieId = sessionStorage.getItem('movieId');
    axios.get('https://api.themoviedb.org/3/movie/'+movieId+'?api_key=7719d9fc54bec69adbe2d6cee6d93a0d&language=en-US')
    .then((response) => {
      movie = response.data;
      arr = [movie.id, movie.imdb_id, movie.runtime, movie.poster_path];
      xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
            }
        };
        xmlhttp.open("POST","add_watched.php", false);
        xmlhttp.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
        xmlhttp.send('data='+arr+'&title='+movie.title+'&overview='+movie.overview);
    })
    .catch((err) => {
      console.log(err.message);
    });
}

//function to add movie to wish list
function addToWished(){
    movieId = sessionStorage.getItem('movieId');
    axios.get('https://api.themoviedb.org/3/movie/'+movieId+'?api_key=7719d9fc54bec69adbe2d6cee6d93a0d&language=en-US')
    .then((response) => {
      movie = response.data;
      arr = [movie.id, movie.imdb_id, movie.runtime, movie.poster_path];
      xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
            }
        };
        xmlhttp.open("POST","add_wished.php", false);
        xmlhttp.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
        xmlhttp.send('data='+arr+'&title='+movie.title+'&overview='+movie.overview);
    })
    .catch((err) => {
      console.log(err.message);
    });
}

//function to remove movies from watch list
function removeWatched($id){
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          alert(this.responseText);
          document.location.reload()
      }
  };
  xmlhttp.open("GET","remove_watched.php?id="+$id, false);
  xmlhttp.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
  xmlhttp.send();
}

//function to remove movies from wished
function removeWished($id){
  xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          alert(this.responseText);
          document.location.reload()
      }
  };
  xmlhttp.open("GET","remove_wished.php?id="+$id, false);
  xmlhttp.setRequestHeader( "Content-Type", "application/x-www-form-urlencoded" );
  xmlhttp.send();
}

//function to swich movies from wish list to watch list
function switchWatched($id){
  addMovie($id, 1);
  removeWished($id);
}