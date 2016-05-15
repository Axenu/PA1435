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
<script src='js/jquery.js'></script>
<?php include_once 'searchView.php';
getSeachInclude(); ?>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
<title>Game house book1</title>
</head>
<body>
<div id='header'>
    <?php
    if (login_check($mysqli) == true) {
        ?><p onclick=''><?php echo htmlentities($_SESSION['username']); ?></p><p onlick=''>logg out</p><?php
    } else {
        ?><a href="loginView.php"><center>Login</a><?php
    }

     ?>
<a href='index.php'><h2><center>Game House</center></h2></a>
<div id='SearchField'><center><?php getSearchView(); ?></center></div>
</div>

<a href='loginView.php'>Login</a>

<div id='contain'>
<?php
if (!isset($_GET['game']) && !isset($_GET['date'])) {
    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
    date_default_timezone_set('Europe/Stockholm');

    if ($stmt = $mysqli->prepare("SELECT price FROM prices WHERE (month=".date('n').")")) {
        // $query = $_POST['query']."%";
        // $stmt->bind_param('s', $query);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows < 5) {
            $stmt->close();
            //create data for current month
            $days = cal_days_in_month(CAL_GREGORIAN, date('n'), date('Y'));
            for ($i = 0; $i < $days; $i++) {
                for ($j = 0; $j < 24; $j++) {
                    $query = "INSERT INTO `prices` (month, day, hour, price, year) VALUES (".date('n').", ".($i+1).", ".($j+1).", 100, ".date('Y').")";
                    if ($result = $mysqli->query($query)) {
                    } else {
                        echo $query;
                    }
                }
            }
        }
        $stmt = $mysqli->prepare("SELECT id, day, price, hour FROM prices WHERE (month=".date('n').")");
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
      } else {
        // echo "SELECT title FROM games WHERE title LIKE '".$_POST['query']."%' LIMIT 5";
      }
} else if (isset($_GET['date']) && isset($_GET['num']) && !isset($_GET['game'])) {

    $macines = array();

    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
    if ($stmt = $mysqli->prepare("SELECT id FROM machines")) {
        // $query = $_POST['query']."%";
        // $stmt->bind_param('s', $query);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id);
        while ($stmt->fetch()) {
            $machines[] = $id;
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
            $machines = array_diff($machines, $id);
        }
    }
    $stmt->close();
    $games = array();
    foreach ($machines as $m) {
        if ($stmt = $mysqli->prepare("SELECT game_id FROM game_machines WHERE machine_id = ? ")) {
            // $query = $_POST['query']."%";
            $stmt->bind_param('i', $m);
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

    foreach ($games as $key => $i) {
        if ($i >= $_GET['num']) {
            $query = "SELECT picture, title FROM games WHERE game_id=".$key;
            if ($result = $mysqli->query($query)) {
                while($row = $result->fetch_assoc()) {
                    echo "<div onclick=\"checkAvailabilityGame(this, '".$key."', '".$_GET['date']."')\" class='gameSmall'><img src='".$row['picture']."'><p class='gameTitle'>".$row['title']."</p></div>";
                }
            } else {
                echo $query;
            }
        }
    }
} else if (isset($_GET['date']) && isset($_GET['num']) && isset($_GET['game']) && !isset($_GET['acc'])) {

    // $macines = array();

    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
    if ($stmt = $mysqli->prepare("SELECT machine_id FROM game_machines WHERE game_id= ? ")) {
        $stmt->bind_param('i', $_GET['game']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id);
        while ($stmt->fetch()) {
            $machines[] = $id;
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
            $machines = array_diff($machines, $id);
        }
    }
    $stmt->close();
    $acc = array();
    foreach ($machines as $m) {
        if ($stmt = $mysqli->prepare("SELECT accessory_id FROM accessories_machines WHERE machine_id = ? ")) {
            $stmt->bind_param('i', $m);
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

    foreach ($acc as $key => $i) {
        if ($i >= $_GET['num']) {
            $query = "SELECT picture, name FROM accessories WHERE id=".$key;
            if ($result = $mysqli->query($query)) {
                while($row = $result->fetch_assoc()) {
                    echo "<div onclick=\"prepareBooking(this, '".$_GET['game']."', '".$_GET['date']."', '".$key."')\" class='gameSmall'><img src='".$row['picture']."'><p class='gameTitle'>".$row['name']."</p></div>";
                }
            } else {
                echo $query;
            }
        }
    }
} else if (isset($_GET['date']) && isset($_GET['num']) && isset($_GET['game']) && isset($_GET['acc'])) {
    if (login_check($mysqli) == true) {
        //confirmation site
        $user = htmlentities($_SESSION['username']);
        echo "<p>logged in as: ".$user."</p>";
        echo "<p>Confirm booking:</p>";
        echo "<p>datePHP</p>";
        echo "<p>numplayersPHP</p>";
        echo "<p>gamePHP</p>";
        echo "<p>accPHP</p>";
        echo "<p>mentorPHP</p>";
        echo "<p onclick='confirmBookingthis, '".$_GET['game']."', '".$_GET['date']."', '".$_GET['acc']."')'>Confirm</p>";
    } else {
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

    <!-- <form action='phpModel/loginModel.php' method='post' name='login_form'>
    <div id='username_center'><p>First Name: </p></div>
    <input type='fName' name='fName' id='fName' placeholder='First Name' autocomplete='fName'/>
    <div id='username_center'><p>Last Name: </p></div>
    <input type='lName' name='lName' id='lName' placeholder='Last Name' autocomplete='lName'/>
    <div id='username_center'><p>Assress: </p></div>
    <input type='text' name='address' placeholder='Address' autocomplete='address' id='address'/>
    <div id='username_center'><p>City: </p></div>
    <input type='text' name='city' placeholder='City' autocomplete='city' id='city'/>
    <div id='username_center'><p>Postal Code: </p></div>
    <input type='text' name='pcode' placeholder='Postal Code' autocomplete='pcode' id='pcode'/>
    <div id='username_center'><p>Email: </p></div>
    <input type='text' name='email' placeholder='Email' autocomplete='email' id='email'/>
    <input type='submit' value='Login as guest' class='submit' onclick='' /> -->
    <!-- <?php echo "<input type='hidden' name='red' value='".$ur."'/>"; ?> -->
    <!-- </form> -->
    <?php }
}

 ?>

</div>

<div id='footer'><p><center>Blekinge Institute of Technology  <b>|</b>  2016  <b>|</b>  PA1435, Objektorientad Programmering  <b>|</b>   Alfons Dahl, Simon Nilsson, Filip Pentikäinen</center><p>
</div>
</body>
</html>
