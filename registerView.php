<?php
include_once 'phpModel/registerModel.php';
include_once 'phpModel/functions.php';
sec_session_start();
$mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="css/Style.css" type="text/css"/>
    <script src="js/jquery.js"></script>
    <?php include_once 'searchView.php';
    getSeachInclude(); ?>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Register</title>
  	<script src="js/jquery.js"></script>
  	<script src="js/forms.js"></script>
  	<script src="js/sha512.js"></script>
  </head>
  <body>

    <div id="header">
      <div id="LoginField">
        <?php
        if (login_check($mysqli) == true) {
          ?><a href='userView.php'><?php echo htmlentities($_SESSION['username']); ?></a><a href='phpModel/logout.php'>logg out</a><?php
        } else {
          ?><a href="loginView.php"><center>Login</a><?php
        }
        ?>
      </div>
        <a href="index.php"><div id="logo"></div></a>
        <div id="SearchField"><center><?php getSearchView(); ?></center></div>
        <div id="BookingField"><a href="bookingView.php"><center>Booking</center></a></div>
    </div>

    <div id="contain">
    <!-- <p class="errormsg hideError"> error message! </p> -->
    <form action="phpModel/registerModel.php"
                method="post"
                name="registration_form">
              <p>Username: </p><input type='text' name='username' id='username' placeholder="Username"/>
              <p>Email: </p><input type="text" name="email" id="email" placeholder="Email"/>
              <p>Password: </p><input type="password" name="password" id="password" placeholder="Password"/>
              <p>Repeat password: </p><input type="password" name="confirmpwd" id="confirmpwd" placeholder="Confirm Password"/>
              <p>First Name: </p>
              <input type='text' name='firstName' id='firstName' placeholder='First Name' autocomplete='firstName'/>
              <p>Last Name: </p>
              <input type='text' name='lastName' id='lastName' placeholder='Last Name' autocomplete='lastName'/>
              <p>Assress: </p>
              <input type='text' name='address' placeholder='Address' autocomplete='address' id='address'/>
              <p>City: </p>
              <input type='text' name='city' placeholder='City' autocomplete='city' id='city'/>
              <p>Postal Code: </p>
              <input type='text' name='postnr' placeholder='Postal Code' autocomplete='postnr' id='postnr'/>
             <br>
            <input type="button" value="Register" class="submit" onclick="return regformhash(this.form, this.form.username,this.form.email,this.form.password,this.form.confirmpwd);" />
        </form>
        <p class="return">Return to the <a href="loginView.php">login page</a>.</p>
      </div>
      </div>

      <div id="footer"><p><center>
        Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>
        Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
      </div>
  </body>
</html>
