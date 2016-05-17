<?php
include_once 'header.php';
?>
   <script src="js/editGamesModel.js"></script>


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


        <?php
        include_once 'footer.php';
        ?>
