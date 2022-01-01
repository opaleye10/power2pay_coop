<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Salesdreport_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
   

    public function displayreport($data)
    {
        # code...
        /*
        $sthdebtors=$this->db->prepare("SELECT DISTINCT customerid,customers,SUM(debit-credit) as balance FROM tbl_debtors WHERE parentid=:pid AND subid=:sid GROUP BY customerid,customers");
        $sthdebtors->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')

            ));
        print_r($sthdebtors->fetchAll());
        exit();
        */
        //delete the record
        $sthdelete=$this->db->prepare("DELETE FROM rpt_salesdreport WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
        $sthdelete->execute(array(
            ':cuser'=>Session::get("CurrentUser"),
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));



        $shselect=$this->db->prepare("SELECT DISTINCT customers,customerid FROM tbl_pos WHERE parentid=:pid AND subid=:sid AND trndate=:trnd AND period=:period");
        $shselect->execute(array(
            ':trnd'=>$data['mydate'],
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':period'=>Session::get("period")
            ));
        $client=($shselect->fetchAll());
        //print_r($client);
        //exit();
        if($client)
        {
            foreach ($client as $key => $valu) {
                # code...
                $sthsel=$this->db->prepare("SELECT * FROM tbl_pos WHERE  customerid=:cid AND parentid=:pid AND subid=:sid AND trndate=:trnd AND period=:period");
                $sthsel->execute(array(
                    ':cid'=>$valu['customerid'],
                    ':pid'=>Session::get('parentcompanyid'),
                    ':sid'=>Session::get('subsidiaryid'),
                    ':period'=>Session::get("period"),
                    ':trnd'=>$data['mydate']
                    ));
                $clientsales=$sthsel->fetchAll();
                //insert all the items
                        foreach ($clientsales as $key => $value) {
                            # code...
                            $sthinsert=$this->db->prepare("INSERT INTO rpt_salesdreport (cusid,customers,pid,product,qty,price,amount,trndate,currentuser,parentid,subid) VALUES(:cid,:cname,:proid,:pro,:qty,:price,:amount,:trnd,:cuser,:pid,:sid)");
                            $sthinsert->execute(array(
                                ':cid'=>$value['customerid'],
                                ':cname'=>$value['customers'],
                                ':proid'=>$value['pid'],
                                ':pro'=>$value['product'],
                                ':qty'=>$value['qty'],
                                ':price'=>$value['price'],
                                ':amount'=>$value['amount'],
                                ':trnd'=>$value['trndate'],
                                ':cuser'=>Session::get('CurrentUser'),
                                ':pid'=>Session::get('parentcompanyid'),
                                ':sid'=>Session::get('subsidiaryid')
                            ));
                        }

            }
            //now display
            $sthedisplay=$this->db->prepare("SELECT * FROM rpt_salesdreport WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid ORDER BY cusid DESC");
            $sthedisplay->execute(array(
                ':cuser'=>Session::get('CurrentUser'),
                ':pid'=>Session::get('parentcompanyid'),
                ':sid'=>Session::get('subsidiaryid')
                ));
            return $sthedisplay->fetchAll();
            

        }
        else
        {
             echo "
             <script type='text/javascript'>
            alert('Sorry!! This report cannot be generated because there are no sales records on the selected date!');
            window.location.replace('https://app.power2pay.com.ng/salesdreport');
            </script>
            ";
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