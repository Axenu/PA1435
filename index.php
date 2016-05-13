<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/Style.css" type="text/css"/>
  <script src="js/jquery.js"></script>
  <?php include_once 'searchView.php';
  getSeachInclude(); ?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Index</title>
  <title>Game house start</title>
</head>
<body>
  <div id="header">
      <div id="LoginField"><a href="loginView.php"><center>Login</a></center></div>
      <h2><center>Game House</center></h2>
      <div id="SearchField"><center><?php getSearchView(); ?></center></div>
  </div>

  <div id="contain">
  </div>

  <p>Info text</p>
  <a href="bookingView.php">book</a>

  <?php
    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
    // if ($mysqli->connect_error) {
    //   echo "Connection failed: " . $conn->connect_error;
    // }
    if (($result = $mysqli->query("SELECT * FROM `reviews_house` LIMIT 5"))) {
      while($obj = $result->fetch_object()) {
        echo "<div class='review'>\n";
        echo "<h3 class='reviewTitle'>".$obj->title."</h3>\n";
        echo "<p class='reviewRating'>".$obj->rating."</p>\n";
        echo "<p class='reviewContent'>".$obj->content."</p>\n";
        echo "</div>\n";
      }
    } else {
      echo "SELECT * FROM `reviews_house` LIMIT 5";
    }
  ?>

  <div id="footer">
    Blekinge Institute of Technology, 2016<br>
    PA1435, Objektorientad Programmering<br>
    Alfons Dahl <br>
    Simon Nilsson<br>
    Filip Pentikäinen<br>
  </div>
</body>
</html>
