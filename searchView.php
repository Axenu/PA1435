<?php
function getSeachInclude() {
  echo '<script type="text/JavaScript" src="js/searchModel.js"></script>';
}

function getSearchView() {
  echo "<input class='searchBar' type='text' name='search' placeholder='Search' onkeyup='searchStringChnged(event)'>";
  echo "<div class='searchResulContainer'> </div>";
}

if (isset($_GET['query'])) {

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
      <?php
      if (login_check($mysqli) == true) {
          ?><a href='userView.php'><?php echo htmlentities($_SESSION['username']); ?></a><a href='phpModel/logout.php'>logg out</a><?php
      } else {
          ?><a href="loginView.php"><center>Login</a><?php
      }

       ?>
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
            echo "<div class='gameSmall'>".$picture.", ".$title."</div>";
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
      <?php
      if (login_check($mysqli) == true) {
          ?><a href='userView.php'><?php echo htmlentities($_SESSION['username']); ?></a><a href='phpModel/logout.php'>logg out</a><?php
      } else {
          ?><a href="loginView.php"><center>Login</a><?php
      }

       ?>
      <!-- <div id="LoginField"><a href="loginView.php"><center>Login</a></center></div> -->
      <a href="index.php"><div id="logo"></div></a>
      <div id="SearchField"><center><?php getSearchView(); ?></center></div>
      <div id="BookingField"><a href="bookingView.php"><center>Booking</center></a></div>
  </div>

  <div id="contain">
<?php

  $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");

  if ($stmt = $mysqli->prepare("SELECT game_id, description, picture, rating FROM games WHERE title LIKE ? LIMIT 5")) {
      $title = $_GET['gameS'];
      $stmt->bind_param('s', $title);
      $stmt->execute();
      $stmt->bind_result($game_id, $desc, $picture, $rating);
      while ($stmt->fetch()) {
          echo "<h1>".$title."</h1>";
          echo "<img src='".$picture."'>";
          echo "<div id='gamedesc'><p>".$desc."</p></div>";
          echo "<div id='gamedescrating'><p>Rating: ".$rating."</p></div>";
      }
  } else {
      echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
        // echo "SELECT title, description, picture, rating FROM games WHERE title LIKE '".$_GET['game']."%' LIMIT 5";
  }
  $stmt->close();
  if ($stmt = $mysqli->prepare("SELECT title, content, rating FROM reviews_game WHERE game_id=? LIMIT 5")) {
      $stmt->bind_param('i', $game_id);
      $stmt->execute();
      $stmt->bind_result($r_title, $r_desc, $r_rating);
      while ($stmt->fetch()) {
          echo "<div class='review'>\n";
          echo "<h3 class='reviewTitle'>".$r_title."</h3>\n";
          echo "<p class='reviewRating'>".$r_rating."</p>\n";
          echo "<p class='reviewContent'>".$r_desc."</p>\n";
          echo "</div>\n";
      }
  } else {
        echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
  }

  ?>

    <form action="phpModel/writeReview.php" method="post" name="login_form">
        <h3>Write Review</h3>
        <p>Title: </p>
        <input type="text" name="title" placeholder="Title" autocomplete="title" id="title"/>
        <p>Content: </p>
        <input type="text" name="content" id="content" placeholder="Content" autocomplete="content"/>
        <p>Rating (0-5): </p>
        <input type="text" name="rating" id="rating" placeholder="Rating" autocomplete="rating"/>
        <input type='hidden' name='game_id' value='<?php echo $game_id; ?>'/>
        <input type='hidden' name='game_title' value='<?php echo $title; ?>'/>
        <input type='hidden' name='user_id' value='
        <?php if (login_check($mysqli) == true) { echo $_SESSION['user_id']; } else {echo '-1';}?>
        '/>
        <input type="submit" value="Login" class="submit"/>
    </form>

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
