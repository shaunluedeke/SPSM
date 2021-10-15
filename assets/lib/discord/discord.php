<?php

class discord
{
    private $info;
    function __construct ($info) {
        $this -> info = $info;
        if($info===null){
        }
    }
    public  function getName(): string
    {
        $info = $this->info;
        return $info->username."#".$this ->info->discriminator;
    }
    public  function getEmail(): string
    {
        $info = $this->info;
        return $info->email;
    }
    public  function getVerified(): bool
    {
        $info = $this->info;
        return $info->verified;
    }
    public  function getLocation(): bool
    {
        $info = $this->info;
        return $info->locale;
    }

    public  function getAvatar(): string
    {
        $info = $this->info;
        $avatar = $info->avatar;

        $ext = substr($avatar, 0, 2);
        if ($ext == "a_") {$avatar.= ".gif";} else {$avatar.= ".png";}

        return "https://cdn.discordapp.com/avatars/".$this ->info->id."/".$avatar;
    }

    public function get():array{
        $a=array();
            $a["name"] = $this->getName();
            $a["email"] = $this->getEmail();
            $a["location"] = $this->getLocation();
            $a["avatar"] = $this->getAvatar();
            $a["isverified"] = $this->getVerified();
        return $a;
    }
}