<?php
require(__DIR__ . "/../config/db_config.php");

class mysql_connetion
{
    private static $link = null;
    public function connect(): bool{

        if(self::$link===null) {
            self::$link = mysqli_connect(db_config::$mysqlhost, db_config::$mysqlusername, db_config::$mysqlpassword, db_config::$mysqldatabase, db_config::$mysqlport);
            if (mysqli_connect_errno()) {
                return false;
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
    public function getLink(){
        if(self::$link===null){
            self::connect();
        }
        return self::$link;
    }
    public function disconnect(): bool {
        if(self::$link!==null) {
            mysqli_close(self::$link);
            return true;
        }else{
            return false;
        }
    }
    public function query($query): bool{
        if(self::$link===null){
            self::connect();
        }
        if(self::$link!==null) {
            if(mysqli_query(self::$link, $query)===TRUE){
                return true;
            }else {
                return false;
            }
        }
    }
    public function result($query){
        if(self::$link===null){
            self::connect();
        }
        if(self::$link!==null) {
            if($result = mysqli_query(self::$link, $query)){
                return $result;
            }else {
                return null;
            }
        }
    }
    public function count($query):int{
        if(self::$link===null){
            self::connect();
        }
        if(self::$link!==null) {
            if($result = mysqli_query(self::$link, $query)){
                return mysqli_num_rows($result);
            }else {
                return 0;
            }
        }
        return 0;
    }
}