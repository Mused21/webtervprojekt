<?php
  session_start();
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <link rel="stylesheet" type="text/css" media="all" href="css/main.css" />
  <link rel="stylesheet" type="text/css" media="all" href="css/program.css" />
  <?php include_once "head.html"; ?>
</head>

<body>
  <?php include_once "banner.html"; ?>
  <?php
    $page='program.php';
    include_once "nav.php";
  ?>

  <div class="content">
    <table id="programTable">
      <thead>
        <tr>
          <th>Time</th>
          <th>Abstract title</th>
          <th>Author</th>
          <th>Affiliation</th>
        </tr>
      </thead>

      <tbody>
        <tr>
          <td>8:30-9:00</td>
          <td colspan="3" class="centered">Check-in</td>
        </tr>
        <tr>
          <td>9:00-9:15</td>
          <td colspan="3" class="centered">Welcome speech</td>

        </tr>
        <tr>
          <td>9:15-10:00</td>
          <td>A Comparative Acoustic Analysis of Purring in Four Cats</td>
          <td>Susanne Schötz</td>
          <td>KTH Royal Institute of Technology Stockholm, Sweden</td>
        </tr>
        <tr>
          <td>10:00-10:30</td>
          <td>Cinema Data Mining: The Smell of Fear</td>
          <td>Jörg Wicker</td>
          <td>Johannes Gutenberg-Universität Mainz, Germany</td>
        </tr>
        <tr>
          <td>10:30-11:00</td>
          <td>How Do Wombats Make Cubed Poo?</td>
          <td>Patricia J. Yang</td>
          <td>Georgia Institute of Technology, USA</td>
        </tr>
        <tr>
          <td>11:00-12:30</td>
          <td colspan="3" class="centered">Lunch break</td>
        </tr>
        <tr>
          <td>12:30-14:30</td>
          <td>Is That Me or My Twin? Lack of Self-Face Recognition Advantage in Identical Twins</td>
          <td>Matteo Martini</td>
          <td>Sapienza - University of Rome, Italy</td>
        </tr>
        <tr>
          <td>14:30-15:00</td>
          <td>Why white-haired horses are the most horsefly-proof horses</td>
          <td>Gábor Horváth</td>
          <td>Eötvös Loránd University, Hungary</td>
        </tr>
        <tr>
          <td>15:00-15:30</td>
          <td>PawSense, the software that detects when a cat is walking across your computer keyboard</td>
          <td>Chris Niswander</td>
          <td>President of BitBoost, USA</td>
        </tr>
        <tr>
          <td>15:30-16:30</td>
          <td colspan="3" class="centered">Coffee break</td>
        </tr>
        <tr>
          <td>16:30-17:00</td>
          <td>Misophonia: Diagnostic criteria for a new psychiatric disorder</td>
          <td>Arjan Schröder</td>
          <td>Academic Medical Center, University of Amsterdam, The Netherlands</td>
        </tr>
        <tr>
          <td>17:00-18:00</td>
          <td>Estimation of the total saliva volume produced per day in five-year-old children</td>
          <td>Shigeru Watanabe</td>
          <td>Health Sciences University of Hokkaido, Japan</td>
        </tr>
        <tr>
          <td>18:00-18:30</td>
          <td>Never smile at a crocodile: Betting on electronic gaming machines is intensified by reptile-induced arousal</td>
          <td>Matthew J. Rockloff</td>
          <td>Institute for Health and Social Science Research, Australia</td>
        </tr>
        <tr>
          <td>20:00-23:00</td>
          <td colspan="3" class="centered">Gala dinner</td>
        </tr>
      </tbody>
    </table>
    <p id="print">
      <a href="#" id="print-button" onclick="window.print();return false;">Print this page for your convenience</a>
    </p>
  </div>


<?php include_once "footer.html"; ?>

</body>

</html>
