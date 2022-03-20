<?php
  session_start();
  include "common.php";

  $who = $_GET['who'];
  if ($who === NULL)   header("Location: profileNull.php");
?>

<!DOCTYPE html>
<html lang= <?php echo($_COOKIE["language"]);?>>
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
    <h2><?php echo ($who. ": ") ?>Deleted profile</h2>

  <?php include_once "footer.php"; ?>
</body>
</html>
