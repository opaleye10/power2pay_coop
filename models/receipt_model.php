<?php
class Receipt_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }



    public function printdebtorsbalances()
    {
        $sth=$this->db->prepare("SELECT DISTINCT customerid,customers, (SUM(debit) - sum(credit)) as balance FROM tbl_debtors WHERE parentid=:pid AND subid=:sid AND period=:period group by customerid,customers");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':period'=>Session::get('period')
            ));
        return $sth->fetchAll();
    }



    public function printdebtorshistory($data)
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_debtors WHERE parentid=:pid AND subid=:sid AND customerid=:cid AND period=:period ORDER BY id");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':period'=>Session::get('period'),
            ':cid'=>$data['id']
            ));
        return $sth->fetchAll();
        
    }

     public function GetBanks()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_banks");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function GetDebtorslist()
    {
    	$sth=$this->db->prepare("SELECT DISTINCT customerid,customers FROM tbl_debtors WHERE parentid=:pid AND subid=:sid AND period=:period");
    	$sth->execute(array(
    		':period'=>Session::get("period"),
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
    		));
    	return $sth->fetchAll();
    }
    public function GetDebtorspaysRefno()
    {
        $sth=$this->db->prepare("SELECT debtorspays FROM tbl_rfno");
        $sth->execute();
        $totref=$sth->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['debtorspays'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET debtorspays=$realno");
            $sthnupdate->execute();
          return  $totref['debtorspays'] + 1;
        }

       // return $totref;
    }


    public function SaveCashPayment($data)
    {


         $sthc=$this->db->prepare("SELECT * FROM tbl_debtors WHERE trnno=:trn AND parentid=:pid AND subid=:sid");
        $sthc->execute(array(
            ':trn'=>$data['trnno'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $recc=$sthc->fetchAll();
        if($recc)
        {
            $mystatus="NO";
            $stringsave="Duplicate: Transaction already exist";            
            $data=array('message'=>$stringsave,'status'=>$mystatus);
            echo json_encode($data); 
        }
        else
        {

        $sth=$this->db->prepare("INSERT INTO tbl_debtors(customerid,customers,trndate,trnno,description,period,posted,currentuser,astatus,postedby,debit,credit,tme,bankref,parentid,subid) VALUES(:customerid,:customers,:trndate,:trnno,:description,:period,:posted,:cuser,:ast,:pby,:dr,:credit,:tme,:bref,:pid,:sid)");
        $sth->execute(array(
            ':customerid'=>$data['customerid'],
            ':customers'=>$data['customers'],
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':description'=>$data['description'],
            ':period'=>$data['period'],
            ':posted'=>'',
            ':cuser'=>$data['currentuser'],
            ':pby'=>$data['currentuser'],
            ':ast'=>'',
            ':dr'=>'0',
            ':credit'=>$data['credit'],
            ':tme'=>$data['tme'],
            ':bref'=>'',
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
                    $cashcode=$value['cash'];
                    
                }
            }



        //POST FOR double entry
        $sthdebit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:inv,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
        $sthdebit->execute(array(
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':inv'=>$data['trnno'],
            ':accountid'=>$cashcode,  //debit cash code receiving the money paid
            ':period'=>$data['period'],
            ':description'=>$data['description'],
            ':posted'=>'N',
            ':currentuser'=>$data['currentuser'],
            ':pby'=>'',
            ':debit'=>$data['credit'],
            ':cr'=>'0',
            ':bref'=>'',
            ':tme'=>$data['tme'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));

        $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:inv,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
        $sthcredit->execute(array(
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':inv'=>$data['trnno'],
            ':accountid'=>$debitorcode,  //Credit debtors account for paying out
            ':period'=>$data['period'],
            ':description'=>$data['description'],
            ':posted'=>'N',
            ':currentuser'=>$data['currentuser'],
            ':pby'=>'',
            ':debit'=>'0',
            ':cr'=>$data['credit'],
            ':bref'=>'',
            ':tme'=>$data['tme'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        

         $sth=$this->db->prepare("SELECT debtorspays FROM tbl_rfno");
        $sth->execute();
        $totref=$sth->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['debtorspays'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET debtorspays=$realno");
            $sthnupdate->execute();
          $refno=$totref['debtorspays'] + 1;
          $refn='PAY/'.Session::get('period').'/'.$refno;
        }


        $mystatus="YES";
        $stringsave="Debtor Payment succesful";            
            $data=array('refno'=>$refn,'message'=>$stringsave,'ref'=>$refno,'status'=>$mystatus);
            echo json_encode($data); 
        }


        //03020201 cash code
        //03020401 debtors code
    }


     public function SaveBankPayment($data)
    {
        //check if the refno is duplicated or wanted to save twice
        $sthc=$this->db->prepare("SELECT * FROM tbl_debtors WHERE trnno=:trn AND parentid=:pid AND subid=:sid");
        $sthc->execute(array(
            ':trn'=>$data['trnno'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $recc=$sthc->fetchAll();
        if($recc)
        {
            $mystatus="NO";
            $stringsave="Duplicate: Transaction already exist";            
            $data=array('message'=>$stringsave,'status'=>$mystatus);
            echo json_encode($data); 
        }
        else
        {

                        $sth=$this->db->prepare("INSERT INTO tbl_debtors(customerid,customers,trndate,trnno,description,period,posted,currentuser,astatus,postedby,debit,credit,tme,bankref,parentid,subid) VALUES(:customerid,:customers,:trndate,:trnno,:description,:period,:posted,:cuser,:ast,:pby,:debit,:credit,:tme,:bankref,:pid,:sid)");
        $sth->execute(array(
            ':customerid'=>$data['customerid'],
            ':customers'=>$data['customers'],
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':description'=>$data['description'],
            ':period'=>$data['period'],
            ':posted'=>'',
            ':cuser'=>$data['currentuser'],
            ':ast'=>'',
            ':pby'=>'',
            ':debit'=>'0',
            ':credit'=>$data['credit'],
            ':tme'=>$data['tme'],
            ':bankref'=>$data['bankref'],            
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));



        //POST FOR double entry
        $sthdebit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:inv,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
        $sthdebit->execute(array(
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':inv'=>$data['trnno'],
            ':accountid'=>$data['accountid'],  //debit bank code receiving the money paid
            ':period'=>$data['period'],
            ':description'=>$data['description'],
            ':posted'=>'N',
            ':currentuser'=>$data['currentuser'],
            ':pby'=>'',
            ':debit'=>$data['credit'],
            ':cr'=>'0',
            ':bref'=>'',
            ':tme'=>$data['tme'],
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
            if($re)
            {
                foreach ($re as $key => $value) {
                    # code...
                    $debitorcode=$value['debtor'];
                    
                }
            }

        $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:inv,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
        $sthcredit->execute(array(
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':inv'=>$data['trnno'],
            ':accountid'=>$debitorcode,  //Credit debtors account for paying out
            ':period'=>$data['period'],
            ':description'=>$data['description'],
            ':posted'=>'N',
            ':currentuser'=>$data['currentuser'],
            ':pby'=>'',
            ':debit'=>'0',
            ':cr'=>$data['credit'],
            ':bref'=>'',
            ':tme'=>$data['tme'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));

  


         $sth=$this->db->prepare("SELECT debtorspays FROM tbl_rfno");
        $sth->execute();
        $totref=$sth->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['debtorspays'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET debtorspays=$realno");
            $sthnupdate->execute();
          $refno=$totref['debtorspays'] + 1;
          $refn='PAY/'.Session::get('period').'/'.$refno;
        }


        $mystatus="YES";
        $stringsave="Debtor Payment to a bank succesful";            
            $data=array('refno'=>$refn,'message'=>$stringsave,'ref'=>$refno,'status'=>$mystatuss);
            echo json_encode($data); 



        }
        
        

        
        //03020401 debtors code
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