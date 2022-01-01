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
                    <a href="<?php echo URL.'index' ?>">Home</a>
                    <i class="fa fa-angle-right"></i>
                    <span>Inventory Setup</span>
                </h2>
            </div>
            <!--//banner-->
            <!--content-->




            <div class="grid_3 grid_5">
                <h3 class="head-top">Inventory</h3>
                <div class="but_list">


                    <div  id="snackbar" class="alert alert-danger" role="alert" ></div>

                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Suppliers</a></li>
                            <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Customer</a></li>

                            <li role="presentation" class="dropdown">
                                <a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Other Setup <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
                                    <li><a href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">Product Category</a></li>
                                    <li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">Product Class</a></li>
                                    <li><a href="#dropdown3" tabindex="-1" role="tab" id="dropdown3-tab" data-toggle="tab" aria-controls="dropdown3">Product List</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                <div class="grid-form1">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="suppliername" id="suppliername" placeholder="Supplier Name"  required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="supplieraddress" id="supplieraddress" placeholder="Supplier Address"  required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="suppliercontactperson" id="suppliercontactperson" placeholder="supplier contact person" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="suppliermobileno" id="suppliermobileno" placeholder="Mobile Tel. Number" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="supplieremail" id="supplieremail" placeholder="supplier email" required>
                                    </div>

                                     <input type="hidden" class="form-control" name="parentid" id="parentid" value="<?php echo Session::get('parentcompanyid') ?>" required>
                                      <input type="hidden" class="form-control" name="subid" id="subid" value="<?php echo Session::get('subsidiaryid') ?>" required>


                                    <button type="submit" id="savesupplierprofile" class="btn btn-default btn-send">Save</button>

                                    <a href="<?php echo URL.'inventorysetup/printsuppliers'; ?>"> <button type="button"  size="30" id="SaveDelivery" class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i>Print List of Suppliers</button></a>

                                </div>

                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                                <div class="grid-form1">
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" name="customerid" id="customerid" placeholder=""   required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="customername" id="customername" placeholder="Customer's name" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="contactadd" id="contactadd" placeholder="Contact Address"  required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="mobilenumber" id="mobilenumber" placeholder="Mobile Tel. Number"  required>
                                    </div>
                                    <input type="hidden" class="form-control" name="parentid" id="parentid" value="<?php echo Session::get('parentcompanyid') ?>" required>
                                      <input type="hidden" class="form-control" name="subid" id="subid" value="<?php echo Session::get('subsidiaryid') ?>" required>

                                    <button type="submit" id="SaveCustomer" class="btn btn-default btn-send">Save Customer Details</button>
                                    <a href="<?php echo URL.'inventorysetup/printcustomers'; ?>"> <button type="button"  size="30" id="SaveDelivery" class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i>Print Customer's List</button></a>

                                </div>

                            </div>

                            <div role="tabpanel" class="tab-pane fade" id="dropdown1" aria-labelledby="dropdown1-tab">
                                <p>Product Category</p>
                                <div class="grid-form1">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="description" id="description" placeholder="Category Description" required>
                                        </div>
                                        <input type="hidden" class="form-control" name="parentid" id="parentid" value="<?php echo Session::get('parentcompanyid') ?>" required>
                                      <input type="hidden" class="form-control" name="subid" id="subid" value="<?php echo Session::get('subsidiaryid') ?>" required>
                                        <button type="submit" id="savecategoryDescription" class="btn btn-default btn-send">Save</button>

                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="dropdown2" aria-labelledby="dropdown2-tab">
                                <p>Product Classification</p>
                                <div class="grid-form1">

                                        <?php
                                        //print_r($this->GetProductCategory);
                                        ?>
                                        <select name="productcategory" id="productcategory" class="country">
                                            <option value disabled selected>Select Product Cagetory</option>
                                            <?php
                                            foreach($this->GetProductCategory as $category) {
                                                ?>
                                                <option value="<?php echo $category["description"]; ?>"><?php echo $category["description"]; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>


                                    <div class="form-group">
                                        <input type="text" class="form-control" name="productclass" id="productclass" placeholder="Product Class" required>
                                    </div>
                                    <button type="submit" id="saveproductclass" class="btn btn-default btn-send">Save</button>


                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="dropdown3" aria-labelledby="dropdown3-tab">
                                <p>Product List</p>
                                <a href="<?php echo URL."stockreorderlevel" ;?>"><button>Re-Order Level</button></a>
                                <a href="<?php echo URL."stockopeningbal" ;?>"><button>Stock Opening Balances</button></a>
                                <div class="grid-form1">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="pid" id="pid" placeholder="Product ID" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="pname" id="pname" placeholder="Description" required>
                                    </div>


                                    <div class="col-md-12 form-group2 group-mail">
                                        <label class="control-label">Category</label>
                                                    <?php
                                                   // print_r($this->GetProductClass);
                                                    ?>
                                                    <select name="pclass" id="pclass" >
                                                        <option value disabled selected>Select Product Cagetory</option>
                                                        <?php
                                                        foreach($this->GetProductCategory as $category) {
                                                            ?>
                                                            <option value="<?php echo $category["id"]; ?>"><?php echo $category["description"]; ?></option>
                                                            <?php                                                        }
                                                        ?>
                                                    </select>
                                    </div>

                                    <div class="col-md-12 form-group2 group-mail">
                                        <label class="control-label">GL Sales</label>
                                        <?php
                                         //print_r($this->GetGLAccountID);
                                        ?>
                                        <select name="glsales" id="glsales" >
                                            <option value disabled selected>Select GL Sales</option>
                                            <?php
                                            foreach($this->GetGLAccountIDSales as $glsales) {
                                                ?>
                                                <option value="<?php echo $glsales["accountid"]; ?>"><?php echo $glsales["gldescription"]; ?></option>
                                            <?php                                                        }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-12 form-group2 group-mail">
                                        <label class="control-label">GL Inventory</label>
                                        <?php
                                        // print_r($this->GetProductClass);
                                        ?>
                                        <select name="glinventory" id="glinventory" >
                                            <option value disabled selected>Select GL Inventory Code</option>
                                            <?php
                                            foreach($this->GetGLAccountIDInventory as $glinventory) {
                                                ?>
                                                <option value="<?php echo $glinventory["accountid"]; ?>"><?php echo $glinventory["gldescription"]; ?></option>
                                            <?php                                                        }
                                            ?>
                                        </select>
                                    </div>

                                    <input type="hidden" class="form-control" name="parentid" id="parentid" value="<?php echo Session::get('parentcompanyid') ?>" required>
                                      <input type="hidden" class="form-control" name="subid" id="subid" value="<?php echo Session::get('subsidiaryid') ?>" required>
                                    <button type="submit" id="saveproductlist" class="btn btn-default btn-send">Save</button>
                                    <a href="<?php echo URL.'inventorysetup/printproductlist'; ?>"> <button type="button"  size="30" id="SaveDelivery" class="btn btn-default"><i class="fa fa-print" aria-hidden="true"></i>Print Products List</button></a>

                                </div>
                                                </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!---->











        </div>
    </div>
    <div class="clearfix"> </div>
</div>

</div>
</div>
<div class="clearfix"> </div>
</div>
<!--//content-->
