<?php
namespace App\Library;

class Common
{
    public const COOKIE_ID = 'ID';

    public const ROOT_PATH = 'http://localhost:8000/';
    public const PAGE = 8;

    /**
     * Set Hash
     * 
     * @param string $password
     * @return string $hash_pass
     */
    public static function setHash($password){
        // return password_hash($password, PASSWORD_BCRYPT);
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Create Randum String
     * @param integer $length
     * @return String $ret_str
     */
    public static function makeRandStr($length){
        $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
        $ret_str = null;
        for ($i = 0; $i < $length; $i++) {
            $ret_str .= $str[rand(0, count($str) - 1)];
        }
        return $ret_str;
    }

}