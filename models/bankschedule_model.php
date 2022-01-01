<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Bankschedule_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
   

public function displaybankschedule($data)
{

    $parentid=Session::get('parentcompanyid');
        $subid=Session::get('subsidiaryid');
        $cuser=Session::get("CurrentUser");
        $period=$data['period'];
        $month=substr($period, 1,2);
        $year=substr($period, 4,4);
// Use mktime() and date() function to 
// convert number to month name 
        $month_name = date("F", mktime(0, 0, 0, $month, 10)); 
  
// Display month name 
    //delete 
    $sthdelete=$this->db->prepare("DELETE FROM rpt_bankschedule WHERE cuser=:cuser");
    $sthdelete->execute(array(
        ':cuser'=>$cuser
        ));


    //use active users(rstatus) to get the available 
    $sthloop=$this->db->prepare("SELECT * FROM tbl_staffrecord WHERE rstatus=:rst AND parentid=:pid AND subid=:sid");
    $sthloop->execute(array(
        ':rst'=>'Active',
        ':pid'=>$parentid,
        ':sid'=>$subid
        ));
    $record=$sthloop->fetchAll();
    if($record)
    {
        foreach ($record as $key => $value) {
            # code...
            $staffid=$value['staffid'];
            $staffname=$value['fname'].' '.$value['mname'].' '.$value['lname'];
            $bank=$value['bank'];
            $acctno=$value['acctno'];

            //get pay for the staff
            $sthpays=$this->db->prepare("SELECT SUM(amount) AS pays FROM tbl_monthlypersonnel WHERE period=:period AND staffid=:staffid AND paytype=:ptype AND parentid=:pid AND subid=:sid");
            $sthpays->execute(array(
                ':period'=>$period,
                ':staffid'=>$staffid,
                ':ptype'=>'P',
                ':pid'=>$parentid,
                ':sid'=>$subid
                ));
            $pays=$sthpays->fetchAll();
            if($pays)
            {
                foreach ($pays as $key => $value) {
                    # code...
                    $payments=$value['pays'];
                }
                //get deductions

                $sthded=$this->db->prepare("SELECT SUM(amount) AS ded FROM tbl_monthlypersonnel WHERE period=:period AND staffid=:staffid AND paytype=:ptype AND parentid=:pid AND subid=:sid");
            $sthded->execute(array(
                ':period'=>$period,
                ':staffid'=>$staffid,
                ':ptype'=>'D',
                ':pid'=>$parentid,
                ':sid'=>$subid
                ));
            $ded=$sthded->fetchAll();
            if($ded)
            {
                foreach ($ded as $key => $value) {
                    # code...
                    $deductions=$value['ded'];
                }
                $netpay=($payments-$deductions);
               // print_r($staffid.' '.$staffname. ' '.$bank.' '.$acctno.' '.$period.' '.$netpay. ' '. $cuser.' '. $month_name. ' '. $year);
                $sthinsert=$this->db->prepare("INSERT INTO rpt_bankschedule (staffid,staffname,bank,acctno,period,amount,cuser,nmonth,nyear) VALUES(:staffid,:sname,:bank,:acctno,:period,:amount,:cuser,:nmonth,:nyear)");
                $sthinsert->execute(array(
                    ':staffid'=>$staffid,
                    ':sname'=>$staffname,
                    ':bank'=>$bank,
                    ':acctno'=>$acctno,
                    ':period'=>$period,
                    ':amount'=>$netpay,
                    ':cuser'=>$cuser,
                    ':nmonth'=>$month_name,
                    ':nyear'=>$year       
                    ));
              
            }


            }


        }
        $sthreturn=$this->db->prepare("SELECT * FROM rpt_bankschedule WHERE cuser=:cuser");
            $sthreturn->execute(array(
                ':cuser'=>$cuser
                ));
            return $sthreturn->fetchAll();
    }
}

 public function GetPeriodList()
   {
    $parentid=Session::get('parentcompanyid');
    $subid=Session::get('subsidiaryid');
    $sth=$this->db->prepare("SELECT * FROM tbl_periodlist WHERE parentid=$parentid AND subid=$subid");
    $sth->execute();
   return ($sth->fetchAll());
    //exit();
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