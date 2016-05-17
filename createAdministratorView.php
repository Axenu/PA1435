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
   <!-- <script src="js/userModel.js"></script> -->
   <script src="js/editGamesModel.js"></script>
   <?php include_once 'searchView.php';
   getSeachInclude(); ?>
   <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
   <title>Home</title>
 </head>
 <body>
   <div id="header">
       <?php
       if (login_check($mysqli) == true) {
           ?><a href='userView.php'><?php echo htmlentities($_SESSION['username']); ?></a><a href='phpModel/logout.php'>logg out</a><?php
       } else {
           ?><a href="loginView.php"><center>Login</a><?php
       }

        ?>
       <!-- <div id="LoginField"><a href="loginView.php"><center>Login</a></center></div> -->
       <a href="index.php"><div id="logo"></div></a>
       <div id="SearchField"><center><?php getSearchView(); ?></center></div>
       <div id="BookingField"><a href="bookingView.php"><center>Booking</center></a></div>
    </div>

    <div id="contain">

        <a href='userView.php'>User info</a>
        <a href='bookingHistory.php'>Booking history</a>
        <?php
        if ($_SESSION['permission'] > 0) {
        ?>

        <a href='editGamesView.php'>Handle Games</a>

        <?php
        }
        if ($_SESSION['permission'] > 1) {
        ?>

        <a href='createAdministratorView.php'>Handle Users</a>
        <a href='generateReport.php'>Get statistics</a>
        <a href='sendNewsLetter'>Send Newsletter</a>

        <?php } ?>


        <?php

            if ($stmt = $mysqli->prepare("SELECT username FROM members WHERE LIMIT 50")) {
                $stmt->execute();
                $stmt->bind_result($username);
                while ($stmt->fetch()) {
                    echo "<p>".$username."</p>";
                }
            } else {
            }
        ?>
        <p onclick='displayAddGameForm();'>Add Game</p>
        <p onclick='deleteSelected();'>Remove Game</p>
        <p onclick='displayEditGameForm();'>Edit Game</p>


   </div>

   <div id="footer"><p><center>
     Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>
     Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
   </div>
 </body>
 </html>
