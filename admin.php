<?php
  session_start();
  include "common.php";

  if (!isset($_SESSION["user"])) {
  	header("Location: login.php");
  }
  if(!$_SESSION["user"]["admin"]) {
    header("Location: profile.php");
  }
  $users = loadUsers("users.txt");
?>

<!DOCTYPE html>
<html lang='en'>
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
    echo "<tr><thead><tr><th>Title</th><th>Name</th><th>E-mail</th><th>Speaker</th><th>Newsletter</th><th>Level</th><th>Block</th><th>Delete</th></tr></thead>";
    foreach ($users as $user) {
      echo
      "<tr><td>"
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
      . "</td> </tr>";
    }
    ?>
    </table>

  <?php include_once "footer.html"; ?>
</body>
</html>
