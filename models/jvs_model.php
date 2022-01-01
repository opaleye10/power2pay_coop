<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 13/02/2017
 * Time: 07:20
 */

class Jvs_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }



    public function GetJournallist()
    {
    	# code...
    	$period=Session::get('period');
    	$sth=$this->db->prepare("SELECT distinct *,sum(debit) as dr, sum(credit) as cr FROM `tbl_banktransaction` WHERE period=:period AND (posted='N' or posted='') group by trnno");
    	$sth->setFetchMode(PDO::FETCH_ASSOC);
    	$sth->execute(array(
    		':period'=>$period
    		));
    	return $sth->fetchAll();
    }
    public function GetBankTransactionRecord($id)
    {
    	$sth=$this->db->prepare("SELECT * FROM tbl_banktransaction WHERE tme=:tme AND period=:period");
    	$sth->execute(array(
    		':tme'=>$id,
    		':period'=>Session::get('period')
    		));
    	$record=$sth->fetchAll();
    	if($record)
    	{
    		foreach ($record as $key => $value) {
    			# code...
    			//search for gldescription
    			$accountid=$value['accountid'];
    			$trnno=$value['trnno'];
    			$trndate=$value['trndate'];
    			$desc=$value['description'];
    			$cuser=$value['currentuser'];
    			$invno=$value['invno'];
    			$debit=$value['debit'];
    			$credit=$value['credit'];
    			$currentuser=Session::get('CurrentUser');
    			$tme=$value['tme'];


    			$sths=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE accountid=:acctid");
    			$sths->setFetchMode(PDO::FETCH_ASSOC);
    			$sths->execute(array(
    				':acctid'=>$accountid
    				));
    			$gldesc=$sths->fetchAll();
    			if($gldesc)
    			{
    				foreach ($gldesc as $ikey => $ivalue) {
    					# code...
    					$gldescription=$ivalue['gldescription'];
    				}
    				

    				//now insert into the journal temporary table
    				$sthInsert=$this->db->prepare("INSERT INTO tbl_jvs (trndate,trnno,invno,accountid,gldescription,description,debit,credit,period,postedby,preparedby,tme) VALUES(:trndate,:trnno,:invno,:accountid,:gldescription,:description,:debit,:credit,:period,:postedby,:preparedby,:tme)");
    				$sthInsert->execute(array(
    					':trndate'=>$trndate,
    					':trnno'=>$trnno,
    					':invno'=>$invno,
    					':accountid'=>$accountid,
    					':gldescription'=>$gldescription,
    					':description'=>$desc,
    					':debit'=>$debit,
    					':credit'=>$credit,
    					':period'=>Session::get('period'),
    					':postedby'=>$cuser,
    					':preparedby'=>$currentuser,
    					':tme'=>$tme
    					));

    			//update tbl_banktransaction (posted and poostedby)
    				$sthposted=$this->db->prepare("UPDATE tbl_banktransaction SET posted=:posted, postedby=:postedby WHERE tme=:tme");
    				$sthposted->execute(array(
    					':posted'=>'Y',
    					':postedby'=>$currentuser,
    					':tme'=>$tme
    					));

    				echo "GL Journal Successfully Created";

    			}
    			else
    			{
    				echo "unexpected error occur, account description in chart of account is missing";
    				exit();
    			}
    		}
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