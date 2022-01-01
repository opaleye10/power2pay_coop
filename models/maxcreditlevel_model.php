<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Maxcreditlevel_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }



public function loaddebtorslist()
{
    $sth=$this->db->prepare("SELECT * FROM tbl_customer WHERE parentid=:pid AND subid=:sid");
    $sth->execute(array(
             ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        return $sth->fetchAll();
}


public function loadmaxcreditlist()
{
    $sth=$this->db->prepare("SELECT * FROM tbl_maxcreditlevel WHERE parentid=:pid AND subid=:sid");
    $sth->execute(array(
             ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        return $sth->fetchAll();
}


public function updatelosv($data)
{

        $sthupdate=$this->db->prepare("UPDATE tbl_maxcreditlevel SET losv=:losv WHERE cid=:cid AND parentid=:pid AND subid=:sid");
            $sthupdate->execute(array(
                ':cid'=>$data['cid'],
                ':losv'=>$data['mcl'],
                ':pid'=>Session::get('parentcompanyid'),
                ':sid'=>Session::get('subsidiaryid')
                ));
         //populate the saved current record
            $sthp=$this->db->prepare("SELECT * FROM tbl_maxcreditlevel WHERE parentid=:pid AND subid=:sid");
            $sthp->execute(array(
                ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));
            $data=$sthp->fetchAll();
            echo json_encode($data);
           // $stringsave="Maximum Cre
       
}

public function savemcl($data)
{
     $sth=$this->db->prepare("SELECT * FROM tbl_maxcreditlevel WHERE  cid=:cid AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':cid'=>$data['cid'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $record=$sth->fetchAll();
        if($record)
        {
        $sthupdate=$this->db->prepare("UPDATE tbl_maxcreditlevel SET mcl=:mcl WHERE cid=:cid AND parentid=:pid AND subid=:sid");
            $sthupdate->execute(array(
                ':cid'=>$data['cid'],
                ':mcl'=>$data['mcl'],
                ':pid'=>Session::get('parentcompanyid'),
                ':sid'=>Session::get('subsidiaryid')
                ));
         //populate the saved current record
            $sthp=$this->db->prepare("SELECT * FROM tbl_maxcreditlevel WHERE parentid=:pid AND subid=:sid");
            $sthp->execute(array(
                ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));
            $data=$sthp->fetchAll();
            echo json_encode($data);
           // $stringsave="Maximum Cre
        }
        else
        {
            $sthinsert=$this->db->prepare("INSERT INTO tbl_maxcreditlevel(cid,customers,mcl,parentid,subid) VALUES(:cid,:customers,:mcl,:pid,:sid)");
            $sthinsert->execute(array(
                ':cid'=>$data['cid'],
                ':customers'=>$data['customers'],
                ':mcl'=>$data['mcl'],                
                 ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));
            //populate the saved current record
            $sthp=$this->db->prepare("SELECT * FROM tbl_maxcreditlevel WHERE parentid=:pid AND subid=:sid");
            $sthp->execute(array(
                ':pid'=>Session::get('parentcompanyid'),
                 ':sid'=>Session::get('subsidiaryid')
                ));
            $data=$sthp->fetchAll();
            echo json_encode($data);
           // $stringsave="Maximum Credit Level successfully Saved";            
            //$data=array('mcl'=>$data['mcl'],'message'=>$stringsave);
            //echo json_encode($data); 
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