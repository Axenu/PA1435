<?php
include_once 'phpModel/registerModel.php';
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
        <?php
        if (login_check($mysqli) == true) {
            ?><p onclick=''><?php echo htmlentities($_SESSION['username']); ?></p><p onlick=''>logg out</p><?php
        } else {
            ?><a href="loginView.php"><center>Login</a><?php
        }

         ?>
        <a href="index.php"><div id="logo"></div></a>
        <div id="SearchField"><center><?php getSearchView(); ?></center></div>
        <div id="BookingField"><a href="bookingView.php"><center>Booking</center></a></div>
    </div>

    <div id="contain">
    <p class="errormsg hideError"> error message! </p>
    <form action="phpModel/registerModel.php"
                method="post"
                name="registration_form">
            <div class="personal">
              <div id="registerpersonal">
                <h3><b> Personal information </b></h3>
              <p>Namn: </p><input type="text" name="firstName" class="smallInput" id="firstName" placeholder="Firstname"/><br>
              <input type="text" name="lastName" class="smallInput" id="lastName" placeholder="Lastname"/>
              <p>Användarnamn: </p><input type='text' name='username' id='username' placeholder="Username"/>
              <p>Email: </p><input type="text" name="email" id="email" placeholder="Email"/>
              <p>Lösenord: </p><input type="password" name="password" id="password" placeholder="Password"/>
              <p>Bekräfta lösenordet: </p><input type="password" name="confirmpwd" id="confirmpwd" placeholder="Confirm Password"/>
            </div>
            </div>
            <div class="company">
              <div id="registercompany">
                  <h3><b> Company information </b></h3>
                <p>Företagsnamn: </p><input type="text" name="company" id="company" placeholder="Företagsnamn"/>
                <p>Organisationsnummer: </p><input type="text" name="orgnr" id="orgnr" placeholder="Organisationsnummer"/>
                <p>Faktureringsaddress: </p><input type="text" name="address" id="address" placeholder="Faktureringsaddress"/>
                <p>Postort: </p><input type="text" name="city" id="city" placeholder="Postort"/>
                <p>Postnummer: </p><input type="text" name="postnr" id="postnr" placeholder="Postnummer"/>
                <p>Fakturamärkning: </p><input type="text" name="faktura" id="faktura" placeholder="Fakturamärkning"/>
                <p>Kontaktperson: </p><input type="text" name="contact" id="contact" placeholder="Kontaktperson"/>
              </div>
           </div>
           <center>
             <br>
             <div  id="username_center">
            <input type="button" value="Register" class="submit" onclick="return regformhash(this.form, this.form.username,this.form.email,this.form.password,this.form.confirmpwd);" />
        </form>
        <p class="return">Return to the <a href="loginView.php">login page</a>.</p>
      </div>
      </center>
      </div>

      <div id="footer"><p><center>
        Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>
        Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
      </div>
  </body>
</html>
