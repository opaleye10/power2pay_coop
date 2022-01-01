<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 25/01/2017
 * Time: 09:13
 */
class Signup_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
        
    }


public function GetStafflist()
{

	$sth=$this->db->prepare("SELECT * FROM tbl_staffrecord WHERE parentid=:pid AND subid=:sid");
   // $sth->setFetchMode(PDO::FETCH_ASSOC);
	$sth->execute(array(
		':pid'=>Session::get('parentcompanyid'),
		':sid'=>Session::get('subsidiaryid')
		));
	return $sth->fetchAll();
}

public function GetRolelist()
{
    $sth=$this->db->prepare("SELECT * FROM tbl_role WHERE parentid=:pid AND subid=:sid");
   // $sth->setFetchMode(PDO::FETCH_ASSOC);
    $sth->execute(array(
        ':pid'=>Session::get('parentcompanyid'),
        ':sid'=>Session::get('subsidiaryid')
        ));
    return $sth->fetchAll();
}
public function createuser($data)
{
    $sth=$this->db->prepare("INSERT INTO users (parentid,subid,roleid,staffid,username,password,logintype,mstatus) VALUES(:pid,:sid,:rid,:stid,:uname,:pwd,:lgt,:mst)");
    $sth->execute(array(
        ':pid'=>$data['parentid'],
        ':sid'=>$data['subid'],
        ':rid'=>$data['roleid'],
        ':stid'=>$data['staffid'],
        ':uname'=>$data['username'],
        ':pwd'=>$data['password'],
        ':lgt'=>$data['logintype'],
        ':mst'=>$data['mstatus']
        ));


echo $data['username']. "user login successfully created";            
          //  $data=array('jref'=>$jref,'message'=>$stringsave,'delno'=>$delno);
          //  echo json_encode($data);  
 //   echo "User successfully created";
}


public function GetRegisteredUsers()

{
    $pid=Session::get('parentid');
    $sid=Session::get('subsidiaryid');
    $sth=$this->db->prepare("SELECT users.parentid,users.subid,users.roleid,users.staffid,users.username, tbl_role.id,tbl_role.rolename,tbl_role.roledesc FROM users
        INNER JOIN tbl_role ON tbl_role.id=users.roleid
        where users.parentid= $pid AND users.subid=$sid");
    $sth->execute();
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