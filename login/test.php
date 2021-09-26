<?php
session_start();
 $_SESSION['Login'] = 1;
    $_SESSION['Name'] = "ChaosSchwein";
    $_SESSION['Rang'] = "Admin" ;
    header("Location: admincp/index.php");
?>