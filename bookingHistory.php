<?php
include_once 'header.php';
?>
   <script src="js/userModel.js"></script>
   <script src="js/bookingModel.js"></script>

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
            $stmt = $mysqli->prepare("SELECT game_id, time_id, id FROM bookings WHERE user_id=".$_SESSION['user_id']." AND time_id > ".$id);
            $stmt->execute();
            $stmt->bind_result($game_id, $time_id, $b_id);
            $bookings = array();
            while($stmt->fetch()) {
                $bookings[$time_id] = [$game_id, $b_id];
            }
            $stmt->close();
            foreach ($bookings as $key => $val) {
                $stmt = $mysqli->prepare("SELECT title FROM games WHERE game_id = ".$val[0]);
                $stmt->execute();
                $stmt->bind_result($title);
                while($stmt->fetch()) {
                    echo "<div class=\"booking\" onclick=\"removeBooking('".$val[1]."')\"><p>".$title;
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
