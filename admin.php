<?php
  session_start();
  include "common.php";

  if (!isset($_SESSION["user"])) {
  	header("Location: login.php");
  }
  if(!$_SESSION["user"]["admin"]) {
    header("Location: profile.php");
  }
?>

<!DOCTYPE html>
<html lang='en'>
<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <link rel="stylesheet" type="text/css" media="all" href="css/profile.css" />
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

  <?php include_once "footer.html"; ?>
</body>
</html>
