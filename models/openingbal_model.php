<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Openingbal_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
   



   public function Getbanklist()
   {
    $sth=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE parentid=:pid AND csubid=:sid AND subclassid like '%03020%'");
    $sth->execute(array(
       ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
        ));
    return $sth->fetchAll();
   }




   public function saveopeningmoney($data)
   {

       //POST FOR double entry
        $sthdebit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
        $sthdebit->execute(array(
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':invno'=>'',
            ':accountid'=>$data['accountid'],  //debit cash code receiving the money paid
            ':period'=>$data['period'],
            ':description'=>'Cash/Bank opening balance',
            ':posted'=>'',
            ':currentuser'=>Session::get('CurrentUser'),
            ':pby'=>'',
            ':debit'=>$data['debit'],
            ':cr'=>'0',
            ':bref'=>'cashbank',
            ':tme'=>$data['tme'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));

        $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
        $sthcredit->execute(array(
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':invno'=>'',
            ':accountid'=>$data['gllist'],  //Credit debtors account for paying out
            ':period'=>$data['period'],
            ':description'=>'Cash/Bank opening balance',
            ':posted'=>'',
            ':currentuser'=>Session::get('CurrentUser'),
            ':pby'=>'',
            ':debit'=>'0',
            ':cr'=>$data['debit'],
            ':bref'=>'cashbank',
            ':tme'=>$data['tme'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));

        echo "Record Successfully saved";
        
   }
 public function saveopeningdebtors($data)
    {
        //delete existing opening balance        
        $sth=$this->db->prepare("INSERT INTO tbl_debtors(customerid,customers,trndate,trnno,description,period,posted,currentuser,astatus,postedby,debit,credit,tme,bankref,parentid,subid) VALUES(:customerid,:customers,:trndate,:trnno,:description,:period,:posted,:cuser,:ast,:pby,:dr,:credit,:tme,:bref,:pid,:sid)");
        $sth->execute(array(
            ':customerid'=>$data['customerid'],
            ':customers'=>$data['customers'],
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':description'=>$data['description'],
            ':period'=>$data['period'],
            ':posted'=>'',
            ':cuser'=>Session::get('CurrentUser'),
            ':ast'=>'',
            ':pby'=>'',
            ':dr'=>$data['debit'],
            ':credit'=>'0',
            ':tme'=>$data['tme'],
            ':bref'=>'debtors',
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));


        $sthacode=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
                 $sthacode->execute(array(
                ':pid'=>Session::get("parentcompanyid"),
                 ':sid'=>Session::get('subsidiaryid')
                ));
            $re=$sthacode->fetchAll();
            $debitorcode="";
            $cashcode="";
            if($re)
            {
                foreach ($re as $key => $value) {
                    # code...
                    $debitorcode=$value['debtor'];
                    
                    
                }
            }



        //POST FOR double entry
        $sthdebit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
        $sthdebit->execute(array(
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':invno'=>'',
            ':accountid'=>$debitorcode,  //debit cash code receiving the money paid
            ':period'=>$data['period'],
            ':description'=>$data['description'],
            ':posted'=>'',
            ':currentuser'=>Session::get('CurrentUser'),
            ':pby'=>'',
            ':debit'=>$data['debit'],
            ':cr'=>'0',
            ':bref'=>'debtors',
            ':tme'=>$data['tme'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));

        $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
        $sthcredit->execute(array(
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':invno'=>'',
            ':accountid'=>$data['gllist'],  //Credit debtors account for paying out
            ':period'=>$data['period'],
            ':description'=>$data['description'],
            ':posted'=>'',
            ':currentuser'=>Session::get('CurrentUser'),
            ':pby'=>'',
            ':debit'=>'0',
            ':cr'=>$data['debit'],
            ':bref'=>'debtors',
            ':tme'=>$data['tme'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        
        $sthsel=$this->db->prepare("SELECT * FROM tbl_debtors WHERE trnno like'%opbal%' AND parentid=:pid AND subid=:sid");
        $sthsel->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $data=$sthsel->fetchAll();

        echo json_encode($data); 


        //03020201 cash code
        //03020401 debtors code
    }


   public function GetGLlist()
   {
    $sth=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE subclassid='010101' AND parentid=:pid AND csubid=:sid");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
        ));
        return $sth->fetchAll();
   }
    public function GetCustomerlist()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_customer WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
        ));
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