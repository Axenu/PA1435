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
