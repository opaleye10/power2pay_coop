<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Banksummary_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }

    public function displaysummary($data)
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


        $sthdelete=$this->db->prepare("DELETE FROM rpt_banksummary WHERE cuser=:cuser");
        $sthdelete->execute(array(
            ':cuser'=>$cuser
            ));
        $sth=$this->db->prepare("SELECT * FROM tbl_salary_bank");
        $sth->execute();
        $banks=$sth->fetchAll();        
        if($banks)
        {
            foreach ($banks as $key => $value) {
                # code...

                $bank=$value['bank'];

                //get gross pay
                $sthsel=$this->db->prepare("SELECT sum(amount) AS GrossPay FROM tbl_monthlypersonnel WHERE period=:period AND paytype=:ptype AND bank=:bank AND parentid=:pid AND subid=:sid");
                $sthsel->execute(array(
                    ':period'=>$period,
                    ':ptype'=>'P',
                    ':bank'=>$bank,
                    ':pid'=>$parentid,
                    ':sid'=>$subid
                    ));
                $findgross=$sthsel->fetchAll();                
                if($findgross)
                {
                   
                    foreach ($findgross as $key => $grs) {
                    # code...
                         $grossamt=$grs['GrossPay'];
                    }

                        
                         //get gross pay
                        $sthsel1=$this->db->prepare("SELECT sum(amount) AS Deductions FROM tbl_monthlypersonnel WHERE period=:period AND paytype=:ptype AND bank=:bank AND parentid=:pid AND subid=:sid");
                        $sthsel1->execute(array(
                            ':period'=>$period,
                           ':ptype'=>'D',
                            ':bank'=>$bank,
                        ':pid'=>$parentid,
                        ':sid'=>$subid
                            ));
                        $findd=$sthsel1->fetchAll();                  
                        
                        foreach ($findd as $key => $ddd) {
                            # code...
                            $dedamt=$ddd['Deductions'];
                        }


                        $sthcst=$this->db->prepare("SELECT count(distinct(staffid)) AS TotalNumber FROM  tbl_monthlypersonnel  WHERE period=:period AND bank=:bank AND parentid=:pid AND subid=:sid");
                        $sthcst->execute(array(
                            ':period'=>$period,
                            ':bank'=>$bank,
                            ':pid'=>$parentid,
                        ':sid'=>$subid
                            ));
                        $totstno=$sthcst->fetchAll();
                        $totalstaffno=0;
                        foreach ($totstno as $key => $valu) {
                            # code...
                            $totalstaffno=$valu['TotalNumber'];
                        }
                        $netpay=0;
                        $netpay=($grossamt-$dedamt);                       
                        //now insert into the report table
                        //print_r($period. ' '.$bank.' '.$totalstaffno. ' '.$netpay. ' '.$cuser.' '.$month_name.' '.$year);
                        $sthinsert=$this->db->prepare("INSERT INTO rpt_banksummary (period,bank,noofstaff,amount,cuser,nmonth,nyear) VALUES(:period,:bank,:noofstaff,:amt,:cuser,:nmonth,:nyear)");                       

                        $sthinsert->execute(array(
                            ':period'=>$period,
                            ':bank'=>$bank,
                            ':noofstaff'=>$totalstaffno,
                            ':amt'=>$netpay,
                            ':cuser'=>$cuser,
                            ':nmonth'=>$month_name,
                            ':nyear'=>$year                            
                            ));
                       
                }               
                


            }
            $sthreturn=$this->db->prepare("SELECT * FROM rpt_banksummary WHERE cuser=:cuser AND noofstaff >0");
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