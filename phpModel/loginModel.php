<?php

include_once 'functions.php';
sec_session_start();

if (isset($_POST['username'], $_POST['p'])) {
    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
    // sec_session_start();
    $email = $_POST['username'];
    $password = $_POST['p']; // The hashed password.
    if (login($email, $password, $mysqli) == true) {
        // Login success
        // echo $_SESSION['username'];
        if (isset($_POST['red'])) {
            // echo $_SESSION['username'];
            header('Location: ../'.$_POST['red']);
        } else {
            header('Location: ../index.php');
        }
    } else {
        // Login failed
        if (isset($_POST['red'])) {
            header('Location: ../'.$_POST['red'].'&error=1');
        } else {
            header('Location: ../loginView.php?error=1');
        }
    }
}

        // echo $_POST['red'];
        // if (!isset($_POST['username'])) {
        //     // echo "username not set";
        // } else if (!isset($_POST['p'])) {
        //     // echo "p not set";
        // }
        // The correct POST variables were not sent to this page.
        // echo 'Invalid Request';
    // }
// }
?>
