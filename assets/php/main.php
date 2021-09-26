<?php

class main
{

    public static function login($name,$pw,$email=true){
        if (!isset($_SESSION)) session_start();

        if($email){
            $sql = "SELECT * FROM `login` WHERE `Email`='".base64_encode($name)."'";
        }else{
            $sql = "SELECT * FROM `login` WHERE `Name`='".base64_encode($name)."'";
        }
        require_once(__DIR__.'/../api/mysql/mysql_connetion.php');
        $mysql = new mysql_connetion();
        $result=$mysql->result($sql);
        $md5pw = md5(md5($pw));

        while($row=mysqli_fetch_array($result)){
            if($row["Password"]===$md5pw){
                $_SESSION['login'] = 1;
                $_SESSION['email'] = base64_decode($row['Email']);
                $_SESSION['name'] = base64_decode($row['Name']);
                $_SESSION['language'] = base64_decode($row['Language']);
                $_SESSION['rang'] = ($row['Roll']);
                return true;
            }
        }
        return false;
    }
    public static function register($name,$pw,$email,$language,$rang){
        require_once(__DIR__.'/../api/mysql/mysql_connetion.php');
        $mysql = new mysql_connetion();
        $usernamemd5 = base64_encode($name);
        $passwordmd5 = md5(md5($pw));
        $emailmd5 = base64_encode($email);
        $languagemd5 = base64_encode($language);
        $na = $mysql->count("SELECT `Name` FROM `login` WHERE `Name` = '".$usernamemd5."'");
        if($na<1){
           return $mysql->query("INSERT INTO `login` (`Name`, `Password`, `Email`, `Language`, `Roll`) VALUES ('$usernamemd5', '$passwordmd5', '$emailmd5', '$languagemd5', '$rang')");
        }
        return false;
    }
    public static function edit($name,$email,$language,$rang,$pw,$withpw){
        require_once(__DIR__.'/../api/mysql/mysql_connetion.php');
        $mysql = new mysql_connetion();
        $usernamemd5 = base64_encode($name);

        $emailmd5 = base64_encode($email);
        $languagemd5 = base64_encode($language);
        $na = $mysql->count("SELECT `Name` FROM `login` WHERE `Name` = '".$usernamemd5."'");
        if($na>0){
            if($withpw){
                $passwordmd5 = md5(md5($pw));
                return $mysql->query("UPDATE `login` SET `Password`='$passwordmd5',`Email`='$emailmd5',`Language`='$languagemd5',`Roll`='$rang' WHERE `Name`='$usernamemd5'");
            }else{
                return $mysql->query("UPDATE `login` SET `Email`='$emailmd5',`Language`='$languagemd5',`Roll`='$rang' WHERE `Name`='$usernamemd5'");
            }
        }
        return false;
    }
}