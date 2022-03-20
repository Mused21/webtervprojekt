<?php
  session_start();

  if (!isset($_COOKIE["language"])) {
    setcookie("language", "en", time() + 604800);
  }
?>

<!DOCTYPE html>
<html lang= <?php echo($_COOKIE["language"]);?>>

<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <?php include_once "head.html"; ?>
</head>

<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='index.php';

    include_once "nav.php";
  ?>

  <div class="content">
    <?php
      include "language/" . $_COOKIE["language"] . "/indexContent.php";
     ?>

    <?php include_once "footer.php"; ?>
  </div>
</body>

</html>
