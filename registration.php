<?php
  session_start();

  include "common.php";
  $users = loadUsers("users.txt");

  $error = [];

  if (isset($_POST["Register"])) {

    if (!isset($_POST["name"]) || trim($_POST["name"]) === "") {
      $error[] = "Name is a mandatory field.";
    }

    if (!isset($_POST["pw"]) || trim($_POST["pw"]) === ""
    || !isset($_POST["pw2"]) || trim($_POST["pw2"]) === "") {
      $error[] = "Password is a mandatory field.";
    }

    if (!isset($_POST["email"]) || trim($_POST["email"]) === "") {
      $error[] = "E-mail is a mandatory field.";
    }

    if (isset($_POST["Title"])) {
      $title = $_POST["Title"];
    } else {
      $title = NULL;
    }
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pw = $_POST["pw"];
    $pw2 = $_POST["pw2"];
    if (isset($_POST["choice"])) {
      $choice = $_POST["choice"];
    } else {
     $choice = NULL;
    }
    if (isset($_POST["news"])) {
      $news = $_POST["news"];
    } else {
      $news = NULL;
    }


    foreach ($users as $user) {
      if ($user["email"] === $email)
        $error[] = "The e-mail is already registered.";
    }

    if (strlen($pw) < 8)
        $error[] = "Password must be at least 8 character long!";

    if ($pw !== $pw2)
        $error[] = "The two given passwords do not match!";

    if (count($error) === 0) {
      $pw = password_hash($jelszo, PASSWORD_DEFAULT);
      $users[] = ["email" => $email, "pw" => $pw, "name" => $name, "title" => $title, "choice" => $choice, "news" => $news];
      saveUsers("users.txt", $users);
      $success = TRUE;
      header("Location: login.php");
    } else {
      $success = FALSE;
    }
}

  ?>
<!DOCTYPE html>
<html lang='en'>

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
    <h1>Registration</h1>
    <p class="content">Registration is a <b>necessity</b> if you would like to participate in the conference.<br />
      Please fill out the form below.<br />
      If you would like to become a speaker, please attach your abstract.
    </p>

    <div id="form">
      <form action="" method="POST" enctype="application/x-www-form-urlencoded" autocomplete="on">
        <fieldset>
          <legend>Registration form</legend>

          <table>
            <tr>
              <td>
                <select name="Title">
                  <option selected disabled>Title</option>
                  <option value="Mr." <?php if (isset($_POST['Title']) && $_POST['Title'] === 'Mr.') echo 'selected'; ?>/>Mr.</option>
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
                <input type="password" name="pw" id="pwid" value="" placeholder="Password"/>
              </td>
            </tr>
            <tr>
              <td>
                <input type="password" name="pw2" id="pwid" value="" placeholder="Password again"/>
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


            <input type="submit" name="Register" value="Submit" />
            <br />
            <input type="reset" name="Reset" value="Reset" id=resetbutton />

          </fieldset>
      </form>
      <?php
        if (isset($success) && $success === TRUE) {
          echo "<p>Successful registration!</p>";
        } else {
          foreach ($error as $i) {
            echo "<p>" . $i . "</p>";
          }
        }

      ?>
    </div>
  </div>
  <?php include_once "footer.html"; ?>
  <!--
  <script>
    const isSpeaker = document.querySelector('#choice_speaker');
    const isParticipant = document.querySelector('#choice_participant');
    const resetButton = document.querySelector('#resetbutton');

    isSpeaker.addEventListener('change', speakerCheck);
    isParticipant.addEventListener('change', speakerCheck);
    resetButton.addEventListener('click', hide);

    function speakerCheck() {
      if (document.getElementById("choice_speaker").checked) {
        document.getElementById("speaker").style.display = "block";
      } else {
        document.getElementById("speaker").style.display = "none";
      }
    }

    function hide() {
      document.getElementById("speaker").style.display = "none";
    }
  </script>
-->
</body>

</html>
