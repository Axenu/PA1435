<?php
include_once 'phpModel/functions.php';
sec_session_start();
$mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
 ?>

<!DOCTYPE html>
<html>
<head>
<link rel='stylesheet' href='css/Style.css' type='text/css'/>
<script src='js/bookingModel.js'></script>
<script src='js/forms.js'></script>
<script src='js/sha512.js'></script>
<script src='js/jquery.js'></script>
<?php include_once 'searchView.php';
getSeachInclude(); ?>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
<title>Game house book</title>
</head>
<body>
<div id='header'>
  <div id="LoginField">
    <?php
    if (login_check($mysqli) == true) {
        ?><p onclick=''><?php echo htmlentities($_SESSION['username']); ?></p><a href='phpModel/logout.php'>logg out</a><?php
    } else {
        ?><a href="loginView.php"><center>Login</a><?php
    }

     ?>
   </div>
<a href="index.php"><div id="logo"></div></a>
<div id='SearchField'><center><?php getSearchView(); ?></center></div>
</div>

<a href='loginView.php'>Login</a>

<div id='contain'>
<?php
if (!isset($_GET['game']) && !isset($_GET['date']) && !isset($_GET['confirm'])) {
    echo "<h3>Select date</h3>";
    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
    date_default_timezone_set('Europe/Stockholm');
    $month = date('n');
    $year = date('Y');
    if (isset($_GET['month'])) {
        $month = $_GET['month'];
    }
    if (isset($_GET['year'])) {
        $year = $_GET['year'];
    }
    $nmonth = $month+1;
    $nyear = $year;
    if ($nmonth > 12) {
        $nmonth = 1;
        $nyear = $nyear+1;
    }
    $pmonth = $month -1;
    $pyear = $year;
    if ($pmonth < 1) {
        $pmonth = 12;
        $pyear -= 1;
    }
    echo "<a href='bookingView.php?month=".$pmonth."&year=".$pyear."'>previous month</a>";
    echo "<p>".date('F', mktime(0, 0, 0, $month, 10))." ".$year."</p>";
    echo "<a href='bookingView.php?month=".$nmonth."&year=".$nyear."'>next month</a>";
    echo "<input type='text' class='numberOfPlayers' placeholder='Number Of Players' value='1'>";

    if ($stmt = $mysqli->prepare("SELECT price FROM prices WHERE (month=".$month." AND year=".$year.")")) {
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows < 5) {
            $stmt->close();
            //create data for current month
            $days = cal_days_in_month(CAL_GREGORIAN, date('n'), date('Y'));
            for ($i = 0; $i < $days; $i++) {
                for ($j = 0; $j < 24; $j++) {
                    $query = "INSERT INTO `prices` (month, day, hour, price, year) VALUES (".$month.", ".($i+1).", ".($j+1).", 100, ".$year.")";
                    if ($result = $mysqli->query($query)) {
                    } else {
                        echo $query;
                    }
                }
            }
        }
    } else {
        echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
    }
    $stmt = $mysqli->prepare("SELECT id, day, price, hour FROM prices WHERE (month=".$month.")");
    $stmt->execute();
    $stmt->bind_result($id, $day, $price, $hour);
    $d = 1;
    echo "<div class='day'><p>1</p>";
    while ($stmt->fetch()) {
        if ($d == $day) {
            if ($price != -1) {
                echo "<p onclick='checkAvailability(this)' id='".$id."'>time: ".$hour." price: ".$price."</p>";
            }
        } else {
            $d = $day;
            echo "</div>";
            echo "<div class='day'><p>".$day."</p>";
            if ($price != -1) {
                echo "<p onclick='checkAvailability(this)' id='".$id."'>time: ".$hour." price: ".$price."</p>";
            }
        }
    }
} else if (isset($_GET['date']) && isset($_GET['num']) && !isset($_GET['game'])) {
    echo "<h3>Select game</h3>";
    $macines = array();

    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
    if ($stmt = $mysqli->prepare("SELECT id FROM machines")) {
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id);
        while ($stmt->fetch()) {
            $machines[$id] = 1;
        }
    }
    $stmt->close();
    if ($stmt = $mysqli->prepare("SELECT machine_id FROM bookings WHERE time_id= ? ")) {
        $stmt->bind_param('s', $_GET['date']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id);
        while ($stmt->fetch()) {
            //remove from machines
            if (array_key_exists($id, $machines)) {
                $machines[$id] = 0;
            }
        }
    }
    $stmt->close();
    $games = array();
    foreach ($machines as $key => $m) {
        if ($m == 1) {
            if ($stmt = $mysqli->prepare("SELECT game_id FROM game_machines WHERE machine_id = ? ")) {
                $stmt->bind_param('i', $key);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($id);
                while ($stmt->fetch()) {
                    if (array_key_exists($id, $games)) {
                        $games[$id] = $games[$id] + 1;
                    } else {
                        $games[$id] = 1;
                    }
                }
            } else {
                echo "SELECT game_id FROM game_machines WHERE machine_id = ? ";
            }
        }
    }

    foreach ($games as $key => $i) {
        if ($i >= $_GET['num']) {
            $query = "SELECT picture, title FROM games WHERE game_id=".$key;
            if ($result = $mysqli->query($query)) {
                while($row = $result->fetch_assoc()) {
                    echo "<div onclick=\"checkAvailabilityGame(this, '".$key."', '".$_GET['date']."', '".$_GET['num']."')\" class='gameSmall'><img src='".$row['picture']."'><p class='gameTitle'>".$row['title']."</p></div>";
                }
            } else {
                echo $query;
            }
        }
    }
} else if (isset($_GET['date']) && isset($_GET['num']) && isset($_GET['game']) && !isset($_GET['acc'])) {

    // accessories
    echo "<h3>Select accessories</h3>";

    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
    if ($stmt = $mysqli->prepare("SELECT machine_id FROM game_machines WHERE game_id= ? ")) {
        $stmt->bind_param('i', $_GET['game']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id);
        while ($stmt->fetch()) {
            $machines[$id] = 1;
        }
    }
    $stmt->close();
    if ($stmt = $mysqli->prepare("SELECT machine_id FROM bookings WHERE time_id= ? ")) {
        // $query = $_POST['query']."%";
        $stmt->bind_param('s', $_GET['date']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id);
        while ($stmt->fetch()) {
            //remove from machines
            if (array_key_exists($id, $machines)) {
                $machines[$id] = 0;
            }
        }
    }
    $stmt->close();
    $acc = array();
    $found = 0;
    foreach ($machines as $key => $m) {
        if ($m == 1) {
            if ($stmt = $mysqli->prepare("SELECT accessory_id FROM accessories_machines WHERE machine_id = ? ")) {
                $stmt->bind_param('i', $key);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($id);
                while ($stmt->fetch()) {
                    if (array_key_exists($id, $acc)) {
                        $acc[$id] = $acc[$id] + 1;
                    } else {
                        $acc[$id] = 1;
                    }
                }
            } else {
                echo "SELECT game_id FROM game_machines WHERE machine_id = ? ";
            }
        }
    }

    foreach ($acc as $key => $i) {
        if ($i >= $_GET['num']) {
            $query = "SELECT picture, name FROM accessories WHERE id=".$key;
            $found = 1;
            if ($result = $mysqli->query($query)) {
                while($row = $result->fetch_assoc()) {
                    echo "<div onclick=\"prepareBooking(this, '".$_GET['game']."', '".$_GET['date']."', '".$key."', '".$_GET['num']."')\" class='gameSmall'><img src='".$row['picture']."'><p class='gameTitle'>".$row['name']."</p></div>";
                }
            } else {
                echo $query;
            }
        }
    }

    if ($found == 0) {
        echo "<p>There are no available accessories at this time</p>";
    }
    echo "<p onclick=\"prepareBooking(this, '".$_GET['game']."', '".$_GET['date']."', '-1', '".$_GET['num']."')\">Next</p>";
    echo "<p>Want a mentor?</p><input type='checkbox' class='selectMentor' value='mentor'>";
} else if (isset($_GET['date']) && isset($_GET['num']) && isset($_GET['game']) && isset($_GET['acc'])) {
    if (login_check($mysqli) == true) {
    echo "<h3>Confirm</h3>";
        //confirmation site
        $user = htmlentities($_SESSION['username']);
        echo "<p>logged in as: ".$user."</p>";
        echo "<p>Confirm booking:</p>";
        if ($stmt = $mysqli->prepare("SELECT day, hour, month FROM prices WHERE id = ? ")) {
            $stmt->bind_param('i', $_GET['date']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($day, $hour, $month);
            while ($stmt->fetch()) {
                echo "<p>Date: ".$day."/".$month.": ".$hour.":00</p>";
            }
        }
        echo "<p>".$_GET['num']." players</p>";
        if ($stmt = $mysqli->prepare("SELECT title FROM games WHERE game_id = ? ")) {
            $stmt->bind_param('i', $_GET['game']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($title);
            while ($stmt->fetch()) {
                echo "<p>".$title."</p>";
            }
        }
        if ($_GET['acc'] != 0) {
            if ($stmt = $mysqli->prepare("SELECT name FROM accessories WHERE id = ? ")) {
                $stmt->bind_param('i', $_GET['acc']);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($title);
                while ($stmt->fetch()) {
                    echo "<p>Accessory: ".$title."</p>";
                }
            }
        }
        if ($_GET['mentor'] == 'true') {
            echo "<p>With mentor</p>";
        }
        echo "<p onclick=\"confirmBooking(this, '".$_GET['game']."', '".$_GET['date']."', '".$_GET['acc']."', '".$_SESSION['user_id']."', '".$_GET['mentor']."', '".$_GET['num']."')\">Confirm</p>";
    } else {
    echo "<h3>Login</h3>";
    $ur = "bookingView.php?date=".$_GET['date']."&game=".$_GET['game']."&num=".$_GET['num']."&acc=".$_GET['acc'];
    // echo $ur;
    ?>
    <form action="phpModel/loginModel.php" method='post' name='login_form'>
    <div id='username_center'><p>Username: </p></div>
    <input type='text' name='username' placeholder='Username' autocomplete='username' id='username'/>
    <div id='username_center'><p>Password: </p></div>
    <input type='password' name='password' id='password' placeholder='password' autocomplete='current-password'/>
    <input type='submit' value='Login' class='submit' onclick='formhash(this.form, this.form.password);' />
    <?php echo "<input type='hidden' name='red' value='".$ur."'/>"; ?>
    </form>

    <form action='phpModel/registerModel.php' method='post' name='login_form'>
    <div id='username_center'><p>First Name: </p></div>
    <input type='text' name='firstName' id='firstName' placeholder='First Name' autocomplete='firstName'/>
    <div id='username_center'><p>Last Name: </p></div>
    <input type='text' name='lastName' id='lastName' placeholder='Last Name' autocomplete='lastName'/>
    <div id='username_center'><p>Assress: </p></div>
    <input type='text' name='address' placeholder='Address' autocomplete='address' id='address'/>
    <div id='username_center'><p>City: </p></div>
    <input type='text' name='city' placeholder='City' autocomplete='city' id='city'/>
    <div id='username_center'><p>Postal Code: </p></div>
    <input type='text' name='postnr' placeholder='Postal Code' autocomplete='postnr' id='postnr'/>
    <div id='username_center'><p>Email: </p></div>
    <input type='text' name='email' placeholder='Email' autocomplete='email' id='email'/>
    <input type='hidden' name='username' id='username' value='Guest'/>
    <input type='hidden' name='password' id='password' value='F4fffff'/>
    <input type='hidden' name='confirmpwd' id='confirmpwd' value='F4fffff'/>
    <input type='submit' value='Login as guest' class='submit' onclick='return regformhash(this.form, this.form.username,this.form.email,this.form.password,this.form.confirmpwd);' />
    <?php echo "<input type='hidden' name='red' value='".$ur."'/>"; ?>
    </form>
    <?php }
} else if (isset($_GET['confirm'])) {
    ?>

    <p>Booking complete</p>

    <?php
}

 ?>

</div>
</div>
<div id='footer'><p><center>Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>   Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
</div>
</body>
</html>
