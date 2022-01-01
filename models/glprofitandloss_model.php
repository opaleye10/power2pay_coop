<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Glprofitandloss_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    } 
    public function printfile($data)
    {

        //delete existing record for the current user and company
        $sthdelete=$this->db->prepare("DELETE FROM rpt_pandlacct WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
        $sthdelete->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':cuser'=>Session::get('CurrentUser')
            ));




        //select setup accountids

         $sthacode=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
                        $sthacode->execute(array(
                            ':pid'=>Session::get("parentcompanyid"),
                             ':sid'=>Session::get('subsidiaryid')
                            ));
                        $re=$sthacode->fetchAll();                        
                        $salesrevcode="";
                        $debtor="";
                        $cogs="";
                        $inventory="";
                        if($re)
                        {
                            foreach ($re as $key => $value) {
                                # code...
                                
                                $salesrevcode=$value['sales'];
                                $debtor=$value['debtor'];
                                $cogs=$value['cogs'];
                                $inventory=$value['inventory'];

                                
                            }
                        }






        //Get sales
        $period=Session::get('period');
        $sth_sales=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE mainid='01' AND parentid=:pid AND csubid=:sid");
        $sth_sales->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $sales=$sth_sales->fetchAll();  
        //print_r($sales);
        //exit();
        $gross=0;
        $totalsalesvalue=0;      
        if($sales)
        {
            foreach ($sales as $key => $svalue) {
                # code...
                $accountid=$svalue['accountid'];
                $acctdetails=$svalue['gldescription'];
                $sthfindsales=$this->db->prepare("SELECT SUM(credit) - SUM(debit) as balance FROM tbl_banktransaction WHERE accountid=:aid AND parentid=:pid AND subid=:sid AND period=:period");
                $sthfindsales->execute(array(
                    ':pid'=>Session::get('parentcompanyid'),
                    ':sid'=>Session::get('subsidiaryid'),
                    ':period'=>$period,
                    ':aid'=>$accountid
                    ));

                    $mybalance=$sthfindsales->fetch();
                    if($mybalance)  
                    {
                        $sthinsertsales=$this->db->prepare("INSERT INTO rpt_pandlacct (accountid,gldescription,amount,gtotal,parentid,subid,currentuser) VALUES (:acctid,:gldesc,:amt,:gtotal,:pid,:sid,:cuser)");
                      $sthinsertsales->execute(array(
                    ':acctid'=>$accountid,
                    ':gldesc'=>$acctdetails,
                    ':amt'=>$mybalance['balance'],
                    ':gtotal'=>0,
                    ':pid'=>Session::get('parentcompanyid'),
                    ':sid'=>Session::get('subsidiaryid'),
                    ':cuser'=>Session::get("CurrentUser")
                    ));

                   $totalsalesvalue=$totalsalesvalue+$mybalance['balance'];
                    }                  
                

            }
        }
        //get cost of goods sold
        //get accountid for cogs at the setup
        //this is it ($cogs)
        //then,get the cost of goods sold
                if($totalsalesvalue > 0)   //this means sales value found
                {
                    $sthfindcogs=$this->db->prepare("SELECT SUM(debit) - SUM(credit) as balance FROM tbl_banktransaction WHERE accountid=:aid AND parentid=:pid AND subid=:sid AND period=:period");
                $sthfindcogs->execute(array(
                    ':pid'=>Session::get('parentcompanyid'),
                    ':sid'=>Session::get('subsidiaryid'),
                    ':period'=>$period,
                    ':aid'=>$cogs
                    ));
                    $cogsvalue=$sthfindcogs->fetch();
                    if($cogsvalue)  //if the cost of good sold found
                    {
                        //insert cost of goods sold
                        
                         $sth_insertcogs=$this->db->prepare("INSERT INTO rpt_pandlacct (accountid,gldescription,amount,gtotal,parentid,subid,currentuser) VALUES (:acctid,:gldesc,:amt,:gtotal,:pid,:sid,:cuser)");
                      $sth_insertcogs->execute(array(
                    ':acctid'=>$cogs,
                    ':gldesc'=>"Cost of Goods Sold",
                    ':amt'=>$cogsvalue['balance'],
                    ':gtotal'=>0,
                    ':pid'=>Session::get('parentcompanyid'),
                    ':sid'=>Session::get('subsidiaryid'),
                    ':cuser'=>Session::get('CurrentUser')
                    ));

                        //insert the gross profit
                      $gross=$totalsalesvalue - $cogsvalue['balance'];
                       $sth_insergross=$this->db->prepare("INSERT INTO rpt_pandlacct (accountid,gldescription,amount,gtotal,parentid,subid,currentuser) VALUES (:acctid,:gldesc,:amt,:gtotal,:pid,:sid,:cuser)");
                      $sth_insergross->execute(array(
                    ':acctid'=>'Gross',
                    ':gldesc'=>"Gross Profit/Loss",
                    ':amt'=>0,
                    ':gtotal'=> $gross,
                    ':pid'=>Session::get('parentcompanyid'),
                    ':sid'=>Session::get('subsidiaryid'),
                    ':cuser'=>Session::get('CurrentUser')
                       ));
                    }
                }
                


        //get gross (total sales - cost of goods sold)
        //get expenses
                //get the list of expenses and insert appropriately
                //total expenses is needed to get net profit

                    $sth_expenses=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE mainid='02' AND parentid=:pid AND csubid=:sid");
                    $sth_expenses->execute(array(
                        ':pid'=>Session::get('parentcompanyid'),
                        ':sid'=>Session::get('subsidiaryid')
                        ));
                    $expenses=$sth_expenses->fetchAll(); 
                    $totalexpvalue=0; 
                    if($expenses)
                        {
                            foreach ($expenses as $key => $evalue) {
                                # code...
                                $accountidexp=$evalue['accountid'];
                                $acctdetailsexp=$evalue['gldescription'];
                                $sthfindexp=$this->db->prepare("SELECT SUM(debit) - SUM(credit) as bal FROM tbl_banktransaction WHERE accountid=:aid AND parentid=:pid AND subid=:sid AND period=:period");
                                $sthfindexp->execute(array(
                                    ':pid'=>Session::get('parentcompanyid'),
                                    ':sid'=>Session::get('subsidiaryid'),
                                    ':period'=>$period,
                                    ':aid'=>$accountidexp
                                    ));

                                    $expbalance=$sthfindexp->fetch();
                                    if($expbalance)  
                                    {
                                        if($accountidexp == $cogs)
                                        {

                                        }
                                        else
                                        {
                                                         $sthinsertexp=$this->db->prepare("INSERT INTO rpt_pandlacct (accountid,gldescription,amount,gtotal,parentid,subid,currentuser) VALUES (:acctid,:gldesc,:amt,:gtotal,:pid,:sid,:cuser)");
                                                  $sthinsertexp->execute(array(
                                                ':acctid'=>$accountidexp,
                                                ':gldesc'=>$acctdetailsexp,
                                                ':amt'=>$expbalance['bal'],
                                                ':gtotal'=>0,
                                                ':pid'=>Session::get('parentcompanyid'),
                                                ':sid'=>Session::get('subsidiaryid'),
                                                ':cuser'=>Session::get("CurrentUser")
                                                ));

                                               $totalexpvalue=$totalexpvalue+$expbalance['bal'];
                                        }
                                       
                                    }                  
                                

                            }

                            //insert total expenses
                             //insert the gross profit
                      
                       $sth_inserexp=$this->db->prepare("INSERT INTO rpt_pandlacct (accountid,gldescription,amount,gtotal,parentid,subid,currentuser) VALUES (:acctid,:gldesc,:amt,:gtotal,:pid,:sid,:cuser)");
                      $sth_inserexp->execute(array(
                    ':acctid'=>'Expenses',
                    ':gldesc'=>"Total Expenses",
                    ':amt'=>0,
                    ':gtotal'=> $totalexpvalue,
                    ':pid'=>Session::get('parentcompanyid'),
                    ':sid'=>Session::get('subsidiaryid'),
                    ':cuser'=>Session::get('CurrentUser')
                       ));



                      //
                      //get profit/loss (gross - total expenses)
                      $net=$gross - $totalexpvalue;
                      $sth_inserexp=$this->db->prepare("INSERT INTO rpt_pandlacct (accountid,gldescription,amount,gtotal,parentid,subid,currentuser) VALUES (:acctid,:gldesc,:amt,:gtotal,:pid,:sid,:cuser)");
                      $sth_inserexp->execute(array(
                    ':acctid'=>'Net',
                    ':gldesc'=>"Net Profit/Loss",
                    ':amt'=>0,
                    ':gtotal'=> $net,
                    ':pid'=>Session::get('parentcompanyid'),
                    ':sid'=>Session::get('subsidiaryid'),
                    ':cuser'=>Session::get('CurrentUser')
                       ));

                }
             

        
        //return the record for printing
                $sthreport=$this->db->prepare("SELECT * FROM rpt_pandlacct WHERE parentid=:pid AND subid=:sid AND currentuser=:cuser");
                $sthreport->execute(array(
                    ':pid'=>Session::get('parentcompanyid'),
                    ':sid'=>Session::get('subsidiaryid'),
                    ':cuser'=>Session::get('CurrentUser')
                    ));
                return $sthreport->fetchAll();

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