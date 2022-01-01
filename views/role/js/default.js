/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide();

    $('#SaveRole').click(function(){

        var currentuser=$('#currentuser').val();
        var parentid= $('#parentid').val();
        var subid= $('#subid').val();
        var rolename= $('#role').val();
        var roledesc= $('#roledesc').val();
        var ddate= $('#ddate').val();
        if(currentuser == '')
        {
        	alert("Application error occur, logout and start over again");
        	return;
        }
        if(parentid == '')
        {
        	alert("Application error occur, logout and start over again");
        	return;
        }
        if(subid == '')
        {
        	alert("Application error occur, logout and start over again");
        	return;
        }
        if(role == '')
        {
        	alert("Role cannot be empty");
        	return;
        }
        if(roledesc == '')
        {
        	alert("Role description is essential");
        	return;
        }

         $.post("role/SaveRole",
            // {staffid(in database):sid(variable here)etc},
            {parentid:parentid,subid:subid,rolename:rolename,roledesc:roledesc,currentuser:currentuser,ddate:ddate},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
                alert(data);
            }
        );
         $('#role').val('');
         $('#roledesc').val('');

         //load table
         var ll ='<img src="http://localhost:8080/finance/account/public/images/edit.png" style="width: 1.2em; height: 1.2em;">';
         
         
          $.ajax({
                  type: 'post',
                  url: 'http://localhost:8080/finance/account/models/load_rolepersubid.php',
                  data: {subid: subid},
                  success: function (o) {
                   var data = JSON.parse(o);
                   //create table head here
                  // $('#snackbar').show();
                   //$('#snackbar').html(o);

                    for(var i=0; 0 < data.length; i++)
                        {
                                                                //add row
                             var createrow = "<tr><td >" + ll + "</td><td>" + data[i].rolename + "</td><td>" + data[i].roledesc + "</td></tr>";
                              $("#tbodyid").append(createrow);
                                                                
                        }







                   }

                });

        
        
    });

    


});





