<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 02:20
 */

class Salaryinfo_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }




    public function GetBanklist()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_banklist");
        $sth->execute();
        return $sth->fetchAll();
    }


    public function GetSalaryBank()
    {
        $sth = $this->db->prepare("SELECT * FROM tbl_salary_bank");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();

    }
    public function GetSalaryCagetory()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_salary_category");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }
    public function saverecord($data)
    {
        //verified record existence
        $sth1=$this->db->prepare("SELECT * FROM tbl_staffrecord WHERE staffid=:staffid");
        $sth1->execute(array(
           ':staffid'=>$data['staffid']
        ));
        $count=$sth1->fetch();
        if($count)
        {
            echo "Record Already exist";
        }
        else {
            $sth = $this->db->prepare("INSERT INTO tbl_staffrecord (staffid,fname,mname,lname,sex,phonenumber,contactaddress,email,title,mstatus,religion,rstatus,currentuser,employment,deptpost,bank,acctno,parentid,subid) VALUES (:staffid,:fname,:mname,:lname,:sex,:phoneno,:cadd,:email,:title,:mstatus,:religion,:rst,:cuser,:emp,:dept,:bank,:acctno,:pid,:sid)");
            $sth->execute(array(
                ':staffid' => $data['staffid'],
                ':fname' => $data['firstname'],
                ':mname' => $data['middlename'],
                ':lname' => $data['lastname'],
                ':sex'=>$data['sex'],
                ':phoneno'=>$data['phonenumber'],
                ':cadd'=>$data['contactaddress'],
                ':email'=>$data['email'],
                ':title'=>$data['title'],
                ':mstatus'=>$data['mstatus'],
                ':religion'=>$data['religion'],
                ':rst'=>'Active',
                ':cuser'=>Session::get("CurrentUser"),
                ':emp'=>$data['employment'],
                ':dept'=>$data['deptpost'],
                ':bank'=>$data['bank'],
                ':acctno'=>$data['acctno'],
                ':pid'=>Session::get('parentcompanyid'),
                ':sid'=>Session::get('subsidiaryid')
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

