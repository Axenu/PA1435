<?php
include_once 'header.php';
?>
    <center>
      <?php
          if (isset($_GET['error'])) {
              echo '<p class="error">Error Logging In!</p>';
          }
          ?>
      <form action="phpModel/loginModel.php" method="post" name="login_form">
        <div id="username_center"><p>Username: </p></div>
        <input type="text" name="username" placeholder="Username" autocomplete="username" id="username"/>
        <div id="username_center"><p>Password: </p></div>
        <input type="password" name="password" id="password" placeholder="password" autocomplete="current-password"/>
        <input type="submit" value="Login" class="submit" onclick="formhash(this.form, this.form.password);" />
      </form>
      <div id="username_center">
        <h6><center>Forgot password? click here: <a href='forgotPasswordView.php'><br>forgot password</a></center></h6><br>
        <h6><center>If you don't have a login, please <a href='registerView.php'>register</a></center></h6>

      </div>

  </center>
  <?php
  include_once 'footer.php';
  ?>
