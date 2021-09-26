<?php

class languagemanager
{

    public static function get(){
        if (!isset($_SESSION)) session_start();
        require_once(__DIR__."/configs.php");
        $language = $_SESSION['language']??configs::$language;
        return (json_decode(file_get_contents(__DIR__ . "/../language/" . $language . ".json"), true, ));
    }
}