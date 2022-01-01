/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

	$('#postranferrefno').hide();   
  $('#snackbar').hide();
  $('#paytype').hide();
  $('#creditdate').hide();
  $('#currentdate').prop("disabled", true);
  $('#cashamount').hide();


$('#customers').on('change', function() {
    var cid=$('#customers').val();


    $.post("pos/load_mcl_para",
                          // {staffid(in database):sid(variable here)etc},
                          {cid:cid},
                          function (data) {
                            //alert(data);
                            

                           $('#cbalance').val((new Intl.NumberFormat().format(data.bal)));
                           $('#maxcreditlimit').val((new Intl.NumberFormat().format(data.mcl)));
                           $('#cilosv').val((new Intl.NumberFormat().format(data.mv)));                           
                        }, 'json'
                        );

    


});

$('#paybills').click(function(){
  var r = confirm("This transaction will be save!");   //to check if you want to proceed or not
      if (r == true) 
      {
          var trnno= $('#trnno').val();
          var period=$('#period').val();

          var trndate = $('#currentdate').val();

          if (trndate == '')
          {
            alert("Date cannot be empty")
            return;
          }

          var customers=$('#customers option:selected').html();
           var customerid=$('#customers').val();
          //alert(customerid);
          if(customerid==null)
          {
            alert("No Customer has being selected");
            return;
          }



          //do credit first
          if($('#credit').is(":checked")){
            var purchasetype="Credit";
            var duedate = $('#duedate').val();                   
            if (duedate == '')
            {
              alert("Due Date cannot be empty")
              return;
            } 
            else
            {

                //do purely credit sales
                var purchasestype="Credit";
                var paymenttype="Credit";              
                var currentuser=$('#currentuser').val();
                var tme=$('#tme').val();
               $.post("pos/SaveCreditSales",
                        // {staffid(in database):sid(variable here)etc},
                        {trndate:trndate,trnno:trnno,customerid:customerid,customers:customers,purchasestype:purchasestype,paymenttype:paymenttype,period:period,currentuser:currentuser,duedate:duedate,tme:tme},
                        function (data) {
                          $('#snackbar').show();
                          $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
                      }
                      );

                     $("#tbodyid").empty();
                     $('#tfootid').empty();
             }

            

          } //end of credit



          //do Cash 
          if($('#cash').is(":checked")){

            alert("yes here here");

          } //end of credit



      } //the end of if r== true

}); //end o bills functions





$('#paybill').click(function(){
  var txt;
  var r = confirm("This transaction will be save!");
  if (r == true) {
    var trnno= $('#trnno').val();
    var period=$('#period').val();

      var trndate = $('#currentdate').val();
      if (trndate == '')
      {
        alert("Date cannot be empty")
        return;
      }

      //end
      var customers=$('#customers option:selected').html();
      var customerid=$('#customers').val();
      //alert(customerid);
      if(customerid==null)
      {
        alert("No Customer has being selected");
        return;
      }

      ///end


      if($('#credit').is(":checked")){
          var purchasetype="Credit";
          var duedate = $('#duedate').val();                   
          if (duedate == '')
          {
            alert("Due Date cannot be empty")
            return;
          }         
          else
          {

            //do purely credit sales
            var purchasestype="Credit";
            var paymenttype="Credit";              
            var currentuser=$('#currentuser').val();
            var tme=$('#tme').val();
           $.post("pos/SaveCreditSales",
                    // {staffid(in database):sid(variable here)etc},
                    {trndate:trndate,trnno:trnno,customerid:customerid,customers:customers,purchasestype:purchasestype,paymenttype:paymenttype,period:period,currentuser:currentuser,duedate:duedate,tme:tme},
                    function (data) {
                      $('#snackbar').show();
                      $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>");
                      $('#totalcreditsalefordday').html((new Intl.NumberFormat().format(data.credit)));
                      $('#totaldailysales').html((new Intl.NumberFormat().format(data.totalsales)));
                      $('#trnno').val(data.posrefno);
                      //determine number switch for report purpose
                                var trackme=$('#tme').val();
                                var trackjv=$('#tmej').val();
                                if(trackme > trackjv)
                                {
                                  $('#tmej').val(trackme);
                                  $('#tme').val(data.jref);
                                }
                                else
                                {
                                  $('#tme').val(data.jref);
                                }

                      //$data=array('posrefno'=>$posref,'jref'=>$jrefno,'totalsales'=>$totalsales,'credit'=>$credit,'message'=>$stringsave);
                  },'json'
                  );

                 $("#tbodyid").empty();
                 $('#tfootid').empty();



          }

      }else if($('#cash').is(":checked")){
          var purchasestype="Cash";
              if($('#pos').is(":checked")){
                    var paymenttype="pos";
                    var payreference=$('#postransfer').val();
                    var currentuser=$('#currentuser').val();
                    var tme=$('#tme').val();
                    var accountid=$('#postocredit').val();
                    if(payreference=='')
                    {
                      alert("POS: Payment reference no on your payment evidence cannot be empty");
                      return;
                    }
                    else if(accountid==null)
                    {
                      alert("POS: Bank to Credit cannot be empty");
                      return;
                    }
                    else
                    {
                      

                          $.post("pos/SavePosSales",
                          // {staffid(in database):sid(variable here)etc},
                          {trndate:trndate,trnno:trnno,customerid:customerid,customers:customers,purchasestype:purchasestype,paymenttype:paymenttype,payreference:payreference,period:period,currentuser:currentuser,accountid:accountid,tme:tme},
                          function (data) {
                            $('#snackbar').show();
                            $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>");
                            $('#cashposfordday').html((new Intl.NumberFormat().format(data.pos)));
                               $('#totaldailysales').html((new Intl.NumberFormat().format(data.totalsales)));
                                $('#trnno').val(data.posrefno);
                                //determine number switch for report purpose
                                var trackme=$('#tme').val();
                                var trackjv=$('#tmej').val();
                                if(trackme > trackjv)
                                {
                                  $('#tmej').val(trackme);
                                  $('#tme').val(data.jref);
                                }
                                else
                                {
                                  $('#tme').val(data.jref);
                                }
                        },'json'
                        );



                      
                    }          

              }

            else  if($('#transfer').is(":checked")){
                    var paymenttype="Transfer";
                    var payreference=$('#postransfer').val();
                    var currentuser=$('#currentuser').val();
                    var tme=$('#tme').val();
                    var accountid=$('#banktocredit').val();
                    if(payreference=='')
                    {
                      alert("Payment reference no on your payment evidence cannot be empty");
                      return;
                    }
                    else if(accountid==null)
                    {
                      alert("Bank to Credit cannot be empty");
                      return;
                    }
                    else
                    {
                      
                           $.post("pos/SavePosTransferSales",
                          // {staffid(in database):sid(variable here)etc},
                          {trndate:trndate,trnno:trnno,customerid:customerid,customers:customers,purchasestype:purchasestype,paymenttype:paymenttype,payreference:payreference,period:period,currentuser:currentuser,accountid:accountid,tme:tme},
                          function (data) {
                            $('#snackbar').show();
                            $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>");
                            $('#transfertobankfortheday').html((new Intl.NumberFormat().format(data.transfer)));
                               $('#totaldailysales').html((new Intl.NumberFormat().format(data.totalsales)));
                                $('#trnno').val(data.posrefno);
                                //determine number switch for report purpose
                                var trackme=$('#tme').val();
                                var trackjv=$('#tmej').val();
                                if(trackme > trackjv)
                                {
                                  $('#tmej').val(trackme);
                                  $('#tme').val(data.jref);
                                }
                                else
                                {
                                  $('#tme').val(data.jref);
                                }
                        }, 'json'
                        );

                       $("#tbodyid").empty();
                       $('#tfootid').empty();
                    }          

              }
                  else if($('#paycash').is(":checked"))
                  {
                    //purely Cash payment
                    var purchasestype="Cash";
                    var paymenttype="Cash";              
                        var currentuser=$('#currentuser').val();
                        var tme=$('#tme').val();
                     $.post("pos/SaveCashSales",
                              // {staffid(in database):sid(variable here)etc},
                              {trndate:trndate,trnno:trnno,customerid:customerid,customers:customers,purchasestype:purchasestype,paymenttype:paymenttype,period:period,currentuser:currentuser,tme:tme},
                              function (data) {
                                $('#snackbar').show();
                                $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>");
                                //$data=array('posrefno'=>$posref,'jref'=>$jrefno,'totalsales'=>$totalsales,'cash'=>$cash,'message'=>$stringsave);
                                $('#cashsalesfordday').html((new Intl.NumberFormat().format(data.cash)));
                               $('#totaldailysales').html((new Intl.NumberFormat().format(data.totalsales)));
                                $('#trnno').val(data.posrefno);
                                //determine number switch for report purpose
                                var trackme=$('#tme').val();
                                var trackjv=$('#tmej').val();
                                if(trackme > trackjv)
                                {
                                  $('#tmej').val(trackme);
                                  $('#tme').val(data.jref);
                                }
                                else
                                {
                                  $('#tme').val(data.jref);
                                }
                                
                            },'json'
                            );

                     $("#tbodyid").empty();
                       $('#tfootid').empty();
                  }
        else if($('#both').is(":checked"))
        {
          alert("i will do transfer and pay cash");

        }
        else
        {
          alert("You cannot pay without Cash/POS/Transfer option selected")
          return;
        }

      }
      else{
        alert("Credit or Cash Sales MUst be selected");
          return;
      }


    txt = "You pressed OK!";
  } else {
    txt = "You pressed Cancel!";
  }
  
});

 $('#price').keypress(function (event) {
            var key=(event.keyCode ? event.keyCode : event.which);
            if (key == 13){
			//save and display in the table
				var price=$('#price').val();
				var pid =$('#pid').val();
				var product=$('#product').val();
				var qty =$('#qty').val();
				var amount=parseFloat($('#amount').val());
				var currentuser=$('#currentuser').val();

        var parentid=$('#parentid').val();
        var subids=$('#subid').val();

        
        $("#tbodyid").empty();
        $("#tfootid").empty();                                
        glid=currentuser;

			$.post("pos/SaveTempoSale",
            // {staffid(in database):sid(variable here)etc},
            {qty:qty,price:price,amount:amount,pid:pid,product:product,currentuser:currentuser},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }
        );

        ////start here
           // return  console.log('selected', val);
           var urldelete ='<img src="https://app.power2pay.com.ng/public/images/delete.png" style="width: 1.2em; height: 1.2em;">';
           $.post("https://app.power2pay.com.ng/models/load_posSalesTemp.php",
            // {staffid(in database):sid(variable here)etc},
            {subid:glid,parentid:parentid,subids:subids},
            function (o) {
              //alert(o);

              var data = JSON.parse(o);
                                                            //create table head here
                                                            //$('#snackbar').show();
                                                            // $('#snackbar').html(o);
                                                            var ntotal=0;
                                                             for(var i=0; 0 < data.length; i++)
                                                            {
                                                                //add row
                                                                ntotal=parseInt(ntotal) + parseInt(data[i].amount);
                                                                var createrow = "<tr><td style='text-align: right'>" + data[i].qty + "</td><td style='text-align: right'>" + data[i].price + "</td><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].amount)) + "</td><td style='text-align: center'>" + data[i].product + "</td><td>" + urldelete + "</td></tr>";
                                                                $("#tbodyid").append(createrow);
                                                                var createfooter="<tr><td colspan='3' style='text-align: right'>"+ (new Intl.NumberFormat().format(ntotal)) +"</td></tr>";
                                                                $("#tfootid").empty();
                                                                $("#tfootid").append(createfooter);
                                                                //$('#snackbar').append(data[i].descristion);
                                                                // $('#snackbar').html(o);
                                                                //  $('#snackbar').html(data);
                                                                $('#Available').val('');
                              $('#product').val('');
                              $('#pid').val('');
                              $('#qty').val('');
                              $('#price').val('');
                              $('#amount').val('');
                              
                                                            }   


























                //$('#snackbar').show();
                //$('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }
        );

                                             
                                               
                                                


                                              

                                             














        //end here
















            }
        });
   
$('#qty, #price').keyup(function(){
               var value1 = parseFloat($('#qty').val()) || 0;
               var value2 = parseFloat($('#price').val()) || 0;

               $('#amount').val(value1 * value2);
            });


$('#qty').focusout(function () {
       $ava = parseFloat($('#Available').val());
       $need = parseFloat($('#qty').val());
       
       if ($need > $ava) {
       	  alert("You can't sell more than what you have in store!");   
       	$('#qty').val('');
       }
    });


	$('#cash').click(function(){
			document.getElementById("credit").checked = false;
			$('#paytype').show();
      $('#creditdate').hide();


	});
	$('#credit').click(function(){
			document.getElementById("cash").checked = false;
			$('#paytype').hide();
      $('#creditdate').show();

	});

	$('#transfer').click(function(){
		  
    if($('#transfer').is(":checked")){
      $('#postranferrefno').show();
      $('#banktocredit').show();
      $('#postocredit').hide();
      document.getElementById("paycash").checked = false;
      document.getElementById("bothtc").checked = false;
      document.getElementById("bothpc").checked = false;
      document.getElementById("pos").checked = false;
    }
    else
    {
      $('#postranferrefno').hide();
    }		      
			
	});


  $('#pos').click(function(){
    
     
    if($('#pos').is(":checked")){
      $('#postranferrefno').show();
      $('#postocredit').show();
      $('#banktocredit').hide();
      $('#cashamount').hide();
      document.getElementById("paycash").checked = false;
      document.getElementById("bothtc").checked = false;
      document.getElementById("bothpc").checked = false;
      document.getElementById("transfer").checked = false;
    }
    else
    {
      $('#postranferrefno').hide();
    } 











  });  
   $('#paycash').click(function(){
		$('#postranferrefno').hide();		
      document.getElementById("transfer").checked = false;
      document.getElementById("bothtc").checked = false;
      document.getElementById("bothpc").checked = false;
      document.getElementById("pos").checked = false;
		

	});
   
   $('#bothtc').click(function(){
    
      if($('#bothtc').is(":checked")){
          $('#postranferrefno').show();
          $('#postocredit').hide();
          $('#banktocredit').show();
          document.getElementById("transfer").checked = false;
          document.getElementById("paycash").checked = false;
          document.getElementById("bothpc").checked = false;
          document.getElementById("pos").checked = false;
         $('#cashamount').show(); 
    }
        else
    {
         $('#postranferrefno').hide();
    } 








       

  });



   $('#bothpc').click(function(){
      if($('#bothpc').is(":checked")){
          $('#postranferrefno').show();
    $('#postocredit').show();
      $('#banktocredit').hide();
      document.getElementById("transfer").checked = false;
      document.getElementById("paycash").checked = false;
      document.getElementById("bothtc").checked = false;
      document.getElementById("pos").checked = false;
    $('#cashamount').show(); 
    }
        else
    {
         $('#postranferrefno').hide();
    } 




     
    

  });

   

    /**
     $('#cancelphreason').keypress(function (event) {
            var key=(event.keyCode ? event.keyCode : event.which);
            if (key == 13){

            }
        });
     **/



});





