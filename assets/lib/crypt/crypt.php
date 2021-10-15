<?php

class crypt
{
    private static $pw;
    function __construct($pw)
    {
        self::$pw=$pw;
    }

    private $md5key = "A!9HHhi%XjjYY4YP2@Nob009X";

    public function setmd5() {

        $qEncoded = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( self::$md5key ), self::$pw, MCRYPT_MODE_CBC, md5( md5( self::$md5key ) ) ) );
        return( $qEncoded );
    }

    public function readmd5() {
        $qDecoded = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( self::$md5key ), base64_decode( self::$pw ), MCRYPT_MODE_CBC, md5( md5( self::$md5key ) ) ), "\0");
        return( $qDecoded );
    }

    public function setbase64() {
        return( base64_encode(self::$pw) );
    }

    public function readbase64() {
        return( base64_decode(self::$pw) );
    }
    public function setsha256() {
        return( hash("sha512",self::$pw) );
    }
}