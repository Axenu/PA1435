<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/Style.css" type="text/css"/>
  <script src="js/jquery.js"></script>
  <?php include_once 'searchView.php';
  getSeachInclude(); ?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Home</title>
</head>
<body>
  <div id="header">
      <div id="LoginField"><a href="loginView.php"><center>Login</a></center></div>
      <a href="index.php"><h2><center>Game House</center></h2></a>
      <div id="SearchField"><center><?php getSearchView(); ?></center></div>
      <div id="BookingField"><a href="bookingView.php"><center>Booking</center></a></div>
  </div>

  <div id="contain">
    <p>Welcome to our game house website. Here you can see what games we have
    avaiable to play at the house and book time at our computers. You can register
    an account for a faster booking experience and for easy access to the games you
    usually play. </p>
    <p>Welcome to our game house website. Here you can see what games we have
    avaiable to play at the house and book time at our computers. You can register
    an account for a faster booking experience and for easy access to the games you
    usually play. </p>
    <p>Welcome to our game house website. Here you can see what games we have
    avaiable to play at the house and book time at our computers. You can register
    an account for a faster booking experience and for easy access to the games you
    usually play. </p>
    <p>Welcome to our game house website. Here you can see what games we have
    avaiable to play at the house and book time at our computers. You can register
    an account for a faster booking experience and for easy access to the games you
    usually play. </p>
    <p>Welcome to our game house website. Here you can see what games we have
    avaiable to play at the house and book time at our computers. You can register
    an account for a faster booking experience and for easy access to the games you
    usually play. </p>

    <?php
      $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
      // if ($mysqli->connect_error) {
      //   echo "Connection failed: " . $conn->connect_error;
      // }
      if (($result = $mysqli->query("SELECT * FROM `reviews_house` LIMIT 5"))) {
        while($obj = $result->fetch_object()) {
          echo "<div id='review'>\n";
          echo "<div class='review'>\n";
          echo "<h3 class='reviewTitle'>".$obj->title."</h3>\n";
          echo "<p class='reviewRating'>".$obj->rating."</p>\n";
          echo "<p class='reviewContent'>".$obj->content."</p>\n";
          echo "</div>\n";
          echo "</div>\n";
        }
      } else {
        echo "SELECT * FROM `reviews_house` LIMIT 5";
      }
    ?>
  </div>

  <div id="footer"><p><center>
    Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>
    Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
  </div>
</body>
</html>
