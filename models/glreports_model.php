<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Glreports_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
   

    public function chartofaccount()
    {
        $sthdelete=$this->db->prepare('DELETE FROM rpt_chartofaccount WHERE parentid=:pid AND subid=:sid AND currentuser=:cuser');
        $sthdelete->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':cuser'=>Session::get('CurrentUser')
            ));
        $sthmain=$this->db->prepare("SELECT * FROM tbl_gl_top");
        $sthmain->execute();
        $top=$sthmain->fetchAll();
        if($top)
        {
            foreach ($top as $key => $value) {
                # code...
                $mid=$value['code'];
                $middesc=$value['description'];
                $sth=$this->db->prepare("SELECT * FROM tbl_gl_subaccount WHERE mainid=:mid");
                $sth->execute(array(
                    ':mid'=>$mid
                    ));
                $datamain=$sth->fetchAll();
                if($datamain)
                {
                    foreach ($datamain as $key => $value) {
                        # code...
                        $desc1=$value['sub_desc'];
                        $subglid=$value['subid'];
                        $sthselect=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE subid=:glsid AND parentid=:pid AND csubid=:sid");
                        $sthselect->execute(array(
                            ':glsid'=>$subglid,
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                            ));
                        $rec=$sthselect->fetchAll();
                        if($rec)
                        {
                            foreach ($rec as $key => $value) {
                                # code...
                                $accountid=$value['accountid'];
                                $gldesc=$value['gldescription'];
                                $sthinsert=$this->db->prepare("INSERT INTO rpt_chartofaccount (accountid,description,parentid,subid,currentuser) VALUES (:acctid,:gldesc,:pid,:sid,:cuser)");
                                $sthinsert->execute(array(
                                    ':acctid'=>$accountid,
                                    ':gldesc'=>$middesc.' --- '.$desc1 . ' --- '. $gldesc,
                                    ':pid'=>Session::get('parentcompanyid'),
                                     ':sid'=>Session::get('subsidiaryid'),
                                     ':cuser'=>Session::get('CurrentUser')
                                    ));
                            }
                        }
                    }
                }
            }

        }
        $sthdisplay=$this->db->prepare("SELECT * FROM rpt_chartofaccount WHERE parentid=:pid AND subid=:sid AND currentuser=:cuser");
        $sthdisplay->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
                                     ':sid'=>Session::get('subsidiaryid'),
                                     ':cuser'=>Session::get('CurrentUser')
            ));

        return $sthdisplay->fetchAll();
        
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