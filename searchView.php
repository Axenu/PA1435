<?php
function getSeachInclude() {
  echo '<script type="text/JavaScript" src="js/searchModel.js"></script>';
}

function getSearchView() {
  echo "<input class='searchBar' type='text' name='search' placeholder='Search' onkeyup='searchStringChnged(event)'>";
  echo "<div class='searchResulContainer'> </div>";
}

if (isset($_GET['query'])) {
  //display results

  include_once 'header.php';

    $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");

    if ($stmt = $mysqli->prepare("SELECT title, picture FROM games WHERE title LIKE ? LIMIT 5")) {
        $query = $_GET['query']."%";
        $stmt->bind_param('s', $query);
        $stmt->execute();
        $stmt->bind_result($title, $picture);
        while ($stmt->fetch()) {
            echo "<div onclick='SelectGame(this)' class='gameSmall'><h3>".$title."</h3><img class='gamepic_menu' src='".$picture."'>";
        }
    } else {
          echo "SELECT title, picture FROM games WHERE title LIKE '".$_GET['query']."%' LIMIT 5";
    }
    include_once 'footer.php';

} else if (isset($_GET['gameS'])) {
  //display game page

  include_once 'header.php';

  $mysqli = new mysqli('localhost', "loadData", "yrEqRKBGvRHsBZ3P", "game_house");

  if ($stmt = $mysqli->prepare("SELECT game_id, title, description, picture, rating FROM games WHERE title LIKE ? LIMIT 5")) {
      $query = $_GET['gameS'];
      $stmt->bind_param('s', $query);
      $stmt->execute();
      $stmt->bind_result($game_id, $title, $desc, $picture, $rating);
      while ($stmt->fetch()) {
          echo "<h1 class='gametitle'>".$title."</h1>";
          echo "<img class='gamepic' src='".$picture."'>";
          echo "<div id='gamedesc'><p>".$desc."</p></div>";
          echo "<div id='gamedescrating'><p>Rating: ".$rating."</p></div>";
      }
  } else {
        echo "SELECT title, description, picture, rating FROM games WHERE title LIKE '".$_GET['game']."%' LIMIT 5";
  }
  $stmt->close();
  if ($stmt = $mysqli->prepare("SELECT title, content, rating FROM reviews_game WHERE game_id=? LIMIT 5")) {
      $stmt->bind_param('i', $game_id);
      $stmt->execute();
      $stmt->bind_result($r_title, $r_desc, $r_rating);
      while ($stmt->fetch()) {
          echo "<div class='review'>\n";
          echo "<h3 class='reviewTitle'>".$r_title."</h3>\n";
          echo "<p class='reviewRating'>".$r_rating."</p>\n";
          echo "<p class='reviewContent'>".$r_desc."</p>\n";
          echo "</div>\n";
      }
  } else {
        echo 'errno: %d, error: %s'. $mysqli->errno, $mysqli->error;
  }
  $stmt->close();
  ?>
  <div id="WriteReview">
  <form action="phpModel/writeReview.php" method="post" name="login_form">

    <h3>Write Review</h3>
         <p>Title: </p>
        <input type="text" name="title" placeholder="Title" autocomplete="title" id="title"/>
        <p>Content: </p>
        <textarea type="text" rows="5" name="content" id="content" placeholder="Content" autocomplete="content"></textarea>
                <p>Rating (0-5): </p>
         <input type="text" name="rating" id="rating" placeholder="Rating" autocomplete="rating"/>
         <input type='hidden' name='game_id' value='<?php echo $game_id; ?>'/>
         <input type='hidden' name='game_title' value='<?php echo $title; ?>'/>
         <input type='hidden' name='user_id' value='
         <?php if (login_check($mysqli) == true) { echo $_SESSION['user_id']; } else {echo '-1';}?>
         '/>
         <input type="submit" value="Login" class="submit"/>
     </form>
   </div>
     <?php
  include_once 'footer.php';
}

?>
