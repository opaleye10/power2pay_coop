<?php
Session::init();
//echo Session::get('roleid');
//echo Session::get('parentcompanyid');
//echo Session::get('subsidiaryid');
//print_r($this->GetMenulist);


$this->DeleteTempoSale;
$id=$this->GetPosRefno;
$idj=$this->GetPOSjref;
 $date=date("Y-m-d");
 foreach ($this->GetDailySalesReports as $key => $value) {
     # code...
    $totalsales=$value['ntotalamt'];
 }
 foreach ($this->GetDailySalesReports_Credit as $key => $value) {
     # code...
    $totalcreditsales=$value['ntotalamt'];
 }
 foreach ($this->GetDailySalesReports_Cash as $key => $value) {
     # code...
    $totalcashsales=$value['ntotalamt'];
 }
 foreach ($this->GetDailySalesReports_transfer as $key => $value) {
     # code...
    $totaltransfersales=$value['ntotalamt'];
 }
 foreach ($this->GetDailySalesReports_pos as $key => $value) {
     # code...
    $totalpossales=$value['ntotalamt'];
 }
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
                      <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown"><span class=" name-caret"><?php echo Session::get('CurrentUser');?><i class="caret"></i></span><img src="images/wo.jpg"></a>
                      <ul class="dropdown-menu " role="menu">
                        <li><a href="#"><i class="fa fa-user"></i>Edit Profile</a></li>
                        <li><a href="#"><i class="fa fa-calendar"></i>Change Password</a></li>
                        <li><a href="#"><i class="fa fa-envelope"></i>Send Mail</a></li>
                        <li><a href="#"><i class="fa fa-clipboard"></i>Tasks</a></li>
                      </ul>
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
                    <span>Dashboard</span>
                </h2>
            </div>
            <!--//banner-->
            <!--content-->
            <div class="col-md-8 content-top-2">

                <div class="content-graph">

                    <div class="graph-container">
                    <div  id="snackbar" class="alert alert-danger" role="alert" ></div>
                        <div class="grid-form1">
                            <div class="form-inline">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="pid" id="pid" placeholder="Product ID" onfocusout="getRecord(this.value)">
                                    <script>
                                            function getRecord(val) {
                                                // return  console.log('selected', val);
                                                var glid = document.getElementById("pid").value;
                                                var parentid=document.getElementById("parentid").value;
                                                var subids=document.getElementById("subid").value;
                                               // alert(glid);
                                                $('#snackbar').hide();
                                                $('#product').val('');
                                                $('#Available').val('');

                                              $.ajax({
                                                        type: 'post',
                                                        url: 'https://app.power2pay.com.ng/models/load_productbyid.php',
                                                        data: {subid: glid,parentid:parentid,subids:subids},
                                                        success: function (o) {
                                                            var data = JSON.parse(o);
                                                            //create table head here
                                                            // $('#snackbar').html(o);
                                                            for(var i=0; 0 < data.length; i++)
                                                            {
                                                                //add row
                                                                $('#product').val(data[i].stock);
                                                                $('#Available').val(data[i].qty);



                                                                //$('#snackbar').append(data[i].descristion);
                                                                // $('#snackbar').html(o);
                                                                //  $('#snackbar').html(data);
                                                            }


                                                        }
                                                    });

                                              $('#qty').focus();



                                            }
                                        </script>


                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control"  name="product" id="product" placeholder="Product Description" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="Available" id="Available" placeholder="Available Qty" required>
                                </div>
                                <br/>

                                <div class="col-md-12 form-group1 group-mail">
                                    <label class="control-label ">Qty</label>
                                    <input type="text" class="form-control"  name="qty" id="qty" placeholder="Qty Required" required>
                                    <label class="control-label ">Unit Price</label>
                                    <input type="text" class="form-control"  name="price" id="price" placeholder="Price/Unit" onfocusout="getRecordDatabase(this.value)">


                                    <script>
                                            function getRecordDatabase(val) {
                                                // return  console.log('selected', val);
                                                var glid = document.getElementById("currentuser").value;
                                                var parentid = document.getElementById("parentid").value;
                                                var subids = document.getElementById("subid").value;

                                                $('#snackbar').hide();
                                                 $("#tbodyid").empty();
                                                 $("#tfootid").empty();


                                                 var urldelete ='<img src="https://app.power2pay.com.ng/public/images/delete.png" style="width: 1.2em; height: 1.2em;">';

                                              $.ajax({
                                                        type: 'post',
                                                        url: 'https://app.power2pay.com.ng/models/load_posSalesTemp.php',
                                                        data: {subid:glid,parentid:parentid,subids:subids},
                                                        success: function (o) {
                                                            var data = JSON.parse(o);
                                                            //create table head here
                                                            //$('#snackbar').show();
                                                            // $('#snackbar').html(o);
                                                            var ntotal=0;
                                                             for(var i=0; 0 < data.length; i++)
                                                            {
                                                                //add row
                                                                ntotal=parseInt(ntotal) + parseInt(data[i].amount);

                                                                var createrow = "<tr><td style='text-align: right'>" + data[i].qty + "</td><td style='text-align: right'>" + data[i].price + "</td><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].amount)) + "</td><td style='text-align: center'>" + data[i].product + "</td><td>" + urldelete + "</td></tr>";
                                                                $("#tbodyid").append(createrow);
                                                                var createfooter="<tr><td colspan='3' style='text-align: right'>"+ (new Intl.NumberFormat().format(ntotal)) +"</td></tr>";
                                                                $("#tfootid").empty();
                                                                $("#tfootid").append(createfooter);
                                                                //$('#snackbar').append(data[i].descristion);
                                                                // $('#snackbar').html(o);
                                                                //  $('#snackbar').html(data);
                                                                $('#Available').val('');
															$('#product').val('');
															$('#pid').val('');
															$('#qty').val('');
															$('#price').val('');
															$('#amount').val('');
															$('#pid').focus();
                                                            }



                                                        }



                                                    });




                                            }
                                        </script>
                                        <label class="control-label ">Amount</label>
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Price/Unit" required>
                                    <input type="hidden" class="form-control" name="currentuser" id="currentuser" value="<?php echo Session::get("CurrentUser") ?>" required>
                                    <input type="hidden" class="form-control" name="parentid" id="parentid" value="<?php echo Session::get("parentcompanyid") ?>" required>
                                    <input type="hidden" class="form-control" name="subid" id="subid" value="<?php echo Session::get("subsidiaryid") ?>" required>
                            <div>
                                    <?php
                                    //   print_r($this->GetGlsubAcctintable);
                                  //  $myrecords=($this->GetGlAcctsubdetails);
                                    ?>
                                    <table class="blueTable">
                                        <thead>
                                        <tr>
                                            <th style='text-align: center'>Qty</th>
                                            <th style='text-align: center'>Price</th>
                                            <th style='text-align: center'>Amount</th>
                                            <th style='text-align: center'>Description</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tfoot id="tfootid">
                                        <tr>
                                            <td colspan="6">
                                            </td>
                                        </tr>
                                        </tfoot>
                                        <tbody id="tbodyid">
                                        <?php
                                        //  foreach ($myrecords as $Key => $Value) {
                                        //    echo '<tr>
                                        //<td>'.$Value['mainid'].'</td><td>'.$Value['subid'].'</td><td>'.$Value['subclassid'].'</td><td>'.$Value['description'].'</td></tr>';
                                        //}


                                        ?>



                                        </tbody>
                                        </tr>
                                    </table>





                                </div>








                                    <?php
/*
                                      <input type="date" class="form-control1 ng-invalid ng-invalid-required" id="currentdate" name="currentdate" ng-model="model.date" value="<?php echo $date;; ?>"  size ="15" required="">
                                      */
                                      ?>
                                    <input type="date" class="form-control1 ng-invalid ng-invalid-required" id="currentdate" name="currentdate" ng-model="model.date" size ="15" required="">
                                </div>

                                <div class="content-top-1">
                                <div class="form-group">
                                <label>Customer</label>
                                    <select name="customers" id="customers">
                                                <option value disabled selected>Select Customer</option>
                                                 <?php
                                                foreach($this->GetCustomer as $module) {
                                                    ?>
                                                    <option value="<?php echo $module["id"]; ?>"><?php echo $module["customername"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select></div>
                                    <label><input type="checkbox" name="cash" id="cash"> Cash </label>     <label><input type="checkbox" name="credit" id="credit"> Credit </label>
                                    <div id="creditdate">
                                    <label>Credit Due Date:</label>
                                     <input type="date" class="form-control1 ng-invalid ng-invalid-required" id="duedate" name="duedate" ng-model="model.date" required=""> </div>


                                    <div class="clearfix"> </div>
                                </div>




                                <div class="content-top-1" id="paytype">
                                    <label><input type="checkbox" name="transfer" id="transfer">Transfer</label>
                                    <label><input type="checkbox" name="paycash" id="paycash"> Cash </label>
                                    <label><input type="checkbox" name="pos" id="pos">POS </label>
                                    <label><input type="checkbox" name="bothtc" id="bothtc">Transfer and Cash </label>
                                    <label><input type="checkbox" name="bothpc" id="bothpc">POS and Cash </label>


                                    <div class="clearfix">  </div>
                                    <div id="postranferrefno" class="alert alert-danger" role="alert">
                                        <input type="text" class="form-control"  name="postransfer" id="postransfer" placeholder="Reference No" required>

                                    <select name="banktocredit" id="banktocredit">
                                                <option value disabled selected>Select Bank</option>
                                                 <?php
                                                foreach($this->GetBanks as $mod) {
                                                    ?>
                                                    <option value="<?php echo $mod["accountid"]; ?>"><?php echo $mod["bank"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <select name="postocredit" id="postocredit">
                                                    <option value disabled selected>Select POS </option>
                                                     <?php
                                                    foreach($this->GetPOS as $mod) {
                                                        ?>
                                                        <option value="<?php echo $mod["accountid"]; ?>"><?php echo $mod["posname"]; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                        </select>
                                            <div class="form-group">
                                    <input type="text" class="form-control"  name="cashamount" id="cashamount" placeholder="Cash Amount" required>

                                    </div>







                                    </div>
                                </div>

                                <div class="clearfix"> </div>
                                <input type="hidden" name="period" id="period" value='<?php echo Session::get('period'); ?>'>
                                <input type="hidden" name="trnno" id="trnno" value="<?php echo 'POS/'.Session::get('period').'/'.$id ;?>">
                                <input type="hidden" name="tme" id="tme" value="<?php echo $idj; ?>">

                                <input type="hidden" name="ntoday" id="ntoday" value="<?php echo $date; ?>"> <button name="paybill" id="paybill" style='font-size:20px'><i class="fa fa-pay" aria-hidden="true"></i> PAY </button>

                                <form method="post" enctype="multipart/form-data" action="<?php echo URL.'pos/printreceipt' ;?>">
                                <input type="hidden" name="tmej" id="tmej" value="<?php echo $idj; ?>">
                                <button type="submit"  size="30" id="SaveDelivery" class="btn btn-default"> <i class="fa fa-print" aria-hidden="true"></i> Print Receipt</button>
                                </form>

                                 <a href="<?php echo URL.'stockin/printdelivery/'. $id; ?>"> <button type="button"  size="30" id="SaveDelivery" class="btn btn-default"> <i class="fa fa-print" aria-hidden="true"></i> Print Daily Total Sales</button></a>
                                  <a href="<?php echo URL.'stockin/printdelivery/'. $id; ?>"> <button type="button"  size="30" id="SaveDelivery" class="btn btn-default"> <i class="fa fa-print" aria-hidden="true"></i> Print Daily Cash Sales</button></a>
                                   <a href="<?php echo URL.'stockin/printdelivery/'. $id; ?>"> <button type="button"  size="30" id="SaveDelivery" class="btn btn-default"> <i class="fa fa-print" aria-hidden="true"></i> Print Credit Sales</button></a>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="content-top">


                <div class="col-md-4 ">
                    <div class="content-top-1">
                        <div class="col-md-6 top-content">
                            <h5 style="font-size: 0.9em">Cash Sales</h5>
                            <div id="cashsalesfordday"><?php echo  number_format($totalcashsales) ;?></div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="content-top-1">
                        <div class="col-md-6 top-content">
                            <h5 style="font-size: 0.9em">Transfer to Bank </h5>
                            <div id="transfertobankfortheday"><?php echo  number_format($totaltransfersales) ;?></div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="content-top-1">
                        <div class="col-md-6 top-content">
                            <h5 style="font-size: 0.9em">POS </h5>
                            <div id="cashposfordday"><?php echo  number_format($totalpossales) ;?></div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="content-top-1">
                        <div class="col-md-6 top-content">
                            <h5 style="font-size: 0.9em">Credit Sales</h5>
                            <div id="totalcreditsalefordday"><?php echo number_format($totalcreditsales);?></div>
                        </div>

                        <div class="clearfix"> </div>
                    </div>
                    <div class="content-top-1">
                        <div class="col-md-6 top-content">
                            <h5 style="font-size: 0.9em">Total Sales</h5>
                            <div id="totaldailysales"><?php echo number_format($totalsales) ;?></div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>

                <div class="clearfix"> </div>
            </div>
            <!---->
