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
    echo"    <div id='LoginField'><a href='loginView.php'><center>Login</a></center></div>";
    echo"    <h2><center>Game House</center></h2>";
    echo"    <div id='SearchField'><center><?php getSearchView(); ?></center></div>";
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
    echo"<a href='bookingView.php'>book</a>";
    echo"</div>";

    echo"<div id='footer'>";
    echo"Blekinge Institute of Technology, 2016<br>";
    echo"PA1435, Objektorientad Programmering<br>";
    echo"Alfons Dahl <br>";
    echo"Simon Nilsson<br>";
    echo"Filip Pentikäinen<br>";
    echo"</div>";
  echo"</body>";
  echo"</html>";
} else if (isset($_GET['game'])) {
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
  echo"    <div id='LoginField'><a href='loginView.php'><center>Login</a></center></div>";
  echo"    <h2><center>Game House</center></h2>";
  echo"    <div id='SearchField'><center><?php getSearchView(); ?></center></div>";
  echo"</div>";

  echo"<div id='contain'>";

  $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");

  if ($stmt = $mysqli->prepare("SELECT title, description, picture, rating FROM games WHERE title LIKE ? LIMIT 5")) {
      $query = $_GET['game']."%";
      $stmt->bind_param('s', $query);
      $stmt->execute();
      $stmt->bind_result($title, $desc, $picture, $rating);
      while ($stmt->fetch()) {
          echo "<h2>".$title."</h2>";
          echo "<p>".$desc."</p>";
          echo "<img src='".$picture."'>'";
          echo "<p>Rating: ".$rating."</p>";
      }
  } else {
        echo "SELECT title, description, picture, rating FROM games WHERE title LIKE '".$_GET['game']."%' LIMIT 5";
  }

  echo"<p>Info text</p>";
  echo"<a href='bookingView.php'>book</a>";

  echo"</div>";

  echo"<div id='footer'>";
  echo"Blekinge Institute of Technology, 2016<br>";
  echo"PA1435, Objektorientad Programmering<br>";
  echo"Alfons Dahl <br>";
  echo"Simon Nilsson<br>";
  echo"Filip Pentikäinen<br>";
  echo"</div>";
  echo"</body>";
  echo"</html>";
}

?>
