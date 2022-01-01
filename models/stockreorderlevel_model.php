<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Stockreorderlevel_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
    
    public function GetAcctYr($id)
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_accountperiod WHERE id=:id");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':id'=>$id
        ));
        return $sth->fetch();
    }

    public function GetItemlist()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_productlist WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get("subsidiaryid")
            ));
        return $sth->fetchAll();
    }

    public function savereorderlevel($data)
    {
        $sth=$this->db->prepare("DELETE FROM tbl_reorderlevel WHERE parentid=:pid AND subid=:sid AND pid=:ppid");
        $sth->execute(array(
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get("subsidiaryid"),
            ':ppid'=>$data['pid']
            ));

        $sthinsert=$this->db->prepare("INSERT INTO tbl_reorderlevel (pid,product,qty,parentid,currentuser,subid,roleid) VALUES(:p,:pr,:qty,:pid,:cuser,:sid,:rid)");
        $sthinsert->execute(array(
            ':p'=>$data['pid'],
            ':pr'=>$data['product'],
            ':qty'=>$data['qty'],
            ':pid'=>$data['parentid'],
            ':cuser'=>$data['currentuser'],
            ':sid'=>$data['subid'],
            ':rid'=>Session::get("roleid")
            ));
        $pid=$data['pid'];
        $product=$data['product'];
        $qty=$data['qty'];

        $stringsave="Record successfully saved";            
        $data=array('itemno'=>$pid,'itemname'=>$product,'qty'=>$qty,'message'=>$stringsave);
            echo json_encode($data); 
        
    }

    public function GetReorderlevelitems()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_reorderlevel WHERE parentid=:pid AND subid=:sid");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':pid'=>Session::get("parentcompanyid"),
            ':sid'=>Session::get("subsidiaryid"),
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