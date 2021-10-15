<?php
require __DIR__ . '/src/MinecraftQuery.php';
require __DIR__ . '/src/MinecraftQueryException.php';
require __DIR__ . '/src/MinecraftPing.php';
require __DIR__ . '/src/MinecraftPingException.php';
require __DIR__ . '/../config/minecraft_config.php';
class serverminecraft
{

    public static $Query = null;
    public static $Info = false;
    public function getInfo(){

        try {
            serverminecraft::$Query = new MinecraftPing(minecraft_config::$mchost, minecraft_config::$mcport, minecraft_config::$mctimeout);

            serverminecraft::$Info = serverminecraft::$Query->Query();

            if (serverminecraft::$Info === false) {

                serverminecraft::$Query->Close();
                serverminecraft::$Query->Connect();

                serverminecraft::$Info = serverminecraft::$Query->QueryOldPre17();
            }
            serverminecraft::$Query->Close();


        } catch
        (MinecraftQueryException $e) {
            return null;
        }
        return serverminecraft::$Info;


    }
    public function getPlayers(bool $max){

        try {
            serverminecraft::$Query = new MinecraftPing(minecraft_config::$mchost, minecraft_config::$mcport, minecraft_config::$mctimeout);

            serverminecraft::$Info = serverminecraft::$Query->Query();

            if (serverminecraft::$Info === false) {

                serverminecraft::$Query->Close();
                serverminecraft::$Query->Connect();

                serverminecraft::$Info = serverminecraft::$Query->QueryOldPre17();
            }
                serverminecraft::$Query->Close();


        } catch
        (MinecraftQueryException $e) {
            return null;
        }



        if($max) {
            return (serverminecraft::$Info["players"]["max"]);
        }else{
            return (serverminecraft::$Info["players"]["online"]);
        }


    }

    public function getDescription(bool $extra){

        try {
            serverminecraft::$Query = new MinecraftPing(minecraft_config::$mchost, minecraft_config::$mcport, minecraft_config::$mctimeout);

            serverminecraft::$Info = serverminecraft::$Query->Query();

            if (serverminecraft::$Info === false) {

                serverminecraft::$Query->Close();
                serverminecraft::$Query->Connect();

                serverminecraft::$Info = serverminecraft::$Query->QueryOldPre17();
            }
            serverminecraft::$Query->Close();


        } catch
        (MinecraftQueryException $e) {
            return null;
        }
            if($extra){

                $infoextra = serverminecraft::$Info["description"]["extra"];
                $i = "<div>";

                for($x = 0, $xMax = count($infoextra); $x< $xMax; $x++){

                    $color = str_replace("_","",$infoextra[$x]['color']);
                    if(isset($infoextra[$x]['bold'])&&$infoextra[$x]['bold']=="1"){
                        $newextra = '<p style="color:' . $color . '; display:inline;"><b>' . $infoextra[$x]['text'] . '</b></p>';
                    }else {
                        $newextra = '<p style="color:' . $color . '; display:inline;">' . $infoextra[$x]['text'] . '</p>';
                    }
                    $i .= $newextra;

                }

                $i .="</div>";

                return $i;

            }else {
                return (serverminecraft::$Info["description"]["text"]);
            }
    }

    public function getVersion(bool $protocol){

        try {
            serverminecraft::$Query = new MinecraftPing(minecraft_config::$mchost, minecraft_config::$mcport, minecraft_config::$mctimeout);

            serverminecraft::$Info = serverminecraft::$Query->Query();

            if (serverminecraft::$Info === false) {

                serverminecraft::$Query->Close();
                serverminecraft::$Query->Connect();

                serverminecraft::$Info = serverminecraft::$Query->QueryOldPre17();
            }
            serverminecraft::$Query->Close();


        } catch
        (MinecraftQueryException $e) {
            return null;
        }
        if($protocol){
            return (serverminecraft::$Info["version"]["protocol"]);
        }else{
            return (serverminecraft::$Info["version"]["name"]);
        }


    }

    public function getIcon(){

        try {

            serverminecraft::$Query = new MinecraftPing(minecraft_config::$mchost, minecraft_config::$mcport, minecraft_config::$mctimeout);

            serverminecraft::$Info = serverminecraft::$Query->Query();

            if (serverminecraft::$Info === false) {

                serverminecraft::$Query->Close();
                serverminecraft::$Query->Connect();

                serverminecraft::$Info = serverminecraft::$Query->QueryOldPre17();
            }
              serverminecraft::$Query->Close();


        } catch
        (MinecraftQueryException $e) {
            return null;
        }

        return(Str_Replace( "\n", "", serverminecraft::$Info["favicon"] ));

    }
}
?>