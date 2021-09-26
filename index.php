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
                $template->parse("users.tpl");
                break;
            case "servers":
                $template->assign("htmllang",$language["html"]);
                $template->assign("title",configs::$title);
                $template->parse("servers.tpl");
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






