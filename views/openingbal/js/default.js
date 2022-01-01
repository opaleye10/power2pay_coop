//010101
$(document).ready(function(){

 $('#customerdetails').show();
 $('#bankdetails').hide();
	

$('#pickcash').click(function(){
  if($('#pickcash').is(":checked")){     
     $('#bankdetails').show();
     $('#customerdetails').hide();
     //documentpickcash.getElementById("debtors").checked = false;
     $("#debtors"). prop("checked", false);
  } 
 
});






$('#debtors').click(function(){
  if($('#debtors').is(":checked")){
     $('#bankdetails').hide();
     $('#customerdetails').show();
    // documentpickcash.getElementById("cash").checked = false;
     $("#pickcash"). prop("checked", false);
  } 
 
});









$('#balance').keypress(function (event) {
            var key=(event.keyCode ? event.keyCode : event.which);
            if (key == 13){
            	var customerid=$('#customers').val();            	
            	var customers=$('#customers option:selected').html();
            	var trndate=$('#ntoday').val();
            	var trnno=$('#trnno').val();
            	var description="Debtor Opening balances";
            	var period=$('#period').val();
            	var debit=$('#balance').val();
            	var tme=$('#tme').val();
            	var gllist=$('#gllist').val();
            	var accountid=$('#banks').val();            	
            	var bankname=$('#banks option:selected').html();

            	if($('#debtors').is(":checked")){
				            		$.post("openingbal/saveopeningdebtors",
				            // {staffid(in database):sid(variable here)etc},
				            {customerid:customerid,customers:customers,trndate:trndate,trnno:trnno,description:description,period:period,debit:debit,tme:tme,gllist:gllist},
				            function (o) {
				               



				            	var stringsaved="Record successfully saved";

				               alert(stringsaved);
                               $('#balance').val('');

				            }
				        );

            	}
            	if($('#pickcash').is(":checked")){    
            				//alert(accountid);
            				$.post("openingbal/saveopeningmoney",
				            // {staffid(in database):sid(variable here)etc},
				            {trndate:trndate,trnno:trnno,description:description,period:period,debit:debit,tme:tme,gllist:gllist,accountid:accountid},
				            function (o) {
				               



				            	var stringsaved="Record successfully saved";

				                alert(stringsaved);
                                $('#balance').val('');
				            }
				        );
            	}


            	









            }

  });







});