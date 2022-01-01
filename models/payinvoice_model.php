<?php

class Payinvoice_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }

public function effectcashpayment($data){
     //update tbl_payinvoices posted='PAID'
        
        $sth=$this->db->prepare("UPDATE tbl_paysinvoices SET posted=:paid WHERE trnno=:trn AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':trn'=>$data['invno'],
            ':paid'=>'PAID',
           ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));

        //insert into tbl_banktransaction
        $sthloop=$this->db->prepare("SELECT * FROM tbl_paysinvoices WHERE  trnno=:trn AND parentid=:pid AND subid=:sid");
        $sthloop->execute(array(
            ':trn'=>$data['invno'],            
           ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $record=$sthloop->fetchAll();
        $tamount=0;
        $period='';
        $desc='';
       // print_r($record);
        //exit();
        if($record)
        {

            //dont forget that creditors receive the money
            //therefore get creditor's account id
                 $sthacode=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
                 $sthacode->execute(array(
                ':pid'=>Session::get("parentcompanyid"),
                 ':sid'=>Session::get('subsidiaryid')
                ));
            $re=$sthacode->fetchAll();
            $creditcode="";
            $cashcode="";
            if($re)
            {
                foreach ($re as $key => $value) {
                    # code...
                    $creditcode=$value['creditor'];
                    $cashcode=$value['cash'];
                }
            }


            //end
            //so debit creditors code
                            foreach ($record as $key => $value) {
                                   # code...
                                            $accountids=$value['accountid'];
                                            $period=$value['period'];
                                            $amount=$value['amount'];
                                           // $invoiceno=$value['invno'];
                                            $desc="Payment: ".$value['description'];
                                            $tamount=$value['amount'] + $tamount;
                                            $sthinsertDebit=$this->db->prepare("INSERT INTO tbl_banktransaction (trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:postedby,:debit,:credit,:bankref,:tme,:pid,:sid)");
                                            $sthinsertDebit->execute(array(
                                                ':trndate'=>$data['trndate'],
                                                ':trnno'=>$data['trnno'],
                                                ':invno'=>$data['invno'],
                                                ':accountid'=>$creditcode,
                                                ':period'=>$period,
                                                ':description'=>$desc,
                                                ':posted'=>'',
                                                ':currentuser'=>Session::get('CurrentUser'),
                                                ':postedby'=>'',
                                                ':debit'=>$amount,
                                                ':credit'=>'0',
                                                ':bankref'=>'cash',
                                                ':tme'=>$data['tme'],
                                                ':pid'=>Session::get("parentcompanyid"),
                                                ':sid'=>Session::get('subsidiaryid')
                                                ));



                             }


                         //credit bank account code

                              $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction (trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:postedby,:debit,:credit,:bankref,:tme,:pid,:sid)");
                                            $sthcredit->execute(array(
                                                ':trndate'=>$data['trndate'],
                                                ':trnno'=>$data['trnno'],
                                                ':invno'=>$data['invno'],
                                                ':accountid'=>$cashcode, 
                                                ':period'=>$period,
                                                ':description'=>$desc,
                                                ':posted'=>'',
                                                ':currentuser'=>Session::get("CurrentUser"),
                                                ':postedby'=>'',
                                                ':debit'=>'0',
                                                ':credit'=>$tamount,
                                                ':bankref'=>'cash',
                                                ':tme'=>$data['tme'],
                                                ':pid'=>Session::get("parentcompanyid"),
                                                ':sid'=>Session::get('subsidiaryid')
                                                ));

                                            header('location:'.URL.'payinvoice');
        }
}





    public function effectbankpayment($data)
    {
       //update tbl_payinvoices posted='PAID'
        
        $sth=$this->db->prepare("UPDATE tbl_paysinvoices SET posted=:paid WHERE trnno=:trn AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':trn'=>$data['invno'],
            ':paid'=>'PAID',
           ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));

        //insert into tbl_banktransaction
        $sthloop=$this->db->prepare("SELECT * FROM tbl_paysinvoices WHERE  trnno=:trn AND parentid=:pid AND subid=:sid");
        $sthloop->execute(array(
            ':trn'=>$data['invno'],            
           ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $record=$sthloop->fetchAll();
        $tamount=0;
        $period='';
        $desc='';
       // print_r($record);
        //exit();
        if($record)
        {

            //dont forget that creditors receive the money
            //therefore get creditor's account id
                 $sthacode=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
                 $sthacode->execute(array(
                ':pid'=>Session::get("parentcompanyid"),
                 ':sid'=>Session::get('subsidiaryid')
                ));
            $re=$sthacode->fetchAll();
            $creditcode="";
            if($re)
            {
                foreach ($re as $key => $value) {
                    # code...
                    $creditcode=$value['creditor'];
                }
            }


            //end
            //so debit creditors code
                            foreach ($record as $key => $value) {
                                   # code...
                                            $accountids=$value['accountid'];
                                            $period=$value['period'];
                                            $amount=$value['amount'];
                                           // $invoiceno=$value['invno'];
                                            $desc="Payment: ".$value['description'];
                                            $tamount=$value['amount'] + $tamount;
                                            $sthinsertDebit=$this->db->prepare("INSERT INTO tbl_banktransaction (trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:postedby,:debit,:credit,:bankref,:tme,:pid,:sid)");
                                            $sthinsertDebit->execute(array(
                                                ':trndate'=>$data['trndate'],
                                                ':trnno'=>$data['trnno'],
                                                ':invno'=>$data['invno'],
                                                ':accountid'=>$creditcode,
                                                ':period'=>$period,
                                                ':description'=>$desc,
                                                ':posted'=>'',
                                                ':currentuser'=>Session::get('CurrentUser'),
                                                ':postedby'=>'',
                                                ':debit'=>$amount,
                                                ':credit'=>'0',
                                                ':bankref'=>$data['bankref'],
                                                ':tme'=>$data['tme'],
                                                ':pid'=>Session::get("parentcompanyid"),
                                                ':sid'=>Session::get('subsidiaryid')
                                                ));



                             }


                         //credit bank account code

                              $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction (trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:postedby,:debit,:credit,:bankref,:tme,:pid,:sid)");
                                            $sthcredit->execute(array(
                                                ':trndate'=>$data['trndate'],
                                                ':trnno'=>$data['trnno'],
                                                ':invno'=>$data['invno'],
                                                ':accountid'=>$data['accountid'], 
                                                ':period'=>$period,
                                                ':description'=>$desc,
                                                ':posted'=>'',
                                                ':currentuser'=>Session::get("CurrentUser"),
                                                ':postedby'=>'',
                                                ':debit'=>'0',
                                                ':credit'=>$tamount,
                                                ':bankref'=>$data['bankref'],
                                                ':tme'=>$data['tme'],
                                                ':pid'=>Session::get("parentcompanyid"),
                                                ':sid'=>Session::get('subsidiaryid')
                                                ));

                                            header('location:'.URL.'payinvoice');
        }
    }

    public function bringcashcode()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $record=$sth->fetchAll();
        if($record)
        {
            foreach ($record as $key => $value) {
                # code...
                $cash=$value['cash'];
            }

            $data=array('cash'=>$cash);
            echo json_encode($data);
        }


        
    }
    public function GetPaymentRefno()
    {
        $sth=$this->db->prepare("SELECT invp FROM tbl_rfno");
        $sth->execute();
        $totref=$sth->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['invp'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET invp=$realno");
            $sthnupdate->execute();
          return  $totref['invp'] + 1;
        }

       // return $totref;
    }


 public function GetBanks()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_banks");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }
    public function GetAccount2pay()
    {
    	$sth=$this->db->prepare("SELECT DISTINCT trndate,trnno,period,posted, description,supplier,tme,sum(amount) as amt FROM `tbl_paysinvoices` where posted='' AND parentid=:pid AND subid=:sid group by trndate,trnno,period,posted,description,supplier,tme ");
    	$sth->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
    	return $sth->fetchAll();
    }


    public function GetInvoice2pay($id)
    {
    	$sth=$this->db->prepare("SELECT * FROM tbl_paysinvoices WHERE tme=:tme");
    	$sth->execute(array(
    		':tme'=>$id
    		));
    	return $sth->fetchAll();
    }



 public function SaveCashPayments($data)
        {
           
            $sth=$this->db->prepare("SELECT *  FROM tbl_paysinvoices WHERE trnno=:trnno");
            $sth->execute(array(
                ':trnno'=>$data['trnno']
                ));
            $record=$sth->fetchAll();
            $amt=0;
            foreach ($record as $key => $value) {

                # code...
                $amt=$value['amount']+$amt;
                $desc=$value['description'];
                $period=$value['period'];
                $tme=$value['tme'];

            }
             //POST FOR double entry
            $sthdebit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,debit,bankref,tme) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:debit,:bankref,:tme)");
            $sthdebit->execute(array(
                ':trndate'=>$data['ccdate'],
                ':trnno'=>$data['invp'],
                ':invno'=>$data['trnno'],
                ':accountid'=>'04010101',  //Debit accountpayable
                ':period'=>$period,
                ':description'=>$desc,
                ':posted'=>'N',
                ':currentuser'=>Session::get('CurrentUser'),
                ':debit'=>$amt,
                ':bankref'=>'Cash',
                ':tme'=>$tme
                ));

            $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,credit,bankref,tme) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:credit,:bankref,:tme)");
            $sthcredit->execute(array(
                ':trndate'=>$data['ccdate'],
                ':trnno'=>$data['invp'],
                ':invno'=>$data['trnno'],
                ':accountid'=>'03020201',  //Credit Cash Account id
                ':period'=>$period,
                ':description'=>$desc,
                ':posted'=>'N',
                ':currentuser'=>Session::get('CurrentUser'),
                ':credit'=>$amt,
                ':bankref'=>$data['postransfer'],
                ':tme'=>$tme
                ));


            //update posted in tbl_paysinvoices  to be paid
            $sthupdate=$this->db->prepare("UPDATE tbl_paysinvoices SET posted=:paid WHERE trnno=:trn");
            $sthupdate->execute(array(
                ':paid'=>'Paid',
                ':trn'=>$data['trnno']
                ));


            echo "Payment successfull";

           

            
            //03020401 debtors code
        }
     public function SaveBankPayments($data)
        {
           
            $sth=$this->db->prepare("SELECT *  FROM tbl_paysinvoices WHERE trnno=:trnno");
            $sth->execute(array(
                ':trnno'=>$data['trnno']
                ));
            $record=$sth->fetchAll();
            $amt=0;
            foreach ($record as $key => $value) {

                # code...
                $amt=$value['amount']+$amt;
                $desc=$value['description'];
                $period=$value['period'];
                $tme=$value['tme'];

            }
             //POST FOR double entry
            $sthdebit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,debit,bankref,tme) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:debit,:bankref,:tme)");
            $sthdebit->execute(array(
                ':trndate'=>$data['ccdate'],
                ':trnno'=>$data['invp'],
                ':invno'=>$data['trnno'],
                ':accountid'=>'04010101',  //Debit accountpayable
                ':period'=>$period,
                ':description'=>$desc,
                ':posted'=>'N',
                ':currentuser'=>Session::get('CurrentUser'),
                ':debit'=>$amt,
                ':bankref'=>$data['postransfer'],
                ':tme'=>$tme
                ));

            $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,credit,bankref,tme) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:credit,:bankref,:tme)");
            $sthcredit->execute(array(
                ':trndate'=>$data['ccdate'],
                ':trnno'=>$data['invp'],
                ':invno'=>$data['trnno'],
                ':accountid'=>$data['accountid'],  //Debit accountpayable
                ':period'=>$period,
                ':description'=>$desc,
                ':posted'=>'N',
                ':currentuser'=>Session::get('CurrentUser'),
                ':credit'=>$amt,
                ':bankref'=>$data['postransfer'],
                ':tme'=>$tme
                ));


            //update posted in tbl_paysinvoices  to be paid
            $sthupdate=$this->db->prepare("UPDATE tbl_paysinvoices SET posted=:paid WHERE trnno=:trn");
            $sthupdate->execute(array(
                ':paid'=>'Paid',
                ':trn'=>$data['trnno']
                ));


            echo "Payment successfull";

           

            
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