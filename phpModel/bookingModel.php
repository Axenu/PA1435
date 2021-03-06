<?php
// get machine id
$machines = array();
$mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
if ($stmt = $mysqli->prepare("SELECT machine_id FROM game_machines WHERE game_id = ? ")) {
    $stmt->bind_param('i', $_POST['game_id']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    while ($stmt->fetch()) {
        $machines[$id] = 1;
    }
}
$stmt->close();
$machine_id = -1;
$ma = array();
if ($_POST['acc_id'] == -1) {
    $ma = $machines;
} else {
    if ($stmt = $mysqli->prepare("SELECT machine_id FROM accessories_machines WHERE accessory_id = ? ")) {
        $stmt->bind_param('i', $_POST['acc_id']);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($id);
        while ($stmt->fetch()) {
            if (array_key_exists($id, $machines)) {
                $ma[$id] = 1;
            }
        }
    }
    $stmt->close();
}
if ($stmt = $mysqli->prepare("SELECT machine_id FROM bookings WHERE time_id = ? ")) {
    $stmt->bind_param('i', $_POST['date_id']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id);
    while ($stmt->fetch()) {
        if (array_key_exists($id, $ma)) {
            $ma[$id] = 0;
        }
    }
}
$stmt->close();

foreach ($ma as $key => $m) {
    if ($m == 1) {
        $machine_id = $key;
        break;
    }
}

if ($machine_id == -1) {
    echo "error, can't book";
    exit();
}
$mentor = $_POST['mentor'];
$num = $_POST['num'];
for ($i = 0; $i < $num; $i++) {
    if ($stmt = $mysqli->prepare("INSERT INTO bookings (user_id, time_id, machine_id, game_id, acc_id, mentor) VALUES( ? , ? , ? , ? , ? , ? ) ")) {
        $stmt->bind_param('iiiiii', $_POST['user_id'], $_POST['date_id'], $machine_id, $_POST['game_id'], $_POST['acc_id'], $mentor);
        $stmt->execute();
    }
    $ma[$machine_id] = 0;
    foreach ($ma as $key => $m) {
        if ($m == 1) {
            $machine_id = $key;
            break;
        }
    }
}
 ?>
