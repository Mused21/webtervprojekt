<?php
session_start();
include "common.php";

deleteUser("users.txt", $_SESSION["user"]);

session_unset();
session_destroy();
header("Location: login.php");
?>
