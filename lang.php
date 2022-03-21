<?php
  $lang = $_GET['lang'];
  setcookie("language", $lang, time() + 604800);
  header("Location: index.php");
 ?>
