<?php
Session::init();
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
                            <a href="<?php echo URL.'index' ?>  " class=" hvr-bounce-to-right"><i class="fa fa-dashboard nav_icon "></i><span class="nav-label">Dashboards</span> </a>
                        </li>
                        <li id="menu_001">
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">General Ledger</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo URL.'glmainacct' ?>" class=" hvr-bounce-to-right"> <i class="fa fa-edit nav_icon"></i>Main Account</a></li>

                                <li><a href="<?php echo URL.'glsubacct' ?>" class=" hvr-bounce-to-right"><i class="fa fa-edit nav_icon"></i>Sub Account Setup</a></li>

                                <li><a href="<?php echo URL.'glacctdetails' ?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Chart of Account Setup</a></li>

                                <li><a href="<?php echo URL.'acctyr' ?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Accounting Period</a></li>

                                <li><a href="<?php echo URL.'openingbal' ?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Opening Balances</a></li>

                                <li><a href="<?php echo URL.'jvs' ?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Jvs</a></li>




                            </ul>
                        </li>

                        <li id="menu_002">
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Account Payable</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo URL.'pinvoice' ?>" class=" hvr-bounce-to-right"> <i class="fa fa-area-chart nav_icon"></i>Invoices</a></li>

                                <li><a href="<?php echo URL.'payinvoice' ?>" class=" hvr-bounce-to-right"><i class="fa fa-map-marker nav_icon"></i>Creditors Payments</a></li>

                                <li><a href="<?php echo URL.'otherpays' ?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Other Payments</a></li>

                            </ul>
                        </li>
                        <li id="menu_003">
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Account Receivable</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo URL.'pos' ?>" class=" hvr-bounce-to-right"> <i class="fa fa-area-chart nav_icon"></i>POS</a></li>

                                <li><a href="<?php echo URL.'poslist' ?>" class=" hvr-bounce-to-right"><i class="fa fa-map-marker nav_icon"></i>POS List</a></li>

                                <li><a href="<?php echo URL.'receipt' ?>" class=" hvr-bounce-to-right"><i class="fa fa-map-marker nav_icon"></i>Debtors Payments</a></li>

                                <li><a href="<?php echo URL.'banks' ?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Banks</a></li>

                                <li><a href="#" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Reports</a></li>

                            </ul>
                        </li>
                        <li id="menu_004">
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Payroll Mgt</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo URL.'salarysetups' ;?>" class=" hvr-bounce-to-right"> <i class="fa fa-area-chart nav_icon"></i>Setup</a></li>

                                <li><a href="<?php echo URL.'salaryinfo' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-map-marker nav_icon"></i>Staff info/Salary</a></li>

                                <li><a href="<?php echo URL.'salaryadvance' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Salary Advance</a></li>

                                <li><a href="<?php echo URL.'salaryvariation' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Variation</a></li>

                                <li><a href="<?php echo URL.'salaryprocess' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Salary Process</a></li>

                                <li><a href="<?php echo URL.'salaryreport' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Reports</a></li>

                            </ul>
                        </li>



                        <li id="menu_005">
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-indent nav_icon"></i> <span class="nav-label">Inventory</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo URL.'inventorysetup' ;?>" class=" hvr-bounce-to-right"> <i class="fa fa-area-chart nav_icon"></i>Setup</a></li>

                                <li><a href="<?php echo URL.'stockin' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-map-marker nav_icon"></i>stock-In</a></li>

                                <li><a href="<?php echo URL.'stockdelivery' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Stock Delivery</a></li>

                                <li><a href="<?php echo URL.'stockcard' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Stock Card</a></li>

                                 <li><a href="<?php echo URL.'stockbalance' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-file-text-o nav_icon"></i>Stock Balance</a></li>
                            </ul>
                        </li>














                        <li id="menu_006">
                            <a href="#" class=" hvr-bounce-to-right"><i class="fa fa-cog nav_icon"></i> <span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo URL.'profile' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i>Company Profile</a></li>
                                <li><a href="<?php echo URL.'role' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-eyedropper nav_icon"></i>Create Role</a></li>
                                <li><a href="<?php echo URL.'menu' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-legal nav_icon"></i>Assign Menu</a></li>
                                <li><a href="<?php echo URL.'signup' ;?>" class=" hvr-bounce-to-right"><i class="fa fa-user nav_icon"></i>Add User</a></li>

                            </ul>
                        </li>
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
                        <div class="grid-form1">
                            <form class="form-inline">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="pid" id="pid" placeholder="Product ID">
                                    
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputName2" name="product" id="product" placeholder="Product Description" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInputName2" name="Available" id="Available" placeholder="Available Qty" required>
                                </div>
                                <br/>

                                <div class="col-md-12 form-group1 group-mail">
                                    <label class="control-label ">Qty</label>
                                    <input type="text" class="form-control" id="exampleInputName2" name="qty" id="qty" placeholder="Qty Required" required>
                                    <label class="control-label ">Unit Price</label>
                                    <input type="text" class="form-control" id="exampleInputName2" name="price" id="price" placeholder="Price/Unit" required>
                                    <label class="control-label ">Amount</label>
                                    <input type="text" class="form-control" id="exampleInputName2" name="amount" id="amount" placeholder="Price/Unit" required>
                                    <label class="control-label ">Date</label>
                                    <input type="date" class="form-control1 ng-invalid ng-invalid-required" id="currentdate" name="currentdate" ng-model="model.date" required="">
                                </div>

                                <div class="content-top-1">
                                    <label><input type="checkbox" name="cash" id="cash"> Cash</label>     <label><input type="checkbox" name="credit" id="credit"> Credit</label>
                                    <div class="clearfix"> </div>
                                </div>

                                <div class="content-top-1">
                                    <label><input type="checkbox" name="pos" id="pos"> POS</label> <label><input type="checkbox" name="paycash" id="paycash"> Cash</label><label><input type="checkbox" name="Transfer" id="Transfer"> Transfer</label>
                                    <div class="clearfix"> </div>
                                </div>

                                <div class="clearfix"> </div>

                                <button type="button" name="paybill" id="paybill" class="btn btn-default btn-send">Pay</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
            <div class="content-top">


                <div class="col-md-4 ">
                    <div class="content-top-1">
                        <div class="col-md-6 top-content">
                            <h5>Cash/Bank</h5>
                            <label>8,761</label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="content-top-1">
                        <div class="col-md-6 top-content">
                            <h5>Credit</h5>
                            <label>6,295</label>
                        </div>

                        <div class="clearfix"> </div>
                    </div>
                    <div class="content-top-1">
                        <div class="col-md-6 top-content">
                            <h5>Sales</h5>
                            <label>15,345</label>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>

                <div class="clearfix"> </div>
            </div>
            <!---->



