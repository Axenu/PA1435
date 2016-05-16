<?php
include_once 'phpModel/functions.php';
sec_session_start();
$mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");


 ?>
 <!DOCTYPE html>
 <html>
 <head>
     <meta charset="UTF-8">
   <link rel="stylesheet" href="css/Style.css" type="text/css"/>
   <script src="js/jquery.js"></script>
   <script src="js/forms.js"></script>
   <script src="js/sha512.js"></script>
   <script src="js/userModel.js"></script>
   <?php include_once 'searchView.php';
   getSeachInclude(); ?>
   <!-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> -->
   <title>Home</title>
 </head>
 <body>
   <div id="header">
       <?php
       if (login_check($mysqli) == true) {
           ?><a href='userView.php'><?php echo htmlentities($_SESSION['username']); ?></a><a href='phpModel/logout.php'>logg out</a><?php
       } else {
           ?><a href="loginView.php"><center>Login</a><?php
       }

        ?>
       <!-- <div id="LoginField"><a href="loginView.php"><center>Login</a></center></div> -->
       <a href="index.php"><div id="logo"></div></a>
       <div id="SearchField"><center><?php getSearchView(); ?></center></div>
       <div id="BookingField"><a href="bookingView.php"><center>Booking</center></a></div>
    </div>

    <div id="contain">
        <a href='bookingHistory.php'>Booking history</a>

        <form action="phpModel/updateUserModel.php" method="post" name="registration_form">
            <p>Username: </p><input type='text' name='username' id='username' placeholder="Username" value="<?php echo htmlentities($_SESSION['username']); ?>"/>
            <?php
            if ($stmt = $mysqli->prepare("SELECT email, first_name, last_name, address, city, postalcode FROM members WHERE id=?")) {
                $stmt->bind_param('i', $_SESSION["user_id"]);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($email, $first_name, $last_name, $address, $city, $postalcode);
                $stmt->fetch();
            }
             ?>
            <p>Email: </p><input type="text" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>"/>
            <p>Password: </p><input type="password" name="password" id="password" placeholder="Password"/>
            <p>Repeat password: </p><input type="password" name="confirmpwd" id="confirmpwd" placeholder="Confirm Password"/>
            <p>First Name: </p>
            <input type='text' name='firstName' id='firstName' placeholder='First Name' autocomplete='firstName' value='<?php echo $first_name; ?>'/>
            <p>Last Name: </p>
            <input type='text' name='lastName' id='lastName' placeholder='Last Name' autocomplete='lastName' value="<?php echo $last_name; ?>"/>
            <p>Assress: </p>
            <input type='text' name='address' placeholder='Address' autocomplete='address' id='address' value="<?php echo $address; ?>"/>
            <p>City: </p>
            <input type='text' name='city' placeholder='City' autocomplete='city' id='city' value="<?php echo $city; ?>"/>
            <p>Postal Code: </p>
            <input type='text' name='postnr' placeholder='Postal Code' autocomplete='postnr' id='postnr' value="<?php echo $postalcode; ?>"/>
            <input type='hidden' value='<?php echo htmlentities($_SESSION["user_id"]); ?>' id='u_id' name='u_id'>
            <input type="button" value="Save changes" class="submit" onclick="return updateFormHash(this.form, this.form.username,this.form.email,this.form.password,this.form.confirmpwd);" />
       </form>
       <p onclick="removeAccount('<?php echo htmlentities($_SESSION["user_id"]); ?>');">Delete account</p>



   </div>

   <div id="footer"><p><center>
     Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>
     Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
   </div>
 </body>
 </html>