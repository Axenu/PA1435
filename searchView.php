<?php
function getSeachInclude() {
  echo '<script type="text/JavaScript" src="js/searchModel.js"></script>';
}

function getSearchView() {
  echo "<input class='searchBar' type='text' name='search' placeholder='Search' onkeyup='searchStringChnged()'>";
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
    echo "<title>Index</title>";
    echo "<title>Game house start</title>";
    echo"</head>";
    echo"<body>";
    echo"<div id='header'>";
    echo"</div>";

    echo"<a href='loginView.php'>Login</a>";
    echo"<div id='contain'>";
    echo"</div>";
    echo"<?php getSearchView(); ?>";
    echo"<h1>Game House</h1>";
    echo"<p>Info text</p>";
    echo"<a href='bookingView.php'>book</a>";

    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");

    if ($stmt = $mysqli->prepare("SELECT title, picture FROM games WHERE title LIKE ? LIMIT 5")) {
        $query = $_GET['query']."%";
        $stmt->bind_param('s', $query);
        $stmt->execute();
        $stmt->bind_result($title, $picture);
        while ($stmt->fetch()) {
            echo "<div class='gameSmall'>".$picture.", ".$title."</div>";
        }
          // echo "$title";
    } else {
          echo "SELECT title, picture FROM games WHERE title LIKE '".$_GET['query']."%' LIMIT 5";
    }

    echo"<div id='footer'>";
    echo"</div>";
  echo"</body>";
  echo"</html>";
} else if (isset($_GET['game'])) {
  //display game page
}

?>
