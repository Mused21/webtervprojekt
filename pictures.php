<?php
  session_start();
?>

<!DOCTYPE html>
<html lang= <?php echo($_COOKIE["language"]);?>>

<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <link rel="stylesheet" type="text/css" media="all" href="css/pictures.css" />
  <?php include_once "head.html"; ?>
</head>

<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='pictures.php';
    include_once "nav.php";
  ?>

  <div class="content">
    <?php if ($_COOKIE["language"]==="en") {
            echo ("<h1>Nostalgia session</h1>
                  <h2>Awesome pictures from past Ig Nobel Conferences</h2>");}
          if ($_COOKIE["language"]==="es"){
            echo ( "<h1>Sesión de nostalgia</h1>
                   <h2>Imágenes impresionantes de conferencias Ig Nobel pasadas</h2>");}?>
    <div id='flexContainer'>
      <a href="media/stockphoto1.jpg"><img class="item" src="media/stockphoto1_lq.jpg" alt="Ig Nobel Archive Photo"></a>
      <a href="media/stockphoto2.jpg"><img class="item" src="media/stockphoto2_lq.jpg" alt="Ig Nobel Archive Photo"></a>
      <a href="media/stockphoto3.jpg"><img class="item" src="media/stockphoto3_lq.jpg" alt="Ig Nobel Archive Photo"></a>
      <a href="media/stockphoto4.jpg"><img class="item" src="media/stockphoto4_lq.jpg" alt="Ig Nobel Archive Photo"></a>
      <a href="media/monica-lewinsky.png"><img class="item" src="media/monica-lewinsky_lq.png" alt="Ig Nobel Archive Photo"></a>
      <a href="media/stockphoto5.jpg"><img class="item" src="media/stockphoto5_lq.jpg" alt="Ig Nobel Archive Photo"></a>
      <a href="media/stockphoto6.jpg"><img class="item" src="media/stockphoto6_lq.jpg" alt="Ig Nobel Archive Photo"></a>
      <a href="media/james-hetfield.jpg"><img class="item" src="media/james-hetfield_lq.jpg" alt="Ig Nobel Archive Photo"></a>
      <a href="media/stockphoto9.jpg"><img class="item" src="media/stockphoto9_lq.jpg" alt="Ig Nobel Archive Photo"></a>
    </div>
  <?php include_once "footer.php"; ?>
  </div>

</body>

</html>
