<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 04/01/2017
 * Time: 12:06
 */

//7038538131
//8059023638
///arruroh@yahoo.co.uk%
class Pinvoice_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }


public function GetTempInvTedeleted()
{
    $parentid=Session::get("parentcompanyid");
    $subid=Session::get('subsidiaryid');
    $sth=$this->db->prepare("DELETE FROM tbl_paysinvoices_temp WHERE parentid=:pid AND subid=:sid AND currentuser=:currentuser");
    $sth->execute(array(
        ':currentuser'=>Session::get('CurrentUser'),
        ':pid'=>$parentid,
        ':sid'=>$subid
        ));
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
    public function GetSuppliers()
    {
        $sth=$this->db->prepare("SELECT * FROM  tbl_supplier WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get('subsidiaryid')
            ));
        return $sth->fetchAll();
    }
    public function GetGLAccount2Debit()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE subclassid=:id AND parentid=:pid AND csubid=:sid");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':id'=>'020102',
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get('subsidiaryid')
            ));
        return $sth->fetchAll();
    }




 public function displaypays($data)
    {
      $sth=$this->db->prepare("SELECT * FROM tbl_personnel WHERE vartype='P' AND staffid=:staffid AND parentid=:pid AND subid=:sid")  ;
      $sth->execute(array(
        ':staffid'=>$data['staffid'],
        ':pid'=>Session::get('parentcompanyid'),
        ':sid'=>Session::get('subsidiaryid')
        ));
      $dat=$sth->fetchAll();
      echo json_encode($dat);
    }











    public function SaveInvoiceTemp($data)
    {
        $sthdelete=$this->db->prepare("DELETE FROM tbl_paysinvoices_temp WHERE accountid=:acid AND currentuser=:cuser AND parentid=:pid AND subid=:sid");
        $sthdelete->execute(array(
            ':acid'=>$data['accountid'],
            ':cuser'=>$data['currentuser'],
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get('subsidiaryid')
            ));
        
        $sth=$this->db->prepare("INSERT INTO tbl_paysinvoices_temp (amount,accountid,gldescription,currentuser,parentid,subid) VALUES(:amount,:accountid,:gldescription,:currentuser,:pid,:sid)");
        $sth->execute(array(
            ':amount'=>$data['amount'],
            ':accountid'=>$data['accountid'],
            ':gldescription'=>$data['gldescription'],
            ':currentuser'=>$data['currentuser'],
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get('subsidiaryid')
            ));

        $sthdisplay=$this->db->prepare("SELECT * FROM tbl_paysinvoices_temp WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid")  ;
         $sthdisplay->execute(array(
        ':cuser'=>$data['currentuser'],
        ':pid'=>Session::get('parentcompanyid'),
        ':sid'=>Session::get('subsidiaryid')
        ));
      $dat=$sthdisplay->fetchAll();
      echo json_encode($dat);       
    }


    public function SaveInvoice($data)
    {
        //check if the creditors code is selected
         $sthacode=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
        $sthacode->execute(array(
            ':pid'=>Session::get("parentcompanyid"),
             ':sid'=>Session::get('subsidiaryid')
            ));
        $re=$sthacode->fetchAll();
        if($re)
        {
            foreach ($re as $key => $value) {
                # code...
                $creditcode=$value['creditor'];
            }




            //load the template
            $sthloop=$this->db->prepare("SELECT * FROM tbl_paysinvoices_temp WHERE parentid=:pid AND subid=:sid AND currentuser=:cuser");
            $sthloop->execute(array(
                ':pid'=>Session::get("parentcompanyid"),
                  ':sid'=>Session::get('subsidiaryid'),
                  ':cuser'=>$data['currentuser']
                ));
            $looprec=$sthloop->fetchAll();
            if($looprec)
            {

                foreach ($looprec as $key => $value) {
                    # code...
                    $amount=$value['amount'];
                    $accountid=$value['accountid'];
                    $gldescription=$value['gldescription'];

                     $sth=$this->db->prepare("INSERT INTO tbl_paysinvoices
                        (amount,accountid,gldescription,currentuser,parentid,subid,trndate,trnno,description,invno,supplierid,supplier,period,tme,posted,postedby) 
                        VALUES
                        (:amount,:accountid,:gldesc,:cuser,:pid,:sid,:trndate,:trnno,:description,:invno,:supplierid,:supplier,:period,:tme,:ptd,:ptdby)");
                         $sth->execute(array(
                            ':amount'=>$amount,
                            ':accountid'=>$accountid,
                            ':gldesc'=>$gldescription,
                            ':cuser'=>$data['currentuser'],
                            ':pid'=>Session::get("parentcompanyid"),
                            ':sid'=>Session::get('subsidiaryid'),                            
                            ':trndate'=>$data['trndate'],
                            ':trnno'=>$data['trnno'],
                            ':description'=>$data['description'],
                            ':invno'=>$data['invno'],
                            ':supplierid'=>$data['supplierid'],
                            ':supplier'=>$data['supplier'],            
                            ':period'=>$data['period'],
                            ':tme'=>$data['tme'],
                            ':ptd'=>'',
                            ':ptdby'=>''
                            ));
            





                }
                //end loopsave




                                    //post double entry record to tbl_banktransaction
                                    //debit selected code(s)
                                    $sthdebitselect=$this->db->prepare("SELECT * FROM tbl_paysinvoices WHERE trnno=:trnno AND parentid=:pid AND subid=:sid");
                                    $sthdebitselect->execute(array(
                                        ':trnno'=>$data['trnno'],
                                        ':pid'=>Session::get("parentcompanyid"),
                                        ':sid'=>Session::get('subsidiaryid')
                                        ));
                                    $count=$sthdebitselect->fetchAll();
                                    $tamount=0;
                                    if ($count) {
                                        # code...
                                        foreach ($count as $key => $value) {
                                            # code...
                                            $accountids=$value['accountid'];
                                            $amount=$value['amount'];
                                            $invoiceno=$value['invno'];
                                            $tamount=$value['amount'] + $tamount;
                                            $sthinsertDebit=$this->db->prepare("INSERT INTO tbl_banktransaction (trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:postedby,:debit,:credit,:bankref,:tme,:pid,:sid)");
                                            $sthinsertDebit->execute(array(
                                                ':trndate'=>$data['trndate'],
                                                ':trnno'=>$data['trnno'],
                                                ':invno'=>$invoiceno,
                                                ':accountid'=>$accountids,
                                                ':period'=>$data['period'],
                                                ':description'=>$data['description'],
                                                ':posted'=>'',
                                                ':currentuser'=>$data['currentuser'],
                                                ':postedby'=>'',
                                                ':debit'=>$amount,
                                                ':credit'=>'0',
                                                ':bankref'=>'',
                                                ':tme'=>$data['tme'],
                                                ':pid'=>Session::get("parentcompanyid"),
                                                ':sid'=>Session::get('subsidiaryid')
                                                ));
                                        }
                                    }

                                    //now credit account payable(creditor)
                                    //04010101        
                                    //tbl_acctcodesetup
                                   
                                        $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction (trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:postedby,:debit,:credit,:bankref,:tme,:pid,:sid)");
                                            $sthcredit->execute(array(
                                                ':trndate'=>$data['trndate'],
                                                ':trnno'=>$data['trnno'],
                                                ':invno'=>$data['invno'],
                                                ':accountid'=>$creditcode, 
                                                ':period'=>$data['period'],
                                                ':description'=>$data['description'],
                                                ':posted'=>'',
                                                ':currentuser'=>$data['currentuser'],
                                                ':postedby'=>'',
                                                ':debit'=>'0',
                                                ':credit'=>$tamount,
                                                ':bankref'=>'',
                                                ':tme'=>$data['tme'],
                                                ':pid'=>Session::get("parentcompanyid"),
                                                ':sid'=>Session::get('subsidiaryid')
                                                ));

                                    

                                    echo "Invoice/voucher successfully saved";













            }

/*
        $sth=$this->db->prepare("INSERT INTO tbl_paysinvoices(amount,accountid,gldescription,currentuser,parentid,subid,trndate,trnno,description,invno,supplierid,supplier,period,tme) SELECT amount,accountid,gldescription,currentuser,parentid,subid,:trndate,:trnno,:description,:invno,:supplierid,:supplier,:period,:tme FROM tbl_paysinvoices_temp WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':trndate'=>$data['trndate'],
            ':trnno'=>$data['trnno'],
            ':description'=>$data['description'],
            ':invno'=>$data['invno'],
            ':supplierid'=>$data['supplierid'],
            ':supplier'=>$data['supplier'],            
            ':period'=>$data['period'],
            ':tme'=>$data['tme'],
            ':cuser'=>$data['currentuser'],
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get('subsidiaryid')
            ));
            */







        }
        else
        {
            echo"Transaction not successful, Please, setup creditors code account and try again";
        }






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
//0056752697