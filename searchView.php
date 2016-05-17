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

  include_once 'header.php';

    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");

    if ($stmt = $mysqli->prepare("SELECT title, picture FROM games WHERE title LIKE ? LIMIT 5")) {
        $query = $_GET['query']."%";
        $stmt->bind_param('s', $query);
        $stmt->execute();
        $stmt->bind_result($title, $picture);
        while ($stmt->fetch()) {
            echo "<div onclick='SelectGame(this)' class='gameSmall'><h3>".$title."</h3><img src='".$picture."'>";
        }
    } else {
          echo "SELECT title, picture FROM games WHERE title LIKE '".$_GET['query']."%' LIMIT 5";
    }
    include_once 'footer.php';

} else if (isset($_GET['gameS'])) {
  //display game page

  include_once 'header.php';

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
  include_once 'footer.php';
}

?>
