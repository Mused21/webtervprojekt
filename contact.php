<?php
  session_start();
?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <link rel="stylesheet" type="text/css" media="all" href="css/contact.css" />
  <?php include_once "head.html"; ?>
</head>

<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='contact.php';
    include_once "nav.php";
  ?>

  <div class="content">
    <h1>Got a question?</h1>
    <div id="appear">
      <div id="listcontainer">
        In case you have questions about:
        <ul>
          <li>
            the conference
          </li>
          <li>
            your presentation
          </li>
          <li>
            available accomodations
          </li>
        </ul>
        or need further information about the venue, do not hesitate and write an <a href="mailto:ignobel2022@szeged.hu?subject=Questions"> e-mail</a> to us.
      </div>
      <p id="signature">
        Best wishes for a successful conference, <br />
        The Organizers
      </p>
      <div class="organizers">
        <figure class="inline">
          <img class="rounded grayscale" id="zsolt" src="media/zsolt.jpg" alt="Bengery Zsolt" />
          <figcaption>Zsolt</figcaption>
        </figure>
        <figure class="inline">
          <div id="pawholder">
            <img class="rounded grayscale" id="norbert" src="media/norbert.jpg" alt="Imre Norbert" />
            <img id="paw" src="media/paw.png" alt="Pusheen Paw" />
          </div>
          <figcaption>Norbert</figcaption>
        </figure>
      </div>
    </div>
<?php include_once "footer.html"; ?>
  </div>
</body>

</html>
