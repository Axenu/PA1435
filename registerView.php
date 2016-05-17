<?php
include_once 'header.php';
include_once 'phpModel/registerModel.php';
?>

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
