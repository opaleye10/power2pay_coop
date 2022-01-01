<?php

class Poslist_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }


    public function DeletePOSTransactions($id)
    {
        $sthsearch=$this->db->prepare("SELECT * FROM tbl_pos WHERE tme=:tme AND parentid=:pid AND subid=:sid");
        $sthsearch->execute(array(
            ':tme'=>$id,
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $drecord=$sthsearch->fetchAll();
        //delete from stock
        if($drecord)
        {
            foreach ($drecord as $key => $value) {
                # code...
                $pid=$value['pid'];
                $tme=$value['tme'];
                $sthdeletestock=$this->db->prepare("DELETE FROM tbl_stock WHERE stockno=:stockno AND tme=:tme AND parentid=:pid AND subid=:sid");
                $sthdeletestock->execute(array(
                    ':stockno'=>$id,
                    ':tme'=>$tme,
                    ':pid'=>Session::get("parentcompanyid"),
                    ':sid'=>Session::get('subsidiaryid')
                    ));
            }
        }
        //delete from tbl_debtors
        $sthdd=$this->db->prepare("DELETE FROM tbl_debtors WHERE tme=:tme parentid=:pid AND subid=:sid");
        $sthdd->execute(array(
            ':tme'=>$value['tme'],
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $sth=$this->db->prepare("DELETE FROM tbl_pos WHERE tme=:tme AND  parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':tme'=>$value['tme'],
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $sthhdel=$this->db->prepare("DELETE FROM tbl_poshead WHERE tme=:tme AND parentid=:pid AND subid=:sid");
        $sthhdel->execute(array(
            ':tme'=>$value['tme'],
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get('subsidiaryid')

            ));

    }

    public function approvedpost($data)
    {
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





        $sth=$this->db->prepare("SELECT * FROM tbl_pos WHERE trnno=:trn AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':trn'=>$data['trnno']
            ));
        $record=$sth->fetchAll();        
        if($record)
        {
            //print_r($record);
           // exit();
            $ptype=$data['purchasestype'];
            foreach ($record as $key => $valu) {
                # code...
                $transactiontype=$valu['purchasestype'];
                //print_r($transactiontype);
               // exit();

                if ($transactiontype==$ptype)     //cash sales
                {
                   
                    //debit cash accountid
                    //cash code already exist in tbl_pos table
                        //start here
                        //POST FOR double entry
                        //debit cash accountid
                        $sthdebit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:inv,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
                        $sthdebit->execute(array(
                            ':trndate'=>$valu['trndate'],
                            ':trnno'=>$data['trnno'],
                            ':inv'=>$data['trnno'],
                            ':accountid'=>$valu['accountid'],  //debit cash code receiving the money paid
                            ':period'=>Session::get('period'),
                            ':description'=>'Being amount paid by '. $valu['customers'] . ' for the purchase of '. $valu['qty']. ' '. $valu['product']. ' @'. $valu['price']. ' per unit',
                            ':posted'=>'N',
                            ':currentuser'=>Session::get('CurrentUser'),
                            ':pby'=>'',
                            ':debit'=>$valu['amount'],
                            ':cr'=>'0',
                            ':bref'=>'',
                            ':tme'=>$valu['tme'],
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                            ));
                        
                        

                        //credit sales revenue accountid
                        $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:inv,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
                        $sthcredit->execute(array(
                            ':trndate'=>$valu['trndate'],
                            ':trnno'=>$data['trnno'],
                            ':inv'=>$data['trnno'],
                            ':accountid'=>$salesrevcode,  //credit sale revenue code 
                            ':period'=>Session::get('period'),
                            ':description'=>'Being amount paid by '. $valu['customers'] . ' for the purchase of '. $valu['qty']. ' '. $valu['product']. ' @'. $valu['price']. ' per unit',
                            ':posted'=>'N',
                            ':currentuser'=>Session::get('CurrentUser'),
                            ':pby'=>'',
                            ':debit'=>'0',
                            ':cr'=>$valu['amount'],
                            ':bref'=>'',
                            ':tme'=>$valu['tme'],
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                            ));
        



                        //end here




                        //do the cost double entries
                        //get max cost for the past 30 days of the transactions
                        $date=date('Y-m-d', strtotime('-29 day', strtotime($valu['trndate'])));                        
                        $sthselectcost=$this->db->prepare("SELECT max(price) as mprice FROM tbl_deliverylist WHERE itemno=:itno AND parentid=:pid AND subid=:sid AND (deldate BETWEEN :gdate AND :trndate)");
                        $sthselectcost->execute(array(
                            ':itno'=>$valu['pid'],
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid'),
                            ':gdate'=>$date,
                            ':trndate'=>$valu['trndate']
                            ));
                        $costrec=$sthselectcost->fetchAll();
                       // print_r($costrec);
                       // exit();
                        $maxprice=0;
                        $damt=0;
                        if($costrec)
                        {
                            foreach ($costrec as $key => $va) {
                                # code...
                                $maxprice=$va['mprice'];

                            }
                            $damt=$valu['qty'] * $maxprice;

                            //debit cost of goods sold with the actual cost of the item
                            $sthdebit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:inv,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
                        $sthdebit->execute(array(
                            ':trndate'=>$valu['trndate'],
                            ':trnno'=>$data['trnno'],
                            ':inv'=>$data['trnno'],
                            ':accountid'=>$cogs,  //debit cost of goods sold
                            ':period'=>Session::get('period'),
                            ':description'=>'Being the cost of  '. $valu['qty']. ' '. $valu['product']. ' @'. $maxprice,
                            ':posted'=>'N',
                            ':currentuser'=>Session::get('CurrentUser'),
                            ':pby'=>'',
                            ':debit'=>$damt,
                            ':cr'=>'0',
                            ':bref'=>'',
                            ':tme'=>$valu['tme'],
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                            ));
                        
                        

                        
        

                            //credit inventory with the actual cost of the item                            
                        $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:inv,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
                        $sthcredit->execute(array(
                            ':trndate'=>$valu['trndate'],
                            ':trnno'=>$data['trnno'],
                            ':inv'=>$data['trnno'],
                            ':accountid'=>$inventory,  //credit inventory code 
                            ':period'=>Session::get('period'),
                            ':description'=>'Being the cost of  '. $valu['qty']. ' '. $valu['product']. ' @'. $maxprice,
                            ':posted'=>'N',
                            ':currentuser'=>Session::get('CurrentUser'),
                            ':pby'=>'',
                            ':debit'=>'0',
                            ':cr'=>$damt,
                            ':bref'=>'',
                            ':tme'=>$valu['tme'],
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                            ));

                        }


                        //end cost double entries
                    

                }
                else   //credit sales
                {
                         //debit debtors accountid
                        $sthdebit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:inv,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
                        $sthdebit->execute(array(
                            ':trndate'=>$valu['trndate'],
                            ':trnno'=>$data['trnno'],
                            ':inv'=>$data['trnno'],
                            ':accountid'=>$debtor,  //debitor account
                            ':period'=>Session::get('period'),
                            ':description'=>'Being goods purchased by '. $valu['customers'] . ' on credit- qty  '. $valu['qty']. ' , product - '. $valu['product']. ' @'. $valu['price']. ' per unit',
                            ':posted'=>'N',
                            ':currentuser'=>Session::get('CurrentUser'),
                            ':pby'=>'',
                            ':debit'=>$valu['amount'],
                            ':cr'=>'0',
                            ':bref'=>'',
                            ':tme'=>$valu['tme'],
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                            ));

                        //credit sales revenue accountid
                        $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:inv,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
                        $sthcredit->execute(array(
                            ':trndate'=>$valu['trndate'],
                            ':trnno'=>$data['trnno'],
                            ':inv'=>$data['trnno'],
                            ':accountid'=>$salesrevcode,  //credit sale revenue code 
                            ':period'=>Session::get('period'),
                            ':description'=>'Being goods purchased by '. $valu['customers'] . ' on credit- qty  '. $valu['qty']. ' , product - '. $valu['product']. ' @'. $valu['price']. ' per unit',
                            ':posted'=>'N',
                            ':currentuser'=>Session::get('CurrentUser'),
                            ':pby'=>'',
                            ':debit'=>'0',
                            ':cr'=>$valu['amount'],
                            ':bref'=>'',
                            ':tme'=>$valu['tme'],
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                            ));









                            //do the cost double entries
                        //get max cost for the past 30 days of the transactions
                        $date=date('Y-m-d', strtotime('-29 day', strtotime($valu['trndate'])));                        
                        $sthselectcost=$this->db->prepare("SELECT max(price) as mprice FROM tbl_deliverylist WHERE itemno=:itno AND parentid=:pid AND subid=:sid AND (deldate BETWEEN :gdate AND :trndate)");
                        $sthselectcost->execute(array(
                            ':itno'=>$valu['pid'],
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid'),
                            ':gdate'=>$date,
                            ':trndate'=>$valu['trndate']
                            ));
                        $costrec=$sthselectcost->fetchAll();
                       // print_r($costrec);
                       // exit();
                        $maxprice=0;
                        $damt=0;
                        if($costrec)
                        {
                            foreach ($costrec as $key => $va) {
                                # code...
                                $maxprice=$va['mprice'];
                            }
                            $damt=$valu['qty'] * $maxprice;

                            //debit cost of goods sold with the actual cost of the item
                            $sthdebit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:inv,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
                        $sthdebit->execute(array(
                            ':trndate'=>$valu['trndate'],
                            ':trnno'=>$data['trnno'],
                            ':inv'=>$data['trnno'],
                            ':accountid'=>$cogs,  //debit cost of goods sold
                            ':period'=>Session::get('period'),
                            ':description'=>'Being the cost of  '. $valu['qty']. ' '. $valu['product']. ' @'. $maxprice,
                            ':posted'=>'N',
                            ':currentuser'=>Session::get('CurrentUser'),
                            ':pby'=>'',
                            ':debit'=>$damt,
                            ':cr'=>'0',
                            ':bref'=>'',
                            ':tme'=>$valu['tme'],
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                            ));
                        
                        

                        
        

                            //credit inventory with the actual cost of the item                            
                        $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:inv,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
                        $sthcredit->execute(array(
                            ':trndate'=>$valu['trndate'],
                            ':trnno'=>$data['trnno'],
                            ':inv'=>$data['trnno'],
                            ':accountid'=>$inventory,  //credit inventory code 
                            ':period'=>Session::get('period'),
                            ':description'=>'Being the cost of  '. $valu['qty']. ' '. $valu['product']. ' @'. $maxprice,
                            ':posted'=>'N',
                            ':currentuser'=>Session::get('CurrentUser'),
                            ':pby'=>'',
                            ':debit'=>'0',
                            ':cr'=>$damt,
                            ':bref'=>'',
                            ':tme'=>$valu['tme'],
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                            ));

                        }


                        //end cost double entries       

                }
            }

            
            

            $sthupdate=$this->db->prepare("UPDATE tbl_poshead SET posted=:ptd WHERE trnno=:trn AND parentid=:pid AND subid=:sid");
            $sthupdate->execute(array(
                ':pid'=>Session::get('parentcompanyid'),
                ':sid'=>Session::get('subsidiaryid'),
                ':ptd'=>'Y',
                ':trn'=>$data['trnno']
                ));
        }

    
    }


    public function GetPOSAccountlist()
    {
    	$sth=$this->db->prepare("SELECT * FROM tbl_poshead WHERE posted=:ptd AND period=:period AND parentid=:pid AND subid=:sid order by trndate LIMIT 200");
    	$sth->execute(array(
    		':period'=>Session::get("period"),
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':ptd'=>''
    		));
    	return $sth->fetchAll();
    }
    public function GetPOSTransactionDetails($id)
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_pos WHERE tme=:tme AND parentid=:pid AND subid=:sid ");
        $sth->execute(array(
            ':tme'=>$id,
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

?>