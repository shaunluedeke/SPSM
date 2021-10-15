<?php

require(__DIR__ . "/../config/ftp_config.php");
class ftp_connect
{

private $ftp_conn = null;

public function connect() {
    self::$ftp_conn = ftp_connect(ftp_config::$ftphost,ftp_config::$ftpport) or null;
    $login = ftp_login(self::$ftp_conn, ftp_config::$ftpusername, ftp_config::$ftppassword);
}

public function isConnected(): bool{
    if(self::$ftp_conn!==null){
        return true;
    }else{
        return false;
    }
}

public function getConnection(){
    return $this->ftp_conn;
}

public function close(): bool{
    if(self::$ftp_conn!==null){
        ftp_close(self::$ftp_conn);
        return true;
    }else{
        return false;
    }
}


}