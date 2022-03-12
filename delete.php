<?php
session_start();
include "common.php";

deleteUser($_SESSION["user"]);

session_unset();
session_destroy();
header("Location: login.php");
?>
