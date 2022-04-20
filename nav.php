<nav>
<?php include_once "language/" . $_COOKIE["language"] . "/nav.php"; ?>

<a <?php echo ($page == 'index.php') ? 'class="current"' : '';?> title="Conference Home Page" href="index.php"><?php echo Home;?></a>
<?php if (isset($_SESSION["user"])) { ?>
  <a <?php echo ($page == 'profile.php') ? 'class="current"' : '';?> title="My profile" href="profile.php"><?php echo Profile;?></a>
<?php } else { ?>
  <a <?php echo ($page == 'registration.php') ? 'class="current"' : '';?> title="Register for the Conference" href="registration.php"><?php echo Registration;?></a>
<?php } ?>
<a <?php echo ($page == 'pictures.php') ? 'class="current"' : '';?> title="Pictures" href="pictures.php"><?php echo Pictures;?></a>
<a <?php echo ($page == 'program.php') ? 'class="current"' : '';?> title="Conference Program" href="program.php"><?php echo Program;?></a>
<a <?php echo ($page == 'venue.php') ? 'class="current"' : '';?> title="Venue of the Conference" href="venue.php"><?php echo Venue;?></a>
<a <?php echo ($page == 'contact.php') ? 'class="current"' : '';?> title="Conference Contact" href="contact.php"><?php echo Contact;?></a>
<a <?php echo ($page == 'forum.php') ? 'class="current"' : '';?> title="Forum" href="forum.php"><?php echo Forum;?></a>
<?php if (isset($_SESSION["user"])) { ?>
  <a <?php echo ($page == 'logout.php') ? 'class="current"' : '';?> title="Log out" href="logout.php"><?php echo Log_out;?></a>
<?php } else { ?>
  <a <?php echo ($page == 'login.php') ? 'class="current"' : '';?> title="Log in" href="login.php"><?php echo Log_in;?></a>
<?php } ?>
</nav>
