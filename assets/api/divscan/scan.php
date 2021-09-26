<?php
class scanDir {
    static private $directories, $files, $ext_filter, $recursive;


    static public function scan(){
        self::$recursive = false;
        self::$directories = array();
        self::$files = array();
        self::$ext_filter = false;

        if(!$args = func_get_args()){
            die("Muss ein String oder ein String Array sein!");
        }
        if(gettype($args[0]) != "string" && gettype($args[0]) != "array"){
            die("Muss ein String oder ein String Array sein!");
        }

        if(isset($args[2]) && $args[2] == true){self::$recursive = true;}

        if(isset($args[1])){
            if(gettype($args[1]) == "array"){self::$ext_filter = array_map('strtolower', $args[1]);}
            else
                if(gettype($args[1]) == "string"){self::$ext_filter[] = strtolower($args[1]);}
        }

        self::verifyPaths($args[0]);
        return self::$files;
    }

    static private function verifyPaths($paths){
        $path_errors = array();
        if(gettype($paths) == "string"){$paths = array($paths);}

        foreach($paths as $path){
            if(is_dir($path)){
                self::$directories[] = $path;
                $dirContents = self::find_contents($path);
            } else {
                $path_errors[] = $path;
            }
        }

        if($path_errors){echo "Der Ordner existier nicht!<br />";die(var_dump($path_errors));}
    }

    static private function find_contents($dir){
        $result = array();
        $root = scandir($dir);
        foreach($root as $value){
            if($value === '.' || $value === '..') {continue;}
            if(is_file($dir.DIRECTORY_SEPARATOR.$value)){
                if(!self::$ext_filter || in_array(strtolower(pathinfo($dir.DIRECTORY_SEPARATOR.$value, PATHINFO_EXTENSION)), self::$ext_filter)){
                    self::$files[] = $result[] = $dir.DIRECTORY_SEPARATOR.$value;
                }
                continue;
            }
            if(self::$recursive){
                foreach(self::find_contents($dir.DIRECTORY_SEPARATOR.$value) as $value) {
                    self::$files[] = $result[] = $value;
                }
            }
        }
        return $result;
    }

    public static function find_by_name($dir,$name,$txt = false){
        $root = scandir($dir);
        foreach($root as $value){
            if($value === '.' || $value === '..') {continue;}
            if(is_file($dir.DIRECTORY_SEPARATOR.$value)){
                if(strtolower(pathinfo($dir.DIRECTORY_SEPARATOR.$value)['filename'])===strtolower($name)){
                    if(!$txt && strtolower(pathinfo($dir.DIRECTORY_SEPARATOR.$value)['extension'])!=="txt"){
                        return pathinfo($dir.DIRECTORY_SEPARATOR.$value)['extension'];
                    }
                    if($txt){
                        return pathinfo($dir.DIRECTORY_SEPARATOR.$value)['extension'];
                    }
                }
            }
        }
        return null;
    }
}
?>