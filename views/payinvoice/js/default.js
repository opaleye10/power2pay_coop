/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide()
    $('#postranferrefno').hide();
      $('#invoice_desc').prop("disabled", true);
      $('#ddate').prop("disabled", true);
      $('#invno').prop("disabled", true);
      $('#trnno').prop("disabled", true);
      $('#tamount').prop("disabled", true)
      $('#supplier').prop("disabled", true);
      






$('#pos').click(function(){
  if($('#pos').is(":checked")){
     $('#postranferrefno').show();
     document.getElementById("paycash").checked = false;
  }
  else
  {
     $('#postranferrefno').hide();

  }
  
 
});



$('#paycash').click(function(){
  document.getElementById("pos").checked = false;
  $('#postranferrefno').hide();




  //get cash code
  $('#accountid').val('cash');

});
        /**
         $.ajax({
            method:"POST",
            url: "dashboard/SavePHcancelReason",
            data:{"id": reason},
            success:function (status) {
                $('#response').text(status);

            }


        });
         */




        /**
         $('#cancelphreason').keypress(function (event) {
            var key=(event.keyCode ? event.keyCode : event.which);
            if (key == 13){

            }
        });
         **/



});





