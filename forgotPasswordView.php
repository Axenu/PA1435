<?php
include_once 'header.php';
?>
        <script type="text/JavaScript" src="js/userModel.js"></script>
        <?php
        if (isset($_GET['done'])) {
            echo "<p>password recovery email sent!</p>";
        } else {
         ?>
        <form onsubmit="return false;" >
            <p>Email: </p>
            <input type="text" name="email" placeholder="Email" autocomplete="email" id="email"/>
            <input type="submit" value="Login" class="submit" onclick="recoverPassword();" />
        </form>
        <?php
    }
include_once 'footer.php';
?>
