<?php
include_once 'header.php';
?>
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
          echo "<p class='reviewRating'> Rating: ".$obj->rating."/5\n";
          echo "<p class='reviewContent'>".$obj->content."</p>\n";
          echo "</div>\n";
          echo "</div>\n";
        }
      } else {
        echo "SELECT * FROM `reviews_house` LIMIT 5";
      }
include_once 'footer.php';
?>
