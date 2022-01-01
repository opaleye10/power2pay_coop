/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

	$('#postranferrefno').hide();
  $('#snackbar').hide();  
  $('#balance').prop("disabled", true);
   
  

$('#debtorspay').click(function(){
    var trndate=$('#currentdate').val();
    if(trndate =='')
          {
            alert("Transaction date is compulsory");
            return;
          }
    var trnno = $('#refno').val();
    if(trnno=='')
          {
            alert('Transaction number cannot be empty');
            return;
          }
    var customerid=$('#customers').val();
      var customers=$('#customers option:selected').html();
    if(customerid==null)
          {
            alert('Customer number cannot be empty');
            return;
          }

    var description=$('#Description').val();
    if(description=='')
          {
            alert('Transaction description cannot be empty');
            return;
          }

   var credit=$('#amount').val();
   var period=$('#period').val();

    if(credit=='' || credit < 1)
          {
            alert('Amount cannot be empty or less than 1');
            return;
          }

    if($('#pos').is(":checked")){
            var bankref=$('#postransfer').val();
            if(bankref == '')
            {
              alert("Transfer reference number cannot be empty");
              return;
            }
            var accountid=$('#banktocredit').val();
            if(banktocredit == null)
            {
              alert("Bank cannot be empty");
              return;
            }
            
            var period=$('#period').val();
            var currentuser=$('#currentuser').val();
            var tme=$('#tme').val();

      //alert("ok, cash saving now");
      //save cash payment
                  $.post("receipt/SaveBankPayment",
                        // {staffid(in database):sid(variable here)etc},
                        {customerid:customerid,customers:customers,trndate:trndate,trnno:trnno,description:description,period:period,currentuser:currentuser,credit:credit,bankref:bankref,accountid:accountid,tme:tme},
                        function (data) {
                          $('#snackbar').show();
                          $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>");
                          if(data.status=='NO')
                          {
                             alert(data.message);
                          }
                            else
                            {
                              $('#tme').val(data.ref);                         
                          $('#refno').val(data.refno);
                          //get the balance

                          var balmain=$('#balance').val();
                         // alert(balmain);

                          var value = parseInt(balmain.replace(/,/g, ''), 10)                          
                         // alert(value);
                          var camt=$('#amount').val();
                          var ball=value - camt;
                          $('#balance').val(new Intl.NumberFormat().format(ball));
                          document.getElementById("pos").checked = false;
                          $('#amount').val('0.00');
                          $('#postranferrefno').hide();
                          alert(data.message);
                          $('#snackbar').hide();

                            }
                          
                      },'json'
                      );




    }
    
    else if($('#paycash').is(":checked")){
      var period=$('#period').val();
      var currentuser=$('#currentuser').val();
      var tme=$('#tme').val();

      //alert("ok, cash saving now");
      //save cash payment
                  $.post("receipt/SaveCashPayment",
                        // {staffid(in database):sid(variable here)etc},
                        {customerid:customerid,customers:customers,trndate:trndate,trnno:trnno,description:description,period:period,currentuser:currentuser,credit:credit,tme:tme},
                        function (data) {
                         $('#snackbar').show();
                          $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>");
                          if(data.status=='NO')
                          {
                             alert(data.message);
                          }
                            else
                            {
                              $('#tme').val(data.ref);                         
                          $('#refno').val(data.refno);
                          //get the balance

                          var balmain=$('#balance').val();
                         // alert(balmain);

                          var value = parseInt(balmain.replace(/,/g, ''), 10)                          
                         // alert(value);
                          var camt=$('#amount').val();
                          var ball=value - camt;
                          $('#balance').val(new Intl.NumberFormat().format(ball));
                          document.getElementById("paycash").checked = false;
                          $('#amount').val('0.00');
                          $('#postranferrefno').hide();
                          alert(data.message);
                          $('#snackbar').hide();

                            }
                      },'json'
                      );
    }
    else
    {
      alert("You cant effect the payment without selected either by cash, pos or transfer to the bnak");
      return;

    }


});








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
});

    /**
     $('#cancelphreason').keypress(function (event) {
            var key=(event.keyCode ? event.keyCode : event.which);
            if (key == 13){

            }
        });
     **/



});





