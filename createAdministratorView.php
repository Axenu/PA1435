<?php
include_once 'header.php';
?>
   <script src="js/createAdministratorModel.js"></script>


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

        <h3>Users:</h3>

        <?php
            if ($stmt = $mysqli->prepare("SELECT username FROM members WHERE username <> 'Guest' LIMIT 50")) {
                $stmt->execute();
                $stmt->bind_result($username);
                while ($stmt->fetch()) {
                    echo "<p>".$username."</p>";
                }
            } else {
                echo $mysqli->error;
            }
        ?>
        <p onclick='displayAddUserForm();'>Add User</p>
        <p onclick='deleteSelected();'>Remove User</p>
        <p onclick='displayEditUserForm();'>Edit User</p>


        <?php
        include_once 'footer.php';
        ?>
