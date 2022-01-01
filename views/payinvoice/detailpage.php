
<?php
Session::init();
$idd=$this->GetPaymentRefno;

//print_r($this->GetAccount2pay);
//print_r($this->GetInvoice2pay);
$amt=0;
foreach ($this->GetInvoice2pay as $key => $value) {
    # code...
    $supplier=$value['supplier'];
    $Description=$value['description'];
    $trnno=$value['trnno'];
    $trndate=$value['trndate'];
    $invno=$value['invno'];
    $amt=$value['amount']+$amt;
    $period=$value['period'];
    $currentuser=$value['currentuser'];
    $tme=$value['tme'];
}
//04010101 account payable code to credit
?>
<div id="wrapper">
   
    <nav class="navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1><a  class="navbar-brand" href="#"><span style="color: #000000; font-size: .7em"  >Power</spane><span style="color: #228B22; font-size: 1em">2</span><span style="color: #000000; font-size: .7em">Pay</span> <span style="font-size: 0.3em"> Ver 1.0 </span></a></h1> 
        </div>
        <div class=" border-bottom">
            <div class="full-left">
                <h3> <a  href="<?php echo URL.'pos' ?>  "><?php  echo Session::get("companyname").' </h3><br></h4> '. Session::get("subsidiary"); ?></a></h4>
                <div class="clearfix"> </div>
            </div>


            <!-- Brand and toggle get grouped for better mobile display -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="drop-men" >
                <ul class=" nav_1">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"><?php echo Session::get('CurrentUser');?><i class="caret"></i></span></a>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
            <div class="clearfix">

            </div>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo URL.'pos' ?>  " class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
                        </li>
                         

                        <?php
                        //do the GL Menu
                        if(empty($this->GetGLMenulist))
                        {

                        }
                        else
                        {


                            foreach ($this->GetGLMenulist as $key => $valu) {
                            # code...
                            $GlMenu=$valu['parentmenu'];
                        }

                        if ($GlMenu=='menu_001')
                        {
                            echo '<li id="menu_001">
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">General Ledger</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">';
                            foreach ($this->GetGLMenulist as $key => $value) {
                                # code...
                                $submenu=$value['submenu'];
                                $submenudesc=$value['submenudesc'];


                                echo'

                                <li ><a href="'. URL.$submenu.'" class="hvr-bounce-to-right"> <i class="fa fa-file-text-o nav_icon"></i>'. $submenudesc .'</a></li>

                                ';


                            }

                            echo' </ul>
                        </li>';
                        }
                       



                        }

                        




                        ?>



                        <?php
                        //do the Account Payable Menu
                       if(empty($this->GetAPMenulist))
                       {

                       }
                        else
                        {


                            foreach ($this->GetAPMenulist as $key => $valu2) {
                            # code...
                            $GlMenu2=$valu2['parentmenu'];
                        }

                        if ($GlMenu2=='menu_002')
                        {
                            echo '<li id="menu_002">
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Account Payable</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">';
                            foreach ($this->GetAPMenulist as $key => $value2) {
                                # code...
                                $submenu2=$value2['submenu'];
                                $submenudesc2=$value2['submenudesc'];


                                echo'

                                <li ><a href="'. URL.$submenu2.'" class="hvr-bounce-to-right"> <i class="fa fa-file-text-o nav_icon"></i>'. $submenudesc2 .'</a></li>

                                ';


                            }

                            echo' </ul>
                        </li>';
                        }
                       


                        }

                        




                        ?>



                        <?php
                        //do the Account Receivables Menu
                        if(empty($this->GetARMenulist ))
                        {

                        }
                        else
                        {

                            foreach ($this->GetARMenulist as $key => $valu3) {
                            # code...
                            $GlMenu3=$valu3['parentmenu'];
                        }

                        if ($GlMenu3=='menu_003')
                        {
                            echo '<li id="menu_003">
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Account Receivable</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">';
                            foreach ($this->GetARMenulist as $key => $value3) {
                                # code...
                                $submenu3=$value3['submenu'];
                                $submenudesc3=$value3['submenudesc'];


                                echo'

                                <li ><a href="'. URL.$submenu3.'" class="hvr-bounce-to-right"> <i class="fa fa-file-text-o nav_icon"></i>'. $submenudesc3 .'</a></li>

                                ';


                            }

                            echo' </ul>
                        </li>';
                        }
                       


                        }

                        



                        ?>





                        <?php
                        //do the Payroll Menu
                        if(empty($this->GetPRMenulist ))
                        {

                        }
                        else
                        {

                             foreach ($this->GetPRMenulist as $key => $valu4) {
                            # code...
                            $GlMenu4=$valu4['parentmenu'];
                        }

                        if ($GlMenu4=='menu_004')
                        {
                            echo '<li id="menu_004">
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Payroll Mgt</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">';
                            foreach ($this->GetPRMenulist as $key => $value4) {
                                # code...
                                $submenu4=$value4['submenu'];
                                $submenudesc4=$value4['submenudesc'];


                                echo'

                                <li ><a href="'. URL.$submenu4.'" class="hvr-bounce-to-right"> <i class="fa fa-file-text-o nav_icon"></i>'. $submenudesc4 .'</a></li>

                                ';


                            }

                            echo' </ul>
                        </li>';
                        }

                        }

                       
                       




                        ?>




                        <?php
                        //do the Inventory Menu
                        if(empty($this->GetINMenulist))
                        {

                        }
                        else
                        {

                            foreach ($this->GetINMenulist as $key => $valu5) {
                            # code...
                            $GlMenu5=$valu5['parentmenu'];
                        }

                        if ($GlMenu5=='menu_005')
                        {
                            echo '<li id="menu_005">
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Inventory</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">';
                            foreach ($this->GetINMenulist as $key => $value5) {
                                # code...
                                $submenu5=$value5['submenu'];
                                $submenudesc5=$value5['submenudesc'];


                                echo'

                                <li ><a href="'. URL.$submenu5.'" class="hvr-bounce-to-right"> <i class="fa fa-file-text-o nav_icon"></i>'. $submenudesc5 .'</a></li>

                                ';


                            }

                            echo' </ul>
                        </li>';
                        }

                        }

                        
                       




                        ?>




                         <?php
                        //do the Inventory Menu
                         if(empty($this->GetSTMenulist))
                         {}
                     else
                     {


                         foreach ($this->GetSTMenulist as $key => $valu6) {
                            # code...
                            $GlMenu6=$valu6['parentmenu'];
                        }

                        if ($GlMenu6=='menu_006')
                        {
                            echo '<li id="menu_006">
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-cog nav_icon"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">';
                            foreach ($this->GetSTMenulist as $key => $value6) {
                                # code...
                                $submenu6=$value6['submenu'];
                                $submenudesc6=$value6['submenudesc'];


                                echo'

                                <li ><a href="'. URL.$submenu6.'" class="hvr-bounce-to-right"> <i class="fa fa-file-text-o nav_icon"></i>'. $submenudesc6 .'</a></li>

                                ';


                            }

                            echo' </ul>
                        </li>';
                        }
                       

                     }

                       



                        ?>
                        <li>
                            <a href="<?php echo URL; ?>login/logout" class=" hvr-bounce-to-right"><i class="fa fa-lock nav_icon"></i> <span class="nav-label">Logout</span> </a>
                        </li>
                    </ul>
                </div>
            </div>
    </nav>
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="content-main">

            <!--banner-->
            <div class="banner">

                <h2>
                    <a href="index.html">Home</a>
                    <i class="fa fa-angle-right"></i>
                    <span>Account Payable: Creditor Payments</span>
                </h2>
            </div>
            <!--//banner-->
            <!--content-->
            <div class="content-top">
                <div class="col-md-8 content-top-2">
                    
                    <div class="content-graph">

                        <div class="graph-container">
                            <div class="grid-form1">
                                <div  id="snackbar" class="alert alert-danger" role="alert"  style="text-align: center;">INVOICES PAYMENTS</div>
                                <form class="form-inline" action="<?php echo URL; ?>payinvoice/effectbankpayment" method="POST">
                                    <div class="form-group">
                                       <input type="text" class="form-control" size="90" name="invoice_desc" id="invoice_desc" placeholder="Description"  enabled="false" value="<?php echo $Description; ?>" required>                                    

                                    </div>
                                    <br/><br/>
                                    <div class="form-group">
                                     <label class="sr-only" for="exampleInputPassword3">Date</label>
                                        <input type="text" class="form-control" size="15" name="ddate" id="ddate" enabled="false" value="<?php echo $trndate; ?>" required>
                                    </div>
                                    <div class="form-group">
                                    <label class="sr-only" for="exampleInputPassword3">Invoice No</label>
                                        <input type="text" class="form-control" size="18" name="invno" id="invno" placeholder="Invoice No."  enabled="false" value="<?php echo $invno; ?>" required>
                                    </div>
                                    <div class="form-group">
                                    <label class="sr-only" for="exampleInputPassword3">Tran No</label>
                                        <input type="text" class="form-control" size="15" name="trnno" id="trnno" placeholder="transrefno"   value="<?php echo $trnno; ?>" required>
                                    </div>
                                    <div class="form-group">
                                    <label class="sr-only" for="exampleInputPassword3">Amount</label>
                                        <input type="text" class="form-control" size="24" name="tamount" id="tamount"  placeholder="Total Amount" value="<?php echo number_format($amt); ?>"required>
                                        <input type="hidden" class="form-control" size="24" name="myamount" id="myamount"  value="<?php echo ($amt); ?>"required>
                                    </div>
                                    <br/><br/>

                                    <div class="form-group">
                                    <label class="sr-only" for="exampleInputPassword3">Supplier</label>
                                        <input type="text" class="form-control" size="90" name="supplier" id="supplier" placeholder="Description"  enabled="false" value="<?php echo $supplier; ?>" required>
                                    </div>
                                    
                                    



















                                 <div>
                                    <?php
                                       //print_r($this->GetPOSAccountlist);
                                  //  $myrecords=($this->GetGlAcctsubdetails);
                                    ?>
                                    <table class="blueTable">
                                        <thead>
                                        <tr>
                                            <th style='text-align: center'>S/No</th>
                                            <th style='text-align: center'>AccountID</th>                                            
                                            <th style='text-align: center'>Description</th>                                     
                                            <th style='text-align: center'>Amount</th>
                                            <th></th>
                                            
                                        </tr>
                                        </thead>
                                        <tfoot id="tfootid">
                                        <tr>
                                            <td colspan="4" style='text-align: right'><?php echo number_format($amt); ?>
                                            </td>
                                        </tr>
                                        </tfoot>
                                        <tbody id="tbodyid">
                                        <?php
                                            $sn=0;
                                          foreach ($this->GetInvoice2pay as $Key => $Value) {
                                          	$sn=$sn+1;
                                          	$id=$Value['tme'];
                                                $link='<a href="'. URL.'payinvoice/details/'. $id.'"> <button style="font-size:12px"><i class="fa fa-pencil"></i> View </button></a>';  
                                            echo '<tr><td>'.$sn.'</td>
                                        <td>'.$Value['accountid'].'</td><td>'.$Value['gldescription'].'</td><td style="text-align: right">'.number_format($Value['amount']).'</td></tr>';
                                        }


                                        ?>
                                        </tbody>
                                        </tr>
                                    </table>




                                        
                                </div>
                                <br/>
                                 <div class="form-group">
                                <label><input type="checkbox" name="pos" id="pos" > POS/Transfer</label> <label><input type="checkbox" name="paycash" id="paycash"> Cash </label>
                                </div>

                                <div id="postranferrefno" class="alert alert-danger" role="alert"><input type="text" class="form-control"  name="postransfer" id="postransfer" placeholder="Reference No" required>
                                     <label>Bank</label>
                                    <select name="banktocredit" id="banktocredit"  onchange="getAccountid(this.value)">
                                                <option value disabled selected>Select Bank</option>
                                                 <?php
                                                foreach($this->GetBanks as $mod) {
                                                    ?>
                                                    <option value="<?php echo $mod["accountid"]; ?>"><?php echo $mod["bank"]; ?></option>
                                                    <?php
                                                }
                                                ?>                                    
                                            </select>
                                             <script>
                                            function getAccountid(val) {
                                                $('#accountid').val('');
                                                // return  console.log('selected', val);
                                                var accountid=$('#banktocredit').val();
                                              
                                                $('#accountid').val(accountid);

                                            }
                                        </script>









                                    </div>
                                     <input type="text" class="form-control" size="90" name="ccdate" id="ccdate"  value="<?php echo date('d-m-Y'); ?>" required>

                                    <input type="text" class="form-control" size="90" name="accountid" id="accountid" value="cash" required>

                                    <input type="text" class="form-control" size="90" name="invp" id="invp"  value="<?php echo 'PYT/'.$period.'/'.$idd; ?>" required> 
                                    <input type="text" class="form-control" size="90" name="tme" id="tme"  value="<?php echo $idd; ?>" required> 


                                     <input type="text" class="form-control" size="15" name="trnno" id="trnno" placeholder="transrefno"   value="<?php echo $trnno; ?>" required>

                                    

                                    

                                   

                                    
                                    <input type="submit" name="effectpay" id="effectpay" value="Effect Payments">
                                   
                                
                                </form>




                                

                            </div>






























                        </div></div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!---->



