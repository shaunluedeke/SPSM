<?php


class json_manager
{

    private static $dirname = __DIR__ . "/files/";
    private static $filename;
    function __construct($filename)
    {
        self::$filename=$filename.".json";
    }
    public function createFile($name){
            $file = fopen(self::$dirname.self::$filename, "w") or die("Unable to open file!");
        try {
            fwrite($file, json_encode($name, JSON_THROW_ON_ERROR));
        } catch (JsonException $e) {
        }
        fclose($file);
    }
    public function deleteFile(){
        $file = self::$dirname.self::$filename;
        if (file_exists($file)) {
            unlink($file);
        }
    }
    public function getAllJSONFiles(): array
    {
        $json_php_dirs = array(__DIR__ . "/files/");
        $php_file_ext = array("json");
        require_once(__DIR__ . '/../divscan/scan.php');
        return (scanDir::scan($json_php_dirs, $php_file_ext));
    }
    public function readAllFiles(): array
    {
        $json_php_dirs = array(__DIR__ . "/files/");
        $php_file_ext = array("json");
        require_once(__DIR__ . '/../divscan/scan.php');
        $files=scanDir::scan($json_php_dirs, $php_file_ext);
        $a=array();
        foreach($files as $file){
            $a[pathinfo(self::$dirname.self::$filename)['filename']]=(json_decode(file_get_contents(self::$dirname.self::$filename), true ));
        }
        return $a;

    }
    public static function getDirname(): string
    {
        return self::$dirname;
    }
    public function read(){
        return (json_decode(file_get_contents(self::$dirname.self::$filename), true ));
    }
}