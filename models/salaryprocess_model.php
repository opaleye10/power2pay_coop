<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Salaryprocess_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
   
    public function processme()
    {
        $parentid=Session::get('parentcompanyid');
        $subid=Session::get('subsidiaryid');
        $sth=$this->db->prepare("SELECT * FROM tbl_periodlist WHERE status='OPEN' AND updated='N' AND parentid=$parentid AND subid=$subid");
        $sth->execute();
        $data=$sth->fetch();
        $period=$data['period'];


        $sthdelete=$this->db->prepare("DELETE FROM tbl_monthlypersonnel WHERE period=:p AND parentid=:pid AND subid=:sid");
        $sthdelete->execute(array(
            ':p'=>$period,
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        $sthstaff=$this->db->prepare("SELECT * FROM tbl_staffrecord WHERE parentid=$parentid AND subid=$subid AND rstatus='Active'");
        $sthstaff->execute();
        $staffrecord=$sthstaff->fetchAll();
        if($staffrecord)
        {
            foreach ($staffrecord as $key => $value) {
                # code...
                $staffid=$value['staffid'];
                $name=$value['fname']. ' '.$value['mname']. ' '.$value['lname'];
                $bank=$value['bank'];
                $acctno=$value['acctno'];

                //SELECT PERSONNEL COST
                $sthper=$this->db->prepare("SELECT * FROM tbl_personnel WHERE staffid=$staffid AND parentid=$parentid AND subid=$subid");
                $sthper->execute();
                $personnel=$sthper->fetchAll();
                if($personnel)
                {
                    foreach ($personnel as $ke => $valu) {
                        # code...
                        $vid=$valu['vid'];
                        $abbr=$valu['abbr'];
                        $frqno=$valu['frqno'];
                        $amount=$valu['amount'];
                        $vtype=$valu['vartype'];
                        $accountid=$valu['accountid'];
                
                        //prepare the salary process now
                    $sthInsert=$this->db->prepare("INSERT INTO tbl_monthlypersonnel(staffid,vid,varname,paytype,frq,status,amount,period,bank,acctno,accountid,parentid,subid) VALUES (:staffid,:vid,:varname,:paytype,:frq,:status,:amount,:period,:bank,:acctno,:acctid,:pid,:sid)");
                    $sthInsert->execute(array(
                        ':staffid'=>$staffid,
                        ':vid'=>$vid,
                        ':varname'=>$abbr,
                        ':paytype'=>$vtype,
                        ':frq'=>$frqno,
                        ':status'=>'No',
                        ':amount'=>$amount,
                        ':period'=>$period,
                        ':bank'=>$bank,
                        ':acctno'=>$acctno,
                        ':acctid'=>$accountid,
                        ':pid'=>$parentid,
                        ':sid'=>$subid
                        ));
                    }
                }
                
            }
        }
        echo "Salary Process for ". $period . " completed";
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