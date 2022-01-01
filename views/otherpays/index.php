<?php
Session::init();
 //print_r($this->GetAssetExpenses);
$id=$this->GetInvRefno;
?>

<div id="wrapper">
    
    <nav class="navbar-default navbar-static-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button><h1><a  class="navbar-brand" href="#"><span style="color: #000000; font-size: .7em"  >Power</spane><span style="color: #228B22; font-size: 1em">2</span><span style="color: #000000; font-size: .7em">Pay</span> <span style="font-size: 0.3em"> Ver 1.0 </span></a></h1> 
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
                    <a href="#">Account Payables</a>
                    <i class="fa fa-angle-right"></i>
                    <span>Other Payments</span>
                </h2>
            </div>
            <!--//banner-->
            <!--content-->
            <div class="content-top">
                <div class="col-md-8 content-top-2">
                    
                    <div class="content-graph">

                        <div class="graph-container">
                            <div class="grid-form1">
                                <div  id="snackbar" class="alert alert-danger" role="alert" style="text-align: center;" >OTHER PAYMENTS</div>
                                <div >                                         
                                            <select name="acct2debit" id="acct2debit" size="5">
                                                <option value disabled selected>GL ACCOUNT TO DEBIT</option>                                    <?php
                                                foreach($this->GetAssetExpenses as $module) {
                                                    ?>
                                                    <option value="<?php echo $module["accountid"]; ?>"><?php echo $module["gldescription"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        
                                        <select name="acct2credit" id="acct2credit" size="5" onchange="getBalance(this.value)">
                                                <option value disabled selected>GL BANK OR CASH</option>                                    <?php
                                                foreach($this->GetAccountid as $modul) {
                                                    ?>
                                                    <option value="<?php echo $modul["accountid"]; ?>"><?php echo $modul["gldescription"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" id="period" value="<?php echo Session::get('period') ;?>">
                                            <input type="hidden" id="parentid" value="<?php echo Session::get('parentcompanyid') ;?>">
                                            <input type="hidden" id="subid" value="<?php echo Session::get('subsidiaryid') ;?>">
                                            <script>
                                            function getBalance(val) {
                                                //return  console.log('selected', val);
                                                var accountid = document.getElementById("acct2credit").value;
                                                var parentid=document.getElementById("parentid").value;
                                                var subid=document.getElementById("subid").value;
                                                var period=document.getElementById("period").value;
                                               $.ajax({
                                                        type: 'post',
                                                        url: 'https://app.power2pay.com.mg/models/load_glbalances.php',
                                                       // url: 'https://app.power2pay.com.ng/models/load_glbalances.php',
                                                        data: {accountid:accountid,parentid:parentid,subid:subid,period:period},
                                                        success: function (o) {
                                                            var data = JSON.parse(o);
                                                            //create table head here
                                                            // $('#snackbar').html(o);
                                                            for(var i=0; 0 < data.length; i++)
                                                            {
                                                                //add row
                                                                 $('#balanceathand').val(new Intl.NumberFormat().format( data[i].balance));
                                                                //$('#snackbar').append(data[i].descristion);
                                                                // $('#snackbar').html(o);
                                                                //  $('#snackbar').html(data);
                                                            }
                                                           

                                                        }
                                                    });

                                             



                                            }
                                        </script>





                                            </div>

                                                <table class="blueTable">
                                        <thead>
                                        <tr>
                                            <th style='text-align: left'><input type="date"  id="currentdate" name="currentdate" ng-model="model.date" value="<?php echo $date;; ?>"  size ="8" required=""></th>
                                            <th style='text-align: left'><input type="text" size="22" class="form-control" value="<?php echo 'EXP/'.Session::get('period').'/'. $id ?>" name="trnno" id="trnno" placeholder="Ref.No" required></th>
                                            <th style='text-align: left'><input type="text" size="12" class="form-control"  name="orefno" id="orefno" placeholder="Ref(T/I No)" required></th>
                                            <input type="hidden" name="tme" id="tme" value="<?php echo $id; ?>">
                                            <th style='text-align: right;'><input type="text" size="17" class="form-control"  name="balanceathand" id="balanceathand" placeholder="Current Balance" style='text-align: right;' required></th>
                                            
                                        </tr>
                                        </thead>
                                        <tfoot id="tfootid">
                                        <tr>
                                            <td colspan="6">
                                            </td>
                                        </tr>
                                        </tfoot>
                                        <tbody id="tbodyid">
                                        <tr ><td colspan="3"><input type="text" class="form-control" size="70" name="description" id="description" placeholder="description" required></td>
                                        <td><input type="text" size="15" class="form-control"  name="amount" id="amount" placeholder="Amount" required></td>
                                        </tr>



                                        </tbody>
                                        </tr>
                                    </table>

                                <div class="clearfix"> </div><br/>
                                <button name="saveexpenses" id="saveexpenses" style='font-size:15px'><i class='fa fa-save'></i> Effect Payment </button>
                                 
                                            






                            </div>





































                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!---->




