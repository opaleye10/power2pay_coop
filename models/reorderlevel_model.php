<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Reorderlevel_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
   

    public function Getitem2reorder()
    {
        $sthd=$this->db->prepare("DELETE FROM rpt_reorder WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
        $sthd->execute(array(
            ':cuser'=>Session::get('CurrentUser'),
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $sth=$this->db->prepare("SELECT distinct stockno,stock,(sum(debit)-sum(credit)) as qty FROM `tbl_stock` WHERE period=:period AND parentid=:pid AND subid=:sid group by stockno,stock");
        $sth->execute(array(
            ':period'=>Session::get('period'),
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
        $data=$sth->fetchAll();
       // print_r($sth->fetchAll());
        //exit();
        foreach ($data as $key => $value) {
                    # code...
                    $qty=$value['qty'];
                    $num=$value['stockno'];
                    $stock=$value['stock'];
                    $sths=$this->db->prepare("SELECT * FROM tbl_reorderlevel WHERE pid=:id AND parentid=:pid AND subid=:sid");
                    $sths->execute(array(
                        ':id'=>$num,                        
                        ':pid'=>Session::get('parentcompanyid'),
                        ':sid'=>Session::get('subsidiaryid')
                        ));

                    $record=$sths->fetchAll();
                   // print_r($record);
                    //exit();
                    if($record)
                    {
                        $myqty=0;
                        foreach ($record as $key => $value) {
                            # code...
                            $myqty=$value['qty'];
                        }
                        if($qty <= $myqty)
                        {
                          //  print_r($qty . ' '. $myqty);
                           // exit();

                        $sthi=$this->db->prepare("INSERT INTO rpt_reorder (stockno,stock,roqty,aqty,currentuser,parentid,subid) VALUES(:stockno,:stock,:roqty,:aqty,:cuser,:pid,:sid)");
                        $sthi->execute(array(
                            ':stockno'=>$num,
                            ':stock'=>$stock,
                            ':roqty'=>$myqty,
                            ':aqty'=>$qty,
                            ':cuser'=>Session::get("CurrentUser"),
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                            ));
                        }

                    }

                }  

                $sthd=$this->db->prepare("SELECT * FROM rpt_reorder WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
                        $sthd->execute(array(
                            ':cuser'=>Session::get("CurrentUser"),
                             ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                            ));

                return $sthd->fetchAll();
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