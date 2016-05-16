<?php

if (isset($_POST['action'])) {
  if ($_POST['action'] == 'search') {
    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");
    // if ($result = $mysqli->query("SELECT title FROM games WHERE title LIKE '".$_POST['query']."%' LIMIT 5")) {
    //   while ($obj = $result->fetch_object()) {
    //     echo "<p>".$obj->title."</p>";
    //   }
    // }
    if ($stmt = $mysqli->prepare("SELECT title FROM games WHERE title LIKE ? LIMIT 5")) {
        $query = $_POST['query']."%";
        $stmt->bind_param('s', $query);
        $stmt->execute();
        $stmt->bind_result($title);
        while ($stmt->fetch()) {
          echo "<p onclick='showResults(this)'>".$title."</p>";
        }
      } else {
        // echo "SELECT title FROM games WHERE title LIKE '".$_POST['query']."%' LIMIT 5";
      }
  }
}

?>
