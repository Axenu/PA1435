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
   <script src="js/userModel.js"></script>
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
        <a href='bookingHistory.php'>Booking history</a>


        <p>Active bookings:</p>

        <?php
        $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
        date_default_timezone_set('Europe/Stockholm');
        $hour = date('G') + 1;
        $day = date('j');
        $month = date('n');
        $year = date('Y');
        if ($stmt = $mysqli->prepare("SELECT id FROM prices WHERE (month=".$month." AND day=".$day." AND hour=".$hour." AND year=".$year.") LIMIT 1")) {
            $stmt->execute();
            $stmt->bind_result($id);
            $stmt->fetch();
            $stmt->close();
            $stmt = $mysqli->prepare("SELECT game_id, time_id FROM bookings WHERE user_id=".$_SESSION['user_id']." AND time_id > ".$id);
            $stmt->execute();
            $stmt->bind_result($game_id, $time_id);
            $bookings = array();
            while($stmt->fetch()) {
                $bookings[$time_id] = $game_id;
            }
            $stmt->close();
            foreach ($bookings as $key => $val) {
                $stmt = $mysqli->prepare("SELECT title FROM games WHERE game_id = ".$val);
                $stmt->execute();
                $stmt->bind_result($title);
                while($stmt->fetch()) {
                    echo "<div class='booking'><p>".$title;
                }
                $stmt->close();
                $stmt = $mysqli->prepare("SELECT month, day, hour FROM prices WHERE id = ".$key);
                $stmt->execute();
                $stmt->bind_result($m, $d, $h);
                while($stmt->fetch()) {
                    echo "</p><p>".$m."/".$d." ".$h.":00</p></div>";
                }
                $stmt->close();
            }
        } else {
            echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
        }
         ?>

        <p>Past bookings:</p>

        <?php
        $stmt = $mysqli->prepare("SELECT game_id, time_id FROM bookings WHERE user_id=".$_SESSION['user_id']." AND time_id < ".$id);
        $stmt->execute();
        $stmt->bind_result($game_id, $time_id);
        $bookings = array();
        while($stmt->fetch()) {
            $bookings[$time_id] = $game_id;
        }
        $stmt->close();
        foreach ($bookings as $key => $val) {
            $stmt = $mysqli->prepare("SELECT title FROM games WHERE game_id = ".$val);
            $stmt->execute();
            $stmt->bind_result($title);
            while($stmt->fetch()) {
                echo "<div class='booking'><p>".$title;
            }
            $stmt->close();
            $stmt = $mysqli->prepare("SELECT month, day, hour FROM prices WHERE id = ".$key);
            $stmt->execute();
            $stmt->bind_result($m, $d, $h);
            while($stmt->fetch()) {
                echo "</p><p>".$m."/".$d." ".$h.":00</p></div>";
            }
            $stmt->close();
        }
         ?>

   </div>

   <div id="footer"><p><center>
     Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>
     Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
   </div>
 </body>
 </html>
