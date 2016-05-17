<?php

$mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
$title = $_POST['title'];
$content = $_POST['content'];

if ($stmt = $mysqli->prepare("INSERT INTO reviews_game (game_id, title, content, rating, user_id) VALUES (?,?,?,?,?)")) {
    $stmt->bind_param('issii', $_POST['game_id'], $_POST['title'], $_POST['content'], $_POST['rating'], $_POST['user_id']);
    $stmt->execute();
    header('Location: /searchView.php?gameS='.$_POST['game_title']);
} else {
    echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
}
$stmt->close();

 ?>
