<?php
  session_start();
  include 'common.php';

  $users = loadUsers("users.txt");

  $msg = "";
  if (isset($_POST["Login"])) {
    if (isNotFilled("email") || isNotFilled("pw")) {
      $msg = "<strong>Error:</strong> Email and password required!";
    } else {
      $email = $_POST["email"];
      $pw = $_POST["pw"];
      $msg = "Login failed! Invalid e-mail or password!";

      foreach ($users as $user) {
        if ($user["email"] === $email && password_verify($pw, $user["pw"])) {
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
  <link rel="stylesheet" type="text/css" media="all" href="css/registration.css" />
  <?php include_once "head.html"; ?>
</head>

<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='login.php';
    include_once "nav.php";
  ?>

  <div class="content">
    <p class="content">
    </p>
    <div id="form2">
      <form action="" method="POST" enctype="application/x-www-form-urlencoded" autocomplete="on">
        <fieldset>
          <legend>Login</legend>
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
      <?php echo '<div class="error">' . $msg . "</div>";?>
    </div>
  </div>
  <?php include_once "footer.html"; ?>
  </div>
</body>
</html>
