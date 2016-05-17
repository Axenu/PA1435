<?php
include_once 'header.php';
?>
   <script src="js/userModel.js"></script>
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
        <a href='sendNewsletterView.php'>Send Newsletter</a> |

        <?php } ?>
</p>
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

<?php
include_once 'footer.php';
?>
