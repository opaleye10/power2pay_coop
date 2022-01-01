<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 02:20
 */

class Salarysetups_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }

    public function GetSalaryAllws(){
        $sth = $this->db->prepare("SELECT * FROM tbl_salary_allowance");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }

    public function GetSalaryUnion(){
        $sth = $this->db->prepare("SELECT * FROM `tbl_salary_union`INNER JOIN tbl_salary_bank where tbl_salary_union.bankunion=tbl_salary_bank.id");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }


    public function GetSalaryBank()
    {
        $sth = $this->db->prepare("SELECT * FROM tbl_salary_bank");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();

    }
    public function GetSalaryDept()
    {
        $sth = $this->db->prepare("SELECT * FROM tbl_salary_dept");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }
    
    public function deleteallwbyid($data)
    {
         $sth=$this->db->prepare('DELETE FROM tbl_salary_allowance WHERE id=:id');
        $sth->execute(array(
            ':id' =>$data['id']
            ));
    }
    public function editdept($data)
    {
        $sth=$this->db->prepare("UPDATE tbl_salary_dept SET astatus=:ast WHERE id=:id");
        $sth->execute(array(
            ':ast' =>'InActive', 
            ':id'=>$data['id']
            ));
    }

    public function editgn($data)
    {
        $sth=$this->db->prepare("UPDATE tbl_salary_gradename SET astatus=:ast WHERE id=:id");
        $sth->execute(array(
            ':ast' =>'Block', 
            ':id'=>$data['id']
            ));
    }
    public function editthisrecord($data)
    {
        $sth=$this->db->prepare("UPDATE tbl_salary_category SET astatus=:ast WHERE id=:id");
        $sth->execute(array(
            ':ast' =>'Block', 
            ':id'=>$data['id']
            ));
    }

    public function deletegn($data)
    {
         $sth=$this->db->prepare('DELETE FROM tbl_salary_gradename WHERE id=:id');
        $sth->execute(array(
            ':id' =>$data['id']
            ));
    }
    public function deletedept($data)
    {
        $sth=$this->db->prepare('DELETE FROM tbl_salary_dept WHERE id=:id');
        $sth->execute(array(
            ':id' =>$data['id']
            ));
    }
    public function deleteunion($data){
        $sth=$this->db->prepare('DELETE FROM tbl_salary_union WHERE salunion=:id');
        $sth->execute(array(
            ':id' =>$data['id']
            ));
    }
    public function deletebank($data)
    {
         $sth=$this->db->prepare('DELETE FROM tbl_salary_bank WHERE id=:id');
        $sth->execute(array(
            ':id' =>$data['id']
            ));
    }

    public function deletethisrecord($data)
    {
        $sth=$this->db->prepare('DELETE FROM tbl_salary_category WHERE id=:id');
        $sth->execute(array(
            ':id' =>$data['id']
            ));
    }
    public function GetSalaryGN()
    {
     $sth=$this->db->prepare("SELECT * FROM tbl_salary_gradename");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }
    public function GetSalaryGL()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE mainid='02'");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();

    }
    public function GetSalaryCagetory()
    {
        $sth = $this->db->prepare("SELECT * FROM tbl_salary_category");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }
    public function SaveDepartment($data)
    {
        $sth=$this->db->prepare("INSERT INTO tbl_salary_dept(dept,astatus) VALUES(:de,:astatus)");
        $sth->execute(array(
           ':de'=>$data['dept'],
           ':astatus'=>$data['astatus']
        ));
        echo "Saved Successully";
    }
    public function saveallw($data)
    {

        //generateid
         $sth1=$this->db->prepare("SELECT allwid FROM tbl_rfno");
        $sth1->execute();
        $totref=$sth1->fetch();
        if ($totref)
        {
            //update the number immediately
            $realno=$totref['allwid'] + 1;
            $sthnupdate=$this->db->prepare("UPDATE tbl_rfno SET allwid=$realno");
            $sthnupdate->execute();
           //  $allw= $realno;        
        }

        $allwno="Allw/".$realno;
        $sth=$this->db->prepare("INSERT INTO tbl_salary_allowance (allwid,allwdesc) VALUES(:aid,:adsc)");
        $sth->execute(array(
            ':aid'=>$allwno,
            ':adsc'=>$data['allwdesc']
            ));
        $stringsave="Allowance Successully saved";            
            $data=array('allwid'=>$allwno,'message'=>$stringsave);
            echo json_encode($data); 

        //echo "Allowance Successully saved";
    }


    public function saveunionlist($data)
    {
        $sth=$this->db->prepare("INSERT INTO tbl_salary_union (salunion,bankunion,acctno) VALUES(:su,:bu,:ano)");
        $sth->execute(array(
            ':su'=>$data['salunion'],
            ':bu'=>$data['bankunion'],
            ':ano'=>$data['acctno']
            ));
        echo "Union Successfully Saved";
    }


    public function SaveGradeName($data)
    {
        $sth=$this->db->prepare("INSERT INTO tbl_salary_gradename (gradename,abbr,astatus) VALUES (:gn,:abb,:ast)");
        $sth->execute(array(
            ':gn'=>$data['gradename'],
            ':abb'=>$data['abbr'],
            ':ast'=>$data['astatus']
        ));
        echo "Saved Successully";
    }
    
    public function SaveBank($data)
    {
        $sth=$this->db->prepare("INSERT INTO tbl_salary_bank(bank) VALUES(:bank)");
        $sth->execute(array(
           ':bank'=>$data['bank'],           
        ));
        echo "Saved Successully";
    }
    
    public function SaveCategory($data)
    {
        $sth=$this->db->prepare("INSERT INTO tbl_salary_category(category,astatus) VALUES(:des,:astatus)");
        $sth->execute(array(
           ':des'=>$data['category'],
           ':astatus'=>$data['astatus']
        ));
        echo "Saved Successully";
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