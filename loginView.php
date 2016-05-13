<?php
include_once 'phpModel/loginModel.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/Style.css" type="text/css"/>
    <script src="js/jquery.js"></script>
    <?php include_once 'searchView.php';
    getSeachInclude(); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Login Page</title>
    <title>Game house Lannister</title>
        <script type="text/JavaScript" src="js/sha512.js"></script>
        <script type="text/JavaScript" src="js/forms.js"></script>
  </head>
  <body>

    <div id="header">

      <a href="loginView.php">Login</a>
    <h1>Game House</h1>
  </div>
  <div id="contain">
    <center>
      <?php
          if (isset($_GET['error'])) {
              echo '<p class="error">Error Logging In!</p>';
          }
          ?>
      <form action="phpModel/loginModel.php" method="post" name="login_form">
        <p>Username: </p>
        <input type="text" name="username" placeholder="Username" autocomplete="username" id="username"/>
        <p>Password: </p>
        <input type="password" name="password" id="password" placeholder="password" autocomplete="current-password"/>
        <input type="submit" value="Login" class="submit" onclick="formhash(this.form, this.form.password);" />
      </form>
      <p>If you don't have a login, please <a href='registerView.php'>register</a></p>
  </center>
  </div>

  </body>
</html>
