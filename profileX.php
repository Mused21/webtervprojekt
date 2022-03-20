<?php
  session_start();
  include "common.php";

  if (!isset($_SESSION["user"])) {
  	header("Location: login.php");
  }
  $who = $_GET['who'];

  if (findEmailByName($who) === Null)   echo (header("Location: profileNull.php?who= ". $who));


  $profile_pic = "profile_pics/default.svg";
  $path = "profile_pics/" . findEmailByName($who);
  $extensions = ["png", "jpg", "jpeg"];
  foreach ($extensions as $extension) {
    if (file_exists($path . "." . $extension)) {
      $profile_pic = $path . "." . $extension;
    }
  }
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
    <h2><?php echo ($who. "'s") ?> profile</h2>
    <br />
    <table id=picTable>
      <tr>
        <th colspan="2">
          <img id="profilepic" src="<?php echo $profile_pic; ?>" alt="Profile picture"/>
        </th>
      </tr>
    </table>

      <table id="profileTable">
        <tr>
          <th>Title:</th>
          <td><?php echo findUserByName($who)['title']; ?></td>
        </tr>
        <tr>
          <th>Name:</th>
          <td><?php echo findUserByName($who)['name']; ?></td>
        </tr>

        <tr>
          <th>E-mail:</th>
          <td><?php echo findUserByName($who)['email']; ?></td>
        </tr>
        <tr>
          <th>Speaker:</th>
          <td><?php echo findUserByName($who)['choice'] === "speaker" ? "Yes" : "No"; ?></td>
        </tr>
      </table>
    <br />

  <?php include_once "footer.php"; ?>
</body>
</html>
