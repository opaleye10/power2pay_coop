<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 03/01/2017
 * Time: 18:28
 */
class Hash{

    public static function create($algo,$data,$salt){
       $context= hash_init($algo,HASH_HMAC,$salt);
        hash_update($context,$data);
        return hash_final($context);
    }
}