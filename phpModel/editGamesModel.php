<?php

$mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $title = $_POST['title'];
        $description= $_POST['description'];

        echo $_POST['title'];
        echo $_POST['description'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
// ile ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        if ($stmt = $mysqli->prepare("INSERT INTO games (title, description, picture) VALUES (?, ?, ?)")) {
            $stmt->bind_param('sss', $title, $description, $target_file);
            $stmt->execute();
        } else {
            echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
        }
        $stmt->close();
        header('Location: /editGamesView.php');
    } else if ($_POST['action'] == 'edit') {
        $title = $_POST['title'];
        $description= $_POST['description'];

        if ($stmt = $mysqli->prepare("UPDATE games SET title=?, description=? WHERE game_id= ?")) {
            $stmt->bind_param('ssi', $title, $description, $_POST['game_id']);
            $stmt->execute();
        } else {
            echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
        }
        $stmt->close();

    } else if ($_POST['action'] == 'delete') {
        if ($stmt = $mysqli->prepare("DELETE FROM games WHERE game_id= ?")) {
            $stmt->bind_param('i', $_POST['game_id']);
            $stmt->execute();
        } else {
            echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
        }
        $stmt->close();
        header('Location: /editGamesView.php');
    } else if ($_POST['action'] == 'selectMachines') {
        $users = array();
        if ($stmt = $mysqli->prepare("SELECT name, id FROM machines")) {
            // $stmt->bind_param('i', $title);
            $stmt->execute();
            $stmt->bind_result($machine_title, $machine_id);
            while($stmt->fetch()) {
                $users[$machine_id] = $machine_title;
            }
        } else {
            echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
        }
        echo "<h3>Machines for selected game</h3>";
        $stmt->close();
        foreach ($users as $key => $val) {
            if ($stmt = $mysqli->prepare("SELECT id FROM game_machines WHERE machine_id=? AND game_id=?")) {
                $stmt->bind_param('ii', $key, $_POST['game_id']);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    echo "<p>".$val."<input type='checkbox' value='".$key."' checked='true' id='checkMachine' onclick='changeValueOf(this)'></p>";
                } else {
                    echo "<p>".$val."<input type='checkbox' value='".$key."' id='checkMachine' onclick='changeValueOf(this)'></p>";
                }
            } else {
                echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
            }
            $stmt->close();
        }

    } else if ($_POST['action'] == 'changeValue') {
        if ($_POST['checked'] == 'false') {
            // echo $_POST['game_id'].", remove ". $_POST['machine_id'];
            if ($stmt = $mysqli->prepare("DELETE FROM game_machines WHERE game_id=? AND machine_id=?")) {
                $stmt->bind_param('ii', $_POST['game_id'], $_POST['machine_id']);
                $stmt->execute();
                // $stmt->bind_result($machine_title, $machine_id);
                // while($stmt->fetch()) {
                    // $users[$machine_id] = $machine_title;
                // }
            } else {
                echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
            }
        } else {
            // echo $_POST['game_id'].", add ". $_POST['machine_id'];
            if ($stmt = $mysqli->prepare("INSERT INTO game_machines (game_id, machine_id) VALUES (?, ?)")) {
                $stmt->bind_param('ii', $_POST['game_id'], $_POST['machine_id']);
                $stmt->execute();
                // $stmt->bind_result($machine_title, $machine_id);
                // while($stmt->fetch()) {
                    // $users[$machine_id] = $machine_title;
                // }
            } else {
                echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
            }
        }
    } else if ($_POST['action'] == 'addMachine') {
        // echo $_POST['game_id'].", remove ". $_POST['machine_id'];
        if ($stmt = $mysqli->prepare("INSERT INTO machines (name, description, type) VALUES (?, ?, ?)")) {
            $stmt->bind_param('sss', $_POST['title'], $_POST['description'], $_POST['type']);
            $stmt->execute();
            // $stmt->bind_result($machine_title, $machine_id);
            // while($stmt->fetch()) {
                // $users[$machine_id] = $machine_title;
            // }
        } else {
            echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
        }
        header('Location: /editGamesView.php');
    } else if ($_POST['action'] == 'displayDelete') {
        echo "<h3>Select machine to remove</h3>";
        if ($stmt = $mysqli->prepare("SELECT name, id FROM machines")) {
            $stmt->execute();
            $stmt->bind_result($machine_title, $machine_id);
            while($stmt->fetch()) {
                echo "<p id='".$machine_id."' onclick='deleteMachine(this)'>".$machine_title."</p>";
            }
        } else {
            echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
        }
    } else if ($_POST['action'] == 'deleteMachine') {
        if ($stmt = $mysqli->prepare("DELETE FROM machines WHERE id=?")) {
            $stmt->bind_param('i', $_POST['machine_id']);
            $stmt->execute();
        } else {
            echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
        }
        $stmt->close();
        if ($stmt = $mysqli->prepare("DELETE FROM game_machines WHERE machine_id=?")) {
            $stmt->bind_param('i', $_POST['machine_id']);
            $stmt->execute();
        } else {
            echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
        }
        $stmt->close();
    }
}

 ?>
