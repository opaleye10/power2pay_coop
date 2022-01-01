<?php
class Index_Model extends Model {
   public function __construct()
    {
        parent::__construct();
        Session::init();
    }
public function selectestimonies()
{
    //thre testimonies at random
    $sth = $this->db->prepare('SELECT * FROM dis_testimony');
    $sth->execute();
    return $sth->fetchAll();

}
    public function xhrGetListings()
    {
        $sth = $this->db->prepare('SELECT * FROM data_rumours ORDER BY id DESC' );
        $sth->setFetchMode(PDO:: FETCH_ASSOC);
        $sth->execute();
        $data = $sth->fetchAll();
        echo json_encode($data);
    }
    public function DisplayMsgList()
    {
       if (__phpfile__ == 0)
       {
           $page1=0;
       }
        else
        {
            $page1=(__phpfile__ * 20) -20;
        }
       //$page1=5;
        $dlp= 20;

   //     exit;
        $sth = $this->db->prepare("SELECT id,ptitle,pname,pmsg FROM data_rumours ORDER BY id DESC LIMIT $page1,$dlp");
        $sth->execute();
        return $sth->fetchAll();

    }
    public function DisplayMsgCount()
    {
        $sth = $this->db->prepare('SELECT id,ptitle,pname,pmsg FROM data_rumours ORDER BY id DESC' );
        $sth->execute();
        return $sth->fetchAll();

    }
    public function DetailsSelected($id)
    {       
        $sth = $this->db->prepare('SELECT id,ptitle,pname,pmsg,ddate,dtime,images,description FROM data_rumours WHERE id= :id');
        $sth->execute(array(':id' => $id));
        return $sth->fetch();
    }
  public  function xhrInsert()
    {
        $post_id=$_POST['post_id'];
        $comment=$_POST['comment'];
        $comment_name =$_POST['comment_name'];
        $ttime = time();
        $ddate = date('Y-m-d H:i:s');
        $sth = $this->db->prepare('INSERT INTO comments 
              (post_id,comments,comment_name,ttime,ddate) VALUES (:post_id,:comment,:comment_name,:ttime,:ddate)');
        $sth->execute(array(
            ':post_id'=> $post_id,
            ':comment'=> $comment,
            ':comment_name'=> $comment_name,
            ':ttime' => $ttime,
            ':ddate' => $ddate
        ));
        $data=array('comment' => $comment,'comment_name' => $comment_name, 'ttime' => $ttime,'ddate'=> $ddate,'id' => $this->db->lastInsertId());
        echo json_encode($data);
    }
    public function xhrSubGetListings($id)
    {
        //$post_id= $_POST['id'];
        $sth = $this->db->prepare('SELECT id,post_id,comments,comment_name,ttime,ddate FROM comments WHERE post_id= :post_id ORDER BY id DESC');
        $sth->setFetchMode(PDO:: FETCH_ASSOC);
        $sth->execute(array(':post_id' => $id));
        return $sth->fetchAll();
        //$data = $sth->fetchAll();
        //echo json_encode($data);
    }
    public function RegisterNewMMF($data)
    {
        //check for the existence of email
        $sthemail=$this->db->prepare("SELECT * FROM tbl_mmf_members WHERE email='". $data['Oemail'] ."'");
        $sthemail->execute();
        $searchemail=$sthemail->fetch();
        //print_r($searchemail);
        if ($searchemail)
        {
            Session::set('emailexist',true);
            header('location: ../reporterror');
        }
        else
        {
            $sthmobile=$this->db->prepare("SELECT * FROM tbl_mmf_members WHERE phoneno='". $data['phoneno'] ."'");
            $sthmobile->execute();
            $searchmobile=$sthmobile->fetch();
            if ($searchmobile)
            {

                Session::set('mobileexist',true);
                header('location: ../reporterror');
            }

            else
            {
                $sth=$this->db->prepare("INSERT INTO tbl_mmf_members (fname,email,pwd,remail,phoneno,cur_date) VALUES(:fname,:email,:pwd,:remail,:phoneno,:ccdate)");
                $sth->execute(array(
                    ':fname'=> $data['fname'],
                    ':email'=> $data['Oemail'],
                    ':pwd'=> Hash::create('SHA256',$data['pwd'],HASH_KEY),
                    ':remail' => $data['remail'],
                    ':phoneno' => $data['phoneno'],
                    ':ccdate' => date("d-m-Y H:i:s")

                ));
                Session::set('successful',true);
                Session::set('email',$data['Oemail']);
                Session::set('yourname',$data['fname']);
                header('location: ../reporterror');
            }
        }
    }
    public function GetTodayPrediction()
    {
        $sth=$this->db->prepare('SELECT id,country,fixture,prediction,dresult FROM freebet ORDER BY rand() LIMIT 5');
        $sth->setFetchMode(PDO:: FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
    }
    public function SelectRandonSpecialAdvert()
    {
        $sth=$this->db->prepare('SELECT id,client_name,webadd,products,image FROM client_records ORDER BY rand() LIMIT 2');
        $sth->setFetchMode(PDO:: FETCH_ASSOC);
        $sth->execute();
        return $sth->fetchAll();
        /*
        $result=array();
        https://www.youtube.com/watch?v=j6mx3hvSDqU

        https://www.youtube.com/watch?v=MEiEWOivG00
        while($row =mysqli_fetch_array($data))
        {
            array_push($result,array(
                    'id' => $row[0],
                    'Name' => $row[1],
                    'products'=> $row[2],
                    'Image' => $row[3]
            ));
        }
        */
       // return json_encode(array("result"=> $data));

        //return $sth->fetchAll();
        //select * from table order by rand() limit 10
    }
    public function xhrMainlikes($id)
    {
        //$post_id= $_POST['id'];
        $st=$this->db->prepare('SELECT * FROM data_rumours WHERE id=:post_id');
        $previousvalue = $st->execute(array(':post_id' => $id));
        $prev_likes = $previousvalue['likes'];

        $sth = $this->db->prepare('UPDATE data_rumours set likes="'. $prev_likes + 1 .'" WHERE id = "'. $id .'"');
        $sth->execute();
        $data=array('id' => $id,'dvalue' => $prev_likes +1);
        echo json_encode($data);
        //then select the value and post for refresh

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