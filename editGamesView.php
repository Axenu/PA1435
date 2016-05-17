<?php
include_once 'header.php';
?>

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

            if ($stmt = $mysqli->prepare("SELECT title, picture, game_id, description FROM games")) {
                $stmt->execute();
                $stmt->bind_result($title, $picture, $game_id, $description);
                while ($stmt->fetch()) {
                    echo "<div onclick='SelectGame(this)' class='gameSmall' id='".$game_id."'><h3>".$title."</h3><img src='".$picture."'><p class='hidden'>".$description."<p></div>";
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
