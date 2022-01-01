<?php
Session::init();
//print_r($this->GetItemList);
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
                    <span>Payroll : Setup</span>
                </h2>
            </div>
            <!--//banner-->
            <!--content-->
            <div  id="snackbar" class="alert alert-danger" role="alert" ></div>
            <div class="grid_3 grid_5">

                <div class="but_list">
                    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Category</a></li>
                            <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Department</a></li>
                            <li role="presentation"><a href="#bank" role="tab" id="bank-tab" data-toggle="tab" aria-controls="bank">Bank</a></li>
                            <li role="presentation"><a href="#GN" role="tab" id="GN-tab" data-toggle="tab" aria-controls="GN">Grade Names</a></li>
                            <li role="presentation"><a href="#unions" role="tab" id="unions-tab" data-toggle="tab" aria-controls="unions">Unions/Cooperative</a></li>
                            <li role="presentation"><a href="#allowances" role="tab" id="allowances-tab" data-toggle="tab" aria-controls="allowances">Allowances</a></li>
                            <li role="presentation"><a href="#allowtable" role="tab" id="allowtable-tab" data-toggle="tab" aria-controls="allowtable">Allowance Table</a></li>
                            <li role="presentation"><a href="#basictable" role="tab" id="basictable-tab" data-toggle="tab" aria-controls="basictable">Basic Table</a></li>
                            <li role="presentation"><a href="#basictable" role="tab" id="taxtable-tab" data-toggle="tab" aria-controls="taxtable">Paye Table</a></li>

                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                <div class="content-top">
                                    <div class="col-md-8 content-top-2">
                                        <div class="content-graph">
                                            <div class="graph-container">
                                                            <div class="grid-form1">
                                                                <div class="form-group">
                                                                    <label class="control-label ">  Category</label><a href="<?php echo URL."variationitems" ;?>"><button>Variation Items Setup</button></a>
                                                                    <input type="text" class="form-control" size="10" name="category" id="category"  required>
                                                                    
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label ">Status</label>
                                                                    <select name="catstatus" id ="catstatus">
                                                                    <option value="Active"> Active</option>
                                                                    <option value="Block"> Block</option>
                                                                    </select>                                                                    
                                                                    <br/><br/>
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
                                                                    <tbody id="tbodyid_cat">
                                                                    <?php
                                                                    foreach ($this->GetSalaryCagetory as $Key => $Value) {
                                                                        $sn= $Key + 1;
                                                                        echo '<tr>
<td>'.$sn.'</td><td>'.$Value['category'].'</td><td>'.$Value['astatus'].'</td><td><a href="'. URL .'salarysetups/deletethisrecord/'. $Value['id'] .'"> <img src='. URL.'public/images/delete.png' .' style="width: 1.4em; height: 1.4em;"> Delete</a></td><td><a href="'. URL .'salarysetups/editthisrecord/'. $Value['id'] .'"> <img src='. URL.'public/images/edit.png' .' style="width: 1.4em; height: 1.4em;"> Block</a></td></tr>';
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





                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">



                                <div class="content-top">
                                    <div class="col-md-8 content-top-2">
                                        <div class="content-graph">
                                            <div class="graph-container">
                                                <div class="grid-form1">
                                                    <div class="form-group">
                                                        <label class="control-label ">Department</label>
                                                        <input type="text" class="form-control" size="10" name="dept" id="dept"  required>
                                                        <br/>
                                                        <button type="button"  id="saveSalaryDept" class="btn btn-primary">Save Record</button>
                                                    </div>


                                                    <table  class="blueTable" style="width: 60%">
                                                        <thead>
                                                        <tr>

                                                            <th style="width: 5%; text-align: right">No.</th>
                                                            <th style="width: 35%; text-align: right" >Department</th>
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
                                                        <tbody id="tbodyid_dept">
                                                        <?php
                                                        foreach ($this->GetSalaryDept as $Key => $Value) {
                                                              $sn= $Key + 1;
                                                                        echo '<tr>
<td>'.$sn.'</td><td>'.$Value['dept'].'</td><td>'.$Value['astatus'].'</td><td><a href="'. URL .'salarysetups/deletedept/'. $Value['id'] .'"> <img src='. URL.'public/images/delete.png' .' style="width: 1.4em; height: 1.4em;"> Delete</a></td><td><a href="'. URL .'salarysetups/editdept/'. $Value['id'] .'"> <img src='. URL.'public/images/edit.png' .' style="width: 1.4em; height: 1.4em;"> InActive</a></td></tr>';
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








                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="bank" aria-labelledby="bank-tab">



                                <div class="content-top">
                                    <div class="col-md-8 content-top-2">
                                        <div class="content-graph">
                                            <div class="graph-container">
                                                <div class="grid-form1">
                                                    <div class="form-group">
                                                        <label class="control-label ">Bank</label>
                                                        <input type="text" class="form-control" size="10" name="bankdesc" id="bankdesc">
                                                        <br/>
                                                        <button type="button"  id="SaveBankButton" class="btn btn-primary">Save Bank</button>
                                                    </div>


                                                    <table  class="blueTable" style="width: 60%">
                                                        <thead>
                                                        <tr>

                                                            <th style="width: 5%; text-align: right">No.</th>
                                                            <th style="width: 35%; text-align: right" >Details</th     
                                                            <th></th>
                                                            <th></th>

                                                        </tr>
                                                        </thead>
                                                        <tfoot>
                                                        <tr>
                                                            <td colspan="4">
                                                            </td>
                                                        </tr>
                                                        </tfoot>
                                                        <tbody id="tbodyid_bank">
                                                        <?php
                                                        foreach ($this->GetSalaryBank as $Key => $Value) {
                                                           $sn= $Key + 1;
                                                    echo '<tr><td>'.$sn.'</td><td>'.$Value['bank'].'</td><td><a href="'. URL .'salarysetups/deletebank/'. $Value['id'] .'"> <img src='. URL.'public/images/delete.png' .' style="width: 1.4em; height: 1.4em;"> Delete</a></td></tr>';
                                                        }
                                                        ?>
                                                        </tbody>
                                                        </tr>
                                                        
                                                        </tbody>
                                                        </tr>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>








                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="GN" aria-labelledby="GN-tab">



                                <div class="content-top">
                                    <div class="col-md-8 content-top-2">
                                        <div class="content-graph">
                                            <div class="graph-container">
                                                <div class="grid-form1">
                                                    <div class="form-group">
                                                        <label class="control-label ">Grade Names</label>
                                                        <input type="text" class="form-control" size="10" name="gn" id="gn">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label ">Grade Abbr</label>
                                                        <input type="text" class="form-control" size="10" name="gnabbr" id="gnabbr">
                                                    </div>

                                                    <div class="form-group">
                                                    <div class="col-md-12 form-group2 group-mail">
                                                    <div class="form-group">
                                                        <label class="control-label ">Grade Status</label>
                                                        <select name ="gstatus" id="gstatus">
                                                        <option value="Active">Active</option>
                                                        <option value="Block">Block</option>
                                                        </select>
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <br/>
                                                        <button type="button"  id="SaveGradeNameButton" class="btn btn-primary">Save Grade Name</button>


                                                    <table  class="blueTable" style="width: 60%">
                                                        <thead>
                                                        <tr>

                                                            <th style="width: 5%; text-align: right">No.</th>
                                                            <th style="width: 35%; text-align: right" >Details</th>
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
                                                        <tbody id="tbodyid_Gn">
                                                        <?php
                                                        foreach ($this->GetSalaryGN as $Key => $Value) {
                                                            $sn= $Key + 1;
                                                    echo '<tr><td>'.$sn.'</td><td>'.$Value['abbr'].'</td><td>'.$Value['astatus'].'</td><td><a href="'. URL .'salarysetups/deletegn/'. $Value['id'] .'"> <img src='. URL.'public/images/delete.png' .' style="width: 1.4em; height: 1.4em;"> Delete</a></td><td><a href="'. URL .'salarysetups/editgn/'. $Value['id'] .'"> <img src='. URL.'public/images/edit.png' .' style="width: 1.4em; height: 1.4em;"> Block</a></td></tr>';
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








                            </div>
                            <div role="tabpane1" class="tab-pane fade" id="unions" aria-labelledby="unions-tab">



                                <div class="content-top">
                                    <div class="col-md-8 content-top-2">
                                        <div class="content-graph">
                                            <div class="graph-container">
                                                <div class="grid-form1">
                                                    <div class="form-group">
                                                        <label class="control-label ">Unions/Cooperatives</label>
                                                        <input type="text" class="form-control" size="10" name="salunion" id="salunion">
                                                    </div>
                                                    <div class="form-group">
                                                    <div class="col-md-12 form-group2 group-mail">
                                                    <div class="form-group">
                                                        <label class="control-label ">Bank</label>
                                                        <select name ="bankunion" id="bankunion">
                                                        <option value disabled selected>Select Bank</option>                                    <?php
                                                foreach($this->GetSalaryBank as $module) {
                                                    ?>
                                                    <option value="<?php echo $module["id"]; ?>"><?php echo $module["bank"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                                        </select>
                                                    </div>
                                                    </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label ">Account No.</label>
                                                        <input type="text" class="form-control" size="10" name="acctno" id="acctno">
                                                    </div>


                                                    <br/>
                                                    <button type="button"  id="SaveUnionButton" class="btn btn-primary">Save Union</button>


                                                    <table  class="blueTable" style="width: 60%">
                                                        <thead>
                                                        <tr>

                                                            <th style="width: 5%; text-align: right">No.</th>
                                                            <th style="width: 35%; text-align: right" >Details</th>
                                                            <th style="width: 15%; text-align: right" >Bank</th>
                                                            <th style="width: 15%; text-align: right" >Acct</th>
                                                            <th></th>
                                                            <th></th>

                                                        </tr>
                                                        </thead>
                                                        <tfoot>
                                                        <tr>
                                                            <td colspan="6">
                                                            </td>
                                                        </tr>
                                                        </tfoot>
                                                        <tbody id="tbodyid_union">
                                                        <?php
                                                        foreach ($this->GetSalaryUnion as $Key => $Value) {
                                                            $sn= $Key + 1;
                                                    echo '<tr><td>'.$sn.'</td><td>'.$Value['salunion'].'</td><td>'.$Value['bank'].'</td><td>'.$Value['acctno'].'</td><td><a href="'. URL .'salarysetups/deleteunion/'. $Value['salunion'] .'"> <img src='. URL.'public/images/delete.png' .' style="width: 1.4em; height: 1.4em;"> Delete</a></td></tr>';
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








                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="allowances" aria-labelledby="allowances-tab">


                                <div class="content-top">
                                    <div class="col-md-8 content-top-2">
                                        <div class="content-graph">
                                            <div class="graph-container">
                                                <div class="grid-form1">
                                                    <div class="form-group">
                                                        <label class="control-label ">Allowance</label>
                                                        <input type="text" class="form-control" size="10" name="salallowance" id="salallowance">
                                                        <br/>
                                                        <button type="button"  id="SaveAllowanceButton" class="btn btn-primary">Save Allowance</button>
                                                    </div>


                                                    <table  class="blueTable" style="width: 60%">
                                                        <thead>
                                                        <tr>

                                                            <th style="width: 5%; text-align: right">S/N</th>
                                                            <th style="width: 5%; text-align: right">Allwid</th>
                                                            <th style="width: 35%; text-align: right" >Details</th>
                                                            <th style="width: 15%; text-align: right" ></th>
                                                            

                                                        </tr>
                                                        </thead>
                                                        <tfoot>
                                                        <tr>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        </tfoot>
                                                        <tbody id="tbodyid_allw">
                                                        <?php                                                        
                                                        foreach ($this->GetSalaryAllws as $Key => $Value) {
                                                            $sn= $Key + 1;
                                                    echo '<tr><td>'.$sn.'</td><td>'.$Value['allwid'].'</td><td>'.$Value['allwdesc'].'</td><td><a href="'. URL .'salarysetups/deleteallwbyid/'. $Value['id'] .'"> <img src='. URL.'public/images/delete.png' .' style="width: 1.4em; height: 1.4em;"> Delete</a></td></tr>';
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








                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="allowtable" aria-labelledby="allowtable-tab">



                                <div class="content-top">
                                    <div class="col-md-8 content-top-2">
                                        <div class="content-graph">
                                            <div class="graph-container">
                                                <div class="grid-form1">
                                                    <div class="form-group">
                                                        <label class="control-label ">Allowance</label>
                                                        <input type="text" class="form-control" size="10" name="allowance" id="allowance">
                                                        <br/>
                                                        <button type="button"  id="SaveAllowanceTable" class="btn btn-primary">Save Allowance</button>
                                                    </div>


                                                    <table  class="blueTable" style="width: 60%">
                                                        <thead>
                                                        <tr>

                                                            <th style="width: 5%; text-align: right">No.</th>
                                                            <th style="width: 35%; text-align: right" >Details</th>
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
                                                        foreach ($this->GetSalaryDept as $Key => $Value) {
                                                            echo '<tr>
                                                                                    <td>'.$Value['id'].'</td><td>'.$Value['dept'].'</td><td>'.$Value['astatus'].'</td><td></td><td></td</tr>';
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








                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="basictable" aria-labelledby="basictable-tab">



                                <div class="content-top">
                                    <div class="col-md-8 content-top-2">
                                        <div class="content-graph">
                                            <div class="graph-container">
                                                <div class="grid-form1">
                                                    <div class="form-group">
                                                        <label class="control-label ">Basic Table</label>
                                                        <input type="text" class="form-control" size="10" name="allowance" id="allowance">
                                                        <br/>
                                                        <button type="button"  id="SaveAllowanceTable" class="btn btn-primary">Save Allowance</button>
                                                    </div>


                                                    <table  class="blueTable" style="width: 60%">
                                                        <thead>
                                                        <tr>

                                                            <th style="width: 5%; text-align: right">No.</th>
                                                            <th style="width: 35%; text-align: right" >Details</th>
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
                                                        foreach ($this->GetSalaryDept as $Key => $Value) {
                                                            echo '<tr>
                                                                                    <td>'.$Value['id'].'</td><td>'.$Value['dept'].'</td><td>'.$Value['astatus'].'</td><td></td><td></td</tr>';
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








                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="basictable" aria-labelledby="basictable-tab">



                                <div class="content-top">
                                    <div class="col-md-8 content-top-2">
                                        <div class="content-graph">
                                            <div class="graph-container">
                                                <div class="grid-form1">
                                                    <div class="form-group">
                                                        <label class="control-label ">tax Table</label>
                                                        <input type="text" class="form-control" size="10" name="allowance" id="allowance">
                                                        <br/>
                                                        <button type="button"  id="SaveAllowanceTable" class="btn btn-primary">Save Allowance</button>
                                                    </div>


                                                    <table  class="blueTable" style="width: 60%">
                                                        <thead>
                                                        <tr>

                                                            <th style="width: 5%; text-align: right">No.</th>
                                                            <th style="width: 35%; text-align: right" >Details</th>
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
                                                        foreach ($this->GetSalaryDept as $Key => $Value) {
                                                            echo '<tr>
                                                                                    <td>'.$Value['id'].'</td><td>'.$Value['dept'].'</td><td>'.$Value['astatus'].'</td><td></td><td></td</tr>';
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







</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>







            <div class="clearfix"> </div>
        </div>
        <!---->



