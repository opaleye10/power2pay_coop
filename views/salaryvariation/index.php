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
                    <a href="index.html">Payroll</a>
                    <i class="fa fa-angle-right"></i>
                    <span>Salary Variation</span>
                </h2>
            </div>
            <!--//banner-->
            <!--content-->
            <div class="content-top">
                <div class="col-md-8 content-top-2">
                    
                    <div class="content-graph">

                        <div class="graph-container">
                            <div class="grid-form1">
                                <div  id="snackbar" class="alert alert-danger" role="alert" style="text-align: center;" >SALARY VARIATIONS</div>
                                <a href="<?php echo URL.'variationitems' ;?>"><button>Setup Variations Items</button></a>
                                <div>
                                        <?php
                                        //   print_r($this->GetGlsubAcctintable);
                                        //$myrecords=($this->GetGlAcctsubdetails);
                                        ?>
                                        <table  class="blueTable" style="width: 100%">
                                        <thead>
                                            <tr>

                                                <th style="width: 7%; text-align: left;"></th>
                                                <th style="width: 13%; text-align: center;" ></th>
                                                <th style="width: 26.66%; text-align: center;"></th>
                                                <th style="width: 26.66%; text-align: left;"></th>                                                
                                                <th style="width: 26.66%; text-align: center"></th>

                                            </tr>
                                            </thead>
                                           
                                            <tbody>

                                            <tr>
                                                <td  style="color: #32CD32; text-align: left; width: 7%"> Staff ID
                                                </td>
                                                <td style="color: #32CD32; text-align: right; width: 13%"> <input type="text" size="13" name="staffid" id="staffid" onfocusout="getstaffid(this.value)">
                                                </td>
                                                <td style="color: #000000; text-align: right; width: 26.66%"> <input type="text" size="25" name="staffname" id="staffname">
                                                </td>                                                
                                                <td style="color: #000000; text-align: right; width: 26.66%"> <input type="text" size="30" name="bank" id="bank">
                                                </td>
                                                <td style="color: #000000; text-align: right; width: 26.66%"> <input type="text" size="28"  name="acctno" id="acctno">
                                                </td>

                                            </tr>
                                            </tbody>
                                            
                                        </table>
                                        <input type="hidden" class="form-control" name="currentuser" id="currentuser" value="<?php echo Session::get("CurrentUser") ?>" required>
                                    <input type="hidden" class="form-control" name="parentid" id="parentid" value="<?php echo Session::get("parentcompanyid") ?>" required>
                                    <input type="hidden" class="form-control" name="subid" id="subid" value="<?php echo Session::get("subsidiaryid") ?>" required>
                                        <script>
                                            function getstaffid(val) {
                                                // return  console.log('selected', val);
                                                var staffid = document.getElementById("staffid").value;
                                                var parentid=document.getElementById("parentid").value;
                                                var subid=document.getElementById("subid").value;
                                               // alert(glid);
                                                $('#snackbar').hide();
                                                

                                              $.ajax({
                                                        type: 'post',
                                                        url: 'https://app.power2pay.com.ng/models/load_staff.php',
                                                        data: {staff:staffid,parentid:parentid,subid:subid},
                                                        success: function (o) {
                                                            var data = JSON.parse(o);
                                                            //create table head here
                                                            // $('#snackbar').html(o);
                                                            for(var i=0; 0 < data.length; i++)
                                                            {
                                                                //add row
                                                                $('#staffname').val(data[i].fname + ' ' + data[i].mname + ' ' + data[i].lname);
                                                                $('#bank').val(data[i].bank);
                                                                $('#acctno').val(data[i].acctno);


                                                                //$('#snackbar').append(data[i].descristion);
                                                                // $('#snackbar').html(o);
                                                                //  $('#snackbar').html(data);
                                                            }
                                                           

                                                        }
                                                    });

                                              //another one


                                              $.ajax({
                                                        type: 'post',
                                                        url: 'https://app.power2pay.com.ng/models/load_staff.php',
                                                        data: {staff:staffid,parentid:parentid,subid:subid},
                                                        success: function (o) {
                                                            var data = JSON.parse(o);
                                                            //create table head here
                                                            // $('#snackbar').html(o);
                                                            for(var i=0; 0 < data.length; i++)
                                                            {
                                                                //add row
                                                                $('#staffname').val(data[i].fname + ' ' + data[i].mname + ' ' + data[i].lname);
                                                                $('#bank').val(data[i].bank);
                                                                $('#acctno').val(data[i].acctno);


                                                                //$('#snackbar').append(data[i].descristion);
                                                                // $('#snackbar').html(o);
                                                                //  $('#snackbar').html(data);
                                                            }
                                                           

                                                        }
                                                    });





                                            }
                                        </script>
                                         <table  class="blueTable" style="width: 100%">
                                            <thead>
                                            <tr>

                                                <th style="width: 50%; text-align: center;">PAYMENTS</th>
                                                <th style="width: 50%; text-align: center;" >DEDUCTIONS</th>
                                                

                                            </tr>
                                            </thead>
                                            <tfoot>
                                            
                                            <tr>                                                
                                                <td  colspan="2" style=" color: #32CD32; text-align: center;">Net Pay:<input type="text" style="text-align: right" placeholder="000.00" id="netpay">
                                                </td>
                                            </tr>
                                            </tfoot>
                                            <tbody id="tbodyid">
                                            <tr>
                                                <td>





                                                 <table  class="blueTable" style="width: 100%">
                                                     <thead>
                                                       <tr>

                                                <th style="width: 30%; text-align: left;">Payments</th>
                                                <th style="width: 6%; text-align: center;" >Frq</th>
                                                <th style="width: 14%; text-align: center;">Amount</th>                                               

                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <td  colspan="3" style="color: #32CD32; text-align: right"><input type="text" placeholder="000.00" style="text-align: right" id="totalpaysx"><input type="hidden" id="totalpaysxx">
                                                </td>                                                
                                            </tr>                                            
                                            </tfoot>
                                            <tbody id="tbodypays">
                                            <?php
                                            //  foreach ($myrecords as $Key => $Value) {
                                            //    echo '<tr>
                                            //<td>'.$Value['mainid'].'</td><td>'.$Value['subid'].'</td><td>'.$Value['subclassid'].'</td><td>'.$Value['description'].'</td></tr>';
                                            //}
                                            ?>
                                            </tbody>
                                            </tr>
                                        </table>



















                                                </td>








                                                <td>
                                                    






                                                        <table  class="blueTable" style="width: 100%">
                                                     <thead>
                                                       <tr>

                                                <th style="width: 30%; text-align: left;">Deductions</th>
                                                <th style="width: 6%; text-align: center;" >Frq</th>
                                                <th style="width: 14%; text-align: center;">Amount</th>                                               

                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <td  colspan="3" style="color: #32CD32; text-align: right"><input type="text" placeholder="000.00" style="text-align: right" id="totaldeductionsx"><input type="hidden" id="totaldeductionsxx">
                                                </td>                                                
                                            </tr>                                            
                                            </tfoot>
                                            <tbody id="tbodydeduction">
                                            <?php
                                            //  foreach ($myrecords as $Key => $Value) {
                                            //    echo '<tr>
                                            //<td>'.$Value['mainid'].'</td><td>'.$Value['subid'].'</td><td>'.$Value['subclassid'].'</td><td>'.$Value['description'].'</td></tr>';
                                            //}
                                            ?>
                                            </tbody>
                                            </tr>
                                        </table>






























                                                </td>

                                            </tr>
                                            </tbody>
                                            </tr>
                                        </table>


                                       
                                    </div>

                                    <label style="font-size: .9em; color: #800000"><input type="checkbox" name="indv" id="indv"> Individual Variation </label>     <label style="font-size: .9em; color: #800000"><input type="checkbox" name="asv" id="asv"> All Staff Variation </label>


                                    <table  class="blueTable" style="width: 100%">
                                        <thead>
                                            <tr>

                                                <th style="width: 50%;"></th>
                                                <th style="width: 50%;" ></th>
                                                

                                            </tr>
                                            </thead>
                                           
                                            <tbody>

                                            <tr>
                                                
                                                <td> 

                                                <select name="vtype" id="vtype" style="font-size: 1.2em;" onchange="getpayitems(this.value)">

                                                    <option value disabled selected>Select Variation Type</option>
                                                    <option value="P">Payments</option>
                                                    <option value="D">Deductions</option>                                                 
                                                </select><br/>
                                                <input type="hidden" name="parentid" id="parentid" value="<?php echo Session::get("parentcompanyid") ;?>">
                                        <script>
                                            function getpayitems(val) {
                                                
                                                // return  console.log('selected', val);
                                                var vartypecode = document.getElementById("vtype").value;
                                                var parentid=document.getElementById("parentid").value;

                                               // alert(vartypecode);
                                               // alert(parentid);
                                               $.ajax({
                                                        type: 'post',
                                                        url: 'https://app.power2pay.com.ng/models/load_payitems.php',
                                                        data: {parentid:parentid,vartypecode:vartypecode},
                                                        success: function (o) {
                                                            var data = JSON.parse(o);                                                            
                                                        // We get the element having id of display_info and put the response inside it

                                                             $( '#payitem' ).html(data.courses);
                                                          //  alert(o);

                                                        }
                                                    });




                                            }
                                        </script>
                                        <br/>
                                                <select name="payitem" id="payitem" style="font-size: 1.2em;">
                                                                                                    
                                                    </select>
                                                </td>
                                                <td>
                                                    <div id="indcompound">Individual Variation<br/><label>Frq:</label><select id="indfrq">
                                                    <option value="P">P</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    </select>   
                                                    <input type="Number" size="10" name="individualamt" id="individualamt"> <br/>
                                                    <button id="indsavevarbutton">Add Variation</button><button id="inddeletevarbutton">Delete Variation</button>
                                                    </div>
                                                    <div id="allcompound">All Staff Variations
                                                    <br/>
                                                    <label>Frq:</label><select id="allfrq">
                                                    <option value="P">P</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    </select>   
                                                    <input type="Number" size="10" name="allamt" id="allamt"> <br/>
                                                    <button id="allsavevarbutton">Add Variation</button><button id="alldeletevarbutton">Delete Variation</button>

                                                    </div>

                                                </td>

                                            </tr>
                                            </tbody>
                                            
                                        </table>

 
                        </div>

                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
            <!---->




