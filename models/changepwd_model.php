<?php

class Changepwd_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }


    public function changeidcode($data)
    {
        
        $sth=$this->db->prepare("UPDATE users SET password=:pwd WHERE username=:cuser AND parentid=:pid AND subid=:sid");
        $sth->execute(array(  
        ':pwd'=>$data['newpass'],          
            ':cuser'=>Session::get('CurrentUser'),
            ':pid'=>Session::get('parentcompanyid'),
             ':sid'=>Session::get('subsidiaryid')
            ));

         echo "<script type='text/javascript'>

            alert('Password Successfully change, you will be logout immediately. Login with your new password');

            window.location.replace('https://app.power2pay.com.ng/login/logout');

            </script>";
        
    }

public function searchpwd($data)
{
    $sth=$this->db->prepare("SELECT * FROM users WHERE username=:uname AND password=:pwd AND parentid=:pid AND subid=:sid");
    $sth->execute(array(
        ':uname'=>Session::get("CurrentUser"),
        ':pwd'=>$data['pwd'],
        ':pid'=>Session::get('parentcompanyid'),
        ':sid'=>Session::get('subsidiaryid')
        ));
    $rec=$sth->fetchAll();
    $stringstatus='';
    if($rec)
    {
        $stringstatus="";
    }
    else
    {
        $stringstatus="password not correct, please ensure you old password is correct";            
            $data=array('message'=>$stringstatus);
            echo json_encode($data); 
    }

    
}



    
    //setup menu rstrictions  version 1.0
    public function GetGLMenulist()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_appmenurole WHERE parentid=:pid AND subid=:sid AND roleid=:rid AND parentmenu=:pm");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':rid'=>Session::get('roleid'),
            ':pm'=>'menu_001'
            ));
        return $sth->fetchAll();
    }

    public function GetAPMenulist()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_appmenurole WHERE parentid=:pid AND subid=:sid AND roleid=:rid AND parentmenu=:pm");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':rid'=>Session::get('roleid'),
            ':pm'=>'menu_002'
            ));
        return $sth->fetchAll();
    }

     public function GetARMenulist()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_appmenurole WHERE parentid=:pid AND subid=:sid AND roleid=:rid AND parentmenu=:pm");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':rid'=>Session::get('roleid'),
            ':pm'=>'menu_003'
            ));
        return $sth->fetchAll();
    }



     public function GetPRMenulist()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_appmenurole WHERE parentid=:pid AND subid=:sid AND roleid=:rid AND parentmenu=:pm");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':rid'=>Session::get('roleid'),
            ':pm'=>'menu_004'
            ));
        return $sth->fetchAll();
    }



     public function GetINMenulist()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_appmenurole WHERE parentid=:pid AND subid=:sid AND roleid=:rid AND parentmenu=:pm");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':rid'=>Session::get('roleid'),
            ':pm'=>'menu_005'
            ));
        return $sth->fetchAll();
    }




     public function GetSTMenulist()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_appmenurole WHERE parentid=:pid AND subid=:sid AND roleid=:rid AND parentmenu=:pm");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':rid'=>Session::get('roleid'),
            ':pm'=>'menu_006'
            ));
        return $sth->fetchAll();
    }







    
 }


?>