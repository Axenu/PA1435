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
    echo "</div>";

    echo"<a href='loginView.php'>Login</a>";
    echo"<div id='contain'>";

    

    echo"</div>";
    echo"<?php getSearchView(); ?>";
    echo"<h1>Game House</h1>";
    echo"<a href='bookingView.php'>book</a>";
    echo"<div id='footer'>";
    echo"</div>";
  echo"</body>";
  echo"</html>";
} else {

}

 ?>
