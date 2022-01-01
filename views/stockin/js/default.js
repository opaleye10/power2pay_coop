/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function()
{
    //hide comment div

    $('#transrefno').prop("disabled", true);
    $('#tamount').prop("disabled", true);
    $('#tamount').val("0.00");
    $('#snackbar').hide()
    $('#amount').val("0.00");
    $('#qty').val("0.00");
    $('#unitprice').val("0.00");    

$('#qty, #unitprice').keyup(function(){
               var value1 = parseFloat($('#qty').val()) || 0;
               var value2 = parseFloat($('#unitprice').val()) || 0;
               $('#amount').val(value1 * value2);
            });

//change snackbar status
    $('#InsertStoreItem').focusout(function () {
        $('#snackbar').html("");
        $('#snackbar').hide();
    });
    
    $('#InsertStoreItem').click(function () {
        //ready to insert records into temporary file
        var urldelete ='<img src="https://app.power2pay.com.ng/public/images/delete.png" style="width: 1.2em; height: 1.2em;">';
        
        var currentuser = $('#currentuser').val();
        var deliveryno = $('#deliveryno').val();
        var tme = $('#tme').val();
        var trnno = $('#transrefno').val();
        var period=$('#period').val();
        var deldate=$('#deldate').val();
        var itemdesc=$('#ouritem option:selected').html();
        var itemno= $('#itemno').val();
        var qty=$('#qty').val();
        var unitprice=$('#unitprice').val();
        var amount = parseFloat( $('#amount').val());
        var supplierid=$('#supplier').val();
        var supplier=$('#supplier option:selected').html();
        var totalamount= parseFloat($('#tamount').val()) ;
        var totalamountt= amount + totalamount ;
        $('#tamount').val(totalamountt);

        $.post("stockin/SaveDeliveryTemp",
            {qty:qty,price:unitprice,amount:amount,itemno:itemno,itemdesc:itemdesc,currentuser:currentuser,trnno:trnno,period:period,deliveryno:deliveryno,supplierid:supplierid,supplier:supplier,deldate:deldate,tme:tme},
            function (data) {                
                
                if((data.text)=="Yes")
                {
                     $('#snackbar').show();
                    $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>");

                    var createrow = "<tr><td style='text-align: right'>" + qty + "</td><td style='text-align: right'>" + unitprice + "</td><td style='text-align: right'>" + amount + "</td><td style='text-align: center'>" + itemdesc + "</td><td>" + urldelete + "</td></tr>";
                    $("table tbody").append(createrow);

                    alert(data.message);
                }
                else
                {
                     $('#snackbar').show();
                    $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>");
                    alert(data.message);
                }
                            
            },'json'
        );       
        
        $('#ouritem').val('');
        $('#itemno').val('');
        $('#qty').val('0.00');
        $('#unitprice').val('0.00');
        $('#amount').val('0.00');

        

    });



    $('#SaveDelivery').focusout(function () {
        $('#snackbar').html("");
        $('#snackbar').hide();
    });

    $('#SaveDelivery').click(function () {
        var currentuser = $('#currentuser').val();
        var deliveryno = $('#deliveryno').val();
        var trnno = $('#transrefno').val();
        var supplierid=$('#supplier').val();
        var supplier=$('#supplier option:selected').html();
        var totalamount= $('#tamount').val();
        var posted="";
        var period=$('#period').val();
        var deldate=$('#deldate').val();
        var tme = $('#tme').val();
        $.post("stockin/SaveDelivery",
            {deldate:deldate,deliveryno:deliveryno,supplierid:supplierid,supplier:supplier,amount:totalamount,posted:posted,trnno:trnno,period:period,currentuser:currentuser,tme:tme},
        function (data) {
            $('#snackbar').show();
            $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>");
            $('#printtract').val(tme);
            nref='DEL/'+ period +'/'+ data.delno;
            $('#transrefno').val(nref);
            $('#tme').val(data.jref);
            alert(data.message);
        },'json'



    );

//empty the input lists
        $("table tbody").empty();
        var deliveryno = $('#deliveryno').val('');        
        //var trnno = $('#transrefno').val('');
        var period=$('#period').val();
        var deldate=$('#deldate').val();        
        var itemno= $('#itemno').val('');
        var qty=$('#qty').val('');
        var unitprice=$('#unitprice').val('');        
        var supplierid=$('#supplier').val('');





    });




});





