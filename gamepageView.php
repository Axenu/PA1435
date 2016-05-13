<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="css/Style.css" type="text/css"/>
  <script src="js/jquery.js"></script>
  <?php include_once 'searchView.php';
  getSeachInclude(); ?>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>Game Page</title>
  <title>Game house Lannister</title>
</head>
<body>
  <div id="header">
    <div id="LoginField">
      <center><a href="loginView.php">Login</a></center>
    </div>
    <center><h1>Game House</h1></center>
  </div>
  <?php getSearchView(); ?>

  <div id="contain">
  </div>

  <div id="footer">
    Blekinge Institute of Technology, 2016<br>
    PA1435<br>
    Alfons Dahl <br>
    Simon Nilsson<br>
    Filip Pentikäinen<br>
  </div>
</body>
</html>
