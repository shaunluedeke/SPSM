<?php
if(file_exists('../assets/php/configs.php')){
  header('Location: ../index.php');
}
$page = 1;

if(!empty($_GET['page']) && is_numeric($_GET['page'])){
    $page = (int) $_GET['page'];
    if($page<1) $page=1;
    if($page>3) $page=3;
}

if(!empty($_POST)){
  if($page===2){
  $mysqlhost = $_POST["host"];
  $mysqlport = $_POST["port"];
  $mysqluser = $_POST["user"];
  $mysqlpw = $_POST["pw"];
  $mysqldb = $_POST["db"];
  if(file_exists('../assets/api/config/db_config.php')){
      unlink('../assets/api/config/db_config.php');
  }
  $myfile = fopen("../assets/api/config/db_config.php","w");
  fwrite($myfile,"<?php \n\n class db_config \n { \n\n\n");
  fwrite($myfile,'  public static $mysqlhost = "'.$mysqlhost.'"'.";\n");
  fwrite($myfile,'  public static $mysqlport = "'.$mysqlport.'"'.";\n");
  fwrite($myfile,'  public static $mysqlusername = "'.$mysqluser.'"'.";\n");
  fwrite($myfile,'  public static $mysqlpassword = "'.$mysqlpw.'"'.";\n");
  fwrite($myfile,'  public static $mysqldatabase = "'.$mysqldb.'"'.";\n }");
  fwrite($myfile,"\n\n?>");
  fclose($myfile);
}
  if($page===3){
    if(isset($_POST["sn"],$_POST["Language"])){
        $configfile = fopen("../assets/php/configs.php","w");
        fwrite($configfile,"<?php \n class configs \n {\n");
        fwrite($configfile,'    public static $title = "'.$_POST["sn"].'";'."\n");
        fwrite($configfile,'    public static $charset = "UTF-8";'."\n");
        fwrite($configfile,'    public static $language = "'.$_POST["Language"].'";'."\n");
        fwrite($configfile,"\n} \n ?>");
        fclose($configfile);
    }
    if(isset($_POST["user"], $_POST["email"] , $_POST["pw"])){
    require('../assets/api/mysql/mysql_connetion.php');
    $mysql = new mysql_connetion();
    $mysql->query('CREATE TABLE IF NOT EXISTS `Login` ( `Name` VARCHAR(100) NOT NULL , `Password` VARCHAR(100) NOT NULL , `Email` VARCHAR(100) NOT NULL , `Language` VARCHAR(100) NOT NULL , `Roll` VARCHAR(100) NOT NULL )');
    $mysql->query('CREATE TABLE IF NOT EXISTS `Servers` ( `Server` VARCHAR(100) NOT NULL , `Host` VARCHAR(100) NOT NULL , `Port` VARCHAR(100) NOT NULL ,  `Roll` VARCHAR(100) NOT NULL)');
    $username = base64_encode($_POST["user"]);
    $password = md5(md5($_POST["pw"]));
    $email = base64_encode($_POST["email"]);
    $language = base64_encode($_POST["Language"]);
    $na = $mysql->count("SELECT `Name` FROM `login` WHERE `Name` = '".$username."'");
    if($na<1){
    $mysql->query("INSERT INTO `login` (`Name`, `Password`, `Email`, `Language`, `Roll`) VALUES ('$username', '$password', '$email', '$language', 'Admin')");
    }
  }else{
    header("Location : index.php?page=2");
  }
}
}

if(file_exists('../assets/api/mysql/mysql_connetion.php')){
 $page=2;
}
if(file_exists('../assets/php/configs.php')){
  $page=3;
}
require("../assets/api/template/template.php");

$template = new template();
$template->setTempFolder("../assets/template/install/");
$template->parse($page.".tpl");

