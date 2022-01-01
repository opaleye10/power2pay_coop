<?php
error_reporting(0);
/**
 * Created by PhpStorm.
 * User: Opaleye
 * Date: 14/02/2017
 * Time: 11:05
 */
echo "<table>
                                                <thead>
                                                    <tr>
                                                            <td style=\"font-size: 0.8em\">  </td>
                                                            <td style=\"font-size: 0.8em\"> Mobile No. </td>
                                                            <td style=\"font-size: 0.8em\"> His/Her Bank </td>
                                                            <td style=\"font-size: 0.8em\"> PH No. </td>
                                                             <td style=\"font-size: 0.8em\"> status </td>
                                                            <td style=\"font-size: 0.8em\"> Expected Amount</td>
                                                            <td style=\"font-size: 0.8em\"> Replace</td>
                                                            
                                                           
                                                    </tr>
                                                </thead>                              
                                                <tbody>";

foreach ($this->myResult as $lkey => $lvalue) {
    $pop=$lvalue['pop'];
    $myemail=$lvalue['rec_email'];
    echo "<tr>";
    echo "<td>" . $lvalue['s_acctname'] . "</td>";
    echo "<td>234" . $lvalue['s_mobile'] . "</td>";
    echo "<td>" . $lvalue['s_bank'] . "</td>";
    echo "<td>" . $lvalue['phtrno'] . "</td>";
    echo "<td>" . $lvalue['mstatus'] . "</td>";
    echo "<td>" . $lvalue['amount'] . "</td>";
    echo "<td> <a href=".URL.'glmainacct/replacemember/'.$lvalue['id'].">Replace Member</a></td>";
    echo "</tr>";
}
echo '<tr>
    <td colspan="6">
     <form id="contact_" method="post" enctype="multipart/form-data" action="'. URL.'glmainacct/treated">                       
                      
                        <input  type="hidden" name="email" value="' .$myemail. '">
                        <button type="Submit" class="btn1" style="float: right" >Treated</button>
                    </form>
    
</td>
    
    </tr>';
echo "</tbody>
                                            </table>";


echo "<div>



</div>";
