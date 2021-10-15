<?php

class random
{

    public static function getString($length=8):string{
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public static function getInt($length=8,bool $minus):int{
        $i = 0;
        try {
            for ($a = 0; $a < $length; $a++) {
                if (!$minus) {
                    $i .= random_int(1, 9);
                } else {
                    $i .= random_int(-9, -1);
                }
            }
        } catch (Exception $e) {
        }
        return $i;
    }
}