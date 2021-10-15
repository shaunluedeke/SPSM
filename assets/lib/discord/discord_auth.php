<?php

require(__DIR__ . "/../config/discord_auth_config.php");

class discord_auth
{

    private $client_id;
    private $client_secret;
    private $redirect;

    private $authorizeURL = 'https://discordapp.com/api/oauth2/authorize';
    private $tokenURL = 'https://discordapp.com/api/oauth2/token';
    private $apiURLBase = 'https://discordapp.com/api/users/@me';

    function __construct ($redirect="",$client_id="",$client_secret="") {
        $this -> client_id = $client_id===""?discord_auth_config::$client_id:$client_id;
        $this -> client_secret = $client_secret===""?discord_auth_config::$client_secret:$client_secret;
        $this -> redirect = $redirect===""?discord_auth_config::$redirect:$redirect;
    }


    public function login () {
        header('Location: https://discordapp.com/api/oauth2/authorize' . '?' . http_build_query(array(
                "client_id" => $this -> client_id,
                "redirect_uri" => $this -> redirect,
                "response_type" => 'code',
                "scope" => discord_auth_config::$scope)));
        die();
    }

    public function get_token ($code) {
        $ch = curl_init($this -> tokenURL);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array(
            "grant_type" => "authorization_code",
            "client_id" => $this -> client_id,
            "client_secret" => $this -> client_secret,
            "redirect_uri" => $this -> redirect,
            "code" => $code)));
        $headers[] = 'Accept: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        return json_decode($response);
    }

    public function get_info ($access_token) {
        $ch = curl_init($this -> apiURLBase);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Bearer ' . $access_token;
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        return json_decode($response);
    }

    public function join_guild ($code, $guildid) {
        $user = $this -> get_info ($code);
        $ch = curl_init("https://discordapp.com/api/guilds/".$guildid."/members/".$user -> id);
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_PUT, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(array("access_token" => $access_token)));
        $headers[] = 'Accept: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $response = curl_exec($ch);
        echo curl_getinfo($ch, CURLINFO_HTTP_CODE);
        return json_decode($response);
    }

}