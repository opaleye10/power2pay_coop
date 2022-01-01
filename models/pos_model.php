<?php

class Pos_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }

    public function load_mcl_para($data)
    {
        //total debt
        $sthtd=$this->db->prepare("SELECT DISTINCT SUM(debit-credit) as balance FROM tbl_debtors WHERE customerid=:cid");
        $sthtd->execute(array(
            ':cid'=>$data['cid']
            ));
        $mBal=$sthtd->fetchAll();

        foreach ($mBal as $key => $value) {
            # code...
            $ibal=$value['balance'];
        }
        
       


        //total credit limit
            $sthcl=$this->db->prepare("SELECT * FROM tbl_maxcreditlevel WHERE cid=:cid");
            $sthcl->execute(array(
                ':cid'=>$data['cid']
                ));
            $mCl=$sthcl->fetchAll();

        foreach ($mCl as $key => $value) {
            # code...
            $icl=$value['mcl'];
            $imv=$value['losv'];
        }

        $mcl=$icl;
        $y= ((10/100) * $mcl);
        $vooja=$imv;
        $cbal=$ibal;
        $bBal=($mcl-($vooja + $cbal));    



        $stringsave="Cash Sales transaction successfully saved";            
            $data=array('bal'=>$ibal,'mcl'=>$bBal, 'mv'=>$y, 'message'=>$stringsave);
            echo json_encode($data); 

        

        //cuurent materials value


    }
public function GetPOS()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_bankpos WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        return $sth->fetchAll();
    }
    public function GetBanks()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_banks WHERE parentid=:pid AND subid=:sid");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
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


    public function printreceipt($data)
    {
         $parentid=Session::get("parentcompanyid");
         $subid=Session::get("subsidiaryid");
        $sth=$this->db->prepare("SELECT * FROM tbl_pos WHERE tme=:tme AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':tme'=>$data['tmej'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
       return $sth->fetchAll();
        

    }

    public function GetDailySalesReports()
    {
        $sth=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE currentuser=:currentuser AND trndate=:tddate");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':currentuser'=>Session::get('CurrentUser'),
            ':tddate'=>date("Y-m-d")
            ));
        return $sth->fetchAll();
    }
    public function GetDailySalesReports_Credit()
    {
        $parentid=Session::get("parentcompanyid");
        $subid=Session::get("subsidiaryid");
        $sth=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE paymenttype=:purch and currentuser=:currentuser AND trndate=:tddate AND parentid=:pid AND subid=:sid");
       $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':purch'=>'Credit',
            ':currentuser'=>Session::get('CurrentUser'),
            ':tddate'=>date("Y-m-d"),
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        return $sth->fetchAll();
    }

    public function GetDailySalesReports_pos()
    {
        $sth=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE paymenttype=:purch and currentuser=:currentuser AND trndate=:tddate");
       $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':purch'=>'pos',
            ':currentuser'=>Session::get('CurrentUser'),
            ':tddate'=>date("Y-m-d")
            ));
        return $sth->fetchAll();
    }

  public function GetDailySalesReports_transfer()
    {
        $sth=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE paymenttype=:purch and currentuser=:currentuser AND trndate=:tddate");
       $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':purch'=>'transfer',
            ':currentuser'=>Session::get('CurrentUser'),
            ':tddate'=>date("Y-m-d")
            ));
        return $sth->fetchAll();
    }



    public function GetDailySalesReports_Cash()
    {
        $sth=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE paymenttype=:purch and currentuser=:currentuser AND trndate=:tddate");
       $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':purch'=>'Cash',
            ':currentuser'=>Session::get('CurrentUser'),
            ':tddate'=>date("Y-m-d")
            ));
        return $sth->fetchAll();
    }

public function GetPOSjref()
    {
        $sth=$this->db->prepare("SELECT jref FROM tbl_rfno");
        $sth->execute();
        $totref=$sth->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['jref'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET jref=$realno");
            $sthnupdate->execute();
          return  $totref['jref'] + 1;
        }

    }


    public function GetCustomer()
    {
        $parentid=Session::get("parentcompanyid");
    $subid=Session::get("subsidiaryid");
    	$sth=$this->db->prepare("SELECT * FROM tbl_customer WHERE parentid=:pid AND subid=:sid");
    	$sth->execute(array(
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
    	return $sth->fetchAll();
    }

    public function DeleteTempoSale()
    {
        $parentid=Session::get("parentcompanyid");
    $subid=Session::get("subsidiaryid");
    	$sth=$this->db->prepare("DELETE FROM tbl_pos_temp WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
    	$sth->execute(array(
    		':cuser'=>Session::get('CurrentUser'),
            ':pid'=>$parentid,
            ':sid'=>$subid
    		));
    }

public function GetPosRefno()
    {
        $sth=$this->db->prepare("SELECT pos FROM tbl_rfno");
        $sth->execute();
        $totref=$sth->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['pos'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET pos=$realno");
            $sthnupdate->execute();
          return  $totref['pos'] + 1;
        }

       // return $totref;
    }



    public function SaveTempoSale($data)
    {
         $parentid=Session::get("parentcompanyid");
        $subid=Session::get("subsidiaryid");
        $sths=$this->db->prepare("SELECT * FROM tbl_pos_temp WHERE pid=:pid AND parentid=:paid AND subid=:sid ");
        $sths->execute(array(
            ':pid'=>$data['pid'],
            ':paid'=>$parentid,
            ':sid'=>$subid
            ));
        $count=$sths->fetchAll();
        if($count)
        {
            echo "Items already exist in this transaction";
        }
        else
        {
            $sth=$this->db->prepare("INSERT INTO tbl_pos_temp (qty,price,amount,pid,product,currentuser,parentid,subid) VALUES(:qty,:price,:amount,:pid,:product,:currentuser,:paid,:sid)");
        $sth->execute(array(
            ':qty'=>$data['qty'],
            ':price'=>$data['price'],
            ':amount'=>$data['amount'],
            ':pid'=>$data['pid'],
            ':product'=>$data['product'],
            ':currentuser'=>$data['currentuser'],
            ':paid'=>$parentid,
            ':sid'=>$subid
            ));

        echo "Product Inserted successfully";
        }

    	
    }


public function SaveCreditSales($data)
{
    $parentid=Session::get("parentcompanyid");
        $subid=Session::get("subsidiaryid");
        //save stock
        $sthstocksave=$this->db->prepare("SELECT * FROM tbl_pos_temp WHERE currentuser=:currentuser AND parentid=:pid AND subid=:sid");
        $sthstocksave->setFetchMode(PDO::FETCH_ASSOC);
        $sthstocksave->execute(array(
            ':currentuser'=>$data['currentuser'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        $count=$sthstocksave->fetchAll();
        foreach ($count as $key => $value) {
            $qty=$value['qty'];
            $pid=$value['pid'];
            $product=$value['product'];
            $desc="Credit purchase by ".$data['customers'] . ' with transaction no ' .$data['trnno'];
            $sthinsertstock=$this->db->prepare("INSERT INTO tbl_stock (trndate,stockno,stock,description,debit,credit,period,tme,parentid,subid) VALUES(:trdate,:pid,:product,:dec,:dr,:qty,:period,:tme,:paid,:sid)");
            $sthinsertstock->execute(array(
                ':trdate'=>$data['trndate'],
                ':pid'=>$pid,
                ':product'=>$product,
                ':dec'=>$desc,
                ':dr'=>'0',
                ':qty'=>$qty,
                ':period'=>$data['period'],
                ':tme'=>$data['tme'],
                ':paid'=>$parentid,
                ':sid'=>$subid
                ));
        }
        //getAmount summation
        $sthsum=$this->db->prepare("SELECT SUM(amount) as amt FROM tbl_pos_temp WHERE currentuser=:currentuser AND parentid=:pid AND subid=:sid");
        $sthsum->execute(array(
            ':currentuser'=>$data['currentuser'],
            ':pid'=>$parentid,
            ':sid'=>$subid            
            ));
        $amt=$sthsum->fetch();
        if($amt)
        {
          $amount=$amt['amt'];
          $sthposhead=$this->db->prepare("INSERT INTO tbl_poshead(customerid,customers,trnno,amount,period,posted,trndate,currentuser,approvedby,tme,parentid,subid) VALUES(:customerid,:customers,:trnno,:amount,:period,:posted,:trndate,:currentuser,:appby,:tme,:pid,:sid)");
        $sthposhead->execute(array(
            ':customerid'=>$data['customerid'],
            ':customers'=>$data['customers'],
            ':trnno'=>$data['trnno'],
            ':amount'=>$amount,
            ':period'=>$data['period'],
            ':posted'=>'',
            ':trndate'=>$data['trndate'],
            ':currentuser'=>$data['currentuser'],
            ':appby'=>'',
            ':tme'=>$data['tme'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        //save  data
        $sth=$this->db->prepare("INSERT INTO tbl_pos (qty,price,amount,pid,product,currentuser,trndate,trnno,customerid,customers,purchasestype,paymenttype,period,duedate,tme,parentid,subid,posted,astatus,payreference,accountid) SELECT qty,price,amount,pid,product,currentuser,:trndate,:trnno,:customerid,:customers,:purchasestype,:paymenttype,:period,:duedate,:tme,:pid,:sid,:posted,:ast,:payref,:acctid FROM tbl_pos_temp WHERE CurrentUser =:cuser AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':customerid'=>$data['customerid'],
            ':customers'=>$data['customers'],
            ':purchasestype'=>$data['purchasestype'],
            ':paymenttype'=>$data['paymenttype'],            
            ':period'=>$data['period'],
            ':duedate'=>$data['duedate'],
            ':cuser'=>$data['currentuser'],
            ':tme'=>$data['tme'],
            ':pid'=>$parentid,
            ':sid'=>$subid,
            ':posted'=>'',
            ':ast'=>'',
            ':payref'=>'',
            ':acctid'=>'03020401'
            ));
        //save customer debts record
        $sthcustomer=$this->db->prepare("INSERT INTO tbl_debtors (customerid,customers,trndate,trnno,description,period,currentuser,debit,tme,parentid,subid,posted,astatus,postedby,credit,bankref) VALUES(:customerid,:customers,:trndate,:trnno,:description,:period,:cuser,:dr,:tme,:pid,:sid,:posted,:ast,:postedby,:credit,:bankref)");
        $sthcustomer->execute(array(
            ':customerid'=>$data['customerid'],
            ':customers'=>$data['customers'],
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':description'=>'Being purchases of goods',
            ':period'=>$data['period'],
            ':cuser'=>$data['currentuser'],
            ':dr'=>$amount,
            ':tme'=>$data['tme'],
            ':pid'=>$parentid,
            ':sid'=>$subid,
            ':posted'=>'',
            ':ast'=>'',
            ':postedby'=>'',
            ':credit'=>'0',
            ':bankref'=>''
            ));
        //delete temporary records
        $sthdelete=$this->db->prepare("DELETE FROM tbl_pos_temp WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
        $sthdelete->execute(array(
            ':cuser'=>$data['currentuser'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));




        //get total credit sales for the day
        $sth=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE purchasestype=:purch and currentuser=:currentuser AND trndate=:tddate AND parentid=:pid AND subid=:sid");
       $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':purch'=>'Credit',
            ':currentuser'=>Session::get('CurrentUser'),
            ':tddate'=>date("Y-m-d"),
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        $totacreditsales= $sth->fetchAll();
        foreach ($totacreditsales as $key => $value) {
            # code...
            $credit=$value['ntotalamt'];
        }
        
        //get total sales for the day
        $sthd=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE currentuser=:currentuser AND trndate=:tddate AND parentid=:pid AND subid=:sid");
        $sthd->setFetchMode(PDO::FETCH_ASSOC);
        $sthd->execute(array(
            ':currentuser'=>Session::get('CurrentUser'),
            ':tddate'=>date("Y-m-d"),
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        $totaldailysales= $sthd->fetchAll();
        foreach ($totaldailysales as $key => $value) {
            # code...
            $totalsales=$value['ntotalamt'];
        }


        //get posJref

        $sthj=$this->db->prepare("SELECT jref FROM tbl_rfno");
        $sthj->execute();
        $totref=$sthj->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['jref'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET jref=$realno");
            $sthnupdate->execute();
          $jrefno= $totref['jref'] + 1;
        }


        //get POS new refno

         $sth=$this->db->prepare("SELECT pos FROM tbl_rfno");
        $sth->execute();
        $totref=$sth->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['pos'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET pos=$realno");
            $sthnupdate->execute();
          $posrefno=  $totref['pos'] + 1;
          $posref='POS/'.Session::get('period').'/'.$posrefno;
        }


        $stringsave="Credit Sales transaction successfully saved";            
            $data=array('posrefno'=>$posref,'jref'=>$jrefno,'totalsales'=>$totalsales,'credit'=>$credit,'message'=>$stringsave);
            echo json_encode($data); 

       // echo "Credit Sales transaction successfully saved";
        }
     
}

    public function SaveCashSales($data)
    {

        $parentid=Session::get("parentcompanyid");
        $subid=Session::get("subsidiaryid");
        //save stock
        $sthstocksave=$this->db->prepare("SELECT * FROM tbl_pos_temp WHERE currentuser=:currentuser AND parentid=:pid AND subid=:sid");
        $sthstocksave->setFetchMode(PDO::FETCH_ASSOC);
        $sthstocksave->execute(array(
            ':currentuser'=>$data['currentuser'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        $count=$sthstocksave->fetchAll();
        foreach ($count as $key => $value) {
            $qty=$value['qty'];
            $pid=$value['pid'];
            $product=$value['product'];
            $desc="Cash purchases by ".$data['customers'] . ' with transaction no ' .$data['trnno'];
            $sthinsertstock=$this->db->prepare("INSERT INTO tbl_stock (trndate,stockno,stock,description,debit,credit,period,tme,parentid,subid) VALUES(:trdate,:pid,:product,:dsc,:dr,:qty,:period,:tme,:paid,:sid)");
            $sthinsertstock->execute(array(
                ':trdate'=>$data['trndate'],
                ':pid'=>$pid,
                ':product'=>$product,
                ':dsc'=>$desc,
                ':dr'=>'0',
                ':qty'=>$qty,
                ':period'=>$data['period'],
                ':tme'=>$data['tme'],
                ':paid'=>$parentid,
                ':sid'=>$subid
                ));
        }
        //getAmount summation
        $sthsum=$this->db->prepare("SELECT SUM(amount) as amt FROM tbl_pos_temp WHERE currentuser=:currentuser AND parentid=:pid AND subid=:sid");
        $sthsum->execute(array(
            ':currentuser'=>$data['currentuser'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        $amt=$sthsum->fetch();
        if($amt)
        {
          $amount=$amt['amt'];
          $sthposhead=$this->db->prepare("INSERT INTO tbl_poshead(customerid,customers,trnno,amount,period,posted,trndate,currentuser,approvedby,tme,parentid,subid) VALUES(:customerid,:customers,:trnno,:amount,:period,:posted,:trndate,:currentuser,:appby,:tme,:pid,:sid)");
        $sthposhead->execute(array(
            ':customerid'=>$data['customerid'],
            ':customers'=>$data['customers'],
            ':trnno'=>$data['trnno'],
            ':amount'=>$amount,
            ':period'=>$data['period'],
            ':posted'=>'',
            ':trndate'=>$data['trndate'],
            ':currentuser'=>$data['currentuser'],
            ':appby'=>'',
            ':tme'=>$data['tme'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        //save  data
        $sth=$this->db->prepare("INSERT INTO tbl_pos (qty,price,amount,pid,product,currentuser,trndate,trnno,customerid,customers,purchasestype,paymenttype,period,tme,parentid,subid,posted,astatus,duedate,payreference,accountid) SELECT qty,price,amount,pid,product,currentuser,:trndate,:trnno,:customerid,:customers,:purchasestype,:paymenttype,:period,:tme,parentid,subid,:posted,:ast,:duedate,:payref,:acctid FROM tbl_pos_temp WHERE CurrentUser =:cuser AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':customerid'=>$data['customerid'],
            ':customers'=>$data['customers'],
            ':purchasestype'=>$data['purchasestype'],
            ':paymenttype'=>$data['paymenttype'],            
            ':period'=>$data['period'],
            ':cuser'=>$data['currentuser'],
            ':tme'=>$data['tme'],
            ':pid'=>$parentid,
            ':sid'=>$subid,
            ':posted'=>'',
            ':ast'=>'',
            ':duedate'=>'',
            ':payref'=>'',
            ':acctid'=>'03020201'
            ));
        //save POS head
        $sthdelete=$this->db->prepare("DELETE FROM tbl_pos_temp WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid ");
        $sthdelete->execute(array(
            ':cuser'=>$data['currentuser'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        //get total Cash sales for the day
        $sth=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE paymenttype=:purch and currentuser=:currentuser AND trndate=:tddate AND parentid=:pid AND subid=:sid");
       $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':purch'=>'Cash',
            ':currentuser'=>Session::get('CurrentUser'),
            ':tddate'=>date("Y-m-d"),
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        $totacashsales= $sth->fetchAll();
        foreach ($totacashsales as $key => $value) {
            # code...
            $cash=$value['ntotalamt'];
        }
        
        //get total sales for the day
        $sthd=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE currentuser=:currentuser AND trndate=:tddate AND parentid=:pid AND subid=:sid");
        $sthd->setFetchMode(PDO::FETCH_ASSOC);
        $sthd->execute(array(
            ':currentuser'=>Session::get('CurrentUser'),
            ':tddate'=>date("Y-m-d"),
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        $totaldailysales= $sthd->fetchAll();
        foreach ($totaldailysales as $key => $value) {
            # code...
            $totalsales=$value['ntotalamt'];
        }


        //get posJref

        $sthj=$this->db->prepare("SELECT jref FROM tbl_rfno");
        $sthj->execute();
        $totref=$sthj->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['jref'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET jref=$realno");
            $sthnupdate->execute();
          $jrefno= $totref['jref'] + 1;
        }


        //get POS new refno

         $sth=$this->db->prepare("SELECT pos FROM tbl_rfno");
        $sth->execute();
        $totref=$sth->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['pos'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET pos=$realno");
            $sthnupdate->execute();
          $posrefno=  $totref['pos'] + 1;
          $posref='POS/'.Session::get('period').'/'.$posrefno;
        }


        $stringsave="Cash Sales transaction successfully saved";            
            $data=array('posrefno'=>$posref,'jref'=>$jrefno,'totalsales'=>$totalsales,'cash'=>$cash,'message'=>$stringsave);
            echo json_encode($data); 









      //  echo "Transaction successfully saved";
        }
    }

    public function SavePosTransferSales($data)
    {
        $parentid=Session::get("parentcompanyid");
        $subid=Session::get("subsidiaryid");
        //save stock
        $sthstocksave=$this->db->prepare("SELECT * FROM tbl_pos_temp WHERE currentuser=:currentuser AND parentid=:pid AND subid=:sid");
        $sthstocksave->setFetchMode(PDO::FETCH_ASSOC);
        $sthstocksave->execute(array(
            ':currentuser'=>$data['currentuser'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        $count=$sthstocksave->fetchAll();
        foreach ($count as $key => $value) {
            $qty=$value['qty'];
            $pid=$value['pid'];
            $product=$value['product'];
            $desc="Bank Transfer payment-purchases by ".$data['customers'] . ' with transaction no ' .$data['trnno'];
            $sthinsertstock=$this->db->prepare("INSERT INTO tbl_stock (trndate,stockno,stock,description,debit,credit,period,tme,parentid,subid) VALUES(:trdate,:pid,:product,:dsc,:dr,:qty,:period,:tme,:paid,:sid)");
            $sthinsertstock->execute(array(
                ':trdate'=>$data['trndate'],
                ':pid'=>$pid,
                ':product'=>$product,
                ':dsc'=>$desc,
                ':dr'=>"0",
                ':qty'=>$qty,
                ':period'=>$data['period'],
                ':tme'=>$data['tme'],
                ':paid'=>$parentid,
                ':sid'=>$subid
                ));
        }
        //getAmount summation
        $sthsum=$this->db->prepare("SELECT SUM(amount) as amt FROM tbl_pos_temp WHERE currentuser=:currentuser AND parentid=:pid AND subid=:sid");
        $sthsum->execute(array(
            ':currentuser'=>$data['currentuser'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        $amt=$sthsum->fetch();
        if($amt)
        {
          $amount=$amt['amt'];
          $sthposhead=$this->db->prepare("INSERT INTO tbl_poshead(customerid,customers,trnno,amount,period,posted,trndate,currentuser,approvedby,tme,parentid,subid) VALUES(:customerid,:customers,:trnno,:amount,:period,:posted,:trndate,:currentuser,:appby,:tme,:pid,:sid)");
        $sthposhead->execute(array(
            ':customerid'=>$data['customerid'],
            ':customers'=>$data['customers'],
            ':trnno'=>$data['trnno'],
            ':amount'=>$amount,
            ':period'=>$data['period'],
            ':posted'=>'',
            ':trndate'=>$data['trndate'],
            ':currentuser'=>$data['currentuser'],
            ':appby'=>'',
            ':tme'=>$data['tme'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        //save  data
        $sth=$this->db->prepare("INSERT INTO tbl_pos (qty,price,amount,pid,product,currentuser,trndate,trnno,customerid,customers,purchasestype,paymenttype,payreference,period,accountid,tme,parentid,subid,posted,astatus,duedate) SELECT qty,price,amount,pid,product,currentuser,:trndate,:trnno,:customerid,:customers,:purchasestype,:paymenttype,:payreference,:period,:accountid,:tme,:pid,:sid,:posted,:astar,:dd FROM tbl_pos_temp WHERE CurrentUser =:cuser AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':customerid'=>$data['customerid'],
            ':customers'=>$data['customers'],
            ':purchasestype'=>$data['purchasestype'],
            ':paymenttype'=>$data['paymenttype'],
            ':payreference'=>$data['payreference'],
            ':period'=>$data['period'],
            ':accountid'=>$data['accountid'],
            ':cuser'=>$data['currentuser'],
            ':tme'=>$data['tme'],
            ':pid'=>$parentid,
            ':sid'=>$subid,
            ':posted'=>'',
            ':astar'=>'',
            ':dd'=>''
            ));
        //save POS head
        $sthdelete=$this->db->prepare("DELETE FROM tbl_pos_temp WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
        $sthdelete->execute(array(
            ':cuser'=>$data['currentuser'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));



//get total transfer payment(cash) sales for the day
        $sth=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE paymenttype=:purch and currentuser=:currentuser AND trndate=:tddate AND parentid=:pid AND subid=:sid");
       $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':purch'=>'Transfer',
            ':currentuser'=>Session::get('CurrentUser'),
            ':tddate'=>date("Y-m-d"),
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        $totacashsales= $sth->fetchAll();
        foreach ($totacashsales as $key => $value) {
            # code...
            $cash=$value['ntotalamt'];
        }
        
        //get total sales for the day
        $sthd=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE currentuser=:currentuser AND trndate=:tddate AND parentid=:pid AND subid=:sid");
        $sthd->setFetchMode(PDO::FETCH_ASSOC);
        $sthd->execute(array(
            ':currentuser'=>Session::get('CurrentUser'),
            ':tddate'=>date("Y-m-d"),
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        $totaldailysales= $sthd->fetchAll();
        foreach ($totaldailysales as $key => $value) {
            # code...
            $totalsales=$value['ntotalamt'];
        }


        //get posJref

        $sthj=$this->db->prepare("SELECT jref FROM tbl_rfno");
        $sthj->execute();
        $totref=$sthj->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['jref'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET jref=$realno");
            $sthnupdate->execute();
          $jrefno= $totref['jref'] + 1;
        }


        //get POS new refno

         $sth=$this->db->prepare("SELECT pos FROM tbl_rfno");
        $sth->execute();
        $totref=$sth->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['pos'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET pos=$realno");
            $sthnupdate->execute();
          $posrefno=  $totref['pos'] + 1;
          $posref='POS/'.Session::get('period').'/'.$posrefno;
        }


        $stringsave="Transfer payment for this transaction successfully saved";            
            $data=array('posrefno'=>$posref,'jref'=>$jrefno,'totalsales'=>$totalsales,'transfer'=>$cash,'message'=>$stringsave);
            echo json_encode($data); 












        //echo "POS/Transfer Payment made-transaction successfully saved";
        }
        
        
    }
    

 public function SavePosSales($data)
    {
        $parentid=Session::get("parentcompanyid");
        $subid=Session::get("subsidiaryid");
        //save stock
        $sthstocksave=$this->db->prepare("SELECT * FROM tbl_pos_temp WHERE currentuser=:currentuser AND parentid=:pid AND subid=:sid");
        $sthstocksave->setFetchMode(PDO::FETCH_ASSOC);
        $sthstocksave->execute(array(
            ':currentuser'=>$data['currentuser'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        $count=$sthstocksave->fetchAll();
        foreach ($count as $key => $value) {
            $qty=$value['qty'];
            $pid=$value['pid'];
            $product=$value['product'];
            $desc="POS Payment purchases by ".$data['customers'] . ' with transaction no ' .$data['trnno'];
            $sthinsertstock=$this->db->prepare("INSERT INTO tbl_stock (trndate,stockno,stock,description,debit,credit,period,tme,parentid,subid) VALUES(:trdate,:pid,:product,:dsc,:dr,:qty,:period,:tme,:paid,:sid)");
            $sthinsertstock->execute(array(
                ':trdate'=>$data['trndate'],
                ':pid'=>$pid,
                ':product'=>$product,
                ':dsc'=>$desc,
                ':dr'=>'0',
                ':qty'=>$qty,
                ':period'=>$data['period'],
                ':tme'=>$data['tme'],
                ':paid'=>$parentid,
                ':sid'=>$subid
                ));
        }
        //getAmount summation
        $sthsum=$this->db->prepare("SELECT SUM(amount) as amt FROM tbl_pos_temp WHERE currentuser=:currentuser AND parentid=:pid AND subid=:sid");
        $sthsum->execute(array(
            ':currentuser'=>$data['currentuser'],
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        $amt=$sthsum->fetch();
        if($amt)
        {
                  $amount=$amt['amt'];
                  $sthposhead=$this->db->prepare("INSERT INTO tbl_poshead(customerid,customers,trnno,amount,period,trndate,currentuser,tme,parentid,subid,posted,approvedby) VALUES(:customerid,:customers,:trnno,:amount,:period,:trndate,:currentuser,:tme,:pid,:sid,:posted,:appby)");
                $sthposhead->execute(array(
                    ':customerid'=>$data['customerid'],
                    ':customers'=>$data['customers'],
                    ':trnno'=>$data['trnno'],
                    ':amount'=>$amount,
                    ':period'=>$data['period'],
                    ':trndate'=>$data['trndate'],
                    ':currentuser'=>$data['currentuser'],
                    ':tme'=>$data['tme'],
                    ':pid'=>$parentid,
                    ':sid'=>$subid,
                    ':posted'=>'',
                    ':appby'=>''
                    ));

                //save  data
                $sth=$this->db->prepare("INSERT INTO tbl_pos (qty,price,amount,pid,product,currentuser,trndate,trnno,customerid,customers,purchasestype,paymenttype,payreference,period,accountid,tme,parentid,subid,posted,astatus,duedate) SELECT qty,price,amount,pid,product,currentuser,:trndate,:trnno,:customerid,:customers,:purchasestype,:paymenttype,:payreference,:period,:accountid,:tme,:pid,:sid,:posted,:ast,:duedate FROM tbl_pos_temp WHERE CurrentUser =:cuser AND parentid=:pid AND subid=:sid");
                $sth->execute(array(
                    ':trndate'=>$data['trndate'],
                    ':trnno'=>$data['trnno'],
                    ':customerid'=>$data['customerid'],
                    ':customers'=>$data['customers'],
                    ':purchasestype'=>$data['purchasestype'],
                    ':paymenttype'=>$data['paymenttype'],
                    ':payreference'=>$data['payreference'],
                    ':period'=>$data['period'],
                    ':accountid'=>$data['accountid'],
                    ':cuser'=>$data['currentuser'],
                    ':tme'=>$data['tme'],
                    ':pid'=>$parentid,
                    ':sid'=>$subid,
                    ':posted'=>'',
                    ':ast'=>'',
                    ':duedate'=>''
                    ));
                //save POS head
                $sthdelete=$this->db->prepare("DELETE FROM tbl_pos_temp WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
                $sthdelete->execute(array(
                    ':cuser'=>$data['currentuser'],
                    ':pid'=>$parentid,
                    ':sid'=>$subid
                    ));



        //get total transfer payment(cash) sales for the day
                $sth=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE paymenttype=:purch and currentuser=:currentuser AND trndate=:tddate AND parentid=:pid AND subid=:sid");
               $sth->setFetchMode(PDO::FETCH_ASSOC);
                $sth->execute(array(
                    ':purch'=>'pos',
                    ':currentuser'=>Session::get('CurrentUser'),
                    ':tddate'=>date("Y-m-d"),
                    ':pid'=>$parentid,
                    ':sid'=>$subid
                    ));
                $totacashsales= $sth->fetchAll();
                foreach ($totacashsales as $key => $value) {
                    # code...
                    $cash=$value['ntotalamt'];
        }
        
        //get total sales for the day
        $sthd=$this->db->prepare("SELECT SUM(amount) as ntotalamt FROM tbl_pos WHERE currentuser=:currentuser AND trndate=:tddate AND parentid=:pid AND subid=:sid");
        $sthd->setFetchMode(PDO::FETCH_ASSOC);
        $sthd->execute(array(
            ':currentuser'=>Session::get('CurrentUser'),
            ':tddate'=>date("Y-m-d"),
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        $totaldailysales= $sthd->fetchAll();
        foreach ($totaldailysales as $key => $value) {
            # code...
            $totalsales=$value['ntotalamt'];
        }


        //get posJref

        $sthj=$this->db->prepare("SELECT jref FROM tbl_rfno");
        $sthj->execute();
        $totref=$sthj->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['jref'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET jref=$realno");
            $sthnupdate->execute();
            $jrefno= $totref['jref'] + 1;
        }


        //get POS new refno

         $sth=$this->db->prepare("SELECT pos FROM tbl_rfno");
        $sth->execute();
        $totref=$sth->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['pos'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET pos=$realno");
            $sthnupdate->execute();
          $posrefno=  $totref['pos'] + 1;
          $posref='POS/'.Session::get('period').'/'.$posrefno;
        }


        $stringsave="POS payment for this transaction successfully saved";            
            $data=array('posrefno'=>$posref,'jref'=>$jrefno,'totalsales'=>$totalsales,'pos'=>$cash,'message'=>$stringsave);
           //echo "Seccussful";


            echo json_encode($data); 
        }
        
  }   
    
}
