<?php

$mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
if ($stmt = $mysqli->prepare("DELETE FROM bookings WHERE id=?")) {
    $stmt->bind_param('i', $_POST['b_id']);
    $stmt->execute();
} else {
    // echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
}
$stmt->close();

 ?>
