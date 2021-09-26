<?php
session_start();
if(!file_exists("assets/php/configs.php")){
    die("<h1>Die Installation ist nicht fertig</h1>");
}
require("assets/php/configs.php");
require("assets/api/template/template.php");
$template = new template();

require("assets/php/languagemanager.php");

$language = languagemanager::get();

$site = $_GET['site'] ?? "";

if(empty($_SESSION['login'])||(int)$_SESSION['login']===0) {
    $template->setTempFolder("assets/template/login/");

    switch($site){
        case "register":
            if(isset($_POST['register'])){
                if(isset($_POST['pw'],$_POST['email'],$_POST['username'])){
                    require_once('assets/php/main.php');
                    if(main::register($_POST['username'],$_POST['pw'],$_POST['email'],$_POST['Language'],"default")){
                        header('Location: index.php');
                    }else{
                        echo '<script>alert("there was a mistake!");</script>';
                    }
                }
            }
            $template->assign("htmllang",$language["html"]);
            $template->assign("title",configs::$title);
            $template->parse("register.tpl");
            break;

        default:
            if(isset($_POST['login'])){
                require_once('assets/php/main.php');
                if(main::login($_POST['name'],$_POST['pw'],isset($_POST['email'],$_POST['pw']))){
                    header("Location: index.php");
                }else{
                    if(isset($_POST['email'],$_POST['pw'])){
                        echo '<script>alert("the password or the email adress is incorrect!");</script>';
                    }else{
                        echo '<script>alert("the password or the username is incorrect!");</script>';
                    }
                }
            }
            $template->assign("htmllang",$language["html"]);
            $template->assign("title",configs::$title);
            $template->assign("useremail",$language["Login"]["useremail"]);
            $template->assign("password",$language["Login"]["password"]);
            $template->assign("login",$language["Login"]["login"]);
            $template->parse("index.tpl");
            break;
    }

}

else if($_SESSION['rang']==="Admin"){
    $template->setTempFolder("assets/template/admincp/");

    switch($site){
            case "users":
                $template->assign("htmllang",$language["html"]);
                $template->assign("title",configs::$title);
                $template->assign("language",$language["Admin"]["Users"]["language"]);
                $template->assign("open",$language["Admin"]["Users"]["open"]);

                require("assets/api/mysql/mysql_connetion.php");
                $mysql = new mysql_connetion();
                $db_res = $mysql->result( "SELECT * FROM `login` ");

                while($row = mysqli_fetch_array($db_res)){
                    $user_loop = array();
                    $user_loop["name"] = base64_decode($row["Name"]);
                    $user_loop["email"] = base64_decode($row["Email"]);
                    $user_loop["language"] = base64_decode($row["Language"]);
                    $user_loop["rang"] = $row["Roll"];
                    $template->assign("user_loop",$user_loop);
                }

                $template->parse("users.tpl");
                break;

            case "user":
                $name = $_GET["name"] ?? "";

                require("assets/api/mysql/mysql_connetion.php");
                $mysql = new mysql_connetion();

                if(isset($_POST["edit"])){
                    if(main::edit($_POST['username'],$_POST['email'],$_POST['Language'],"default",$_POST['pw'],isset($_POST['pw']))){
                        header("Location: index.php?site=users");
                    }else{
                        echo '<script>alert("there was a mistake!");</script>';
                        header("Location: index.php?site=users");
                    }

                }

                $template->assign("name",$name);
                $template->assign("htmllang",$language["html"]);
                $template->assign("title",configs::$title);


                $db_res = $mysql->result( "SELECT * FROM `login` WHERE `Name`='".base64_encode($name)."'");

                $email="";
                $german = false;
                $admin = false;
                while($row = mysqli_fetch_array($db_res)){
                    $email = base64_decode($row["Email"]);
                    $german = base64_decode($row["Language"])==="GER";
                    $admin = $row["Roll"]==="Admin";
                }
                $template->assign("email",$email);
                $template->assign("ger",$german);
                $template->assign("admin",$admin);
                $template->parse("user.tpl");
                break;

            case "server-add":
                if(isset($_POST["add"])){
                    require("assets/api/mysql/mysql_connetion.php");
                    $mysql = new mysql_connetion();

                    $name = $_POST["name"];
                    $host = $_POST["host"];
                    $port = $_POST["port"];
                    $rang = $_POST["rang"];

                    if($mysql->count("SELECT * FROM `servers` WHERE `Server`='".$name."'")<1){

                        if($mysql->query("INSERT INTO `servers`(`Server`, `Host`, `Port`, `Roll`) VALUES ('$name','$host','$port','$rang')")){
                            header("Location: index.php?site=servers");
                        }else{
                            echo '<script>alert("there was a mistake!");</script>';
                            header("Location: index.php?site=servers");
                        }
                    }else{
                        if($mysql->query("UPDATE `servers` SET `Host`='$host',`Port`='$port',`Roll`='$rang' WHERE `Server`='$name'")){
                            header("Location: index.php?site=servers");
                        }else{
                            echo '<script>alert("there was a mistake!");</script>';
                            header("Location: index.php?site=servers");
                        }
                    }
                }

                $template->assign("htmllang",$language["html"]);
                $template->assign("title",configs::$title);


                $template->parse("server-add.tpl");
                break;
            case "servers":
                $template->assign("htmllang",$language["html"]);
                $template->assign("title",configs::$title);
                $template->assign("open",$language["Admin"]["Users"]["open"]);

                require("assets/api/mysql/mysql_connetion.php");
                $mysql = new mysql_connetion();
                if($mysql->count("SELECT * FROM `servers` ")<1){
                    $template->assign("serverloopstatus",false);
                }else {
                    $template->assign("serverloopstatus",true);
                    $db_res = $mysql->result("SELECT * FROM `servers` ");

                    while ($row = mysqli_fetch_array($db_res)) {
                        $server_loop = array();
                        $server_loop["name"] = ($row["Server"]);
                        $server_loop["host"] = ($row["Host"]);
                        $server_loop["port"] = ($row["Port"]);
                        $server_loop["rang"] = $row["Roll"];
                        $template->assign("server_loop", $server_loop);
                    }
                }
                $template->parse("servers.tpl");
                break;

            case "server":
                $name = $_GET["name"] ?? "";

                require("assets/api/mysql/mysql_connetion.php");
                $mysql = new mysql_connetion();
                $db_res = $mysql->result("SELECT * FROM `servers` WHERE `Server`='".$name."'");

                $host = "";
                $port = 0;
                $rang = "";

                while ($row = mysqli_fetch_array($db_res)) {
                    $host = $row['Host'];
                    $port = (int)$row['Port'];
                    $rang = $row['Roll'];
                }
                require("assets/api/serverstatus/Serverstatus.php");
                if($host=="localhost"||$host=="127.0.0.1"){

                    $template->assign("local", true);
                    $template->assign("cpuload",Serverstatus::getServerLoad());
                    $template->assign("memory",Serverstatus::getServerMemoryUsage(true));
                    $template->assign("speicher1",Serverstatus::free_disk_space(true));
                    $template->assign("speicher2",Serverstatus::free_disk_space(false));
                }else{
                    $template->assign("local", false);
                    $template->assign("ping2", Serverstatus::ping($host,$port,1));
                    $template->assign("ping1", sprintf('%1.0f',Serverstatus::ping($host,$port,1)/10));
                    $template->assign("host", $host);
                    $template->assign("port", $port);
                }

                $template->assign("name",$name);
                $template->assign("htmllang",$language["html"]);
                $template->assign("title",configs::$title);


                $template->parse("server.tpl");

                break;

            case "logout":
                $_SESSION['Login'] = 0;
                $_SESSION['email'] = "";
                $_SESSION['name'] = "";
                $_SESSION['language'] = "";
                $_SESSION['rang'] = "";
                session_destroy();
                header('Location: index.php');
                break;

                default:
                $template->assign("Name",$_SESSION['name']);
                $template->assign("htmllang",$language["html"]);
                $template->assign("title",configs::$title);

                $template->assign("welcome",$language["Admin"]["Index"]["welcome"]);
                $template->assign("allusers",$language["Admin"]["Index"]["allusers"]);
                $template->assign("allservers",$language["Admin"]["Index"]["allservers"]);
                $template->assign("shownow",$language["Admin"]["Index"]["shownow"]);

                require("assets/api/mysql/mysql_connetion.php");
                $mysql = new mysql_connetion();
                $db_res = $mysql->count( "SELECT `Name` FROM `login` ");
                $template->assign("usernumber",$db_res);


                $db_res1 = $mysql->count( "SELECT `Server` FROM `servers` ");
                $template->assign("servernumber",$db_res1);

                $template->parse("index.tpl");
                break;
    }
}
else{
    $template->setTempFolder("assets/template/usercp/");

    switch($site){
            case "logout":
                $_SESSION['Login'] = 0;
                $_SESSION['email'] = "";
                $_SESSION['name'] = "";
                $_SESSION['language'] = "";
                $_SESSION['rang'] = "";
                session_destroy();
                header('Location: index.php');
                break;
            default:
                break;
    }
}






