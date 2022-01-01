<?php
Session::init();
$id= $this->GetDebtorspaysRefno;
 
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
                    <a href="index.html">Account Receivable</a>
                    <i class="fa fa-angle-right"></i>
                    <span>Debtors Payment</span>
                </h2>
            </div>
            <!--//banner-->
            <!--content-->
            <div class="col-md-8 content-top-2">
               
                <div class="content-graph">

                    <div class="graph-container">
                    
                        <div class="grid-form1">
                            <div class="form-inline">
                            <div  id="snackbar" class="alert alert-danger" role="alert" ></div>
                                <div class="form-group">
                                     <input type="date" class="form-control1 ng-invalid ng-invalid-required" id="currentdate" name="currentdate" ng-model="model.date" required="">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control"  name="refno" id="refno"  value="<?php echo 'PAY/'.Session::get('period').'/'.$id ;?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="balance" id="balance" placeholder="balance" enabled="false" required>
                                </div>
                                <br/><br/>


                                <div class="form-group">
                                <label>Customer</label>
                                    <select  class="form-control"  name="customers" id="customers" onchange="getInfo(this.value)">
                                                <option value disabled selected>Select Customer</option>
                                                 <?php
                                                foreach($this->GetDebtorslist as $module) {
                                                    ?>
                                                    <option value="<?php echo $module["customerid"]; ?>"><?php echo $module["customers"]; ?></option>
                                                    <?php
                                                }
                                                ?>                                    
                                            </select>


                                            <script>
                                            function getInfo(val) {
                                                // return  console.log('selected', val);
                                                var glid = document.getElementById("customers").value;
                                                $('#debtorid').val(glid);

                                             //   alert(glid);
                                              //  $('#snackbar').hide();
                                              $.ajax({
                                                        type: 'post',
                                                        url: 'https://app.power2pay.com.ng/models/load_debtorsbalance.php',
                                                        data: {subid: glid},
                                                        success: function (o) {
                                                            var data = JSON.parse(o);
                                                            //create table head here
                                                            // $('#snackbar').html(o);
                                                            for(var i=0; 0 < data.length; i++)
                                                            {
                                                                //add row
                                                                 $('#balance').val(new Intl.NumberFormat().format(data[i].balance));
                                                                //$('#snackbar').append(data[i].descristion);
                                                                // $('#snackbar').html(o);
                                                                //  $('#snackbar').html(data);
                                                            }
                                                           

                                                        }
                                                    });

                                              $('#Description').val('Being amount paid by the customer owing our firm');

                                             



                                            }
                                        </script>












                                            </div>

                                <div class="col-md-12 form-group1 group-mail">
                                    <label class="control-label ">Description</label>
                                    <input type="text" class="form-control"  name="Description" id="Description" placeholder="Description" required>
                                </div>

                                <label><input type="checkbox" name="pos" id="pos"> POS/Transfer</label> <label><input type="checkbox" name="paycash" id="paycash"> Cash </label>
                                <br/>




                                <div id="postranferrefno" class="alert alert-danger" role="alert"><input type="text" class="form-control"  name="postransfer" id="postransfer" placeholder="Reference No" required>
                                     <label>Bank</label>
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

                                    </div>

                                <div class="col-md-12 form-group1 group-mail">
                                    <label class="control-label ">Amount</label>
                                    <input type="text" class="form-control"  name="amount" id="amount" placeholder="Amount" required>
                                </div>

                                
                                <div class="clearfix"> </div>
                                <input type="hidden" name="period" id="period" value='<?php echo Session::get('period'); ?>'>
                                <input type="hidden" name="trnno" id="trnno" value="<?php echo 'PAY/'.Session::get('period').'/'.$id ;?>">
                                <input type="hidden" name="tme" id="tme" value="<?php echo $id; ?>">
                                <input type="hidden" name="currentuser" id="currentuser" value="<?php echo Session::get('CurrentUser'); ?>">
                                

                                <input type="hidden" name="ntoday" id="ntoday" value="<?php echo $date; ?>">
                                 <button name="debtorspay" id="debtorspay" style='font-size:20px'><i class='fa fa-save'></i> Save </button>
                                 <a href="<?php echo URL.'maxcreditlevel' ;?>"><button name="maximumcreditallowed" id="maximumcreditallowed" style='font-size:20px'><i class='fa fa-bath'></i> Max. Credit Level </button></a>

                                 
                                 <form class="form-inline" action="<?php echo URL; ?>receipt/printdebtorbalance" method="POST">
                                 <input type="hidden" name="debtorid" id="debtorid">
                                  <button type="submit"  size="30"  class="btn btn-default"> <i class="fa fa-print" aria-hidden="true"></i> Debtor Transaction Listing</button>
                                  </form>
                                  <form class="form-inline" action="<?php echo URL; ?>receipt/printdebtorbalances" method="POST">
                                    <button type="submit"  size="30"  class="btn btn-default"> <i class="fa fa-print" aria-hidden="true"></i> All Debtor Balances</button> 
                                    </form>                               
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            

                <div class="clearfix"> </div>
            </div>
            <!---->




                                    	

