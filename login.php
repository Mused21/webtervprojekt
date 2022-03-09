<?php
  session_start();


//test accounts
  $accounts = [
    ["Title" => "Mr.", "name" => "admin", "pw" => "1234", "choice" => "speaker", "news" => NULL],
    ["Title" => "Mr.", "name" => "admin2", "pw" => "1234", "choice" => "speaker", "news" => NULL]
  ];

  $msg = "";
  // valid login -> create _SESSION["user"]
  if (isset($_POST["Login"])) {
    if (!isset($_POST["name"]) || trim($_POST["name"]) === "" || !isset($_POST["pw"]) || trim($_POST["pw"]) === "") {
      $msg = "<strong>Error:</strong> Name and password required!";
    } else {
      $name = $_POST["name"];
      $pw = $_POST["pw"];
      $msg = "Login failed! Invalid name or password!";
      foreach ($accounts as $i) {
        echo ($i["name"] . " - " . $i["pw"] . "<br>");
        if ($i["name"] === $name &&   $i["pw"] === $pw) {// hashelt esetben ez később password_verify metódus lesz
          $msg = "Welcome!";
          $_SESSION["user"] = $i;
          header("Location: index.php");
        }
      }
    }
  }
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <link rel="stylesheet" type="text/css" media="all" href="css/form.css" />
  <?php include_once "head.html"; ?>
</head>

<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='login.php';
    include_once "nav.php";
  ?>

  <div class="content">
    <h1>Log in</h1>
    <p class="content">
    </p>
    <div id="form2">
      <form action="" method="POST" enctype="application/x-www-form-urlencoded" autocomplete="on">
        <fieldset>
          <legend>Login form</legend>

          <table>
            <tr>
              <td>
                <input type="text" name="name"
                value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"
                placeholder="John Doe" maxlength="50" autofocus tabindex="1" />
              </td>
            </tr>
            <tr>
              <td>
                <input type="password" name="pw" id="pwid"
                value=""
                placeholder="Password"  tabindex="3" />
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" name="Login" value="Login" tabindex="7" />
              </td>
            </tr>

          </table>
        </fieldset>
      </form>
        <?php echo ($msg . "<br/>"); ?>
    </div>
  </div>
  <?php include_once "footer.html"; ?>
  </div>
</body>
</html>
