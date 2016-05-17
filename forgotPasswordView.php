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
        <script type="text/JavaScript" src="js/userModel.js"></script>
  </head>
  <body>

    <div id="header">
        <?php
        if (login_check($mysqli) == true) {
            ?><p onclick=''><?php echo htmlentities($_SESSION['username']); ?></p><p onlick=''>logg out</p><?php
        } else {
            ?><a href="loginView.php"><center>Login</a><?php
        }

         ?>
        <a href="index.php"><div id="logo"></div></a>
        <div id="SearchField"><center><?php getSearchView(); ?></center></div>
        <div id="BookingField"><a href="bookingView.php"><center>Booking</center></a></div>
    </div>
    <div id="contain">
        <?php
        if (isset($_GET['done'])) {
            echo "<p>password recovery email sent!</p>";
        } else {
         ?>
        <form onsubmit="return false;" >
            <p>Email: </p>
            <input type="text" name="email" placeholder="Email" autocomplete="email" id="email"/>
            <input type="submit" value="Login" class="submit" onclick="recoverPassword();" />
        </form>
        <?php } ?>
    </div>

  <div id="footer"><p><center>
    Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>
    Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
  </div>

  </body>
</html>
