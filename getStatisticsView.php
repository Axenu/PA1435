<?php
include_once 'header.php';
?>
   <script src="js/getStatisticsModel.js"></script>

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
        <?php
    }
        date_default_timezone_set('Europe/Stockholm');
        ?>
        </p>
        <form class='form1'>
            Start at:&nbsp
            <input type='text' class='py' placeholder='year' value='<?php echo date('Y'); ?>'/> /
            <input type='text' class='pm'  placeholder='month' value='<?php echo date('n')-1; ?>'/> /
            <input type='text' class='pd'  placeholder='date' value='<?php echo date('j'); ?>'/> kl.
            <input type='text' class='ph'  placeholder='hour' value='<?php echo date('G'); ?>'/>
            <br><br>
            End at: &nbsp
            <input type='text' class='ny'  placeholder='year' value='<?php echo date('Y'); ?>'/> /
            <input type='text' class='nm'  placeholder='month' value='<?php echo date('n'); ?>'/> /
            <input type='text' class='nd'  placeholder='date' value='<?php echo date('j'); ?>'/> kl.
            <input type='text' class='nh'  placeholder='hour' value='<?php echo date('G'); ?>'/>
        </form>


        <div class='result12'></div><br>
        <input type='text' class='user_name' placeholder='Username'/>
        <p onclick='calculateTotal()'>Calculate</p>
        <p onclick='userReport()'>Get userReport</p>
        <div class='result3'></div>

<?php
include_once 'footer.php';
?>
