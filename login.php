<?php
  session_start();
  include 'common.php';

  $users = loadUsers("users.txt");

  $msg = "";
  // valid login -> create _SESSION["user"]
  if (isset($_POST["Login"])) {
    if (!isset($_POST["email"]) || trim($_POST["email"]) === "" || !isset($_POST["pw"]) || trim($_POST["pw"]) === "") {
      $msg = "<strong>Error:</strong> Email and password required!";
    } else {

      $email = $_POST["email"];
      $pw = $_POST["pw"];
      $msg = "Login failed! Invalid e-mail or password!";

      foreach ($users as $user) {
        if ($user["email"] ??= $email && password_verify($pw, $user["pw"])) {
          $msg = "Welcome!";
          $_SESSION["user"] = $user;
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
                <input type="email" name="email"
                value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"
                placeholder="john.doe@ignobel.com" maxlength="50" autofocus />
              </td>
            </tr>
            <tr>
              <td>
                <input type="password" name="pw" id="pwid"
                placeholder="Password"/>
              </td>
            </tr>
            <tr>
              <td>
                <input type="submit" name="Login" value="Login" />
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
