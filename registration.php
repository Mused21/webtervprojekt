<?php
  session_start();

  $error = [];

  //Form process
  if (isset($_POST["Register"])) {
    echo "submitted";

    // Jól vannak e megadva?
    if (!isset($_POST["name"]) || trim($_POST["name"]) === "")
      $error[] = "Name required";
      //erősen hiányos

    //értékátadások
    if (isset($_POST["Title"]))
      $Title = $_POST["Title"];
    else $Title = NULL;
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pw = $_POST["pw"];
    //még nincs  $pw2 = $_POST["pw2"];
    if (isset($_POST["choice"]))
      $choice = $_POST["choice"];
    else $choice = NULL;
    if (isset($_POST["news"]))
      $news = $_POST["news"];
    else $news = NULL;

/* későbbi fiunkció
    foreach ($fiokok as $fiok) {
      if ($fiok["felhasznalonev"] === $felhasznalonev)
        $hibak[] = "A felhasználónév már foglalt!";
    }
*/

  //jelszo valid? későbbi funkció
  /*    if (strlen($jelszo) < 5)
        $hibak[] = "A jelszónak legalább 5 karakter hosszúnak kell lennie!";

      if ($jelszo !== $jelszo2)
        $hibak[] = "A jelszó és az ellenőrző jelszó nem egyezik!";*/

    if (count($error) === 0) { //Successful registration
      //$jelszo = password_hash($jelszo, PASSWORD_DEFAULT);
      //$fiokok[] = ["felhasznalonev" => $felhasznalonev, "jelszo" => $jelszo, "eletkor" => $eletkor, "nem" => $nem, "hobbik" => $hobbik];
      //saveUsers("users.txt", $fiokok);
      $success = TRUE;
      header("Location: login.php");
    } else {                    // fail...
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
                <select name="Title" tabindex="4">
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
                placeholder="John Doe" maxlength="50" autofocus tabindex="1" />
              </td>
            </tr>
            <tr>
              <td>
                <input type="email" name="email"
                value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"
                placeholder="john.doe@ignobel.com" tabindex="2" />
              </td>
            </tr>
            <tr>
              <td>
                <input type="password" name="pw" id="pwid" value="" placeholder="Password" tabindex="3" />
              </td>
            </tr>
          </table>

          <label for="choice_participant">Participant: </label>
          <input type="radio" id="choice_participant" name="choice" value="participant"
            <?php if (isset($_POST['choice']) && $_POST['choice'] === 'participant') echo 'checked'; ?> />
          <label for="choice_speaker">Speaker: </label>
          <input type="radio" id="choice_speaker" name="choice" value="speaker" tabindex="5"
            <?php if (isset($_POST['choice']) && $_POST['choice'] === 'speaker') echo 'checked'; ?>/>


            <div id="speaker">
              <label>Title:<br /><input type="text" name="presentation_title" maxlength="255" size="30" /></label>
              <br />
              <label>Abstract: <br /><textarea rows="15" cols="35"></textarea></label>
            </div>

            <br />

            <label for="checkbox1">Subscribe for newsletters: </label>
            <input type="checkbox" id="checkbox1" name="news" value="yes" tabindex="6"
            <?php if (isset($_POST['news']) && $_POST['news'] === 'yes') echo 'checked'; ?> />
            <br />


            <input type="submit" name="Register" value="Submit" tabindex="7" />
            <br />
            <input type="reset" name="Reset" value="Reset" tabindex="8" id=resetbutton />

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
