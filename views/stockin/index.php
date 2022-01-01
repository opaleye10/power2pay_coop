<?php
Session::init();

$this->DeleteStockIn_Temp;
//print_r($this->GetItemList);
$refno='DEL/'. Session::get('period') .'/'. $this->GetDeliveryRefno;
$id=$this->GetDeliveryjref;   //for jref(journal reftracking)
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
                    <span>Inventory : Stockin</span>
                </h2>
            </div>
            <!--//banner-->
            <!--content-->
            <div class="content-top">
                <div class="col-md-8 content-top-2">
                  
                    <div class="content-graph">

                        <div class="graph-container">
                            <div class="grid-form1">
                                <div  id="snackbar" class="alert alert-danger" role="alert" ></div>
                                <form class="form-inline">
                                    <div class="col-md-12 form-group2 group-mail">
                                        <select name="supplier" id="supplier" onchange="getSupplierInfo(this.value)">
                                            <option value disabled selected>Select Supplier</option>                                    <?php
                                            foreach($this->GetSupplierList as $supplier) {
                                                ?>
                                                <option value="<?php echo $supplier["id"]; ?>"><?php echo $supplier["supplier"]; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>


                                        <script>
                                            function getSupplierInfo(val) {
                                                // return  console.log('selected', val);
                                                var supplierid=$('#supplier').val();
                                                //alert(supplierid);
                                                $('#snackbar').val('');
                                                $('#snackbar').hide();

                                                $.ajax({
                                                    type: 'post',
                                                    url: 'https://app.power2pay.com.ng/models/getsupplierinfo.php',
                                                    data: {id: supplierid},
                                                    success: function (o) {
                                                        var data = JSON.parse(o);
                                                        //create table head here
                                                        // $('#snackbar').html(o);
                                                        // $('#supplieraddress').html(o[0].id);
                                                        for(var i=0; 0 < data.length; i++)
                                                        {
                                                            //add row
                                                            $('#supplieraddress').html(data[i].address + ',  Contact Person :' + data[i].contact_person + ',   Mobile :' + data[i].phone_number);

                                                            // var createrow = "<tr><td>" + data[i].mainid + "</td><td>" + data[i].subid + "</td><td>" + data[i].subclassid + "</td><td>" + data[i].descristion + "</td></tr>";
                                                            // $("#tbodyid").append(createrow);


                                                            //$('#snackbar').append(data[i].descristion);
                                                            // $('#snackbar').html(o);
                                                            //  $('#snackbar').html(data);
                                                        }

                                                    }
                                                });



                                            }
                                        </script>
                                        <div id="supplieraddress"></div><div id="suppliercontactperson"></div><div id="supplierphone"></div>

                                    </div>
                                    <br/>




                                    <div class="form-group">
                                        <input type="date" name="deldate" id="deldate"  size="15" class="form-control1 ng-invalid ng-invalid-required" ng-model="model.date" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" size="15" name="deliveryno" id="deliveryno" placeholder="Delivery No."  enabled="false" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" size="15" name="transrefno" id="transrefno" value="<?php echo $refno ;?>"   enabled="false" required>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" size="25" name="tamount" id="tamount"  style="text-align:right;" required>
                                    </div>

                                    <br/>

                                    <br class="form-group">
                                        <div class="col-md-12 form-group2 group-mail">
                                            <select name="ouritem" id="ouritem"  onchange="getItemno(this.value)">
                                                <option value disabled selected>Select Delivered Item</option>
                                                <?php
                                                foreach($this->GetItemList as $items) {
                                                    ?>
                                                    <option value="<?php echo $items["pid"]; ?>"><?php echo $items["pname"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>

                                            <script>
                                                function getItemno(val) {
                                                    // return  console.log('selected', val);
                                                    var itemno=$('#ouritem').val();
                                                    $('#itemno').val(itemno);
                                                    $('#qty').focus();
                                                }
                                            </script>
                                             <input type="hidden" class="form-control" size="5" name="itemno" id="itemno" placeholder="item No."  enabled="false" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label ">Qty</label>
                                            <input type="text"   class="form-control" name="qty" id="qty" placeholder="qty"   style="text-align:right;" maxlength="8" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label ">Price</label>
                                            <input type="text"  class="form-control"  name="unitprice" id="unitprice"  style="text-align:right;" maxlength="8" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label ">Total</label>
                                            <input type="text" class="form-control" size="15" name="amount" id="amount"  placeholder="Amount" style="text-align:right;" maxlength="8" required>
                                        </div>
                                    <br/><br/>
                                    <div class="form-group">
                                        <input type="hidden" class="form-control" size="10" name="currentuser" id="currentuser"  value="<?php echo Session::get('CurrentUser') ;?>" required>
                                        <input type="hidden" class="form-control" size="10" name="period" id="period" value="<?php echo Session::get('period') ;?>"   required>
                                        <input type="hidden" class="form-control" size="10" name="tme" id="tme" value="<?php echo $id ;?>"   required>
                                        <div class="col-md-12 form-group2 group-mail">

                                        <input type="hidden" class="form-control" size="10" name="parentid" id="parentid"  value="<?php echo Session::get('parentcompanyid') ;?>" required>
                                        <input type="hidden" class="form-control" size="10" name="subid" id="subid"  value="<?php echo Session::get('subsidiaryid') ;?>" required>

                                        <input type="hidden" class="form-control" size="10" name="printtract" id="printtract"  value="<?php echo $id ;?>" required>

                                        <button type="button"  size="20" id="InsertStoreItem" class="btn btn-default"> <i class="fa fa-level-down" aria-hidden="true"></i> Insert Item</button>                                        
                                        <button type="button"  size="30" id="SaveDelivery" class="btn btn-default"> <i class="fa fa-save"></i> Save Delivery</button>
                                       <a href="<?php echo URL.'stockin/printdelivery/'. $id; ?>"> <button type="button"  size="30" id="SaveDelivery" class="btn btn-default"> <i class="fa fa-print" aria-hidden="true"></i> Print Delivery Document</button></a>
                                    </div>
                                    </div>
                                
                                    <div>
                                        <?php
                                        //   print_r($this->GetGlsubAcctintable);
                                        //$myrecords=($this->GetGlAcctsubdetails);
                                        ?>
                                        <table  class="blueTable" style="width: 100%">
                                            <thead>
                                            <tr>

                                                <th style="width: 15%; text-align: right">Qty</th>
                                                <th style="width: 15%; text-align: right" >Price/Unit</th>
                                                <th style="width: 30%; text-align: right">Amount</th>
                                                <th style="width: 45%; text-align: center">Description</th>
                                                <th></th>
                                                <th></th>

                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <td colspan="7">
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



