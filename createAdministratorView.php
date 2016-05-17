<?php
include_once 'header.php';
?>
   <script src="js/createAdministratorModel.js"></script>

<p class="center">

      <script src="js/userModel.js"></script>

        <a href='userView.php'>User info</a> |
        <a href='bookingHistory.php'>Booking history</a> |
        <?php
        if ($_SESSION['permission'] > 0) {
        ?>

        <a href='editGamesView.php'>Handle Games</a> |

        <?php
        }
        if ($_SESSION['permission'] > 1) {
        ?>

        <a href='createAdministratorView.php'>Handle Users</a> |
        <a href='generateReport.php'>Get statistics</a> |
        <a href='sendNewsletterView.php'>Send Newsletter</a>

        <?php } ?>
</p>
        <h3>Users:</h3>

        <?php
            if ($stmt = $mysqli->prepare("SELECT username, id FROM members WHERE username <> 'Guest' LIMIT 50")) {
                $stmt->execute();
                $stmt->bind_result($username, $user_id);
                while ($stmt->fetch()) {
                    echo "<p class='userclass' onclick='SelectUser(this);' id=".$user_id.">".$username."</p>";
                }
            } else {
                echo $mysqli->error;
            }
        ?>
        <div id="useroptions">
          <p class="hover" onclick='displayAddUserForm();'>Add User</p>
          <p class="hover" onclick='deleteSelected();'>Remove User</p>
          <p class="hover" onclick='displayEditUserForm();'>Edit User</p>
        </div>


        <?php
        include_once 'footer.php';
        ?>
