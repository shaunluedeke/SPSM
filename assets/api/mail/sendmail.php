<?php

require(__DIR__ . "/../config/mail_config.php");
class sendmail
{

public function send($email,$subject,$txt){
    $to = "";
    if(is_array($email)) {
        for($i=0, $iMax = count($email); $i < $iMax; $i++){
            $to .= $email[$i] .", ";
        }
    }else{
        $to = $email;
    }

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $headers .= 'From: <'.mail_config::$from.'>' . "\r\n";
    $headers .= 'Cc: '.$to.'' . "\r\n";

    mail($to,$subject,$txt,$headers);
}
}