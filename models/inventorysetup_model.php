<?php
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 01/02/2017
 * Time: 02:20
 */

class Inventorysetup_Model extends Model
{
    function __construct()
    {
        parent::__construct();
        Session::init();
    }


    public function GetMyProductList()
    {
        $parentid=Session::get('parentcompanyid');
        $subid=Session::get('subsidiaryid');
        $sth=$this->db->prepare("SELECT * FROM tbl_productlist WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        return $sth->fetchAll();

    }
    public function GetMyCustomers()
    {
        $parentid=Session::get('parentcompanyid');
        $subid=Session::get('subsidiaryid');
        $sth=$this->db->prepare("SELECT * FROM tbl_customer WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        return $sth->fetchAll();
    }
    public function GetMySuppliers()
    {
         $parentid=Session::get('parentcompanyid');
        $subid=Session::get('subsidiaryid');
        $sth=$this->db->prepare("SELECT * FROM tbl_supplier WHERE parentid=:pid AND subid=:sid");
        $sth->execute(array(
            ':pid'=>$parentid,
            ':sid'=>$subid
            ));
        return $sth->fetchAll();
    }
    public function GetGLAccountIDInventory()
    {
        $parentid=Session::get('parentcompanyid');
        $subid=Session::get('subsidiaryid');
        $sth=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE subclassid=:mid AND parentid=:pid AND csubid=:sid");
       // $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':mid'=>'030201',
            ':pid'=>$parentid,
            ':sid'=>$subid
        ));
        return $sth->fetchAll();
    }
    public function GetGLAccountIDSales()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_gl_chartofaccount WHERE mainid=:mid");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute(array(
            ':mid'=>'01'
        ));
        return $sth->fetchAll();
    }
    public function SaveCustomer($data)
    {
        $sth=$this->db->prepare("INSERT INTO tbl_customer (customername,address,mobileno,parentid,subid) VALUES(:cname,:cadd,:cmb,:pid,:sid)");
        $sth->execute(array(
           ':cname'=>$data['customername'],
            ':cadd'=>$data['address'],
            ':cmb'=>$data['mobileno'],
            ':pid'=>$data['parentid'],
            ':sid'=>$data['subid']
        ));
        echo "Customer record successfully saved";
    }
    public function SaveSupplier($data)
    {
        $sth=$this->db->prepare("INSERT INTO tbl_supplier (supplier,address,contact_person,phone_number,email,parentid,subid) VALUES(:supplier,:address,:contperson,:phnum,:email,:pid,:sid)");
        $sth->execute(array(
           ':supplier'=>$data['supplier'],
           ':address'=>$data['address'],
            ':contperson'=>$data['contact_person'],
            ':phnum'=>$data['phone_number'],
            ':email'=>$data['email'],
            ':pid'=>$data['parentid'],
            ':sid'=>$data['subid']
        ));
        echo "Supplier information successfully saved";
    }

    public function SaveProductList($data)
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_productlist WHERE pid=:pid AND parentid=:paid AND subid=:sid");
        $sth->execute(array(
           ':pid'=>$data['pid'],
           ':paid'=>$data['parentid'],
           ':sid'=>$data['subid']
        ));
        $count=$sth->fetch();
        if($count)
        {
            //found, then update
            $sthupdate=$this->db->prepare("UPDATE tbl_productlist  SET pname=:pname,pclass=:pclass WHERE pid=:pid AND parentid=:paid AND subid=:sid");
            $sthupdate->execute(array(
               ':pname'=>$data['pname'],
               ':pclass'=>$data['pclass'],
               ':pid'=>$data['pid'],
               ':paid'=>$data['parentid'],
                ':sid'=>$data['subid']
            ));
            echo "Product List Table Successfully Updated";
        }
        else
        {
            //not exist before, then insert
            $sthInsert=$this->db->prepare("INSERT INTO tbl_productlist (pid,pname,pclass,glsales,glinventory,parentid,subid) VALUES (:pid,:pname,:pclass,:gls,:gli,:paid,:sid)");
            $sthInsert->execute(array(
               ':pid'=>$data['pid'],
               ':pname'=>$data['pname'],
               ':pclass'=>$data['pclass'],
                ':gls'=>$data['glsales'],
                ':gli'=>$data['glinventory'],
                ':paid'=>$data['parentid'],
                ':sid'=>$data['subid']
            ));

            echo "Product List Record successfully saved";

        }
    }
    public function GetProductClass()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_productclass");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }
    public function SaveProductClass($data)
    {
        $sth=$this->db->prepare("INSERT INTO tbl_productclass (category,pclass) VALUES(:cate,:pc)");
        $sth->execute(array(
           ':cate'=>$data['category'],
           ':pc'=>$data['pclass']
        ));
        echo "Product Classification successfully saved";
    }
    public function SaveProductCategory($data)
    {
        $sth=$this->db->prepare("INSERT INTO tbl_productcategory (description,parentid,subid) VALUES(:des,:pid,:sid)");
        $sth->execute(array(
           ':des'=>$data['description'],
           ':pid'=>$data['parentid'],
           ':sid'=>$data['subid']
        ));
        echo "Product Category successfully saved";
    }
    public function GetProductCategory()
    {
        $sth=$this->db->prepare("SELECT * FROM tbl_productcategory");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
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

