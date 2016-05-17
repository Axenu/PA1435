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
        <?php } ?>
    </div>

  <div id="footer"><p><center>
    Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>
    Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
  </div>

  </body>
</html>
