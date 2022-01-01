<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Salessummary_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }
   
    public function dailysalessummary($data)
    {
        //delete from the report table rpt_salessummary
        $sthdelete=$this->db->prepare("DELETE FROM rpt_salessummary WHERE parentid=:pid and subid=:sid and currentuser=:cuser");
        $sthdelete->execute(array(
           ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':cuser'=>Session::get('CurrentUser')
            ));
        //get the date from for cost prices
       // $date = (Date($data['mydate']),strtotime("-2 week");
           $date = date('Y-m-d', strtotime('-1 week', strtotime($data['mydate'])));
       // $date_from=date($data['mydate'], strtotime("-2 week"));
       
       //select the list of products sold on the date selected
           $sthproductlist=$this->db->prepare("SELECT DISTINCT(pid) FROM tbl_pos WHERE parentid=:pid AND subid=:sid AND period=:period AND trndate=:date1");
           $sthproductlist->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid'),
            ':period'=>Session::get('period'),
            ':date1'=>$data['mydate']            
            ));
           $products=$sthproductlist->fetchAll();
          // print_r($products);
           //exit();

           if($products)
           {
                    foreach ($products as $key => $value) {
                        # code...
                        $pid=$value['pid'];
                        //get the qty and amount of each product
                        $sthqa=$this->db->prepare("SELECT DISTINCT pid,product, sum(qty) as qty,sum(amount) as amt FROM tbl_pos WHERE pid=:prid AND parentid=:pid AND subid=:sid AND period=:period AND trndate=:date1 GROUP BY pid,product");
                        $sthqa->execute(array(
                            ':prid'=>$pid,
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid'),
                            ':period'=>Session::get('period'),
                            ':date1'=>$data['mydate']            
                            ));
                           $qtyamt=$sthqa->fetchAll();
                          // print_r($qtyamt);
                           //exit();
                           $qty=0;
                           $amt=0;
                           $totalec=0;
                           foreach ($qtyamt as $key => $valueqa) {
                               # code...
                            $qty=$valueqa['qty'];
                            $amt=$valueqa['amt'];
                            $product=$valueqa['product'];

                           }


                           //get the cost price
                           $date2=$data['mydate'];
                           echo $date2 . ' '. $date;
                           $sthcp=$this->db->prepare("SELECT * FROM tbl_deliverylist WHERE itemno=:itno AND parentid=:pid AND subid=:sid AND period=:period AND deldate <= :date1 ORDER BY id DESC LIMIT 1");
                           $sthcp->execute(array(
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid'),
                            ':period'=>Session::get('period'),
                            ':itno'=>$pid,                            
                            ':date1'=>$data['mydate']
                            ));
                           $cpdata=$sthcp->fetchAll();
                           //print_r($cpdata);
                           //exit();
                           $cost=0;

                           if($cpdata)
                           {
                            foreach ($cpdata as $key => $valuect) {
                                # code...
                                $cost=$valuect['price'];
                            }

                           }
                           else
                           {

                                //try three weeks
                                $date3 = date('Y.m.d', strtotime('-1 week', strtotime($data['mydate'])));
                                $sthcp3=$this->db->prepare("SELECT * FROM tbl_deliverylist WHERE itemno=:itno AND parentid=:pid AND subid=:sid AND period=:period AND deldate <= :date1 ORDER BY id DESC LIMIT 1");
                               $sthcp3->execute(array(
                                ':pid'=>Session::get('parentcompanyid'),
                                ':sid'=>Session::get('subsidiaryid'),
                                ':period'=>Session::get('period'),
                                ':itno'=>$pid,                                
                                ':date1'=>$date3 
                                ));
                               $cpdata3=$sthcp3->fetchAll();
                               if($cpdata3)
                               {
                                    foreach ($cpdata3 as $key => $valuect1) {
                                # code...
                                        $cost=$valuect1['price'];
                                    }
                               }
                               else
                               {
                                        echo "<script type='text/javascript'>

                                        alert('Sorry!! This report cannot be generated because you have not being buy goods for resell for the past 3 weeks');

                                        window.location.replace('https://app.power2pay.com.ng/salessummary');

                                        </script>";
                               }

                           }
                           
                           $totalqty=$qty;
                           $totalrev=$amt;
                           $totalactualcost=$totalqty * $cost;
                           if($totalactualcost==0)
                           {
                             $profit=0;   
                           }
                           else
                           {
                            $profit=$totalrev-$totalactualcost;
                           }
                           
                          // echo "PID :".$pid . '  '.$product. '  qty :'.$totalqty. '  Income '. $totalrev.'   Expected Cost '.$totalactualcost. '  p/l '.$profit. '<br/>';
                            
                           //insert the record and loop again
                           $sthindert=$this->db->prepare("INSERT INTO rpt_salessummary(prid,product,qty,income,actualcost,profitloss,rptdate,currentuser,parentid,subid) VALUES(:prid,:prod,:qty,:inc,:act,:pro,:rptd,:cuser,:pid,:sid)");
                           $sthindert->execute(array(
                            ':prid'=>$pid,
                            ':prod'=>$product,
                            ':qty'=>$totalqty,
                            ':inc'=>$totalrev,
                            ':act'=>$totalactualcost,
                            ':pro'=>$profit,
                            ':rptd'=>$data['mydate'],
                            ':cuser'=>Session::get('CurrentUser'),
                            ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                            ));

                    }

                    //after all insert record, then display it
                    $sthselect=$this->db->prepare("SELECT * FROM rpt_salessummary WHERE currentuser=:cuser AND parentid=:pid AND subid=:sid");
                    $sthselect->execute(array(
                        ':cuser'=>Session::get("CurrentUser"),
                        ':pid'=>Session::get('parentcompanyid'),
                            ':sid'=>Session::get('subsidiaryid')
                        ));
                    return $sthselect->fetchAll();
                    

           }
           else
           {
            echo "<script type='text/javascript'>

            alert('No Sales on the selected date');

            window.location.replace('https://app.power2pay.com.ng/salessummary');

            </script>";
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