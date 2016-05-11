<!DOCTYPE html>
<html>
<head>
<<<<<<< HEAD
  <link rel="stylesheet" href="css.css" type="text/css"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Index</title>
=======
  <title>Game house start</title>
>>>>>>> c6565a2c94e0374fb65f55ac1c1f175b2b5a0f0c
</head>
<body>
  <div id="header">
  </div>

<<<<<<< HEAD
  <div id="contain">
  </div>
=======
  <a href="login.php">Login</a>
  <h1>Game House</h1>
  <p>Info text</p>
  <a href="bookView.php">book</a>

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
>>>>>>> c6565a2c94e0374fb65f55ac1c1f175b2b5a0f0c

  <div id="footer">
  </div>
</body>
</html>
