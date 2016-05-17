<?php
include_once 'phpModel/functions.php';
sec_session_start();
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/Style.css" type="text/css"/>
    <script src="js/jquery.js"></script>
    <?php include_once 'searchView.php';
    getSeachInclude(); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Game House Login</title>
        <script type="text/JavaScript" src="js/sha512.js"></script>
        <script type="text/JavaScript" src="js/forms.js"></script>
  </head>
  <body>

    <div id="header">
      <div id="LoginField">
        <?php
        if (login_check($mysqli) == true) {
            ?><p onclick=''><?php echo htmlentities($_SESSION['username']); ?></p><p onlick=''>logg out</p><?php
        } else {
            ?><a href="loginView.php"><center>Login</a><?php
        }

         ?>
       </div>
        <a href="index.php"><div id="logo"></div></a>
        <div id="SearchField"><center><?php getSearchView(); ?></center></div>
        <div id="BookingField"><a href="bookingView.php"><center>Booking</center></a></div>
    </div>
  <div id="contain" class="center">
      <?php
          if (isset($_GET['error'])) {
              echo '<p class="error">Error Logging In!</p>';
          }
          ?>
      <form action="phpModel/loginModel.php" method="post" name="login_form">
        <div id="username_center"><p>Username: </p></div>
        <input type="text" name="username" placeholder="Username" autocomplete="username" id="username"/>
        <div id="username_center"><p>Password: </p></div>
        <input type="password" name="password" id="password" placeholder="password" autocomplete="current-password"/>
        <input type="submit" value="Login" class="submit" onclick="formhash(this.form, this.form.password);" />
      </form>
      <div id="username_center">
        <h6><center>Forgot password? click here: <a href='forgotPasswordView.php'><br>forgot password</a></center></h6><br>
        <h6><center>If you don't have a login, please <a href='registerView.php'>register</a></center></h6>

      </div>
  </div>

  <div id="footer"><p><center>
    Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>
    Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
  </div>

  </body>
</html>
