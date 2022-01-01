<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Acctyr_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
    public function EditAcctPeriod($data)
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_accountperiod WHERE id=:id");
        $sth->execute(array(
           ':id'=>$data['id']
        ));
        $count=$sth->fetch();
        if($count)
        {
            $sthupdate=$this->db->prepare("UPDATE tbl_accountperiod SET astatus=:ast WHERE id=:id");
            $sthupdate->execute(array(
               ':ast'=>$data['astatus'],
               ':id'=>$data['id']
            ));
        }else{
            //not found
        }
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
    public function GetAccountperiodlist(){
        $sth=$this->db->prepare("SELECT * FROM tbl_accountperiod");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }
    public function SaveAccountingPeriod($data)
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_accountperiod WHERE yr=:yr");
        $sth->execute(array(
            ':yr'=>$data['yr']
        ));
        $count=$sth->fetch();
        if($count)
        {
            echo "Account year exist, you may edit";
        }
        else {
            $sthSave = $this->db->prepare("INSERT INTO tbl_accountperiod (startdate,enddate,yr,astatus) VALUES(:sdate,:edate,:yr,:astatus)");
            $sthSave->execute(array(
                ':sdate' => $data['startdate'],
                ':edate' => $data['enddate'],
                ':yr' => $data['yr'],
                ':astatus' => $data['astatus']
            ));
            echo "Accounting period successfully saved";
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