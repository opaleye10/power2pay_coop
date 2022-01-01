<?php
Session::init();
//print_r($this->GetDeliveredStock);
$b=array($this->GetStockDelivered);
//print_r($this->GetStockDelivered_Total);
//$ntotal=array($this->GetStockDelivered_Total['nTotal']);


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
            <h1> <a class="navbar-brand" href="<?php echo URL.'index' ?>  ">Power2pay</a></h1>
        </div>
        <div class=" border-bottom">
            <div class="full-left">
                <h2> <a  href="<?php echo URL.'index' ?>  "><?php  echo Session::get("companyname"); ?></a></h2>
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
                            <a href="<?php echo URL.'index' ?>  " class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
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
                    <span>Inventory : Stock Delivery</span>
                </h2>
            </div>
            <!--//banner-->
            <!--content-->
            <div class="content-top">
                <div class="col-md-8 content-top-2">
                  
                    <div class="content-graph">
                     <?php
                            foreach ($this->GetStockDelivered as $Key) {
                             $supplier=$Key['supplier'];


                             }
                        ?>
                        <div class="graph-container">
                            <div class="grid-form1"> 
                            <?php


                            foreach ($this->GetStockDelivered as $key => $value) {
                                # code...
                               $comp=$value['supplier'];
                               $ddat = $value['deldate'];
                               $delno = $value['deliveryno'];
                               $trnno=$value['trnno'];
                            }
                           echo  '<div class="form-group">
                                            Delivery Date : '. $ddat .'
                                            
                                        </div>
                                <div class="form-group">
                                            Vendor Name :  '. $comp .'
                                            
                                        </div>
                                <div class="form-group">
                                            Delivery Number :  '. $delno .'
                                            
                                        </div>

                                <div class="form-group">
                                            Transaction RefNo :  '. $trnno .'
                                            
                                        </div>



                                        ';


                            ?>
                            
                                            
                            








                                                           
                                
                                    <div>
                                        <?php
                                          // print_r($this->GetStockhead);
                                        //$myrecords=($this->GetGlAcctsubdetails);
                                        //get the value
                                        foreach ($this->GetStockDelivered_Total as $Key => $Value) {
                                            $ntotal=$Value['nTotal'];
                                        }
                                        
                                        ?>
                                        <table  class="blueTable" style="width: 100%">
                                            <thead>
                                            <tr>

                                                <th style="width: 15%; text-align: center;">Item No</th>
                                                <th style="width: 40%; text-align: center;" >Item</th>
                                                <th style="width: 20%; text-align: center;">Qty</th>
                                                <th style="width: 15%; text-align: center">Price</th>
                                                <th style="width: 15%; text-align: center">Amount</th>
                                                <th></th>                                               

                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <td colspan="6" style="text-align: right;"><?php echo number_format($ntotal) ; ?>
                                                </td>
                                            </tr>
                                            </tfoot>
                                            <tbody id="tbodyid">
                                            <?php
                                              foreach ($this->GetStockDelivered as $Key => $Value) {
                                                $tme=$Value['tme'];
                                                $link='<a href="'. URL.'stockdelivery/details/'. $Value['tme'].'"> <button>Approve</button></a>';                                                
                                                echo '<tr>
                                            <td>'.$Value['itemno'].'</td><td>'.$Value['itemdesc'].'</td><td style="text-align: right">'.number_format($Value['qty']).'</td><td style="text-align: right">'.number_format($Value['price']).'</td></td><td style="text-align: right">'. number_format($Value['amount']).'</td></tr>';
                                            }
                                            ?>
                                            </tbody>
                                            </tr>
                                        </table>

                                        <form method="post" enctype="multipart/form-data" action="<?php echo URL.'stockdelivery/approveddelivery' ;?>">
                                        <input type="hidden" name="deliverytrackno" value="<?php echo $tme; ?>">
                                        <input type="submit" name="" value="Approve Delivery"> <a href="<?php echo URL."stockdelivery"; ?>"><input type="button" name="" value="Back to Delivery List"></a>
                                        </form>
                                        
                                    </div>


                                    





















                            </div>
                                </form>


                            </div>
































                            <script>
                                function getMyId(val) {
                                    // return  console.log('selected', val);
                                    var acctid = document.getElementById("glminacct").value;
                                    // alert(acctid);
                                    $('#mainid').val(acctid);
                                }
                            </script>
                        </div></div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!---->



