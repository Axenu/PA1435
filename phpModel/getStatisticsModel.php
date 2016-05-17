<?php

if (isset($_POST['action'])) {
    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
    // echo $_POST['month'];
    if ($_POST['action'] == 'date_id') {
        if ($stmt = $mysqli->prepare("SELECT sum FROM prices WHERE month= ? AND day=? AND year=? AND hour=?")) {
            $stmt->bind_param('iiii', $_POST['month'], $_POST['day'], $_POST['year'], $_POST['hour']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($sum);
            $stmt->fetch();
            echo $sum;
            $stmt->close();
        }
    } else if ($_POST['action'] == 'totalIncome') {
        $sumOfAll = 0;
        $games = array();
        if ($stmt = $mysqli->prepare("SELECT id, price FROM prices WHERE sum<=? AND sum >=?")) {
            $stmt->bind_param('ii', $_POST['ssum'], $_POST['lsum']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($date_id, $price);
            $mysql = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
            while($stmt->fetch()) {
                // echo $date_id.", ".$price."\n";
                if ($st = $mysql->prepare("SELECT game_id FROM bookings WHERE time_id=?")) {
                    $st->bind_param('i', $date_id);
                    $st->execute();
                    $st->store_result();
                    $sumOfAll += $st->num_rows * $price;
                    $st->bind_result($game_id);
                    while($st->fetch()) {
                        if (array_key_exists($game_id, $games)) {
                            $games[$game_id] = $games[$game_id] + 1;
                        } else {
                            $games[$game_id] = 1;
                        }
                    }
                    $st->close();
                }
            }
            $stmt->close();
            arsort($games);
            $result = array_slice($games, 0, 30, true);
            echo "<p>Total Income = ".$sumOfAll."</p>";
            echo "<p>Most popular games:</p>";
            foreach ($result as $key => $val) {
                if ($stmt = $mysqli->prepare("SELECT title FROM games WHERE game_id = ?")) {
                    $stmt->bind_param('i', $key);
                    $stmt->execute();
                    $stmt->store_result();
                    $stmt->bind_result($title);
                    $stmt->fetch();
                    echo "<p>".$title.": ".$val."</p>";
                }
            }
            // echo $sumOfAll."\n";
        } else {
            echo $mysqli->error;
        }
    } else if ($_POST['action'] == 'player') {
        if ($stmt = $mysqli->prepare("SELECT id FROM members WHERE username=?")) {
            $stmt->bind_param('s', $_POST['user']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($user_id);
            $stmt->fetch();
            $stmt->close();
            if (isset($user_id)) {
                $stmt = $mysqli->prepare("SELECT game_id, time_id, id FROM bookings WHERE user_id=?");
                $stmt->bind_param('s', $user_id);
                $stmt->execute();
                $stmt->bind_result($game_id, $time_id, $b_id);
                $bookings = array();
                // echo $_POST['user'];
                while($stmt->fetch()) {
                    $bookings[$time_id] = [$game_id, $b_id];
                }
                $stmt->close();
                foreach ($bookings as $key => $val) {
                    $stmt = $mysqli->prepare("SELECT title FROM games WHERE game_id = ".$val[0]);
                    $stmt->execute();
                    $stmt->bind_result($title);
                    while($stmt->fetch()) {
                        echo "<p>".$title.": ";
                    }
                    $stmt->close();
                    $stmt = $mysqli->prepare("SELECT month, day, hour FROM prices WHERE id = ".$key);
                    $stmt->execute();
                    $stmt->bind_result($m, $d, $h);
                    while($stmt->fetch()) {
                        echo $m."/".$d." ".$h.":00</p>";
                    }
                    $stmt->close();
                }
            } else {
                echo "<p>User dows not exist</p>";
            }
        }
    }
}

 ?>
