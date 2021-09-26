<?php
if(file_exists('../config.yml')){
  header('Location: ../index.php');
}
$page = 1;


if(!empty($_GET["page"])){
if($_GET["page"]=="1"){
  $page = 1;
}else
if($_GET["page"]=="2"){
  $page = 2;
}
if($_GET["page"]=="3"){
  $page = 3;
}
}
if(!empty($_POST)){
  if($page==2){
  $mysqlhost = $_POST["host"];
  $mysqlport = $_POST["port"];
  $mysqluser = $_POST["user"];
  $mysqlpw = $_POST["pw"];
  $mysqldb = $_POST["db"];
  $myfile = fopen("../mysql.php","w");
  fwrite($myfile,"<?php\n");
  fwrite($myfile,'$host = "'.$mysqlhost.'"'.";\n");
  fwrite($myfile,'$port = "'.$mysqlport.'"'.";\n");
  fwrite($myfile,'$user = "'.$mysqluser.'"'.";\n");
  fwrite($myfile,'$pw = "'.$mysqlpw.'"'.";\n");
  fwrite($myfile,'$db = "'.$mysqldb.'"'.";\n\n\n");
  fwrite($myfile,'$link = mysqli_connect($host,$user,$pw,$db,$port);'."\n\n");
  fwrite($myfile,'if(!$link){'."\n".'die("Keine MySQL Connection!");'."\n".'}');
fwrite($myfile,"\n?>");
  fclose($myfile);
}
  if($page==3){
    if(isset($_POST["sn"])&&isset($_POST["Language"])){
    $configfile = fopen("../config.php","w");
  //$title = "Login";
  //$charset = "UTF-8";
  //$language = "GER";
      fwrite($configfile,"<?php\n");
      fwrite($configfile,'$title = "'.$_POST["sn"].'"'."\n");
      fwrite($configfile,'$charset = "UTF-8"'."\n");
      fwrite($configfile,'$language = "'.$_POST["Language"].'"'."\n");
      fwrite($configfile,"?>");
      fclose($configfile);
    }
    //fEX18lIB
    if(isset($_POST["user"])&&isset($_POST["email"])&&isset($_POST["pw"])){
    require('../mysql.php');
    mysqli_query($link,'CREATE TABLE IF NOT EXISTS `Login` ( `Name` VARCHAR(100) NOT NULL , `Password` VARCHAR(100) NOT NULL , `Email` VARCHAR(100) NOT NULL , `Language` VARCHAR(100) NOT NULL , `Roll` VARCHAR(100) NOT NULL )');
    mysqli_query($link,'CREATE TABLE IF NOT EXISTS `Servers` ( `Server` VARCHAR(100) NOT NULL , `Host` VARCHAR(100) NOT NULL , `Port` VARCHAR(100) NOT NULL ,  `Roll` VARCHAR(100) NOT NULL)');
    $username = md5($_POST["user"]);
    $password = md5(md5($_POST["pw"]));
    $email = md5($_POST["email"]);
    $language = md5($_POST["Language"]);
    $na = 0;
    $db_res = mysqli_query($link,"SELECT `Name` FROM `login` WHERE `Name` = ".$username."") or ($na = 1);
    if($na==1){
    mysqli_query($link,"INSERT INTO `login` (`Name`, `Password`, `Email`, `Language`, `Roll`) VALUES ('$username', '$password', '$email', '$language', 'Admin')");
    }
  }else{
    header("Location : index.php?page=2");
  }
}
}

if(file_exists('../mysql.php')){
 $page=2;
}
if(file_exists('../config.php')){
  $page=3;
}
if($page!=2){
  if($page!=3){
 ?>


<html>
    <head>
      <title>Install Page 1</title>
      <meta charset="utf-8"/>
      <link rel="stylesheet" href="style.css">
    </head>
    <body>
      <section>
      </section>
      <form class="login-box" action="index.php?page=2" method="post">



          <?php echo "<h1>Install Page: ".$page."</h1>"; ?>
          <h2>MySQL Data</h2>
        <div class="text-box">
          <i class="fas fa-database"></i>
          <input type="text" placeholder="MySQL Host" name="host" value="localhost">
        </div>
        <div class="text-box">
          <i class="fas fa-database"></i>
          <input type="text" placeholder="MySQL Port" name="port" value="3306">
        </div>
        <div class="text-box">
          <i class="fas fa-database"></i>
          <input type="text" placeholder="MySQL Username" name="user" value="root">
        </div>
        <div class="text-box">
          <i class="fas fa-lock" aria-hidden="true" onclick="showhide();" id="toggle"></i>
          <input type="password" placeholder="MySQL Password" name="pw" value="" id="password">
        </div>
        <div class="text-box">
          <i class="fas fa-database"></i>
          <input type="text" placeholder="MySQL Database" name="db" value="SPSM-Core">
        </div>

        <input class="button" type="submit" name="contains" value="Next Page" >
      </form>
      <script type="text/javascript">
        const password = document.getElementById('password');
        const toggle = document.getElementById('toggle');


        function showhide(){
          if(password.type === 'password'){
            password.setAttribute('type','text');
            toggle.setAttribute('class','fas fa-lock-open');

          }else{
            password.setAttribute('type','password');
            toggle.setAttribute('class','fas fa-lock');

          }
        }
      </script>
    </body>
</html>
<?php
}else {

}
}else{
?>
    <html>
      <head>
        <title>Install Page 2</title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="style.css">
      </head>
      <body>
        <section>
        </section>
        <form class="login-box" action="index.php?page=3" method="post">



            <?php echo "<h1>Install Page: ".$page."</h1>"; ?>
            <h2>Settings</h2>
          <div class="text-box">
            <i class="fas fa-database"></i>
            <input type="text" placeholder="Server Name" name="sn" value="">
          </div>
          <div class="text-box">
            <i class="fas fa-database"></i>
            <select class="login-language" name="Language" title="language">

              <option class="login-language-down" value="GER" >German / Deutsch</option>
              <option class="login-language-down" value="ENG" >English / UK</option>
            </select>
          </div>
          <div class="text-box">
            <i class="fas fa-id-card"></i>
            <input type="text" placeholder="Username" name="user" value="">
          </div>
          <div class="text-box">
            <i class="fas fa-envelope"></i>
            <input type="text" placeholder="E-Mail Adress" name="email" value="">
          </div>
          <div class="text-box">
            <i class="fas fa-lock" aria-hidden="true" onclick="showhide();" id="toggle"></i>
            <input type="password" placeholder="Password" name="pw" value="" id="password">
          </div>

          <input class="button" type="submit" name="contains" value="Finish" >
        </form>
        <script type="text/javascript">
          const password = document.getElementById('password');
          const toggle = document.getElementById('toggle');


          function showhide(){
            if(password.type === 'password'){
              password.setAttribute('type','text');
              toggle.setAttribute('class','fas fa-lock-open');

            }else{
              password.setAttribute('type','password');
              toggle.setAttribute('class','fas fa-lock');

            }
          }
        </script>
      </body>
  </html><?php
} if($page==3){
  ?>


 <html>
     <head>
       <title>Install Page 3</title>
       <meta charset="utf-8"/>
       <link rel="stylesheet" href="style.css">
     </head>
     <body>
       <div class="login-box">



           <?php echo "<h1>Install Page: ".$page."</h1>"; ?>

         <div class="text-box">
           <p class="ready">The installation is done</p>
         </div>


         <button class="button" ><a href="../login.php" style="text-decoration: none; color:white; font-size:20px;">Login Page</a></button>
       </div>
       <script type="text/javascript">
       alert("Installation is done!");
       </script>
     </body>

 </html>
 <?php

}
 ?>
