<?php

class Salaryvariation_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }


    public function inddelete($data)
    {
        $sth=$this->db->prepare("DELETE FROM tbl_personnel WHERE vid=:vid AND staffid=:staffid AND parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':vid'=>$data['vid'],
            ':staffid'=>$data['staffid'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        echo "Variation successfully deleted";
    }

    public function displaydeductions($data)
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_personnel WHERE vartype='D' AND  staffid=:staffid AND parentid=:pid AND subid=:sid")  ;
      $sth->execute(array(
        ':staffid'=>$data['staffid'],
        ':pid'=>Session::get('parentcompanyid'),
        ':sid'=>Session::get('subsidiaryid')
        ));
      $dat=$sth->fetchAll();
      echo json_encode($dat);
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
    public function indvarsave($data)
    {
        //delete the exist record the the selected staff
        $sthdelete=$this->db->prepare("DELETE FROM tbl_personnel WHERE staffid=:staffid AND vid=:vid AND parentid=:pid AND subid=:sid");
        $sthdelete->execute(array(
            ':staffid'=>$data['staffid'],
            ':vid'=>$data['vid'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        //select accountid
        $sthaid=$this->db->prepare("SELECT * FROM tbl_variationitemsetup WHERE vid=:vid AND parentid=:pid");
        $sthaid->execute(array(
            ':vid'=>$data['vid'],
            ':pid'=>Session::get('parentcompanyid')
            ));
        $acctid=$sthaid->fetchAll();
        if($acctid)
        {
            foreach ($acctid as $key => $value) {
                # code...
                $accountid=$value['accountid'];
            }
        }
        $sth=$this->db->prepare("INSERT INTO tbl_personnel(vid,abbr,users,defaultstatus,frequency,frqno,amount,accountid,staffid,vartype,parentid,subid) VALUES(:vid,:abbr,:cuser,:dst,:frq,:frqno,:amt,:acctid,:staffid,:vtype,:pid,:sid)");
        $sth->execute(array(
            ':vid'=>$data['vid'],
            ':abbr'=>$data['abbr'],
            ':cuser'=>Session::get('CurrentUser'),
            ':dst'=>'',
            ':frq'=>'Yes',
            ':frqno'=>$data['frqno'],
            ':amt'=>$data['amount'],
            ':acctid'=>$accountid,
            ':staffid'=>$data['staffid'],
            ':vtype'=>$data['vartype'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));

        echo "successfully saved";

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