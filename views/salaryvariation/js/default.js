/**
 * Created by Opaleye on 15/05/2020.
 */
$(document).ready(function(){

	$('#indcompound').hide();
  $('#allcompound').hide();
  //alert("hello");
$('#totalpays').val('20,000');

$('#staffid').focusout(function(){
  var staffid=$('#staffid').val();

   $.post("salaryvariation/displaypays",
                        // {staffid(in database):sid(variable here)etc},
                        {staffid:staffid},
                        function (o) {
                          var data = JSON.parse(o);


                          var ptotal=0;
                           $("#tbodypays").empty();                  
                          
                          for(var i=0; 0 < data.length; i++)
                              {
                                 //add row
                                 ptotal=parseInt(ptotal) + parseInt(data[i].amount);
                                 var createrow = "<tr><td style='text-align: left'>" + data[i].abbr + "</td><td style='text-align: center'>" + data[i].frqno + "</td><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].amount)) + "</td></tr>";
                                 $("#tbodypays").append(createrow);  
                                 $('#totalpaysx').val((new Intl.NumberFormat().format(ptotal)));
                                 $('#totalpaysxx').val(ptotal);
                              
                              } 
                              
                      }


    );

   


   //do deductions
         $.post("salaryvariation/displaydeductions",
                        // {staffid(in database):sid(variable here)etc},
                        {staffid:staffid},
                        function (o) {
                          var data = JSON.parse(o);
                          $("#tbodydeduction").empty();
                          dtotal=0;
                          for(var i=0; 0 < data.length; i++)
                              {
                                 //add row
                                 dtotal=parseInt(dtotal) + parseInt(data[i].amount); 
                                 var createrow = "<tr><td style='text-align: left'>" + data[i].abbr + "</td><td style='text-align: center'>" + data[i].frqno + "</td><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].amount)) + "</td></tr>";
                                 $("#tbodydeduction").append(createrow);
                              $('#totaldeductionsx').val((new Intl.NumberFormat().format(dtotal)));  
                              $('#totaldeductionsxx').val(dtotal);                        

                              } 



                              
                      }

          


       );

       
         //netpay
         var dedd = $('#totaldeductionsxx').val();
         var payss=$('#totalpaysxx').val();
         var netpay=(parseFloat(payss)-parseFloat(dedd));
         //var netpay=(new Intl.NumberFormat().format(pays)) - (new Intl.NumberFormat().format(ded));
         $('#netpay').val((new Intl.NumberFormat().format(netpay)));















});




$('#indsavevarbutton').click(function(){
  var staffid=$('#staffid').val();
  var frqno=$('#indfrq').val();
  var amount=$('#individualamt').val();
  var vartype=$('#vtype').val();
  var vid=$('#payitem').val();
  var abbr=$('#payitem option:selected').html();

  if(frqno=='')
  {
    alert("frequency cannot be empty");
  }
  else if(amount < 1)
  {
    alert("Amount cannot be empty or less than a naira");
  }
  else if(vartype == null)
  {
    alert("please, select a pay type: Payment or Deduction");
  }
  else if(vid== null)
  {
    alert("Please, select a pay item");
  }
  else if(staffid=='')
  {
    alert("Please, staff details is not yet selected");
  }
  else
  {
    
    $.post("salaryvariation/indvarsave",
                        // {staffid(in database):sid(variable here)etc},
                        {vid:vid,abbr:abbr,vartype:vartype,staffid:staffid,frqno:frqno,amount:amount},
                        function (data) {
                          $('#snackbar').show();
                          $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
                      }
    );





//do payments
         $.post("salaryvariation/displaypays",
                        // {staffid(in database):sid(variable here)etc},
                        {staffid:staffid},
                        function (o) {
                          var data = JSON.parse(o);


                          var ptotal=0;
                           $("#tbodypays").empty();                  
                          
                          for(var i=0; 0 < data.length; i++)
                              {
                                 //add row
                                 ptotal=parseInt(ptotal) + parseInt(data[i].amount);
                                 var createrow = "<tr><td style='text-align: left'>" + data[i].abbr + "</td><td style='text-align: center'>" + data[i].frqno + "</td><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].amount)) + "</td></tr>";
                                 $("#tbodypays").append(createrow);  
                                 $('#totalpaysx').val((new Intl.NumberFormat().format(ptotal)));
                                 $('#totalpaysxx').val(ptotal);
                              
                              } 
                              
                      }


    );

   


   //do deductions
         $.post("salaryvariation/displaydeductions",
                        // {staffid(in database):sid(variable here)etc},
                        {staffid:staffid},
                        function (o) {
                          var data = JSON.parse(o);
                          $("#tbodydeduction").empty();
                          dtotal=0;
                          for(var i=0; 0 < data.length; i++)
                              {
                                 //add row
                                 dtotal=parseInt(dtotal) + parseInt(data[i].amount); 
                                 var createrow = "<tr><td style='text-align: left'>" + data[i].abbr + "</td><td style='text-align: center'>" + data[i].frqno + "</td><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].amount)) + "</td></tr>";
                                 $("#tbodydeduction").append(createrow);
                              $('#totaldeductionsx').val((new Intl.NumberFormat().format(dtotal)));  
                              $('#totaldeductionsxx').val(dtotal);                        

                              } 



                              
                      }

          


       );

       
         //netpay
         var dedd = $('#totaldeductionsxx').val();
         var payss=$('#totalpaysxx').val();
         var netpay=(parseFloat(payss)-parseFloat(dedd));
         //var netpay=(new Intl.NumberFormat().format(pays)) - (new Intl.NumberFormat().format(ded));
         $('#netpay').val((new Intl.NumberFormat().format(netpay)));







  }







  });





$('#inddeletevarbutton').click(function(){  
  var staffid=$('#staffid').val();
  var vtype=$('#vtype').val();
  var vid=$('#payitem').val();

  
  
  if(vtype == null)
  {
    alert("please, select a pay type: Payment or Deduction");
  }
  else if(vid== null)
  {
    alert("Please, select a pay item");
  }
  else if(staffid=='')
  {
    alert("Enter staff number.");
  }
  else
  {

    $.post("salaryvariation/inddelete",
                        // {staffid(in database):sid(variable here)etc},
                        {vid:vid,staffid:staffid},
                        function (data) {
                          $('#snackbar').show();
                          $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
                      }
    );






 $.post("salaryvariation/displaypays",
                        // {staffid(in database):sid(variable here)etc},
                        {staffid:staffid},
                        function (o) {
                          var data = JSON.parse(o);


                          var ptotal=0;
                           $("#tbodypays").empty();                  
                          
                          for(var i=0; 0 < data.length; i++)
                              {
                                 //add row
                                 ptotal=parseInt(ptotal) + parseInt(data[i].amount);
                                 var createrow = "<tr><td style='text-align: left'>" + data[i].abbr + "</td><td style='text-align: center'>" + data[i].frqno + "</td><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].amount)) + "</td></tr>";
                                 $("#tbodypays").append(createrow);  
                                 $('#totalpaysx').val((new Intl.NumberFormat().format(ptotal)));
                                 $('#totalpaysxx').val(ptotal);
                              
                              } 
                              
                      }


    );

   


   //do deductions
         $.post("salaryvariation/displaydeductions",
                        // {staffid(in database):sid(variable here)etc},
                        {staffid:staffid},
                        function (o) {
                          var data = JSON.parse(o);
                          $("#tbodydeduction").empty();
                          dtotal=0;
                          for(var i=0; 0 < data.length; i++)
                              {
                                 //add row
                                 dtotal=parseInt(dtotal) + parseInt(data[i].amount); 
                                 var createrow = "<tr><td style='text-align: left'>" + data[i].abbr + "</td><td style='text-align: center'>" + data[i].frqno + "</td><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].amount)) + "</td></tr>";
                                 $("#tbodydeduction").append(createrow);
                              $('#totaldeductionsx').val((new Intl.NumberFormat().format(dtotal)));  
                              $('#totaldeductionsxx').val(dtotal);                        

                              } 



                              
                      }

          


       );

       
         //netpay
         var dedd = $('#totaldeductionsxx').val();
         var payss=$('#totalpaysxx').val();
         var netpay=(parseFloat(payss)-parseFloat(dedd));
         //var netpay=(new Intl.NumberFormat().format(pays)) - (new Intl.NumberFormat().format(ded));
         $('#netpay').val((new Intl.NumberFormat().format(netpay)));


























  }




  });



$('#netpay').focus(function(){
   var dedd = $('#totaldeductionsxx').val();
         var payss=$('#totalpaysxx').val();
         var netpay=(parseFloat(payss)-parseFloat(dedd));
         //var netpay=(new Intl.NumberFormat().format(pays)) - (new Intl.NumberFormat().format(ded));
         $('#netpay').val((new Intl.NumberFormat().format(netpay)));
});


$('#indv').click(function(){
      document.getElementById("asv").checked = false;
      document.getElementById("indv").checked = true;
      $('#indcompound').show();
      $('#allcompound').hide();

  });


$('#asv').click(function(){
      document.getElementById("indv").checked = false;
      document.getElementById("asv").checked = true;
      $('#allcompound').show();
      $('#indcompound').hide();

  });
   



});





