<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Stockdelivery_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }


    public function deletehead($id)
    {
        $sth=$this->db->prepare("DELETE FROM tbl_deliveryhead WHERE tme=:tme AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':tme'=>$id,
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get("subsidiaryid")
            ));
    }

    public function GetStockhead()
    {
        $parentid=Session::get("parentcompanyid");
    $subid=Session::get("subsidiaryid");
    	$sth=$this->db->prepare("SELECT * FROM tbl_deliveryhead WHERE posted=:posted AND period=:period AND parentid=:pid AND subid=:sid");
    	$sth->execute(array(
            ':posted'=>'',
    		':period'=>Session::get('period'),
            ':pid'=>$parentid,
            ':sid'=>$subid
    		));
    	return $sth->fetchAll();
    }

    public function GetDeliveredStock($id)
    {
         $parentid=Session::get("parentcompanyid");
    $subid=Session::get("subsidiaryid");
        $sth=$this->db->prepare("SELECT * FROM tbl_deliverylist WHERE tme=:tme AND period=:period AND parentid=:pid AND subid=:sid");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':tme'=>$id,
            ':period'=>Session::get('period'),
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        return $sth->fetchAll();
    }
    
    public function GetDeliveredStock_total($id)
    {
        $parentid=Session::get("parentcompanyid");
    $subid=Session::get("subsidiaryid");
        $sth=$this->db->prepare("SELECT sum(amount) as nTotal  FROM tbl_deliverylist WHERE tme=:tme AND period=:period AND parentid=:pid AND subid=:sid");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':tme'=>$id,
            ':period'=>Session::get('period'),
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));

        return $sth->fetchAll();
    }

    public function approvedelivery($data)
    {
     $parentid=Session::get("parentcompanyid");
     $subid=Session::get("subsidiaryid");

      //start gl_posting
                  //get account code to debit
                    $sthacc2debit=$this->db->prepare("SELECT * FROM tbl_productlist WHERE parentid=(trim($parentid)) AND subid=(trim($subid))");
                    $sthacc2debit->execute();
                    $dataatd=$sthacc2debit->fetchAll(); 
                    if ($dataatd)
                    {
                        foreach ($dataatd as $key => $value) {
                            # code...
                            $account2debit=$value['glinventory'];
                        }
                    }
                    else
                    {
                        echo "Product setup eeror has occured, plz correct the account code on product list setup";
                        exit();
                    }
                    

                    //get account to credit
                     $sthacode=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
                      $sthacode->execute(array(
                      ':pid'=>Session::get("parentcompanyid"),
                     ':sid'=>Session::get('subsidiaryid')
                     ));
                      $re=$sthacode->fetchAll();
                      $delivercode="";                            
                      if($re)
                       {
                         foreach ($re as $key => $val) {
                            $delivercode=$val['delivery'];                                   
                          }
                      }





                //start

                      $sthhead=$this->db->prepare("SELECT * FROM  tbl_deliveryhead  WHERE tme=:tme AND period=:period AND parentid=:pid AND subid=:sid");
                        $sthhead->execute(array(
                            ':tme'=>$data['tme'],
                            ':period'=>Session::get('period'),
                             ':pid'=>Session::get('parentcompanyid'),
                             ':sid'=>Session::get('subsidiaryid')
                            ));
                        $headrecord=$sthhead->fetchAll();
                                    
                        if($headrecord)
                        {


                                    foreach ($headrecord as $key => $value) {
                                    # code...



                                        $sthdebit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
                                        $sthdebit->execute(array(
                                            ':trndate'=>$value['deldate'],
                                            ':trnno'=>$value['trnno'],
                                            ':invno'=>$value['deliveryno'],
                                            ':accountid'=>$account2debit,  
                                            ':period'=>Session::get('period'),
                                            ':description'=>'Being Purchases of inventory',
                                            ':posted'=>'',
                                            ':currentuser'=>Session::get('CurrentUser'),
                                            ':pby'=>'',
                                            ':debit'=>$value['amount'],
                                            ':cr'=>'0',
                                            ':bref'=>'cashbank',
                                            ':tme'=>$data['tme'],
                                            ':pid'=>Session::get('parentcompanyid'),
                                            ':sid'=>Session::get('subsidiaryid')
                                            ));




                                        $sthcredit=$this->db->prepare("INSERT INTO tbl_banktransaction(trndate,trnno,invno,accountid,period,description,posted,currentuser,postedby,debit,credit,bankref,tme,parentid,subid) VALUES(:trndate,:trnno,:invno,:accountid,:period,:description,:posted,:currentuser,:pby,:debit,:cr,:bref,:tme,:pid,:sid)");
                                        $sthcredit->execute(array(
                                            ':trndate'=>$value['deldate'],
                                            ':trnno'=>$value['trnno'],
                                            ':invno'=>$value['deliveryno'],
                                            ':accountid'=>$delivercode,  //debit cash code receiving the money paid
                                            ':period'=>Session::get('period'),
                                            ':description'=>'Being Purchases of inventory',
                                            ':posted'=>'',
                                            ':currentuser'=>Session::get('CurrentUser'),
                                            ':pby'=>'',
                                            ':debit'=>'0',
                                            ':cr'=>$value['amount'],
                                            ':bref'=>'cashbank',
                                            ':tme'=>$data['tme'],
                                            ':pid'=>Session::get('parentcompanyid'),
                                            ':sid'=>Session::get('subsidiaryid')
                                            ));



                            }

                            //update the deliveryhead
                                            $sthupdate=$this->db->prepare("UPDATE tbl_deliveryhead SET posted=:posted WHERE tme=:tme AND period=:period AND parentid=:pid AND subid=:sid");
                                            $sthupdate->execute(array(
                                                ':posted'=>'Y',
                                                ':tme'=>$data['tme'],
                                                ':period'=>Session::get('period'),
                                                ':pid'=>$parentid,
                                                ':sid'=>$subid   
                                                ));

                                                        echo "Delivery successfully approved and posted";


                        }






                //end




















        $sth=$this->db->prepare("SELECT * FROM tbl_deliverylist WHERE period=:p AND tme=:tme AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':p'=>Session::get('period'),
            ':tme'=>$data['tme'],
            ':pid'=>$parentid,
            ':sid'=>$subid            
            ));
        $record=$sth->fetchAll();
        //print_r($record);
        //exit();
        $tamount=0;
        if($record)
        {
            //insert into stock record
            foreach ($record as $key => $value) {
                # code...
                $qty=$value['qty'];
                $desc="Bening delivery made by ".$value['supplier']. " with Invoice no ".$value['deliveryno'];
               // $price=$value['price'];
               // $amount=$value['amount'];
                $itmno=$value['itemno'];
                $itemdesc=$value['itemdesc'];
                $deldate=$value['deldate'];
                $tamount=($value['amount'] + $tamount);

                //echo      $itmno. " and ". $itemdesc. '<br/>';         
                
               // $sthinsert=$this->db->prepare("INSERT INTO tbl_stock (trndate,stockno,stock,description,debit,period,parentid,subid) VALUES(:tdate,:stockno,:stock,:dsc,:dr,:pr,:pid,:sid)");

                $sthinsert=$this->db->prepare("INSERT INTO tbl_stock (trndate,stockno,stock,description,debit,credit,period,tme,parentid,subid) VALUES (:trndate,:stockno,:stock,:descript,:dr,:cr,:pr,:tme,:pid,:sid)");
                $sthinsert->execute(array(                    //':tdate'=>$deldate,
                    ':stockno'=>$itmno,
                    ':stock'=>$itemdesc,
                    ':trndate'=>$deldate,
                    ':descript'=>$desc,
                    ':dr'=>$qty,
                    ':cr'=>"0",
                    ':pr'=>Session::get('period'),
                    ':tme'=>$data['tme'],
                    ':pid'=>$parentid,
                    ':sid'=>$subid
                    ));

            }

                   









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