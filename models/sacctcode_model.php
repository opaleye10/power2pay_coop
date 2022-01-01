<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Sacctcode_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }


public function loadcode()
{
    $sth=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
    $sth->execute(array(
             ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        return $sth->fetchAll();
}




public function Saveinventorycode($data)
{
     $sth=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
             ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $record=$sth->fetchAll();
        if($record)
        {
            $sthupdate=$this->db->prepare("UPDATE tbl_acctcodesetup SET inventory=:inv WHERE  parentid=:pid AND subid=:sid");
            $sthupdate->execute(array(
                ':inv'=>$data['inventory'],
                  ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));
             $stringsave="Inventory Code successfully updated";            
            $data=array('inventory'=>$data['inventory'],'message'=>$stringsave);
            echo json_encode($data); 
        }
        else

        {
            $sthinsert=$this->db->prepare("INSERT INTO tbl_acctcodesetup(cash,creditor,debtor,delivery,sales,cogs,inventory,parentid,subid) VALUES(:cash,:credit,:debit,:deli,:sale,:cogs,:inv,:pid,:sid)");
            $sthinsert->execute(array(
                ':cash'=>'',
                ':credit'=>'',
                ':debit'=>'',
                ':sale'=>'',
                ':cogs'=>'',
                ':inv'=>$data['inventory'],
                ':deli'=>'',
                 ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));

            $stringsave="Inventory Code successfully saved";            
            $data=array('inventory'=>$data['inventory'],'message'=>$stringsave);
            echo json_encode($data); 
        }
}

public function Savecogscode($data)

{
     $sth=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
             ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $record=$sth->fetchAll();
        if($record)
        {
            $sthupdate=$this->db->prepare("UPDATE tbl_acctcodesetup SET cogs=:cogs WHERE parentid=:pid AND subid=:sid");
            $sthupdate->execute(array(
                ':cogs'=>$data['cogs'],
                  ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));
             $stringsave="Cost of Goods Sold Code successfully updated";            
            $data=array('cogs'=>$data['cogs'],'message'=>$stringsave);
            echo json_encode($data); 
        }
        else

        {
            $sthinsert=$this->db->prepare("INSERT INTO tbl_acctcodesetup(cash,creditor,debtor,delivery,sales,cogs,inventory,parentid,subid) VALUES(:cash,:credit,:debit,:deli,:sale,:cogs,:inv,:pid,:sid)");
            $sthinsert->execute(array(
                ':cash'=>'',
                ':credit'=>'',
                ':debit'=>'',
                ':sale'=>'',
                ':cogs'=>$data['cogs'],
                ':inv'=>'',
                ':deli'=>'',
                 ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));

            $stringsave="Cost of Goods Sold Code successfully saved";            
            $data=array('cogs'=>$data['cogs'],'message'=>$stringsave);
            echo json_encode($data); 
        }
}


public function Savesalescode($data)
{
     $sth=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
             ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $record=$sth->fetchAll();
        if($record)
        {
            $sthupdate=$this->db->prepare("UPDATE tbl_acctcodesetup SET sales=:sale WHERE  parentid=:pid AND subid=:sid");
            $sthupdate->execute(array(
                ':sale'=>$data['sales'],
                  ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));
             $stringsave="Sales Code successfully updated";            
            $data=array('sales'=>$data['sales'],'message'=>$stringsave);
            echo json_encode($data); 
        }
        else

        {
            $sthinsert=$this->db->prepare("INSERT INTO tbl_acctcodesetup(cash,creditor,debtor,delivery,sales,cogs,inventory,parentid,subid) VALUES(:cash,:credit,:debit,:deli,:sale,:cogs,:inv,:pid,:sid)");
            $sthinsert->execute(array(
                ':cash'=>'',
                ':credit'=>'',
                ':debit'=>'',
                ':sale'=>$data['sales'],
                ':cogs'=>'',
                ':inv'=>'',
                ':deli'=>'',
                 ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));

            $stringsave="Sales Code successfully saved";            
            $data=array('sales'=>$data['sales'],'message'=>$stringsave);
            echo json_encode($data); 
        }
}

public function savedeliverycode($data)
{
     $sth=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
             ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $record=$sth->fetchAll();
        if($record)
        {
            $sthupdate=$this->db->prepare("UPDATE tbl_acctcodesetup SET delivery=:deli WHERE  parentid=:pid AND subid=:sid");
            $sthupdate->execute(array(
                ':deli'=>$data['delivery'],
                  ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));
             $stringsave="Delivery Code successfully updated";            
            $data=array('delivery'=>$data['delivery'],'message'=>$stringsave);
            echo json_encode($data); 
        }
        else

        {
            $sthinsert=$this->db->prepare("INSERT INTO tbl_acctcodesetup(cash,creditor,debtor,delivery,sales,cogs,inventory,parentid,subid) VALUES(:cash,:credit,:debit,:deli,:sale,:cogs,:inv,:pid,:sid)");
            $sthinsert->execute(array(
                ':cash'=>'',
                ':credit'=>'',
                ':debit'=>'',
                ':sale'=>'',
                ':cogs'=>'',
                ':inv'=>'',
                ':deli'=>$data['delivery'],
                 ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));

            $stringsave="Delivery Code successfully saved";            
            $data=array('delivery'=>$data['delivery'],'message'=>$stringsave);
            echo json_encode($data); 
        }
}

public function Savedebtorcode($data)
{
     $sth=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
             ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $record=$sth->fetchAll();
        if($record)
        {
            $sthupdate=$this->db->prepare("UPDATE tbl_acctcodesetup SET debtor=:debt WHERE  parentid=:pid AND subid=:sid");
            $sthupdate->execute(array(
                ':debt'=>$data['debtor'],
                  ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));
             $stringsave="Debtor Code successfully updated";            
            $data=array('debtor'=>$data['debtor'],'message'=>$stringsave);
            echo json_encode($data); 
        }
        else

        {
            $sthinsert=$this->db->prepare("INSERT INTO tbl_acctcodesetup(cash,creditor,debtor,delivery,sales,cogs,inventory,parentid,subid) VALUES(:cash,:credit,:debit,:deli,:sale,:cogs,:inv,:pid,:sid)");
            $sthinsert->execute(array(
                ':cash'=>'',
                ':credit'=>'',
                ':debit'=>$data['debtor'],
                ':sale'=>'',
                ':cogs'=>'',
                ':inv'=>'',
                ':deli'=>'',
                 ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));

            $stringsave="Debtor Code successfully saved";            
            $data=array('debtor'=>$data['debtor'],'message'=>$stringsave);
            echo json_encode($data); 
        }
}




public function Savecreditorcode($data)
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
             ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $record=$sth->fetchAll();
        if($record)
        {
            $sthupdate=$this->db->prepare("UPDATE tbl_acctcodesetup SET creditor=:credit WHERE  parentid=:pid AND subid=:sid");
            $sthupdate->execute(array(
                ':credit'=>$data['creditor'],
                  ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));
             $stringsave="Creditor Code successfully updated";            
            $data=array('creditor'=>$data['creditor'],'message'=>$stringsave);
            echo json_encode($data); 
        }
        else

        {
            $sthinsert=$this->db->prepare("INSERT INTO tbl_acctcodesetup(cash,creditor,debtor,delivery,sales,cogs,inventory,parentid,subid) VALUES(:cash,:credit,:debit,:deli,:sale,:cogs,:inv,:pid,:sid)");
            $sthinsert->execute(array(
                ':cash'=>'',
                ':credit'=>$data['creditor'],
                ':debit'=>'',
                ':sale'=>'',
                ':cogs'=>'',
                ':inv'=>'',
                ':deli'=>'',
                 ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));

            $stringsave="Creditor Code successfully saved";            
            $data=array('creditor'=>$data['creditor'],'message'=>$stringsave);
            echo json_encode($data); 
        }
    }

    public function Savecashcode($data)
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_acctcodesetup WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
             ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $record=$sth->fetchAll();
        if($record)
        {
            $sthupdate=$this->db->prepare("UPDATE tbl_acctcodesetup SET cash=:cash WHERE  parentid=:pid AND subid=:sid");
            $sthupdate->execute(array(
                ':cash'=>$data['cash'],
                  ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));
             $stringsave="Cash Code successfully updated";            
            $data=array('cash'=>$data['cash'],'message'=>$stringsave);
            echo json_encode($data); 
        }
        else

        {
            $sthinsert=$this->db->prepare("INSERT INTO tbl_acctcodesetup (cash,creditor,debtor,delivery,parentid,subid) VALUES(:cash,:credit,:debit,:deli,:pid,:sid)");
            $sthinsert->execute(array(
                ':cash'=>$data['cash'],
                ':credit'=>'',
                ':debit'=>'',
                ':deli'=>'',
                 ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));

            $stringsave="Cash Code successfully saved";            
            $data=array('cash'=>$data['cash'],'message'=>$stringsave);
            echo json_encode($data); 
        }
    }
   public function GetAccountlist()
   {
    $sth=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE parentid=:pid AND csubid=:sid");
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