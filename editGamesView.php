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
    <a href='getStatisticsView.php'>Get statistics</a> |
    <a href='sendNewsletterView.php'>Send Newsletter</a>

<?php } ?>
    </p>
    <input class='searchBarGame' type='text' name='search' placeholder='Search' onkeyup='searchQueryChanged(event)'>

<?php
    if (isset($_GET['queryG'])) {
        if ($stmt = $mysqli->prepare("SELECT title, picture, game_id, description FROM games WHERE title LIKE ?")) {
            $query = $_GET['queryG']."%";
            $stmt->bind_param('s', $query);
            $stmt->execute();
            $stmt->bind_result($title, $picture, $game_id, $description);
            while ($stmt->fetch()) {
                echo "<div onclick='SelectGame(this)' class='gameSmall_left' id='".$game_id."'><h3>".$title."</h3><img class='gamepic_menu_small' src='".$picture."'><p class='hidden'>".$description."</p></div>";
            }
        } else {
        }
    } else {
        if ($stmt = $mysqli->prepare("SELECT title, picture, game_id, description FROM games")) {
            $stmt->execute();
            $stmt->bind_result($title, $picture, $game_id, $description);
            while ($stmt->fetch()) {
                echo "<div onclick='SelectGame(this)' class='gameSmall_left' id='".$game_id."'><h3>".$title."</h3><img class='gamepic_menu_small' src='".$picture."'><p class='hidden'>".$description."</p></div>";
            }
        } else {
        }
    }
?>
    <div id="options">
      <p class="hover" onclick='displayAddGameForm();'>Add Game</p>
      <p class="hover" onclick='deleteSelected();'>Remove Game</p>
      <p class="hover" onclick='displayEditGameForm();'>Edit Game</p>
      <p class="hover" onclick='displayEditMachineForm();'>Select Machines for Game</p>

        <p class="hover" onclick='displayAddMachineForm();'>Add Machine</p>
        <p class="hover" onclick='dislayDeleteMachineForm();'>Remove Machine</p>
        <!-- <p class="hover" onclick='displayEditGameForm();'>Edit Game</p> -->
    </div>
    <div class='outputContainer'></div>


<?php
include_once 'footer.php';
?>
