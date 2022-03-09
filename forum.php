<?php
    session_start();

    $messages = [
      ["name" => "admin", "message" => "One two three"],
      ["name" => "Kólikás Macska", "message" => "A gépek lázadása"]
    ];

    if (isset($_POST["send-message"])) {
      $name = $_SESSION["user"]["name"];
      $message = trim($_POST["text"]);
      echo "soon...";
    }
  ?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <?php include_once "head.html"; ?>
</head>

<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='forum.php';
    include_once "nav.php";
  ?>

  <div class="content">
    <h1>Messages:</h1>
    <?php  if (count($messages) === 0) { ?>
      <p>No messages... Silence is sometimes the best answer...</p>
    <?php } else { ?>
      <?php foreach ($messages as $i) { ?>
        <div class="message">
          <h2><?php echo $i["name"]; ?></h4>
          <div class="message"><?php echo ($i["message"]); ?></div>
        </div>
      <?php } ?>
    <?php } ?>

    <?php if (isset($_SESSION["user"])) { ?>
      <div class="message-box">
        <p><b>Your blabla</b></p>
        <form class="message-form" action="forum.php" method="POST">
          <textarea name="text" rows="8" cols="60" maxlength="400" required=""></textarea>
          <br/>
          <input type="submit" name="send-message" value="Send-message"/>
        </form>
      </div>
    <?php } ?>


  <?php include_once "footer.html"; ?>


</body>

</html>
