<nav>
<a <?php echo ($page == 'index.php') ? 'class="current"' : '';?> title="Conference Home Page" href="index.php">Home</a>
<a <?php echo ($page == 'registration.php') ? 'class="current"' : '';?> title="Register for the Conference" href="registration.php">Registration</a>
<a <?php echo ($page == 'pictures.php') ? 'class="current"' : '';?> title="Pictures" href="pictures.php">Pictures</a>
<a <?php echo ($page == 'program.php') ? 'class="current"' : '';?> title="Conference Program" href="program.php">Program</a>
<a <?php echo ($page == 'venue.php') ? 'class="current"' : '';?> title="Venue of the Conference" href="venue.php">Venue</a>
<a <?php echo ($page == 'contact.php') ? 'class="current"' : '';?> title="Conference Contact" href="contact.php">Contact</a>
<a <?php echo ($page == 'forum.php') ? 'class="current"' : '';?> title="Forum" href="forum.php">Forum</a>

<?php if (isset($_SESSION["user"])) { ?>
  <a <?php echo ($page == 'profile.php') ? 'class="current"' : '';?> title="My profile" href="profile.php">Profile</a>
<?php } else { ?>
  <a <?php echo ($page == 'login.php') ? 'class="current"' : '';?> title="Log in" href="login.php">Log in</a>
<?php } ?>

</nav>
