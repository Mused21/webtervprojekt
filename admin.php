<?php
  session_start();
  include "common.php";

  if (!isset($_SESSION["user"])) {
  	header("Location: login.php");
  }

  if(!$_SESSION["user"]["admin"]) {
    header("Location: profile.php");
  }
  $users = loadUsers();

  if (isset($_POST["block"])) {
    blockUser(findUserByEmail($_POST["block"]));
    echo "<meta http-equiv='refresh' content='0'>";
  }

  if (isset($_POST["unblock"])) {
    unblockUser(findUserByEmail($_POST["unblock"]));
    echo "<meta http-equiv='refresh' content='0'>";
  }

  if (isset($_POST["deleteUser"])) {
    deleteUser(findUserByEmail($_POST["deleteUser"]));
    echo "<meta http-equiv='refresh' content='0'>";
  }

?>

<!DOCTYPE html>
<html lang= <?php echo($_COOKIE["language"]);?>>
<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <link rel="stylesheet" type="text/css" media="all" href="css/admin.css" />
  <?php include_once "head.html"; ?>
</head>
<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='profile.php';
    include_once "nav.php";
  ?>
  <div class="content">
    <h1>Control room</h1>

    <table>
    <?php
    $extensions = ["png", "jpg", "jpeg"];
    echo "<tr><thead><tr><th>Picture</th><th>Title</th><th>Name</th><th>E-mail</th><th>Speaker</th><th>Newsletter</th><th>Level</th><th>Block</th><th>Delete</th></tr></thead>";
    foreach ($users as $user) {
      $path = "profile_pics/" . $user["email"];
      $profile_pic = "profile_pics/default.png";
      foreach ($extensions as $extension) {
        if (file_exists($path . "." . $extension)) {
          $profile_pic = $path . "." . $extension;
        }
      }
      echo
      "<tr><td>"
      . "<img class='profilepic' src='" . $profile_pic . "'/>"
      . "</td><td>"
      . $user['title']
      . "</td><td>"
      . $user['name']
      . "</td><td>"
      . $user['email']
      . "</td><td>"
      . ($user['choice'] === 'speaker' ? 'yes' : 'no')
      . "</td><td>"
      . ($user['news'] === 'yes' ? 'yes' : 'no')
      . "</td><td>"
      . ($user['admin'] ? 'admin' : 'user')
      . "</td><td>"
      . ($user['admin'] ? '-' : ($user['block'] ?
      "<form action='' method='POST'>"
      .
      "<input type='hidden' name='unblock' value='" . $user['email'] . "'/>"
      .
      "<input class='greencheck' type='image' src='media/greencheckmark.png' />"
      .
      "</form>" :
      "<form action='admin.php' method='POST'>"
      .
      "<input type='hidden' name='block' value='" . $user['email'] . "'/>"
      .
      "<input class='redcross' type='image' src='media/redcross.png' />"
      .
      "</form>"
      ))
      . "</td><td>"
      . ($user['admin'] ? '-' :
      "<form action='admin.php' method='POST'>"
      .
      "<input type='hidden' name='deleteUser' value='" . $user['email'] . "'/>"
      .
      "<input class='redcross' type='image' src='media/redcross.png' /> </form>")
      . "</td> </tr>";
    }

    ?>
    </table>

  <?php include_once "footer.php"; ?>
</body>
</html>
