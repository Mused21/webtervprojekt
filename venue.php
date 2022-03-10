<?php
  session_start();
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <link rel="stylesheet" type="text/css" media="all" href="css/venue.css" />
  <?php include_once "head.html"; ?>
</head>

<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='venue.php';
    include_once "nav.php";
  ?>
  <div class="content">
    <video controls preload="metadata">
      <source src="media/szeged_video_480p.mp4#t=0.5" type="video/mp4" />
    </video>

    <h2>In case you get lost...</h2>
    <div id="map">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2759.013828515889!2d20.144221315380662!3d46.249952888689876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47448871b6abb4a7%3A0x257aa9635ae4dc8!2sSZTE%20Rektori%20Hivatal!5e0!3m2!1shu!2shu!4v1645892615144!5m2!1shu!2shu"
        allowfullscreen="" loading="lazy"></iframe>
    </div>
    <p>
      <img id=flag src="media/flag.png" alt="hungary flag">
      Hungary, Szeged, Dugonics tér 13, 6720
    </p>
  <?php include_once "footer.html"; ?>
  </div>
</body>

</html>
