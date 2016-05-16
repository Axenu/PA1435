<?php

$mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
echo $_POST['u_id'];
if ($stmt = $mysqli->prepare("DELETE FROM members WHERE id = ? LIMIT 1")) {
    $stmt->bind_param('i', $_POST['u_id']);
    $stmt->execute();
    $stmt->close();
    include_once 'functions.php';
    sec_session_start();

    $_SESSION = array();

    $params = session_get_cookie_params();

    setcookie(session_name(),
            '', time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]);

    session_destroy();
} else {
  echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
}

 ?>
