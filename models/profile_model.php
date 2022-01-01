<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 07/02/2017
 * Time: 01:10
 */

class Profile_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
    public function GetCompanyProfile()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_firm");
        $sth->setFetchMode(PDO:: FETCH_ASSOC);
        $sth->execute();
        return $sth->fetch();
    }
    public function SaveProfile($data)
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_firm WHERE companyname=:cname");
        $sth->execute(array(
           ':cname'=>$data['companyname']
        ));
        $count=$sth->fetchAll();
        if($count){
            //this means, record was found but still need update
            $sth1=$this->db->prepare("UPDATE tbl_firm SET companyaddress=:cadd, companymobile=:cmobile WHERE companyname=:cname");
            $sth1->execute(array(
               ':cadd'=>$data['companyadd'],
                ':cmobile'=>$data['companymobile'],
                ':cname'=>$data['companyname']
            ));
            echo "Record found but successfully updated";
        }
        else
        {
            $sth2=$this->db->prepare("INSERT INTO tbl_firm (companyname,companyaddress,companymobile) VALUES (:cname,:cadd,:cmobile)");
            $sth2->execute(array(
               ':cname'=>$data['companyname'],
               ':cadd'=>$data['companyadd'],
               ':cmobile'=>$data['companymobile']
            ));
            echo "Record successfully saved";
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