<?php


class readText
{

    public static function getString($file,$lineofset=0)
    {
        $txt = "";
        $txtarray = self::getArray($file);
        if($txtarray===null){
            return null;
        }
        for ($i = $lineofset, $iMax = count($txtarray); $i< $iMax; $i++){
            $txt.= $txtarray[$i]."<br>";
        }
        return $txt;

    }

    public static function getArray($file)
    {
        $txt = array();
        if (file_exists( $file)) {
            if ($fileman = fopen($file, "r")) {
                while (!feof($fileman)) {
                    $txt[]=fgets($fileman);
                }
            }
            return $txt;
        }
        return null;
    }


}