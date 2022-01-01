<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 01:27
 */
class Menu_Model extends Model
{
    public function __construct()
    {
        parent::__construct();
        Session::init();
    }

    public function GetAppRoleList()
    {
    	$sth=$this->db->prepare("SELECT * FROM tbl_role");
    	$sth->execute();
    	return $sth->fetchAll();
    }

    public function GetMenuHead()
    {
    	$sth=$this->db->prepare('SELECT * FROM tbl_mainmenu');
    	$sth->execute();
    	return $sth->fetchAll();
    }

    public function addappmenu($data)
    {

        
        $sth=$this->db->prepare("SELECT * FROM tbl_appmenurole WHERE submenu=:sb AND roleid=:rid AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':sb'=>$data['submenu'],
            ':rid'=>$data['roleid'],
            ':pid'=>$data['parentid'],
            ':sid'=>$data['subid']
            ));
        $record=$sth->fetchAll();
        if($record)
        {
            echo "Menu already exist on the selected role, please, check the table below";
        }
        else
        {
            
            //insert into the table            
            $sthin=$this->db->prepare("INSERT INTO tbl_appmenurole (parentid,subid,roleid,rolename,parentmenu,parentmenudesc,submenu,submenudesc,currentuser) VALUES(:parentid,:subid,:roleid,:rolename,:parentmenu,:parentmenudesc,:submenu,:submenudesc,:cuser)");
            $sthin->execute(array(
                ':parentid'=>$data['parentid'],
                ':subid'=>$data['subid'],
                ':roleid'=>$data['roleid'],
                ':rolename'=>$data['rolename'],
                ':parentmenu'=>$data['parentmenu'],
                ':parentmenudesc'=>$data['parentmenudesc'],
                ':submenu'=>$data['submenu'],
                ':submenudesc'=>$data['submenudesc'],
                ':cuser'=>$data['currentuser']
            ));
            /*
            //select record to display
            $sths=$this->db->prepare("SELECT * FROM tbl_appmenurole WHERE roleid=:rid");
            $sths->execute(array(
                ':rid'=>$data['roleid']
                ));
            */
            echo "Menu successfully saved";
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





    //end menu restriction codes

}