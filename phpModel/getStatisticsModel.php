<?php

if (isset($_POST['action'])) {
    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
    if ($_POST['action'] == 'date_id') {
        if ($stmt = $mysqli->prepare("SELECT id FROM prices WHERE month= ? AND day=? AND year=? AND hour=?")) {
            $stmt->bind_param('iiii', $_POST['month'], $_POST['day'], $_POST['year'], $_POST['hour']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id);
            $stmt->fetch();
            echo $id;
            $stmt->close();
        }
    } else if ($_POST['action'] == 'totalIncome') {
        if ($stmt = $mysqli->prepare("SELECT id FROM prices WHERE month=? AND day=? AND year=? AND hour=?")) {
            $stmt->bind_param('iiii', $_POST['month'], $_POST['day'], $_POST['year'], $_POST['hour']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($id);
            $stmt->fetch();
            echo $id;
            $stmt->close();
        }
    }
}

 ?>
