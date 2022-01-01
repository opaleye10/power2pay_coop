<?php
class Poslist extends Controller{
    function __construct()
    {
        parent::__construct();
        Session::init();
        $this->view->js=array('poslist/js/default.js');

        $logged = Session::get('loggedIn');
        if ($logged == false) {
            Session::destroy();
            header('location: ' . URL . 'login');
            exit;
        }
    }
    function index(){
        $this->view->GetGLMenulist =$this->model->GetGLMenulist();
        $this->view->GetAPMenulist =$this->model->GetAPMenulist();
        $this->view->GetARMenulist =$this->model->GetARMenulist();
        $this->view->GetPRMenulist =$this->model->GetPRMenulist();
        $this->view->GetINMenulist =$this->model->GetINMenulist();
        $this->view->GetSTMenulist =$this->model->GetSTMenulist(); 
       $this->view->GetPOSAccountlist =$this->model->GetPOSAccountlist();
        $this->view->render('poslist/index');
    }

    public function delete($id)
    {
         $this->view->DeletePOSTransactions =$this->model->DeletePOSTransactions($id);
        $this->view->render('poslist/index');
    }

    public function details($id)
    {
        $this->view->GetPOSTransactionDetails =$this->model->GetPOSTransactionDetails($id);
        $this->view->render('poslist/detailpage');
    }

    public function approvedpost()
    {

       if(isset($_POST['trnno'])  )
       {
         $data=array();
          $data['trnno']=$_POST['trnno'];
        $data['customer']=$_POST['customer'];
        $data['purchasestype']=$_POST['purchasestype'];
          //print_r($data);
         $this->model->approvedpost($data);
         echo "<script type='text/javascript'>
            alert('Transaction successfully approved and posted to journal');
            window.location.replace('https://app.power2pay.com.ng/poslist');            
            </script>";
         //  $this->view->detailsdaterange =$this->model->detailsdaterange($data);
          // header('location: ' . URL . 'poslist');
       }
       else

       {
        echo "<script type='text/javascript'>

            alert('Please re-select the Transaction');

            window.location.replace('https://app.power2pay.com.ng/poslist');

            </script>";
       }
            
       
    }



       
    
}
?>