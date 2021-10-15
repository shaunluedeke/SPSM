<?php

require(__DIR__ . "/../config/redis_config.php");

class redis_connection
{
    private static $redis;

    public static function connect(): bool
    {
        self::$redis = new Redis();
        self::$redis->connect(redis_config::$redishost,redis_config::$redisport);
        self::$redis->auth(redis_config::$redispassword);
        try {
            return self::$redis->ping() ? true : false;
        } catch (RedisException $e) {
            return false;
        }
    }

    public static function isConnected():bool
    {
        return self::$redis::ping() ? true : false;
    }

    public static function getLink()
    {
        if(!self::$redis->ping()){
            self::connect();
        }
        return self::$redis;
    }

    public static function close():bool
    {
        self::$redis::close();
        return self::$redis::ping() ? false : true;
    }

}

class redis_simple{

    private static $key = "";

    public function __construct($key){
        self::$key = $key;
    }

    public function set($value):bool
    {
        if(redis_connection::getLink !== "") {
            if(is_array($value)){
                return self::getLink()::mset(self::$key, $value);
            }else {
                return self::getLink()::set(self::$key, $value);
            }
        }else{
            return false;
        }
    }

    public function setEX($value,$sec):bool{
        if(redis_connection::$key!=="") {
                return self::getLink()::setex(self::$key,$sec, $value);
        }else{
            return false;
        }
    }

    public function getSet($value)
    {
        if(redis_connection::$key!=="") {
            return self::getLink()::getset(self::$key, $value);
        }else{
            return null;
        }
    }

    public function get(){
        if(redis_connection::$key!=="") {
            if(is_array(self::$key)) {
                return self::getLink()::mget(self::$key);
            }else{
                return self::getLink()::get(self::$key);
            }
        }else{
            return null;
        }
    }

    public function getKeys(){
        if(redis_connection::$key!=="") {
            return self::getLink()::keys(self::$key);
        }else{
            return null;
        }
    }

    public function append($value): bool
    {
        if(redis_connection::$key!=="") {
            return self::getLink()::append(self::$key,$value);
        }else{
            return false;
        }
    }

    public function delete(): bool
    {
        if(redis_connection::$key!=="") {
            return self::getLink()::del(self::$key);
        }else{
            return false;
        }
    }

    public function isSet(): bool
    {
        if(redis_connection::$key!=="") {
            if(self::getLink()::strlen(self::$key)>0){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function gettype(){
        if(redis_connection::$key!=="") {
            return self::getLink()::type(self::$key);
        }else{
            return null;
        }
    }

    public function getLengt(): int
    {
        if(redis_connection::$key!=="") {
            return self::getLink()::strlen(self::$key);
        }else{
            return -1;
        }
    }

}

class redis_hash
{

    private $key = "";

    public function __construct($hash)
    {
        self::$key = $hash;
    }

    public function getValue($field)
    {
        if (redis_connection::$key !== "") {
            if (is_array($field)) {
                return self::getLink()::hmget(self::$key, $field);
            } else {
                return self::getLink()::hget(self::$key, $field);
            }
        } else {
            return null;
        }
    }

    public function getAll()
    {
        if (redis_connection::$key !== "") {
            return self::getLink()::hmgetall(self::$key);
        } else {
            return null;
        }
    }

    public function getAllKey()
    {
        if (redis_connection::$key !== "") {
            return self::getLink()::hkeys(self::$key);
        } else {
            return null;
        }
    }

    public function getAllValue()
    {
        if (redis_connection::$key !== "") {
            return self::getLink()::hvals(self::$key);
        } else {
            return null;
        }
    }

    public function set($field, $value, bool $replace): bool
    {
        if (redis_connection::$key !== "") {
            if ($replace) {
                return self::getLink()::hset(self::$key ,$field,$value);
            } else {
                return self::getLink()::hsetnx(self::$key,$field,$value);
            }
        } else {
            return false;
        }
    }

    public function delete($field): bool
    {
        if (redis_connection::$key !== "") {
            return self::getLink()::hdel(self::$key, $field);
        } else {
            return false;
        }
    }

    public function exists($field): bool
    {
        if (redis_connection::$key !== "") {
            return self::getLink()::exists(self::$key, $field);
        } else {
            return false;
        }
    }

    public function getArrayLength(): int
    {
        if (redis_connection::$key !== "") {
            return self::getLink()::hlen(self::$key);
        } else {
            return -1;
        }
    }

    public function getLength($field): int
    {
        if (redis_connection::$key !== "") {
            return self::getLink()::hstrlen(self::$key, $field);
        } else {
            return -1;
        }
    }

}

class redis_list{
    private $key = "";

    public function __construct($key){
        self::$key = $key;
    }

    public function getValue($field){
        if((redis_connection::$key !== "") && is_int($field)) {
            return self::getLink()::lindex(self::$key,$field);
        } else{
            return null;
        }
    }

    public function add($value,bool $down): bool
    {
        if(redis_connection::$key!=="") {
            if($down){
                return self::getLink()::rpush(self::$key, $value);
            }else {
                return self::getLink()::lpush(self::$key, $value);
            }
        }else {
            return false;
        }
    }

    public function delete(bool $down){
        if(redis_connection::$key!=="") {
            if($down){
                return self::getLink()::rpop(self::$key);
            }else{
                return self::getLink()::lpop(self::$key);
            }
        }else {
            return null;
        }
    }

    public function getListLength(): int
    {
        if(redis_connection::$key!=="") {
            return self::getLink()::llen(self::$key);
        }else {
            return -1;
        }
    }

    public function getList(): int
    {
        if(redis_connection::$key!=="") {
            return self::getLink()::lrange(self::$key,0,-1);
        }else {
            return -1;
        }
    }

}