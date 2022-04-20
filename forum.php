<?php
    session_start();
    include "common.php";

    $comments = array_reverse(loadComments());

    if (isset($_POST["send-comment"])) {
      $errors = [];
      $name = $_SESSION["user"]["name"];
      $email = $_SESSION["user"]["email"];

      if (!isset($_POST["text"]) || trim($_POST["text"]) === "") {
        $errors[] = "Error: No character detected";
      }
      if (strlen($_POST["text"]) > 350) {
        $errors[] = "Error: Max 350 characters";
      }
      $time = new DateTime();
      $time->setTimezone(new DateTimeZone("Europe/Budapest"));
      $comment = trim($_POST["text"]);
      if (count($errors) === 0) {
        $newComment[] = ["email" => $email, "name" => $name, "time" => $time, "comment" => $comment];
        $comments[] = $newComment;
        saveComments($comments);
      }
      else foreach ($errors as $i) {
          echo '<div class="error">' . $i . $_POST["text"] . "</div>" ;
        }
    }
  ?>

<!DOCTYPE html>
<html lang= <?php echo($_COOKIE["language"]);?>>
<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <link rel="stylesheet" type="text/css" media="all" href="css/forum.css" />
  <?php include_once "head.html"; ?>
</head>
<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='forum.php';
    include_once "nav.php";
  ?>
  <div class="content">
    <h1>Comments:</h1>
    <?php  if (count($comments) === 0) { ?>
      <p>No comments... Silence is sometimes the best answer...</p>
    <?php } else { ?>
      <?php foreach ($comments as &$comment) { ?>
        <div class="commentBox">
          <img src="<?php
                $profile_pic = "profile_pics/default.png";
                $path = "profile_pics/" . $comment[0]["email"];
                $extensions = ["png", "jpg", "jpeg"];
                foreach ($extensions as $extension) {
                  if (file_exists($path . "." . $extension)) {
                    $profile_pic = $path . "." . $extension;
                  }
                }
                echo $profile_pic; ?>" alt="profilepic" class="profilePic"/>

          <div class="time"><?php echo ($comment[0]["time"]->format('Y-m-d H:i:s')); ?></div>
          <?php $replacedName = str_replace(' ', '%20', $comment[0]["name"]);?>
          <a href="profileX.php?who=<?php echo $replacedName?>"><div class="name"><b> <?php echo $comment[0]["name"]; ?></b></div></a>
          <div class="commentText"><?php echo ($comment[0]["comment"]); ?></div>
        </div>
      <?php } ?>
    <?php } ?>
    <!--new comment-->
    <?php if (isset($_SESSION["user"])) { ?>
      <div class="yourComment">
        <br>
        <h2><b>Your <del>blabla</del> deeply respected comment:</b></h2>
        <form class="commentForm" action="forum.php" method="POST">
          <textarea name="text" rows="8" cols="60" maxlength="400" required=""></textarea>
          <br/>
          <input type="submit" name="send-comment" value="Send comment" id="commentButton"/>
        </form>
      </div>
    <?php } ?>
  </div>
  <?php include_once "footer.php"; ?>
</body>
</html>
