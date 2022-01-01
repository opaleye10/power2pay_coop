<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 22/01/2017
 * Time: 01:27
 */
//create_image();
function create_image()
{
    $rand= md5(rand(0,999));
    $value = substr($rand,10,8);
    $width =100;
    $height = 30;

    $image=imagecreate($width,$height);
    $black= imagecolorallocate($image,0,0,0);
    $white= imagecolorallocate($image,255,255,255);

    $grey= imagecolorallocate($image,132,132,132);
    $blue= imagecolorallocate($image,138,197,255);
    imagefill($image,0,0,$blue);
    header('Content-Type: image/gif');
    imageline($image,0,$height/2,$width,$height/2,$grey);
    imageline($image,$width/2,0,$width/2,$height,$grey);

    imageline($image,0,0,$width,$height,$grey);
    imageline($image,0,$height,$width,0,$grey);
    imagestring($image,5,15,7,$value, $black);
    imagegif($image);
    imagedestroy($image);
    Session::init();
    Session::set('catpcha_key',$value);
   // exit(0);

}