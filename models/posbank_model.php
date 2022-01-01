<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Posbank_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
    public function Getposbanklist()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_bankpos WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        return $sth->fetchAll();
    }
    public function SaveBankpos($data)
    {
        $sth=$this->db->prepare("INSERT INTO tbl_bankpos (bank,acctno,accountid,posname,parentid,subid) VALUES(:bk,:actno,:actid,:pname,:pid,:sid)");
        $sth->execute(array(
            ':bk'=>$data['bank'],
            ':actno'=>$data['acctno'],
            ':actid'=>$data['accountid'],
            ':pname'=>$data['posname'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));



        $stringsave="Record successfully saved";            
            $data=array('bank'=>$data['bank'],'accountnum'=>$data['acctno'],'posmachine'=>$data['posname'],'message'=>$stringsave);
             echo json_encode($data); 

        
    }
    public function GetBanklist()
    {
    	$sth=$this->db->prepare("SELECT * FROM tbl_banklist order by banks Asc");
    	$sth->setFetchMode(PDO::FETCH_ASSOC);
    	$sth->execute();
    	return $sth->fetchAll();
    }
    public function GetAccountid()
    {
    	$sth=$this->db->prepare("SELECT *  FROM tbl_gl_chartofaccount where subclassid='030203'");
    	$sth->setFetchMode(PDO::FETCH_ASSOC);
    	$sth->execute();
    	return $sth->fetchAll();
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