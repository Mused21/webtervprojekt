<?php
  session_start();
?>
<!DOCTYPE html>
<html lang= <?php echo($_COOKIE["language"]);?>>

<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <link rel="stylesheet" type="text/css" media="all" href="css/contact.css" />
  <?php include_once "head.html"; ?>
</head>

<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='contact.php';
    include_once "nav.php";
  ?>

  <div class="content">
    <?php
      include "language/" . $_COOKIE["language"] . "/contactContent.php";
     ?>
<?php include_once "footer.php"; ?>
  </div>
</body>

</html>
