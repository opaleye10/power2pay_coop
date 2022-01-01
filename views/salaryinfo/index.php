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
                    <span>Salary Info/Salary</span>
                </h2>
            </div>
            <!--//banner-->
            <!--content-->

            <div class="grid_3 grid_5">
                <h3 class="head-top">Salary Information</h3>
                <div class="but_list">

                    <div  id="snackbar" class="alert alert-danger" role="alert" ></div>
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Bio Record</a></li>
                            
                            

                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                <p>
                                    <div class="validation-system">
                                        <div class="validation-form">                                            <!---->


                                                <div class="vali-form">
                                                    <div class="col-md-6 form-group1">
                                                        <label class="control-label">Staff ID</label>
                                                        <input type="text" name="staffid" id="staffid" placeholder="Staffid" required="" onfocusout="getstaffid(this.value)">
                                                    </div>
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





                                            }
                                        </script>








                                                    <div class="col-md-6 form-group1 form-last">
                                                        <label class="control-label">First Name</label>
                                                        <input type="text" name="firstname" id="firstname" placeholder="Firstname" required="">
                                                    </div>
                                                </div>


                                                <div class="vali-form">
                                                    <div class="col-md-6 form-group1">
                                                        <label class="control-label">Middle Name</label>
                                                        <input type="text" name="middlename" id="middlename" placeholder="Middlename" required="">
                                                    </div>

                                                    <div class="col-md-6 form-group1 form-last">
                                                        <label class="control-label">Last Name</label>
                                                        <input type="text" name="lastname" id="lastname" placeholder="Lastname" required="">
                                                    </div>
                                                </div>

                                            <div class="vali-form">

                                                <div class="col-md-6 form-group1">
                                                    <label class="control-label">Phone Number</label>
                                                    <input type="text" name="phonenumber" id="phonenumber" placeholder="phone number" required="">
                                                </div>

                                                <div class="col-md-6 form-group1 form-last">
                                                    <label class="control-label">email</label>
                                                    <input type="text" name="email"  id="email" placeholder="email" required="">
                                                </div>
                                                <br/>

                                                <div class="col-md-6 form-group1 form-last">
                                                    <label class="control-label">Contact Address</label>
                                                    <input type="text" name="contactaddress" id="contactaddress" placeholder="contact address" required="">
                                                </div>
                                                <br/>
                                            </div>
                                            <div class="col-md-12 form-group2 group-mail">

                                                <div class="vali-form">
                                                    <div class="col-md-6 form-group1">
                                                        <label class="control-label">Title</label>
                                                        <select name="title" id="title" placeholder="Title">
                                                            <option value="Mr">Mr</option>
                                                            <option value="Mrs">Mrs</option>
                                                            <option value="Engr.">Engr</option>
                                                            <option value="Dr.">Dr</option>
                                                            <option value="Prof.">Prof</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group1 form-last">
                                                        <label class="control-label">Sex</label>
                                                        <select name="sex" id="sex">
                                                            <option value="Male">Male</option>
                                                            <option value="Female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="vali-form">
                                                    <div class="col-md-6 form-group1">
                                                        <label class="control-label">Marital Status</label>
                                                        <select name="mstatus" id="mstatus">
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                            <option value="Divorced">Divorced</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group1 form-last">
                                                        <label class="control-label">Religion</label>
                                                        <select name="religion" id="religion">
                                                            <option value="Islamic">Islamic</option>
                                                            <option value="Christianity">Christianity</option>
                                                        </select>
                                                    </div>                                                    
                                                </div>



                                                 <div class="vali-form">
                                                    <div class="col-md-6 form-group1">
                                                        <label class="control-label">Employment Status</label>
                                                        <select name="employment" id="employment">
                                                            <option value="Permanent">Permanent</option>
                                                            <option value="Casual">Casual</option>
                                                            <option value="Temporary">Temporary</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group1 form-last">
                                                        <label class="control-label">Department/Section</label>
                                              <input type="text" name="deptpost" id="deptpost" placeholder="Department and Post" required="">
                                                        
                                                            
                                                    </div>                                                    
                                                </div>
                                                <div class="vali-form">
                                                    <div class="col-md-6 form-group1">
                                                        <label class="control-label">Bank</label>
                                                        <select name="bank" id="bank">
                                                            
                                                             <option value disabled selected>Select Bank</option>
                                                 <?php
                                                foreach($this->GetSalaryBank as $module) {
                                                    ?>
                                                    <option value="<?php echo $module["bank"]; ?>"><?php echo $module["bank"]; ?></option>
                                                    <?php
                                                }
                                                ?>  
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 form-group1 form-last">
                                                        <label class="control-label">Account No.</label>
                                                        <input type="text" name="acctno" id="acctno" placeholder="Account Number" required="">
                                                    </div>                                                    
                                                </div>





                                            </div>
                                            <input type="hidden" name="crrt" id="crrt" value="<?php echo Session::get('CurrentUser'); ?>">















                                            <div class="col-md-12 form-group">
                                <button type="submit"  id="submitstaffrecord" class="btn btn-primary">Save Record</button>
                                <button type="reset" id="resetstaffrecordform" class="btn btn-default">Reset</button>
                                                <div  id="snackbar" class="alert alert-danger" role="alert" >

                                                </div>
                            </div>
                            <div class="clearfix"> </div>


                            <!---->
                        </div>

                    </div>




                                </p>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                                <p>
                                <div class="content-top">
                                    <div class="col-md-8 content-top-2">
                                        <div class="content-graph">
                                            <div class="graph-container">
                                                <div class="grid-form1">
                                                    <div  id="snackbar" class="alert alert-danger" role="alert" ></div>
                                                    <div class="form-group">
                                                        <label class="control-label ">Category</label>
                                                        <input type="text" class="form-control" size="10" name="category" id="category"  required>
                                                        <br/>
                                                        <button type="submit"  id="saveSalaryCategory" class="btn btn-primary">Save Record</button>
                                                    </div>


                                                        <table  class="blueTable" style="width: 60%">
                                                            <thead>
                                                            <tr>

                                                                <th style="width: 5%; text-align: right">No.</th>
                                                                <th style="width: 35%; text-align: right" >Category Desc</th>
                                                                <th style="width: 15%; text-align: right" >Status</th>
                                                                <th></th>
                                                                <th></th>

                                                            </tr>
                                                            </thead>
                                                            <tfoot>
                                                            <tr>
                                                                <td colspan="5">
                                                                </td>
                                                            </tr>
                                                            </tfoot>
                                                            <tbody id="tbodyid">
                                                            <?php
                                                            foreach ($this->GetSalaryCagetory as $Key => $Value) {
                                                                echo '<tr>
                                                        <td>'.$Value['id'].'</td><td>'.$Value['category'].'</td><td>'.$Value['astatus'].'</td><td></td><td></td</tr>';
                                                            }
                                                            ?>
                                                            </tbody>
                                                            </tr>
                                                        </table>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div></p>                            </div>
                            
                            






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
