<?php
session_start();
require('../../../config.php');
if(!isset($_SESSION['Login'])){
  header('Location: ../../../index.php');
}else {
  if($_SESSION['Login']!=1){
    header('Location: ../../../index.php');
  }else{
    if($_SESSION['Rang']=="ADMIN"){
 ?>
<html>
<head>

    <meta charset="utf-8">
    <?php echo "<title>".$title." | Server Controll Panel</title>"; ?>
    <link rel="shortcut icon" type="image/png" href="../../img/icon.png">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
      <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
    <script>
  function openSlideMenu(){
    document.getElementById('menu').style.width = '250px';
    document.getElementById('content').style.marginLeft = '250px';
    document.getElementById('slide').style.visibility = 'hidden';
  }
  function closeSlideMenu(){
    document.getElementById('menu').style.width = '0';
    document.getElementById('content').style.marginLeft = '0';
    document.getElementById('slide').style.visibility = 'visible';
  }

</script>
</head>
<body>
    <div id="content">
    <span class="slide" id="slide">
      <a onclick="openSlideMenu()">
        <i class="fas fa-bars"></i>
      </a>
    </span>
    <div id="menu" class="nav">
      <a class="close" onclick="closeSlideMenu()">
        <i class="fas fa-times"></i>
      </a>
      <a href="../index.php"><i class="fas fa-home"></i>  Home</a>
      <a href="index.php" class="aktiv"><i class="fas fa-server"></i>  Servers</a>
      <a href="../user/index.php"><i class="fas fa-users"></i>  Users</a>
      
      <a class="logout" href="../../logout.php" ><i class="fas fa-sign-out-alt"></i>  Logout</a>
      </div>
  </div>



</body>
</html>
<?php
}else{
  header('Location: ../../../index.php');
}
}
}
 ?>
