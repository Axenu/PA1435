<?php
include_once 'header.php';
?>
   <script src="js/sendNewsletterModel.js"></script>

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

        <?php
        if (isset($_GET['confirm'])) {
            echo "<p>Newsletter sent!</p>";
        } else {
         ?>
        <form>
            <input type='text' placeholder="Title"></input>
            <textarea placeholder="Content"></textarea>
            <input type='button' value="Send" onclick='sendNewsletter();'></input>
        </form>

<?php
}
include_once 'footer.php';
?>
