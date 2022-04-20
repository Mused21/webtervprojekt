<?php
  session_start();
  include "common.php";

  if (isset($_SESSION["user"])) {
    header("Location: profile.php");
  }

  $error = [];
  $users = loadUsers();
  if (isset($_POST["Register"])) {

    if (isNotFilled("name")) {
      $error[] = "Name is a mandatory field.";
    }
    $name = $_POST["name"];

    if (isNotFilled("email")) {
      $error[] = "E-mail is a mandatory field.";
    }
    $email = $_POST["email"];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $error[] = "The e-mail is not valid.";
    }

    if (isNotFilled("pw") || isNotFilled("pw2")) {
      $error[] = "Password is a mandatory field.";
    }
    $pw = $_POST["pw"];
    $pw2 = $_POST["pw2"];

    if (strlen($pw) < 8){
      $error[] = "Password must be at least 8 characters long!";
    }

    if ($pw !== $pw2) {
      $error[] = "The two given passwords do not match!";
    }

    if (isset($_POST["Title"])) {
      $title = $_POST["Title"];
    } else {
      $error[] = "Please select a title!";
    }
    if (!isset($_POST["choice"])) {
      $error[] = "Please select how are you going to participate.";
    } else {
      $choice = $_POST["choice"];
    }

    if (isset($_POST["news"])) {
      $news = $_POST["news"];
    } else {
      $news = NULL;
    }

    foreach ($users as $user) {
      if ($user["email"] === $email) {
        $error[] = "The e-mail is already registered.";
      }
    }

    foreach ($users as $user) {
      if (strtolower($user["name"]) === strtolower($name)) {
        $error[] = "The name is already registered.";
      }
    }


    if (count($error) === 0) {
      $pw = password_hash($pw, PASSWORD_DEFAULT);
      $users[] = ["email" => $email, "pw" => $pw, "name" => $name, "title" => $title, "choice" => $choice, "news" => $news, "admin" => FALSE, "block" => FALSE, "hidden" => FALSE];
      saveUsers($users);
      $success = TRUE;
      header("Location: login.php");
    } else {
      $success = FALSE;
    }
  }
  ?>
<!DOCTYPE html>
<html lang= <?php echo($_COOKIE["language"]);?>>

<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <link rel="stylesheet" type="text/css" media="all" href="css/registration.css" />
  <?php include_once "head.html"; ?>
</head>

<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='registration.php';
    include_once "nav.php";
  ?>

  <div class="content">
    <p class="content">
      <?php if ($_COOKIE["language"]==="en")
        echo "Registration is a <b>necessity</b> if you would like to participate in the conference.<br />
      Please fill out the form below. Your password must be at least 8 characters.<br />";
            if ($_COOKIE["language"]==="es") echo "La inscripción es una <b>necesidad</b> si desea participar en la conferencia.<br />
       Por favor, rellene el siguiente formulario. Su contraseña debe tener al menos 8 caracteres.<br />"; ?>
    </p>
    <div id="form">
      <fieldset>
        <legend>Registration form</legend>
          <form action="#" method="POST" enctype="application/x-www-form-urlencoded" autocomplete="on">
          <table>
            <tr>
              <td>
                <select name="Title">
                  <option selected disabled>Title</option>
                  <option value="Mr." <?php if (isset($_POST['Title']) && $_POST['Title'] === 'Mr.') echo 'selected'; ?>>Mr.</option>
                  <option value="Ms." <?php if (isset($_POST['Title']) && $_POST['Title'] === 'Ms.') echo 'selected'; ?>>Ms.</option>
                  <option value="Dr." <?php if (isset($_POST['Title']) && $_POST['Title'] === 'Dr.') echo 'selected'; ?>>Dr.</option>
                  <option value="Prof." <?php if (isset($_POST['Title']) && $_POST['Title'] === 'Prof.') echo 'selected'; ?>>Prof</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>
                <input type="text" name="name"
                value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"
                placeholder="John Doe" maxlength="50" autofocus/>
              </td>
            </tr>
            <tr>
              <td>
                <input type="email" name="email"
                value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"
                placeholder="john.doe@ignobel.com"/>
              </td>
            </tr>
            <tr>
              <td>
                <input type="password" name="pw" id="pwid" placeholder="Password"/>
              </td>
            </tr>
            <tr>
              <td>
                <input type="password" name="pw2" id="pwid2" placeholder="Password again"/>
              </td>
            </tr>
          </table>

          <label for="choice_participant">Participant: </label>
          <input type="radio" id="choice_participant" name="choice" value="participant"
            <?php if (isset($_POST['choice']) && $_POST['choice'] === 'participant') echo 'checked'; ?> />
          <label for="choice_speaker">Speaker: </label>
          <input type="radio" id="choice_speaker" name="choice" value="speaker"
            <?php if (isset($_POST['choice']) && $_POST['choice'] === 'speaker') echo 'checked'; ?>/>


            <div id="speaker">
              <label>Title:<br /><input type="text" name="presentation_title" maxlength="255" size="30" /></label>
              <br />
              <label>Abstract: <br /><textarea rows="15" cols="35"></textarea></label>
            </div>

            <br />

            <label for="checkbox1">Subscribe for newsletters: </label>
            <input type="checkbox" id="checkbox1" name="news" value="yes"
            <?php if (isset($_POST['news']) && $_POST['news'] === 'yes') echo 'checked'; ?> />
            <br />
            <input type="submit" name="Register" value="Submit" id="submitbutton" />
            <br />
      </form>
      <form action="resetform.php">
            <input type="submit" name="Reset" value="Reset" id="resetbutton" />
      </form>
      <?php
        if (isset($success) && $success === TRUE) {
          echo "<p>Successful registration!</p>";
        } else {
          foreach ($error as $i) {
            echo '<div class="error">' . $i . "</div>";
          }
        }
      ?>
    </fieldset>

    </div>
  </div>
  <?php include_once "footer.php"; ?>
</body>

</html>
