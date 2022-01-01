<?php
class Login_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }


    
   public function permit($data)
   {
       $sth= $this->db->prepare("SELECT * FROM users WHERE username=:users AND password=:pwd AND mstatus=:mst");
       $sth->execute(array(
           ':users'=> $data['login'],
           ':pwd'=> $data['password'],
           ':mst'=>'Active'
       ));
       $data1 = $sth->fetch();
    if($data1)
       {
          /*
          if($data1['access_status']=='Yes')
          {
            Session::set('access_permit',true);
          } */
          Session::set('parentcompanyid',$data1['parentid']);
          Session::set('subsidiaryid',$data1['subid']);


          //get the main company
           $sth9=$this->db->prepare("SELECT * FROM tbl_firm WHERE cid=:id");
           $sth9->setFetchMode(PDO:: FETCH_ASSOC);
           $sth9->execute(array(
            ':id'=>Session::get('parentcompanyid')
            ));
           $count=$sth9->fetch();



           //get the subsidiary company
           $sthsub=$this->db->prepare("SELECT * FROM tbl_subfirm WHERE parentid=:pid AND id=:sid");           
           $sthsub->execute(array(
            ':pid'=>Session::get('parentcompanyid'),
            ':sid'=>Session::get('subsidiaryid')
            ));
           $countme=$sthsub->fetch();
          



           //select the current active accounting period
           $sthAcctYr=$this->db->prepare("SELECT * FROM tbl_accountperiod WHERE astatus=:astatus");
           $sthAcctYr->execute(array(
              ':astatus'=>'Active'
           ));
           $Acctyr=$sthAcctYr->fetch();
           if($Acctyr)
           {
                //if account year is set correctly
                //let a session call currentyear hold account year
               Session::set('period',$Acctyr['yr']);

               //where as, interval is also needed for transaction date verifications
               //therefore, lets hold startdate and enddate in a session too
               Session::set('startdate',$Acctyr['startdate']);
               Session::set('enddate',$Acctyr['enddate']);

               Session::set('CurrentUser',$data1['username']);
               Session::set('loggedIn',true);

               //Get company profile
               //print_r($count);
               //exit();
               Session::set('roleid',$data1['roleid']);
               Session::set('subsidiary',$countme['subfirm']);
               Session::set('subsidiarycontact',$countme['contact']);
               Session::set('companyname',$count['companyname']);



               if(Session::get('roleid')==8)
               {
                header('location: ../reorderlevel');
               }
               else
               {
                header('location: ../pos');
               }
               
           }
           else
           {
                //if there is no active account period
               //exit the application
               echo "Application stopped, no valid accounting period";
               exit();
           }

       }
       else if($data['login']=='logmein' && $data['password']=='123456')
       {
        /*
              Session::set('CurrentUser',$data['login']);
               Session::set('loggedIn',true);
               Session::set('parentcompanyid',500);
              Session::set('subsidiaryid',500);
              Session::set('roleid',500);
           header('location: ../profile');
           */
           echo "<script>
           alert('Login expired, contact the administrator');
           window.location = 'http://localhost:8080/finance/account/index';
           </script>";

       }
       else
       {
       
           echo "Login not correct";
       
       }


       function logout()
       {
           Session::destroy();
           header('location: ../login');
           exit;
       }

   }
}