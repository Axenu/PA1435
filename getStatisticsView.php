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
        <form id='form1'>
            <p>start at</p>
            <input type='text' class='py' placeholder='year' value='<?php echo date('Y'); ?>'/>
            <input type='text' class='pm'  placeholder='month' value='<?php echo date('n')-1; ?>'/>
            <input type='text' class='pd'  placeholder='date' value='<?php echo date('j'); ?>'/>
            <input type='text' class='ph'  placeholder='hour' value='<?php echo date('G'); ?>'/>
            <p>end at</p>
            <input type='text' class='ny'  placeholder='year' value='<?php echo date('Y'); ?>'/>
            <input type='text' class='nm'  placeholder='month' value='<?php echo date('n'); ?>'/>
            <input type='text' class='nd'  placeholder='date' value='<?php echo date('j'); ?>'/>
            <input type='text' class='nh'  placeholder='hour' value='<?php echo date('G'); ?>'/>
        </form>

        <p onclick='calculateTotal()'>Calculate total income</p>

        <p class='result1'></p>

<?php
include_once 'footer.php';
?>
