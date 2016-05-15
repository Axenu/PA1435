<!-- <!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/Style.css" type="text/css"/>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Site name</title>
</head>
<body>
  <div id="header">
  </div>

  <div id="contain">
  </div>

  <div id="footer">
  </div>
</body>
</html> -->
<?php
if (!isset($_GET['game'])) {
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
    echo"<div id='LoginField'><a href='LoginView.php'><center>Login</a></center></div>";
    echo"<a href='index.php'><h2><center>Game House</center></h2></a>";
    echo"<div id='SearchField'><center><?php getSearchView(); ?></center></div>";
    echo"</div>";

    echo"<a href='loginView.php'>Login</a>";

    echo"<div id='contain'>";

    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
    date_default_timezone_set('Europe/Stockholm');

    if ($stmt = $mysqli->prepare("SELECT price FROM prices WHERE (month=".date('n')." AND hour=12)")) {
        // $query = $_POST['query']."%";
        // $stmt->bind_param('s', $query);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows < 5) {
            $stmt->close();
            //create data for current month
            $days = cal_days_in_month(CAL_GREGORIAN, date('n'), date('Y'));
            for ($i = 0; $i < $days; $i++) {
                for ($j = 0; $j < 24; $j++) {
                    $query = "INSERT INTO `prices` (month, day, hour, price, year) VALUES (".date('n').", ".($i+1).", ".($j+1).", 100, ".date('Y').")";
                    if ($result = $mysqli->query($query)) {
                    } else {
                        echo $query;
                    }
                }
            }
        }
        $stmt = $mysqli->prepare("SELECT day, price FROM prices WHERE (month=".date('n')." AND hour=12)");
        $stmt->execute();
        $stmt->bind_result($day, $price);
        while ($stmt->fetch()) {
          echo "<p onclick=''>day: ".$day." ca price: ".$price."</p>";
        }
      } else {
        // echo "SELECT title FROM games WHERE title LIKE '".$_POST['query']."%' LIMIT 5";
      }

    echo"</div>";

    echo"<?php getSearchView(); ?>";
    echo"<h1>Game House</h1>";
    echo"<a href='bookingView.php'>book</a>";

    echo"<div id='footer'><p><center>";
    echo"Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>   Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>";
    echo"</div>";
    echo"</body>";
    echo"</html>";
} else {

}

 ?>
