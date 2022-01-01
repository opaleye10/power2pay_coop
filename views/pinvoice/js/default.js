/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

	
  $('#snackbar').hide(); 

  
  $('#SaveInvoice').click(function(){
    var tamount=$('#tamount').val();
    if(tamount=='')
    {
      alert("Invoice Record(s) is neccessary");
      return
    }
    else
    {
      var supplier=$('#supplier option:selected').html();
       var supplierid=$('#supplier').val();
        var invno=$('#invno').val();
       var trnno=$('#transrefno').val();
       var description=$('#invoice_desc').val();       
       var amount=$('#amount').val();
       var tamount=$('#tamount').val();
        var accountid=$('#accountid').val();
        var gldescription=$('#accountid option:selected').html();        
       var trndate=$('#end_date').val();
       var trnno=$('#transrefno').val();
       var currentuser=$('#currentuser').val();
       var tme=$('#tme').val();
       var period=$('#period').val();

       $.post("pinvoice/SaveInvoice",
                        // {staffid(in database):sid(variable here)etc},
                        {trndate:trndate,trnno:trnno,accountid:accountid,description:description,invno:invno,tme:tme,supplierid:supplierid,supplier:supplier,amount:amount,currentuser:currentuser,period:period},
                        function (data) {
                          $('#snackbar').show();
                          $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
                      }
                      );

        $("#tfootid").empty();
        $("#tbodyid").empty();
        $('#supplier option:selected').html("");       
        $('#invno').val('');
       $('#transrefno').val('');
       $('#invoice_desc').val('');       
       $('#amount').val('0');
       $('#tamount').val('0');        
        $('#accountid option:selected').html('');   




    }
  });
  
  $('#InsertInvoicerec').click(function(){
      var supplier=$('#supplier option:selected').html();
       var supplierid=$('#supplier').val();
        var invno=$('#invno').val();
       var trnno=$('#transrefno').val();
       var description=$('#invoice_desc').val();
       var amount=$('#amount').val();
        var accountid=$('#accountid').val();
        var gldescription=$('#accountid option:selected').html();        
       var trndate=$('#end_date').val();
       var currentuser=$('#currentuser').val();
       if(supplierid==null)
       {
        alert("Supplier cannot be empty");
      return;
       }
      if(trndate == '')
      {
        alert("Date cannot be empty");
        return;
      }
      if(amount == '')
      {
        alert("Amount cannot be empty");
        return;
      }
      
      if(description=='')
      {
        alert("Invoice description cannot be empty");
        return;
      }
      if(accountid==null)
      {
        alert("Account to Debit(GL Account) cannot be empty");
        return;
      }


                    $.post("pinvoice/SaveInvoiceTemp",
                        // {staffid(in database):sid(variable here)etc},
                        {amount:amount,accountid:accountid,gldescription:gldescription,currentuser:currentuser},
                        function (o) {
                          var msgstring="Temporary record successfully inserted";
                          $('#snackbar').show();
                          $('#snackbar').html("<strong style='color: #0FA015'>" + msgstring + "</strong>");
                          var data = JSON.parse(o);
                          var ntotal=0;
                           $("#tbodyid").empty();                  
                          
                          for(var i=0; 0 < data.length; i++)
                              {
                                 //add row
                                 ntotal=parseInt(ntotal) + parseInt(data[i].amount);
                                  var createrow = "<tr><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].amount)) + "</td><td style='text-align: center'>" + data[i].gldescription + "</td><td style='text-align: center'>" + data[i].accountid + "</td></tr>";
                                  $("#tbodyid").append(createrow);
                                  var createfooter="<tr><td colspan='3' style='text-align: left'>"+ (new Intl.NumberFormat().format(ntotal)) +"</td></tr>";
                                  $("#tfootid").empty();
                                   $("#tfootid").append(createfooter);
                                   $('#tamount').val((new Intl.NumberFormat().format(ntotal)));
                              
                              } 







                      }
                      );
      


  });




    /**
     $('#cancelphreason').keypress(function (event) {
            var key=(event.keyCode ? event.keyCode : event.which);
            if (key == 13){

            }
        });
     **/



});





