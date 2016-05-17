<?php
include_once 'header.php';
?>

<script src="js/editGamesModel.js"></script>
<p class="center">

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

        <?php
            if ($stmt = $mysqli->prepare("SELECT title, picture, game_id, description FROM games")) {
                $stmt->execute();
                $stmt->bind_result($title, $picture, $game_id, $description);
                while ($stmt->fetch()) {
                    echo "<div onclick='SelectGame(this)' class='gameSmall' id='".$game_id."'><h3>".$title."</h3><img class='gamepic_menu_small' src='".$picture."'><p class='hidden'>".$description."</p></div>";
                }
            } else {
            }
        ?>
        <div id="options">
          <p class="hover" onclick='displayAddGameForm();'>Add Game</p>
          <p class="hover" onclick='deleteSelected();'>Remove Game</p>
          <p class="hover" onclick='displayEditGameForm();'>Edit Game</p>
        </div>


        <?php
        include_once 'footer.php';
        ?>
