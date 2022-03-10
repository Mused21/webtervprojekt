<?php
  session_start();
  include "common.php";

  if (!isset($_SESSION["user"])) {
  	header("Location: login.php");
  }

  $profile_pic = "profile_pics/default.png";
  $path = "profile_pics/" . $_SESSION["user"]["email"];
  $extensions = ["png", "jpg", "jpeg"];

  foreach ($extensions as $extension) {
    if (file_exists($path . "." . $extension)) {
      $profile_pic = $path . "." . $extension;
    }
  }

  if (isset($_POST["upload-btn"]) && is_uploaded_file($_FILES["pic"]["tmp_name"])) {
    $uploadError = "";
    uploadProfilePicture($_SESSION["user"]["email"]);

    $ext = strtolower(pathinfo($_FILES["pic"]["name"], PATHINFO_EXTENSION));
    $path = "profile_pics/" . $_SESSION["user"]["email"] . "." . $ext;

    if ($uploadError === "") {
      if ($path !== $profile_pic && $profile_pic !== "profile_pics/default.png") {
        unlink($profile_pic);
      }
      header("Location: profile.php");
    } else {
      echo "<p>" . $uploadError . "</p>";
    }
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
    <h1>My profile</h1>
      <table id="profileTable">
        <tr>
          <th colspan="2">
            <img id="profilepic" src="<?php echo $profile_pic; ?>" alt="Profile picture"/>
              <form action="profile.php" method="POST" enctype="multipart/form-data">
                <input type="file" name="profile-pic" accept="image/*"/>
                <input type="submit" name="upload-btn" value="Upload a picture"/>
              </form>
          </th>
        </tr>
        <tr>
          <th>Title:</th>
          <td><?php echo $_SESSION["user"]["title"]; ?></td>
        </tr>
        <tr>
          <th>Name:</th>
          <td><?php echo $_SESSION["user"]["name"]; ?></td>
        </tr>
        <tr>
          <th>E-mail:</th>
          <td><?php echo $_SESSION["user"]["email"]; ?></td>
        </tr>
        <tr>
          <th>Speaker:</th>
          <td><?php echo ($_SESSION["user"]["choice"] === "speaker" ? "Yes" : "No"); ?></td>
        </tr>
      </table>
      <br />
      <form action="delete.php" method="POST" onsubmit="return confirm('Are you sure?');">
        <input id="deleteProfile" type="submit" name="delete" value="DELETE PROFILE"/>
      </form>
    </div>
  <?php include_once "footer.html"; ?>
</body>
</html>
