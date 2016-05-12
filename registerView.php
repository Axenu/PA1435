<?php
include_once 'phpModel/registerModel.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Game house start</title>
  	<script src="js/jquery.js"></script>
  	<script src="js/forms.js"></script>
  	<script src="js/sha512.js"></script>
  </head>
  <body>

      <a href="loginView.php">Login</a>
    <h1>Game House</h1>
    <p class="errormsg hideError"> error message! </p>
    <form action="phpModel/registerModel.php"
                method="post"
                name="registration_form">
            <div class="personal">
            <p>Namn: </p><input type="text" name="firstName" class="smallInput" id="firstName" placeholder="Förnamn"/>
            <input type="text" name="lastName" class="smallInput" id="lastName" placeholder="Efternanm"/>
            <p>Användarnamn: </p><input type='text' name='username' id='username' placeholder="Användarnamn"/>
            <p>Email: </p><input type="text" name="email" id="email" placeholder="Email"/>
            <p>Lösenord: </p><input type="password" name="password" id="password" placeholder="Lösenord"/>
            <p>Bekräfta lösenordet: </p><input type="password" name="confirmpwd" id="confirmpwd" placeholder="Bekräfta lösenordet"/>
            </div>
            <div class="company">
            <p>Företagsnamn: </p><input type="text" name="company" id="company" placeholder="Företagsnamn"/>
            <p>Organisationsnummer: </p><input type="text" name="orgnr" id="orgnr" placeholder="Organisationsnummer"/>
            <p>Faktureringsaddress: </p><input type="text" name="address" id="address" placeholder="Faktureringsaddress"/>
            <p>Postort: </p><input type="text" name="city" id="city" placeholder="Postort"/>
            <p>Postnummer: </p><input type="text" name="postnr" id="postnr" placeholder="Postnummer"/>
            <p>Fakturamärkning: </p><input type="text" name="faktura" id="faktura" placeholder="Fakturamärkning"/>
            <p>Kontaktperson: </p><input type="text" name="contact" id="contact" placeholder="Kontaktperson"/>
            </div>
            <input type="button" value="Register" class="submit" onclick="return regformhash(this.form, this.form.username,this.form.email,this.form.password,this.form.confirmpwd);" />
        </form>
        <p class="return">Return to the <a href="loginView.php">login page</a>.</p>
  </body>
</html>
