<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Aheadreport_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
   
    public function detailsdaterange($data)
    {




    //account details date ranges from tbl_banktrabsaction
        Session::set('sc_startdate',$data['from']);
        Session::set('sc_enddate',$data['to']);
        $parentid=Session::get("parentcompanyid");
        $subid=Session::get("subsidiaryid");





         //get account description from chatof account
        $sthget=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE accountid=:acctid AND parentid=:pid AND csubid=:sid");
        $sthget->execute(array(
            ':acctid'=>$data['head'],
            ':pid'=>$parentid,
             ':sid'=>$subid            
            ));
        $getdd=$sthget->fetchAll();
        $getmyheadname="";
        foreach ($getdd as $key => $v) {
            # code...
            $getmyheadname=$v['gldescription'];


        }
        Session::set('dtitle',$getmyheadname);


        //GET THE FIRST OF JANUARY
        $dbegin=Session::get('period').'-01-01';
       // $date =$data['from'];
        $date=date('Y-m-d', strtotime('-1 day', strtotime($data['from'])));
        //empty rpt_stock database table
        $sthdelete=$this->db->prepare("DELETE FROM rpt_accountdetails WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
        $sthdelete->execute(array(
            ':cuser'=>Session::get('CurrentUser'),
            ':pid'=>$parentid,
             ':sid'=>$subid
            ));
        
        //get the previous balance before the dfrom
        $sthp=$this->db->prepare("SELECT accountid,sum(debit-credit) as balance FROM tbl_banktransaction WHERE accountid=:acctid AND  parentid=:pid AND subid=:sid AND period=:period AND (trndate BETWEEN :dbegin AND :dfrom)  GROUP BY accountid");
        $sthp->execute(array(
            ':acctid'=>$data['head'],
            ':pid'=>$parentid,
             ':sid'=>$subid,
             ':period'=>Session::get("period"),
             ':dbegin'=>$dbegin,
             ':dfrom'=>$date
            ));
      // print_r($sthp->fetchAll());
      // exit();
        $opbal=($sthp->fetchAll());
        if($opbal)
        {
            //insert it as opening balance if the stock as at that date
            foreach ($opbal as $key => $value) {
                # code...
                 $sthinsert=$this->db->prepare("INSERT INTO rpt_accountdetails(trndate,descriptions,debit,credit,parentid,subid,period,currentuser,accountid) VALUES (:tdate,:descc,:dr,:cr,:pid,:sid,:period,:cuser,:acctid)");
                 $sthinsert->execute(array(
                    ':tdate'=>$data['from'],                    
                    ':descc'=>'Opening Balance as at '.$data['from'],
                    ':dr'=>$value['balance'],
                    ':cr'=>'0',
                    ':pid'=>$parentid,
                    ':sid'=>$subid,
                     ':period'=>Session::get("period"),
                     ':cuser'=>Session::get('CurrentUser'),
                     ':acctid'=>$data['head']
                    ));
            }
           
        }


        $sthIN=$this->db->prepare("INSERT INTO rpt_accountdetails (trndate,descriptions,debit,credit,parentid,subid,period,accountid,currentuser) SELECT trndate,description,debit,credit,parentid,subid,period,accountid,:cuser FROM tbl_banktransaction WHERE accountid=:acctid AND  parentid=:pid AND subid=:sid AND period=:period AND (trndate BETWEEN :dfrom AND :dto)");
        $sthIN->execute(array(
            ':acctid'=>$data['head'],
            ':pid'=>$parentid,
             ':sid'=>$subid,
             ':period'=>Session::get("period"),
             ':dfrom'=>$data['from'],
             ':dto'=>$data['to'],
             ':cuser'=>Session::get('CurrentUser')
            ));

        $sthdisplay=$this->db->prepare("SELECT * FROM rpt_accountdetails WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
        $sthdisplay->execute(array(
            ':cuser'=>Session::get('CurrentUser'),
            ':pid'=>$parentid,
             ':sid'=>$subid
            ));
        //print_r($sthdisplay->fetchAll());
       // exit();
       return ($sthdisplay->fetchAll());      
        
        
    }












    public function GetAcctYr($id)
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_accountperiod WHERE id=:id");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':id'=>$id
        ));
        return $sth->fetch();
    }

    public function GetGLAccountHead()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE parentid=:pid AND csubid=:sid");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        return $sth->fetchAll();
    }

    public function GetAccountperiodlist(){
        $sth=$this->db->prepare("SELECT * FROM tbl_accountperiod");
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