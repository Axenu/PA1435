<?php
function getSeachInclude() {
  echo '<script type="text/JavaScript" src="js/searchModel.js"></script>';
}

function getSearchView() {
  echo "<input class='searchBar' type='text' name='search' placeholder='Search' onkeyup='searchStringChnged(event)'>";
  echo "<div class='searchResulContainer'> </div>";
}

if (isset($_GET['query'])) {
  //display results
    echo "<!DOCTYPE html>";
    echo "<html>";
    echo "<head>";
    echo "<link rel='stylesheet' href='css/Style.css' type='text/css'/>";
    echo "<script src='js/jquery.js'></script>";
    echo "<?php include_once 'searchView.php';";
    echo "getSeachInclude(); ?>";
    echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
    echo "<title>Game house Lannister</title>";
    echo"</head>";
    echo"<body>";
    echo"<div id='header'>";
    echo"<div id='LoginField'><a href='LoginView.php'><center>Login</a></center></div>";
    echo"<a href='index.php'><div id='logo'></div></a>";
    echo"<div id='SearchField'><center><?php getSearchView(); ?></center></div>";
    echo"<div id='BookingField'><a href='bookingView.php'><center>Booking</center></a></div>";
    echo"</div>";

    echo"<div id='contain'>";

    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");

    if ($stmt = $mysqli->prepare("SELECT title, picture FROM games WHERE title LIKE ? LIMIT 5")) {
        $query = $_GET['query']."%";
        $stmt->bind_param('s', $query);
        $stmt->execute();
        $stmt->bind_result($title, $picture);
        while ($stmt->fetch()) {
            echo "<div class='gameSmall'>".$picture.", ".$title."</div>";
        }
    } else {
          echo "SELECT title, picture FROM games WHERE title LIKE '".$_GET['query']."%' LIMIT 5";
    }
    echo"<p>Info text</p>";
    echo"</div>";

    echo"<div id='footer'><p><center>";
    echo"Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>   Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>";
    echo"</div>";
    echo"</body>";
    echo"</html>";
} else if (isset($_GET['gameS'])) {
  //display game page
  echo "<!DOCTYPE html>";
  echo "<html>";
  echo "<head>";
  echo "<link rel='stylesheet' href='css/Style.css' type='text/css'/>";
  echo "<script src='js/jquery.js'></script>";
  echo "<?php include_once 'searchView.php';";
  echo "getSeachInclude(); ?>";
  echo "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>";
  echo "<title>Game house</title>";
  echo"</head>";
  echo"<body>";
  echo"<div id='header'>";
  echo"<div id='LoginField'><a href='LoginView.php'><center>Login</a></center></div>";
  echo"<a href='index.php'><div id='logo'></div></a>";
  echo"<div id='SearchField'><center><?php getSearchView(); ?></center></div>";
  echo"<div id='BookingField'><a href='bookingView.php'><center>Booking</center></a></div>";
  echo"</div>";

  echo"<div id='contain'>";

  $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");

  if ($stmt = $mysqli->prepare("SELECT title, description, picture, rating FROM games WHERE title LIKE ? LIMIT 5")) {
      $query = $_GET['game']."%";
      $stmt->bind_param('s', $query);
      $stmt->execute();
      $stmt->bind_result($title, $desc, $picture, $rating);
      while ($stmt->fetch()) {
          echo "<h1>".$title."</h1>";
          echo "<img src='".$picture."'>";
          echo "<div id='gamedesc'><p>".$desc."</p></div>";
          echo "<div id='gamedescrating'><p>Rating: ".$rating."</p></div>";
      }
  } else {
        echo "SELECT title, description, picture, rating FROM games WHERE title LIKE '".$_GET['game']."%' LIMIT 5";
  }

  echo"<div id='gamedescinfo'><p>Info text</p></div>";

  echo"</div>";

  echo"<div id='footer'><p><center>";
  echo"Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>   Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>";
  echo"</div>";
  echo"</body>";
  echo"</html>";
}

?>
