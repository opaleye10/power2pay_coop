/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide()
    $('#Addmenu').click(function(){
        var parentid=$('#parentId').val();
        var subid=$('#subid').val();
        var currentuser=$('#currentuser').val();
        var roleid=$('#approle').val();
        var parentmenu=$('#menuhead').val();
        var submenu=$('#dmodule-list').val();
         var rolename=$('#approle option:selected').html();
         var parentmenudesc=$('#menuhead option:selected').html();
         if (parentid == '')
         {
            alert("Application error occur, please, logout and start again");
            return;
         }
         if (subid == '')
         {
            alert("Application error occur, please, logout and start again");
            return;
         }
         if (currentuser == '')
         {
            alert("Application error occur, please, logout and start again");
            return;
         }
         if (roleid == null)
         {
            alert("Please, select a role from the application role list");
            return;
         }
         if (parentmenu == null)
         {
            alert("Please, select a Main Menu from the menu list");
            return;
         }
         if (submenu == null)
         {
            alert("Select from the List of sub menus");
            return;
         }
        var smd=$('#dmodule-list option:selected').html();
         var n=smd.lastIndexOf("-");
         var submenudesc=smd.substr(0, n-4);
         
          //save the accounting period
        $.post("menu/addappmenu",
            {parentid:parentid,subid:subid,roleid:roleid,rolename:rolename,parentmenu:parentmenu,parentmenudesc:parentmenudesc,submenu:submenu,submenudesc:submenudesc,currentuser:currentuser},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }
        );


        $("#tbodyid").empty();
        $.post("http://localhost:8080/finance/account/models/load_allmenuperrole.php",
            {subid:roleid},
            function (o) {
                        
                        //var data = JSON.parse(o);
                       //
                       // alert(o);
                        /*

                    var dat = JSON.parse(o);
                    
                    for(var i=0; 0 < o.length; i++)
                        {                                           
                           // var createrow = "<tr><td>" + dat[i].id + "</td><td>" + dat[i].parentmenudesc + "</td><td>" + dat[i].submenudesc + "</td></tr>";
                            //$("#tbodyid").append(createrow);
                            $('#snackbar').append(o[i].parentmenudesc);
                        }
                        */
               
            }
        );


         




    });



});





