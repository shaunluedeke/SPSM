<?php
session_start();
$_SESSION['Login'] = 0;
$_SESSION['Name'] = "";
session_destroy();
header('Location: ../index.php');
?>
