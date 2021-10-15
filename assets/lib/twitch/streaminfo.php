<?php

class streaminfo
{
    private $name="";
    function __construct($name) {
        $this->name=$name;
    }
    public function isLive(): bool
    {
        if (!isset($this->getInfos()['data'][0])) {
            return false;
        } else {
            return true;
        }
    }

    public function getInfos():array{
        $client_id = "qx82p59jmhus1braehs7wcnk4k3cbd";
        $secret_id = "jl7e5ixc2ngvi2u2xbdyfy5fncusof";
        $keys = false;
        if (file_exists(__DIR__ . '/auth.json')) {
            $keys = json_decode(file_get_contents(__DIR__ . '/auth.json'));
        }

        $generate_token = true;
        if ($keys) {

            $ch = curl_init('https://id.twitch.tv/oauth2/validate');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Authorization: OAuth ' . $keys->access_token
            ));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $r = curl_exec($ch);
            $i = curl_getinfo($ch);
            curl_close($ch);

            if ($i['http_code'] == 200) {
                $generate_token = false;
                $data = json_decode($r);
                if (json_last_error() == JSON_ERROR_NONE) {
                    if ($data->expires_in < 3600) {
                        $generate_token = true;
                    }
                } else {
                    $generate_token = true;
                }
            }
        } else { $generate_token = true; }

        if ($generate_token) {
            $ch = curl_init('https://id.twitch.tv/oauth2/token');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array(
                'client_id' => $client_id,
                'client_secret' => $secret_id,
                'grant_type' => "client_credentials"
            ));
            $r = curl_exec($ch);
            $i = curl_getinfo($ch);
            curl_close($ch);
            if ($i['http_code'] == 200) {
                $data = json_decode($r);
                if (json_last_error() == JSON_ERROR_NONE) {
                    file_put_contents(__DIR__ . '/auth.json', $r, JSON_PRETTY_PRINT);
                }
            }
        }
        $user = $this->name;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.twitch.tv/helix/streams?user_login=$user");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Client-ID: $client_id","Authorization: Bearer ".$keys->access_token));
        $profile_data = json_decode(curl_exec($ch), true);
        curl_close($ch);
        return $profile_data;
    }

}