<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Variationitems_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }



    public function savevariationitems($data)
    {
        //if the record exist delete and replace else, save new
        $sth=$this->db->prepare("DELETE FROM tbl_variationitemsetup WHERE vid=:vid");
        $sth->execute(array(
            ':vid'=>$data['vid']
            ));
        $sthinsert=$this->db->prepare("INSERT INTO tbl_variationitemsetup(vid,variation,vartype,vartypecode,accountid,abbr,shows,parentid) VALUES(:vid,:vtion,:vtype,:vtc,:acctid,:abbr,:sh,:pid)");
        $sthinsert->execute(array(
            ':vid'=>$data['vid'],
            ':vtion'=>$data['variation'],
            ':vtype'=>$data['vartype'],
            ':vtc'=>$data['vartypecode'],
            ':acctid'=>$data['accountid'],
            ':abbr'=>$data['abbr'],
            ':sh'=>$data['shows'],
            ':pid'=>Session::get("parentcompanyid")
            ));

       $dnum=substr($data['vid'], 1);
       $cnum= $dnum + 1;

        //update the number
        $sthnumberupdate=$this->db->prepare("UPDATE tbl_vidno SET vidno=:dd WHERE parentid=:pid AND subid=:sid ");
        $sthnumberupdate->execute(array(
                ':dd'=>$cnum,
                ':pid'=>Session::get("parentcompanyid"),
                ':sid'=>Session::get('subsidiaryid')                
            ));
        //set to display it
        $sthd=$this->db->prepare("SELECT * FROM tbl_variationitemsetup WHERE parentid=:pid");
        $sthd->execute(array(
            ':pid'=>Session::get('parentcompanyid')
            ));
        $data=$sthd->fetchAll();

        echo json_encode($data);
        //echo "Variation successfully save";

    }
   

   public function glaccount()
   {
    $sth=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE subclassid='020101' AND parentid=:pid AND csubid=:sid");
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