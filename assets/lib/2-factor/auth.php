<?php
class auth
{

    private $id;
    function __construct($id=0){
        $this->id = $id;
    }

    public function verify($key):bool{

            $ip = $_SERVER['REMOTE_ADDR'];
            require_once(__DIR__ ."/../json/json_manager.php");
            $json = new json_manager("auth");

            $all = $json->read();

            if(isset($all[$ip])){
            require_once(__DIR__."/googleLib/GoogleAuthenticator.php");
            $ga = new GoogleAuthenticator();
            return $ga->verifyCode($all[$ip], $key,2);
            }

        return false;
    }

    public static function generateSecret(){
        require_once(__DIR__."/googleLib/GoogleAuthenticator.php");

        $ga = new GoogleAuthenticator();
        $ga->createSecret(32);

        return base64_encode(base64_encode($ga));
    }

    public static function createSecret(){
        $ip = $_SERVER['REMOTE_ADDR'];
        require_once(__DIR__ ."/../json/json_manager.php");
        $json = new json_manager("auth");

        $all = $json->read();
        if(!isset($all[$ip])) {
            $all[$ip] = self::generateSecret();
            $json->createFile($all);
        }
    }
}