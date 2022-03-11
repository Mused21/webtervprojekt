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

  $error = [];
  if (isset($_POST["Change"])) {

    $error = [];

    if((isNotFilled("newPw") || isNotFilled("newPw2")) && $_SESSION["user"]["email"] === $_POST["newEmail"]) {
      $error[] = "You must change either your password or your e-mail.";
    }

    $users = loadUsers("users.txt");
    $currentEmail = $_SESSION["user"]["email"];
    $currentPw = $_SESSION["user"]["pw"];
    if (isFilled("newEmail") && $_SESSION["user"]["email"] !== $_POST["newEmail"]) {
      $currentEmail = $_POST["newEmail"];
      if (!filter_var($currentEmail, FILTER_VALIDATE_EMAIL)) {
        $error[] = "The e-mail is not valid.";
      }
      foreach ($users as $user) {
        if ($user["email"] === $currentEmail) {
          $error[] = "The e-mail is already registered.";
        }
      }
    }

    if (isNotFilled("givenPw") || !password_verify($_POST["givenPw"], $currentPw)) {
      $error[] = "Please provide your current password to change your data.";
    }

    $currentPw = $_POST["givenPw"];

    if (isFilled("newPw") && isFilled("newPw2")) {
      $newPw = $_POST["newPw"];
      $newPw2 = $_POST["newPw2"];
      if (strlen($newPw) < 8) {
        $error[] = "Password must be at least 8 characters long!";
      }

      if ($newPw !== $newPw2) {
        $error[] = "The two given passwords do not match!";
      }
      if (count($error) === 0) {
        $currentPw = $newPw;
      }
    }

    if (count($error) === 0) {
      $currentPw = password_hash($currentPw, PASSWORD_DEFAULT);
      $users[] = ["email" => $currentEmail, "pw" => $currentPw, "name" => $_SESSION["user"]["name"], "title" => $_SESSION["user"]["title"],
      "choice" => $_SESSION["user"]["choice"], "news" => $_SESSION["user"]["news"], "admin" => $_SESSION["user"]["admin"]];

      if ($profile_pic !== "profile_pics/default.png" && $currentEmail !== $_SESSION["user"]["email"]) {
        $extension = strtolower(pathinfo($profile_pic, PATHINFO_EXTENSION));
        $new_profile_pic = "profile_pics/" . $currentEmail . "." . $extension;
        rename($profile_pic, $new_profile_pic);
      }
      saveUsers("users.txt", $users);
      $success = TRUE;
      header("Location: delete.php");
    } else {
      $success = FALSE;
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

    <table>
      <tr>
        <th colspan="2">
          <img id="profilepic" src="<?php echo $profile_pic; ?>" alt="Profile picture"/>
        </th>
      </tr>
      <tr>
        <th colspan="2">
          <form action="profile.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="pic" accept="image/*"/>
            <input type="submit" name="upload-btn" value="Upload a picture"/>
          </form>
        </th>
      </tr>
    </table>
    <form action="" method="POST" enctype="application/x-www-form-urlencoded">
      <table id="profileTable">
        <tr>
          <th>Title:</th>
          <td>
              <?php echo $_SESSION["user"]['title']; ?>
          </td>
        </tr>
        <tr>
          <th>Name:</th>
          <td>
            <?php echo $_SESSION["user"]['name']; ?>
          </td>
        </tr>
        <tr>
          <th>E-mail:</th>
          <td>
            <input type="text" name="newEmail" value="<?php echo $_SESSION["user"]['email']; ?>" placeholder="<?php echo $_SESSION["user"]['email']; ?>"/>
          </td>
        </tr>
        <tr>
          <th>Speaker:</th>
          <td><?php echo ($_SESSION["user"]["choice"] === "speaker" ? "Yes" : "No"); ?></td>
        </tr>
      </table>
      <br />
      <table>
        <tr>
          <td>
            <input type="password" name="newPw" value="" placeholder="New Password"/>
          </td>
        </tr>
        <tr>
          <td>
            <input type="password" name="newPw2" value="" placeholder="New Password Again"/>
          </td>
        </tr>
        <tr>
          <td>
            <input type="password" name="givenPw" value="" placeholder="Current Password"/>
          </td>
        </tr>
        <tr>
          <td>
        <input type="submit" name="Change" value="Change data"/>
          </td>
        </tr>
      </table>
    </form>
      <br />
      <form action="delete.php" method="POST" onsubmit="return confirm('Are you sure?');">
        <input id="deleteProfile" type="submit" name="delete" value="DELETE PROFILE"/>
      </form>
    </div>
    <br />
    <?php
      if (isset($success) && $success === TRUE) {
        echo "<p>Successful data change!</p>";
      } else {
        foreach ($error as $index => $value) {
          if ($index == 0) {
            echo "<hr/>";
            echo '<div class="error">' . $value . "</div>";
          } else {
            echo '<div class="error">' . $value . "</div>";
          }
        }
      }
    ?>
  <?php include_once "footer.html"; ?>
</body>
</html>
