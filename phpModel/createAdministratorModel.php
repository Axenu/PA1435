<?php

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $first_name = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $last_name = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $postnr = filter_input(INPUT_POST, 'postnr', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
        $birth = filter_input(INPUT_POST, 'birth', FILTER_SANITIZE_STRING);
        $perm = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);

        $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_msg .= '<p class="error">The email address you entered is not valid</p>';
        }
        if (strlen($password) != 128) {
            $error_msg .= '<p class="error">Invalid password configuration.</p>';
        }
        $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
        $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
        $stmt = $mysqli->prepare($prep_stmt);
        if ($stmt) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $error_msg .= '<p class="error">A user with this email address already exists.</p>';
                            $stmt->close();
            } else {
              $stmt->close();
            }
        } else {
            $error_msg .= '<p class="error">Database error Line 39</p>';
                    $stmt->close();
        }
        $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
        $stmt = $mysqli->prepare($prep_stmt);

        if ($stmt) {
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                    $error_msg .= '<p class="error">A user with this username already exists</p>';
                    $stmt->close();
            } else {
              $stmt->close();
            }
        } else {
                $error_msg .= '<p class="error">Database error line 55</p>';
                $stmt->close();
        }
        if (empty($error_msg)) {
            $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
            $ppp = $password;
            $password = hash('sha512', $password . $random_salt);
            if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt, first_name, last_name, address, city, postalcode, birthdate, permissions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
                $insert_stmt->bind_param('ssssssssiii', $username, $email, $password, $random_salt, $first_name, $last_name, $address, $city, $postnr, $birth, $perm);
                if (!$insert_stmt->execute()) {
                    echo "failed with query";
                }
                $insert_stmt->close();
            } else {
              echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
            }
            header('Location: /createAdministratorView.php');
      	} else {
          echo $error_msg;
        }
    } else if ($_POST['action'] == 'edit') {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
        $first_name = filter_input(INPUT_POST, 'firstName', FILTER_SANITIZE_STRING);
        $last_name = filter_input(INPUT_POST, 'lastName', FILTER_SANITIZE_STRING);
        $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $postnr = filter_input(INPUT_POST, 'postnr', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $u_id = filter_input(INPUT_POST, 'u_id', FILTER_SANITIZE_STRING);
        $birth = filter_input(INPUT_POST, 'birth', FILTER_SANITIZE_STRING);
        $perm = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_STRING);
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
                if ($insert_stmt = $mysqli->prepare("UPDATE members SET username=?, email=?, password=?, first_name=?, last_name=?, address=?, city=?, postalcode=?, birthdate=?, permissions=? WHERE id = ? ")) {
                    $insert_stmt->bind_param('sssssssiiii', $username, $email, $password, $first_name, $last_name, $address, $city, $postnr, $birth, $perm, $u_id);
                    if (! $insert_stmt->execute()) {
                        echo "INSERT INTO members (username, email, password, salt, first_name, last_name, address, city, postalcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    }
                    $insert_stmt->close();
                    header('Location: /createAdministratorView.php');
                } else {
                  echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
                }
            } else {
                if ($insert_stmt = $mysqli->prepare("UPDATE members SET username=?, email=?, first_name=?, last_name=?, address=?, city=?, postalcode=?, birthdate=?, permissions=? WHERE id = ? ")) {
                    $insert_stmt->bind_param('ssssssiiii', $username, $email, $first_name, $last_name, $address, $city, $postnr, $birth, $perm, $u_id);
                    if (! $insert_stmt->execute()) {
                        echo "INSERT INTO members (username, email, salt, first_name, last_name, address, city, postalcode) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    }
                    $insert_stmt->close();
                    header('Location: /createAdministratorView.php');
                } else {
                  echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
                }
            }
      	} else {
          echo $error_msg;
        }
    } else if ($_POST['action'] == 'getInfo') {
    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
        if ($stmt = $mysqli->prepare("SELECT username, email, permissions, first_name, last_name, address, city, postalcode, birthdate FROM members WHERE id=? LIMIT 1")) {
            // echo $_POST['user_id']." user\n";
            $stmt->bind_param('s', $_POST['user_id']);
            $stmt->execute();
            $stmt->store_result();
            $stmt->bind_result($username, $email, $perm, $fname, $lname, $address, $city, $pcode, $birth);
            $stmt->fetch();
            $result = array("username"=>$username,"email"=>$email,"perm"=>$perm,"fname"=>$fname,"lname"=>$lname,"address"=>$address,"city"=>$city,"pcode"=>$pcode,"birth"=>$birth);
            echo json_encode($result, JSON_PRETTY_PRINT);
        }
    } else if ($_POST['action'] == 'delete') {
        $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
        if ($stmt = $mysqli->prepare("DELETE FROM members WHERE id= ?")) {
            $stmt->bind_param('i', $_POST['user_id']);
            $stmt->execute();
        } else {
            echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
        }
        $stmt->close();
    }
}


?>
