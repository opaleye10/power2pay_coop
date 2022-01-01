<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Otherpays_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
    

    public function savexpenses($data)
    {

        
        $sth=$this->db->prepare("INSERT INTO tbl_paysinvoices (trndate,trnno,accountid,gldescription,description,invno,tme,supplierid,supplier,amount,currentuser,posted,postedby,period,parentid,subid) VALUES(:trnd,:trnn,:acctid,:gldesc,:ddesc,:invno,:tme,:suppid,:supp,:amt,:cuser,:posted,:postedby,:period,:pid,:sid)");
        $sth->execute(array(
            ':trnd'=>$data['trndate'],
            ':trnn'=>$data['trnno'],
            ':acctid'=>$data['acct2debit'],            
            ':gldesc'=>$data['description'],
            ':ddesc'=>$data['description'],
            ':invno'=>$data['refno'],
            ':tme'=>$data['tme'],
            ':suppid'=>'0',
            ':supp'=>'General',
            ':amt'=>$data['amount'],
            ':cuser'=>Session::get('CurrentUser'),
            ':posted'=>'PAID',
            ':postedby'=>'',
            ':period'=>Session::get('period'),
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
            //debit one account
             $sthdebit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
                                        $sthdebit->execute(array(
                                            ':trndate'=>$data['trndate'],
                                            ':trnno'=>$data['trnno'],
                                            ':invno'=>$data['refno'],
                                            ':accountid'=>$data['acct2debit'],   
                                            ':period'=>Session::get('period'),
                                            ':description'=>$data['description'],
                                            ':posted'=>'',
                                            ':currentuser'=>Session::get('CurrentUser'),
                                            ':pby'=>'',
                                            ':debit'=>$data['amount'],
                                            ':cr'=>'0',
                                            ':bref'=>'trnst',
                                            ':tme'=>$data['tme'],
                                            ':pid'=>Session::get('parentcompanyid'),
                                            ':sid'=>Session::get('subsidiaryid')
                                            ));
            //credit another account
            $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
                                        $sthcredit->execute(array(
                                            ':trndate'=>$data['trndate'],
                                            ':trnno'=>$data['trnno'],
                                            ':invno'=>$data['refno'],
                                            ':accountid'=>$data['acct2credit'],   
                                            ':period'=>Session::get('period'),
                                            ':description'=>$data['description'],
                                            ':posted'=>'',
                                            ':currentuser'=>Session::get('CurrentUser'),
                                            ':pby'=>'',
                                            ':debit'=>'0',
                                            ':cr'=>$data['amount'],
                                            ':bref'=>'trnst',
                                            ':tme'=>$data['tme'],
                                            ':pid'=>Session::get('parentcompanyid'),
                                            ':sid'=>Session::get('subsidiaryid')
                                            ));

//get the next reference number

        $sthref=$this->db->prepare("SELECT inv FROM tbl_rfno");
        $sthref->execute();
        $totref=$sthref->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['inv'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET inv=$realno");
            $sthnupdate->execute();
          $newref= $totref['inv'] + 1;
            $stringsave="Transaction successfully saved";            
            $data=array('message'=>$stringsave,'Refno'=>$newref);
            echo json_encode($data);
        }
    }

    public function GetInvRefno()
    {
        $sth=$this->db->prepare("SELECT inv FROM tbl_rfno");
        $sth->execute();
        $totref=$sth->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['inv'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET inv=$realno");
            $sthnupdate->execute();
          return  $totref['inv'] + 1;
        }

       // return $totref;
    }

    public function GetAssetExpenses()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE parentid=:pid AND csubid=:sid AND (mainid like :mid OR mainid like :mids)");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':mid'=>'%02%',
            ':mids'=>'%03%'
            ));
        return $sth->fetchAll();
    }

    public function GetAccountid()
    {
         $sth=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE parentid=:pid AND csubid=:sid AND (subclassid like :mid OR subclassid like :mids)");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':mid'=>'%030203%',
            ':mids'=>'%030202%'
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