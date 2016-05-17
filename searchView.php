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

  include_once 'phpModel/functions.php';
  sec_session_start();
  $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
  ?>

  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="UTF-8">
    <link rel="stylesheet" href="css/Style.css" type="text/css"/>
    <script src="js/jquery.js"></script>
    <script src="js/forms.js"></script>
    <script src="js/sha512.js"></script>
    <?php include_once 'searchView.php';
    getSeachInclude(); ?>
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <title>Home</title>
  </head>
  <body>
    <div id="header">
        <div id="LoginField">
          <?php
          if (login_check($mysqli) == true) {
            ?><a href='userView.php'><?php echo htmlentities($_SESSION['username']); ?></a><a href='phpModel/logout.php'>logg out</a><?php
          } else {
            ?><a href="loginView.php"><center>Login</a><?php
          }
          ?>
        </div>
        <!-- <div id="LoginField"><a href="loginView.php"><center>Login</a></center></div> -->
        <a href="index.php"><div id="logo"></div></a>
        <div id="SearchField"><center><?php getSearchView(); ?></center></div>
        <div id="BookingField"><a href="bookingView.php"><center>Booking</center></a></div>
    </div>

    <div id="contain">
        <?php

    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");

    if ($stmt = $mysqli->prepare("SELECT title, picture FROM games WHERE title LIKE ? LIMIT 5")) {
        $query = $_GET['query']."%";
        $stmt->bind_param('s', $query);
        $stmt->execute();
        $stmt->bind_result($title, $picture);
        while ($stmt->fetch()) {
            echo "<div onclick='SelectGame(this)' class='gameSmall'><h3>".$title."</h3><img src='".$picture."'></div>";
        }
    } else {
          echo "SELECT title, picture FROM games WHERE title LIKE '".$_GET['query']."%' LIMIT 5";
    }

    ?>

    </div>

    <div id="footer"><p><center>
    Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>
    Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
    </div>
    </body>
    </html>
    <?php

} else if (isset($_GET['gameS'])) {
  //display game page

  include_once 'phpModel/functions.php';
  sec_session_start();
  $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
  ?>

  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="UTF-8">
    <link rel="stylesheet" href="css/Style.css" type="text/css"/>
    <script src="js/jquery.js"></script>
    <script src="js/forms.js"></script>
    <script src="js/sha512.js"></script>
    <?php include_once 'searchView.php';
    getSeachInclude(); ?>
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
    <title>Home</title>
  </head>
  <body>
    <div id="header">
        <div id="LoginField">
          <?php
          if (login_check($mysqli) == true) {
            ?><a href='userView.php'><?php echo htmlentities($_SESSION['username']); ?></a><a href='phpModel/logout.php'>logg out</a><?php
          } else {
            ?><a href="loginView.php"><center>Login</a><?php
          }
          ?>
        </div>
        <!-- <div id="LoginField"><a href="loginView.php"><center>Login</a></center></div> -->
        <a href="index.php"><div id="logo"></div></a>
        <div id="SearchField"><center><?php getSearchView(); ?></center></div>
        <div id="BookingField"><a href="bookingView.php"><center>Booking</center></a></div>
    </div>

    <div id="contain">
        <?php

  $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");

  if ($stmt = $mysqli->prepare("SELECT title, description, picture, rating FROM games WHERE title LIKE ? LIMIT 5")) {
      $query = $_GET['gameS'];
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

  ?>

  </div>

  <div id="footer"><p><center>
  Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>
  Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
  </div>
  </body>
  </html>
  <?php
}

?>
