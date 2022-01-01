//010101
$(document).ready(function(){

 $('#allperiod').hide();
 $('#daterange').hide();
	


$('#allperiodpick').click(function(){
  if($('#allperiodpick').is(":checked")){     
     $('#allperiod').show();
     $('#daterange').hide();
     //documentpickcash.getElementById("debtors").checked = false;
     $("#daterangepick"). prop("checked", false);
  } 
 
});



$('#daterangepick').click(function(){
  if($('#daterangepick').is(":checked")){
     $('#allperiod').hide();
     $('#daterange').show();
    // documentpickcash.getElementById("cash").checked = false;
     $("#allperiodpick"). prop("checked", false);
  } 
 
});






});