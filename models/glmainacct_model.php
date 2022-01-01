<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 14/02/2017
 * Time: 09:38
 */

class Glmainacct_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
    public function GetGLHeald($data)
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_gl_subaccount WHERE mainid=:mainid");
        $sth->execute(array(
            ':mainid'=>$data['mainid']
        ));
        return $sth->fetchAll();
    }
    public function GetGlsubAcctintable()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_gl_subaccount WHERE parentid=:pid");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid')
            ));
        return $sth->fetchAll();
    }
    public function getglAcct()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_gl_top");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function SaveGLSubhead($data)
    {
        $sth=$this->db->prepare("INSERT INTO tbl_gl_subaccount (mainid,subid,sub_desc,parentid) VALUES(:mainid,:subid,:desca,:pid)");
        $sth->execute(array(
           ':mainid'=>$data['mainid'],
           ':subid'=>$data['subid'],
           ':desca'=>$data['sub_desc'],
           ':pid'=>Session::get('parentcompanyid')
        ));
        echo "GL Sub Account setup successfully saved";
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