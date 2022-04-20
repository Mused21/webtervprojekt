<?php
  session_start();
  include "common.php";

  if (!isset($_SESSION["user"])) {
  	header("Location: login.php");
  }

  if (isset($_POST["reveal"])) {
    revealUserEmail($_SESSION["user"]);
    echo "<meta http-equiv='refresh' content='0'>";
  }

  if (isset($_POST["hide"])) {
    hideUserEmail($_SESSION["user"]);
    echo "<meta http-equiv='refresh' content='0'>";
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

    $users = loadUsers();
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
      "choice" => $_SESSION["user"]["choice"], "news" => $_SESSION["user"]["news"], "admin" => $_SESSION["user"]["admin"], "block" => $_SESSION["user"]["block"], "hidden" => $_SESSION["user"]["hidden"]];

      if ($profile_pic !== "profile_pics/default.png" && $currentEmail !== $_SESSION["user"]["email"]) {
        $extension = strtolower(pathinfo($profile_pic, PATHINFO_EXTENSION));
        $new_profile_pic = "profile_pics/" . $currentEmail . "." . $extension;
        rename($profile_pic, $new_profile_pic);
      }
      saveUsers($users);
      $success = TRUE;
      if ($currentEmail == $_SESSION["user"]["email"]) {
        deleteUserWithoutProfilePic($_SESSION["user"]);
        session_unset();
        session_destroy();
        header("Location: login.php");
      } else {
        header("Location: delete.php");
      }
    } else {
      $success = FALSE;
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
    <h1>My profile</h1>
    <?php
    if ($_SESSION["user"]["admin"]) {
      echo '<form action="admin.php">
              <input id="adminButton" type="submit" value="Admin Room"/>
            </form>';
    }
     ?>
    <br />
    <table id=picTable>
      <tr>
        <th>
          <img id="profilepic" src="<?php echo $profile_pic; ?>" alt="Profile picture"/>
        </th>
      </tr>
      <tr>
        <th>
          <form action="profile.php" method="POST" enctype="multipart/form-data">
            <input type="file" id="picture" class="hidden" name="pic" accept="image/*"/>
            <label for="picture">Click to select picture</label>
            <input type="submit" name="upload-btn" value="Upload a picture" id="uploadButton"/>
          </form>
        </th>
      </tr>
    </table>

    <form action="#" method="POST" enctype="application/x-www-form-urlencoded">
      <table id="profileTable">
        <tr>
          <th>Title:</th>
          <td><?php echo $_SESSION["user"]['title']; ?></td>
        </tr>
        <tr>
          <th>Name:</th>
          <td><?php echo $_SESSION["user"]['name'];?></td>
        </tr>

        <tr>
          <th>E-mail:</th>
          <td><input type="text" name="newEmail" value="<?php echo $_SESSION["user"]['email']; ?>" placeholder="<?php echo $_SESSION["user"]['email']; ?>"/>
          </td>
        </tr>

        <tr>
          <th>Speaker:</th>
          <td><?php echo ($_SESSION["user"]["choice"] === "speaker" ? "Yes" : "No"); ?></td>
        </tr>
      </table>

      <table id = "changeTable">
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
        <input type="submit" name="Change" value="Change data" id="changeButton"/>
          </td>
        </tr>
      </table>
    </form>
    <table>
      <tr>
        <td>
          <?php if(findUserByName($_SESSION["user"]['name'])['hidden']) {
            echo "<form action='#' method='POST'><input id='hide' type='image' alt='reveal' title='Reveal e-mail' src='media/hide.png'/><input type='hidden' name='reveal'/></form>";
          } else {
            echo "<form action='#' method='POST'><input id='hide' type='image' alt='hide' title='Hide e-mail' src='media/reveal.jpg'/><input type='hidden' name='hide'/></form>";
          }
          ?>
        </td>
      </tr>
      <tr>
        <td>
          <form action="delete.php" method="POST" onsubmit="return confirm('Are you sure?');">
            <input id="deleteProfile" type="submit" name="delete" value="DELETE PROFILE"/>
          </form>
        </td>
      </tr>
    </table>
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
  </div>
  <?php include_once "footer.php"; ?>
</body>
</html>
