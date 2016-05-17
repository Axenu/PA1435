<?php

$mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");

if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        $title = $_POST['title'];
        $description= $_POST['description'];

        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
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
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
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
    }
    header('Location: /editGamesView.php');
}

 ?>
