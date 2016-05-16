<?php

$error_msg = "";
if (isset($_POST['username'], $_POST['email'], $_POST['p'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $first_name = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
    $postnr = filter_input(INPUT_POST, 'postnr', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $u_id = filter_input(INPUT_POST, 'u_id', FILTER_SANITIZE_STRING);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    // if (strlen($password) != 128) {
    //     $error_msg .= '<p class="error">Invalid password configuration.</p>';
    // }

    if (strlen($username) < 2) {
        $error_msg .= '<p class="error">Too short username</p>';
    }
    if (strlen($email) < 2) {
        $error_msg .= '<p class="error">Too short email</p>';
    }
    if (strlen($first_name) < 2) {
        $error_msg .= '<p class="error">Too short first name</p>';
    }
    if (strlen($last_name) < 2) {
        $error_msg .= '<p class="error">Too short last name</p>';
    }
    if (strlen($address) < 2) {
        $error_msg .= '<p class="error">Too short address</p>';
    }
    if (strlen($city) < 2) {
        $error_msg .= '<p class="error">Too short city</p>';
    }

    if (empty($error_msg)) {

        $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
        if ($stmt = $mysqli->prepare("SELECT salt FROM members WHERE id = ? LIMIT 1")) {
            $stmt->bind_param('i', $u_id);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($salt);
            $stmt->fetch();
        }

        if (strlen($password == 128)) {
            $ppp = $password;
            $password = hash('sha512', $password . $salt);
            if ($insert_stmt = $mysqli->prepare("UPDATE members SET username=?, email=?, password=?, first_name=?, last_name=?, address=?, city=?, postalcode=? WHERE id = ? ")) {
                $insert_stmt->bind_param('sssssssii', $username, $email, $password, $first_name, $last_name, $address, $city, $postnr, $u_id);
                if (! $insert_stmt->execute()) {
                    echo "INSERT INTO members (username, email, password, salt, first_name, last_name, address, city, postalcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                }
                $insert_stmt->close();
                header('Location: /userView.php');
            } else {
              echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
            }
        } else {
            if ($insert_stmt = $mysqli->prepare("UPDATE members SET username=?, email=?, first_name=?, last_name=?, address=?, city=?, postalcode=? WHERE id = ? ")) {
                $insert_stmt->bind_param('ssssssii', $username, $email, $first_name, $last_name, $address, $city, $postnr, $u_id);
                if (! $insert_stmt->execute()) {
                    echo "INSERT INTO members (username, email, salt, first_name, last_name, address, city, postalcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                }
                $insert_stmt->close();
                header('Location: /userView.php');
            } else {
              echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
            }
        }
  	} else {
      echo $error_msg;
    }
}

?>
