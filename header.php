<?php

include_once 'phpModel/functions.php';
sec_session_start();
$mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
  <link rel="stylesheet" href="css/Style.css" type="text/css"/>
  <script src="js/jquery.js"></script>
  <script src="js/forms.js"></script>
  <script src="js/sha512.js"></script>
  <?php include_once 'searchView.php';
  getSeachInclude(); ?>
  <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
  <title>Home</title>
</head>
<body>
  <div id="header">
      <div id="LoginField">
        <?php
        if (login_check($mysqli) == true) {
          ?><a href='userView.php'><?php echo htmlentities($_SESSION['username']); ?></a><a href='phpModel/logout.php'>logg out</a><?php
        } else {
          ?><a href="loginView.php"><center>Login</a><?php
        }
        ?>
      </div>
      <!-- <div id="LoginField"><a href="loginView.php"><center>Login</a></center></div> -->
      <a href="index.php"><div id="logo"></div></a>
      <div id="SearchField"><center><?php getSearchView(); ?></center></div>
      <div id="BookingField"><a href="bookingView.php"><center>Booking</center></a></div>
  </div>

  <div id="contain">
