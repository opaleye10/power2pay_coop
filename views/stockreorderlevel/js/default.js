/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide();

$('#SaveReorderlevel').click(function(){
    	var pid=$('#itemno').val();
    	var product=$('#ouritem option:selected').html();        
        var currentuser=$('#currentuser').val();
        var parentid=$('#parentid').val();
        var subid=$('#subid').val();
        var qty=$('#qty').val();



        if(pid=="")
        {
        	alert("Reselect a product");
        	
        }

        //var urldelete ='<a href=""><img src="http://localhost:8080/finance/account/public/images/delete.png" style="width: 1.2em; height: 1.2em;"></a>';
        
        $.post("stockreorderlevel/savereorderlevel",
            // {staffid(in database):sid(variable here)etc},
            {pid:pid,product:product,qty:qty,parentid:parentid,currentuser:currentuser,subid:subid},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>");                
                var createrow = "<tr><td style='text-align: left'>" + data.itemno + "</td><td style='text-align: left'>" + data.itemname + "</td><td style='text-align: right'>" + data.qty + "</td></tr>";
                $("#tbodyid").append(createrow);
            },'json'
        );
       
        
});









});





