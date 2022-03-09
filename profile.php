<?php
  session_start();
  if (isset($_POST["Logout"])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
  }

  if (isset($_FILES["pic"])) {
    $path = "profile_pics/" . $_FILES["pic"]["name"];
    if (move_uploaded_file($_FILES["pic"]["tmp_name"], $path)) {
      echo "Profile picture: " .  $_FILES["pic"]["name"] . " uploaded!";
    } else {
      echo "Fail!";
    }
  }
    //később: a képet el kell nevezni az userről, mert igy fals lesz a felulrás. mondjuk meghívni se lehet random képeket.
    //később pl. méret limit bevezetése pl
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <link rel="stylesheet" type="text/css" media="all" href="css/pictures.css" />
    <link rel="stylesheet" type="text/css" media="all" href="css/registration.css" />
  <?php include_once "head.html"; ?>
</head>
<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='profile.php';
    include_once "nav.php";
  ?>
  <div class="content">
    <h1>My profile</h1>
    <p class="content">
      <a><img id="pic" src="media/profile-pic.svg" alt="pic"></a>
      <br>
      <form class="" method="POST" enctype="multipart/form-data">

      <input type="file" name="pic" value="Upload" accept="image/*"/>
      <br>
      <input type="submit" name="upload-button" value="Upload" />
      </form>
      <br>
      <?php
        echo ("session_id: " . session_id()) . "<br>";
        echo ("Name: " . $_SESSION["user"]["name"] . "<br>") ;
        echo ("Password: " . $_SESSION["user"]["pw"] . "<br>") ;
      ?>
    </p>
    <form class="" method="POST" enctype="application/x-www-form-urlencoded">
    <input type="submit" name="Logout" value="Log out" />
    </form>
    </div>
  <?php include_once "footer.html"; ?>
</body>
</html>
