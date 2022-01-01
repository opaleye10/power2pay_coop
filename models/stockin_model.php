<?php

/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 26/02/2017
 * Time: 10:52
 */
class Stockin_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }

    public function Restrictioncheck()
    {
      $sth=$this->db->prepare("SELECT * FROM tbl_appmenurole WHERE parentid=:pid AND subid=:sid AND roleid=:rid AND submenu=:smu AND access_status=:st");
      $sth->execute(array(
        ':pid'=>$parentid,
        ':sid'=>$subid,
        ':rid'=>$roleid,
        ':smu'=>'stockin',
        ':st'=>'Yes'
        ));
      $find=$sth->fetch();
      if($find)
      {
        Session::set('access_permit',true);
      }
    }

    public function GetItemList()
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
    public function printdelivery($id)
    {
        $parentid=Session::get("parentcompanyid");
    $subid=Session::get("subsidiaryid");
        $sth=$this->db->prepare("SELECT * FROM tbl_deliverylist WHERE tme =:dlno AND parentid=:pid AND subid=:sid");  
        $sth->setFetchMode(PDO::FETCH_ASSOC);      
        $sth->execute(array(
            ':dlno'=> $id,
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        return $sth->fetchAll();
    }
    

public function DeleteStockIn_Temp()
{
    $parentid=Session::get("parentcompanyid");
    $subid=Session::get("subsidiaryid");

    $sth=$this->db->prepare("DELETE FROM tbl_delivery_temp WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
    $sth->execute(array(
        ':cuser'=>Session::get("CurrentUser"),
        ':pid'=>$parentid,
        ':sid'=>$subid
        ));
}
    public function GetDeliveryRefno()
    {

        $sth=$this->db->prepare("SELECT deliveryno FROM tbl_rfno");
        $sth->execute();
        $totref=$sth->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['deliveryno'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET deliveryno=$realno");
            $sthnupdate->execute();
          return  $totref['deliveryno'] + 1;
        }

    }

    public function GetDeliveryjref()
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



    public function GetSupplierList()
    {
        $parentid=Session::get("parentcompanyid");
         $subid=Session::get("subsidiaryid");
        $sth=$this->db->prepare("SELECT * FROM tbl_supplier WHERE parentid=:pid AND subid=:sid");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        return $sth->fetchAll();
    }

    public function SaveDelivery($data)
    {
        //before creating delivery head, save the list of items into delivery lis
         $parentid=Session::get("parentcompanyid");
         $subid=Session::get("subsidiaryid");
        //stock list
        $sthinsert=$this->db->prepare("INSERT INTO tbl_deliverylist (currentuser,period,supplierid,supplier,deliveryno,deldate,itemno,itemdesc,qty,price,amount,trnno,tme,parentid,subid) SELECT currentuser,period,supplierid,supplier,deliveryno,deldate,itemno,itemdesc,qty,price,amount,trnno,tme,parentid,subid FROM tbl_delivery_temp WHERE currentuser=:cuser AND trnno=:trn AND parentid=:pid AND subid=:sid");
        //$sthinsert=$this->db->prepare("INSERT INTO tbl_deliverylist (currentuser,period) SELECT currentuser,period FROM tbl_delivery_temp");
        $sthinsert->execute(array(
            ':cuser'=>$data['currentuser'],
            ':trn'=>$data['trnno'],
            ':pid'=>$parentid,
            ':sid'=>$subid
        ));

        $sth=$this->db->prepare("INSERT INTO tbl_deliveryhead (deldate,deliveryno,supplierid,supplier,amount,posted,trnno,period,currentuser,tme,parentid,subid) VALUES (:ddate,:dno,:sid,:sup,:amt,:po,:trn,:period,:cuser,:tme,:pid,:sd)");
        $sth->execute(array(
           ':ddate'=>$data['deldate'],
           ':dno'=>$data['deliveryno'],
           ':sid'=>$data['supplierid'],
           ':sup'=>$data['supplier'],
           ':amt'=>$data['amount'],
           ':po'=>$data['posted'],
           ':trn'=>$data['trnno'],
           ':period'=>$data['period'],
           ':cuser'=>$data['currentuser'],
           ':tme'=>$data['tme'],
           ':pid'=>$parentid,
           ':sd'=>$subid
           //':dtno'=>$data['trackno']
        ));


        //update reference number        
        //    $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET deliveryno=:tme");
          //  $sthnupdate->execute(array(
            //    ':tme'=>$data['tme']
              //  ));
         
       // return $totref;

        //get jref first
        $sthjref=$this->db->prepare("SELECT jref FROM tbl_rfno");
        $sthjref->execute();
        $totref=$sthjref->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['jref'] + 1;
            $sthnupdatejref=$this->db->prepare("UPDATE tbl_rfno SET jref=$realno");
            $sthnupdatejref->execute();
            $jref=$totref['jref'] + 1;
        }

        //get delivery no

        $sthdelno=$this->db->prepare("SELECT deliveryno FROM tbl_rfno");
        $sthdelno->execute();
        $totref=$sthdelno->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['deliveryno'] + 1;
            $sthnupdatedelno=$this->db->prepare("UPDATE tbl_rfno SET deliveryno=$realno");
            $sthnupdatedelno->execute();
          $delno=$totref['deliveryno'] + 1;
        }


            $stringsave="Store Items Delivery record successfully Saved";            
            $data=array('jref'=>$jref,'message'=>$stringsave,'delno'=>$delno);
            echo json_encode($data);        
    }


    public function SaveDeliveryTemp($data)
    {
        $parentid=Session::get("parentcompanyid");
         $subid=Session::get("subsidiaryid");
        $sthfind=$this->db->prepare("DELETE FROM tbl_delivery_temp WHERE currentuser=:cuser AND itemno=:itno AND parentid=:pid AND subid=:sid");
        $sthfind->execute(array(
           ':itno'=>$data['itemno'],
           ':cuser'=>$data['currentuser'],
           ':pid'=>$parentid,
           ':sid'=>$subid
        ));

        
            $sth=$this->db->prepare("INSERT INTO tbl_delivery_temp (period,supplierid,supplier,deliveryno,deldate,qty,price,amount,itemno,itemdesc,currentuser,trnno,tme,parentid,subid) VALUES(:period,:supid,:sup,:delno,:ddate,:qty,:price,:amt,:itno,:itdesc,:muser,:trnno,:tme,:pid,:sid)");
            $sth->execute(array(
                ':period'=>$data['period'],
                ':supid'=>$data['supplierid'],
                ':sup'=>$data['supplier'],
                ':delno'=>$data['deliveryno'],
                ':ddate'=>$data['deldate'],
                ':qty'=>$data['qty'],
                ':price'=>$data['price'],
                ':amt'=>$data['amount'],
                ':itno'=>$data['itemno'],
                ':itdesc'=>$data['itemdesc'],
                ':muser'=>$data['currentuser'],
                ':trnno'=>$data['trnno'],
                ':tme'=>$data['tme'],
                ':pid'=>$parentid,
                ':sid'=>$subid
            ));
            
            $stringsave='Item Inserted successfully';
            $mystring="Yes";
            $data=array('text'=>$mystring,'message'=>$stringsave);
            echo json_encode($data);
        

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