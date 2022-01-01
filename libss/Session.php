<?php
class Session{
    public static function init()
    {
        @session_start();
        $expireAfter = 30;
        if(isset($_SESSION['last_action'])){

            //Figure out how many seconds have passed
            //since the user was last active.
            $secondsInactive = time() - $_SESSION['last_action'];

            //Convert our minutes into seconds.
            $expireAfterSeconds = $expireAfter * 60;

            //Check to see if they have been inactive for too long.
            if($secondsInactive >= $expireAfterSeconds){
                //User has been inactive for too long.
                //Kill their session.
                session_unset();
                session_destroy();
            }

        }

//Assign the current timestamp as the user's
//latest activity
        $_SESSION['last_action'] = time();
    }
    public static function set($key, $value)
    {
        $_SESSION[$key]= $value;
    }
    public static function get($key)
    {
        if (isset($_SESSION[$key]))
        return $_SESSION[$key];
    }
    public static function destroy(){
        //unset($_SESSION);
        session_destroy();
    }
    public static function uset($key){
        //unset($_SESSION);
       $_SESSION[$key]="";
        return $_SESSION[$key];
    }
}