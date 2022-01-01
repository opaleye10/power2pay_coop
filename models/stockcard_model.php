<?php

class Stockcard_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }

    public function GetProductList()
    {
        $parentid=Session::get("parentcompanyid");
        $subid=Session::get("subsidiaryid");
         $sth=$this->db->prepare("SELECT * FROM tbl_productlist WHERE parentid=:pid AND subid=:sid");
         $sth->execute(array(
        ':pid'=>$parentid,
        ':sid'=>$subid
        ));
    return $sth->fetchAll();
    }


    public function printstockhistory($data)
    {//pickstockcard date ranges
        Session::set('sc_startdate',$data['from']);
        Session::set('sc_enddate',$data['to']);
        $parentid=Session::get("parentcompanyid");
        $subid=Session::get("subsidiaryid");
        //GET THE FIRST OF JANUARY
        $dbegin=Session::get('period').'-01-01';
       // $date =$data['from'];
        $date=date('Y-m-d', strtotime('-1 day', strtotime($data['from'])));
        

        //empty rpt_stock database table
        $sthdelete=$this->db->prepare("DELETE FROM rpt_stock WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
        $sthdelete->execute(array(
            ':cuser'=>Session::get('CurrentUser'),
            ':pid'=>$parentid,
             ':sid'=>$subid,
            ));
        
        //get the previous balance before the dfrom
        $sthp=$this->db->prepare("SELECT stockno,stock,sum(debit-credit) as balance FROM tbl_stock WHERE stockno=:stkno AND  parentid=:pid AND subid=:sid AND period=:period AND (trndate BETWEEN :dbegin AND :dfrom)  GROUP BY stockno,stock");
        $sthp->execute(array(
            ':stkno'=>$data['id'],
            ':pid'=>$parentid,
             ':sid'=>$subid,
             ':period'=>Session::get("period"),
             ':dbegin'=>$dbegin,
             ':dfrom'=>$date,
            ));
       //return $sth->fetchAll();
        $opbal=($sthp->fetchAll());
        if($opbal)
        {
            //insert it as opening balance if the stock as at that date
            foreach ($opbal as $key => $value) {
                # code...
                 $sthinsert=$this->db->prepare("INSERT INTO rpt_stock(trndate,stockno,stock,description,debit,credit,parentid,subid,period,currentuser) VALUES (:tdate,:stkno,:stock,:descc,:dr,:cr,:pid,:sid,:period,:cuser)");
                 $sthinsert->execute(array(
                    ':tdate'=>$data['from'],
                    ':stkno'=>$value['stockno'],
                    ':stock'=>$value['stock'],
                    ':descc'=>'Opening Balance as at '.$data['from'],
                    ':dr'=>$value['balance'],
                    ':cr'=>'0',
                    ':pid'=>$parentid,
                    ':sid'=>$subid,
                     ':period'=>Session::get("period"),
                     ':cuser'=>Session::get('CurrentUser')
                    ));
            }
           
        }


        $sthIN=$this->db->prepare("INSERT INTO rpt_stock (trndate,stockno,stock,description,debit,credit,parentid,subid,period,currentuser) SELECT trndate,stockno,stock,description,debit,credit,parentid,subid,period,:cuser FROM tbl_stock WHERE stockno=:stkno AND  parentid=:pid AND subid=:sid AND period=:period AND (trndate BETWEEN :dfrom AND :dto)");
        $sthIN->execute(array(
            ':stkno'=>$data['id'],
            ':pid'=>$parentid,
             ':sid'=>$subid,
             ':period'=>Session::get("period"),
             ':dfrom'=>$data['from'],
             ':dto'=>$data['to'],
             ':cuser'=>Session::get('CurrentUser')
            ));

        $sthdisplay=$this->db->prepare("SELECT * FROM rpt_stock WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
        $sthdisplay->execute(array(
            ':cuser'=>Session::get('CurrentUser'),
            ':pid'=>$parentid,
             ':sid'=>$subid
            ));
       return ($sthdisplay->fetchAll());      
        
        
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










?>