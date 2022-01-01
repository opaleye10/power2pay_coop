/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){


$('#cash').prop("disabled", true);
$('#creditor').prop("disabled", true);







$('#inventor').click(function(){        
        var inventory=$('#glcode').val();

       if(inventory)
       {
        $.post("sacctcode/Saveinventorycode",
                        // {staffid(in database):sid(variable here)etc},
                        {inventory:inventory},
                        function (o) {
                          


                            alert(o.message);
                            $('#inventory').val(o.inventory);



                      }, 'json'
                      );


       }
       else
       {
        alert("Please, select the appropriate code to cash transactions");
       }
        





    });


$('#cog').click(function(){        
       var cogs=$('#glcode').val();

       if(cogs)
       {
        $.post("sacctcode/Savecogscode",
                        // {staffid(in database):sid(variable here)etc},
                        {cogs:cogs},
                        function (o) {

                            alert(o.message);
                            $('#cogs').val(o.cogs);

                      }, 'json'
                      );


       }
       else
       {
        alert("Please, select the appropriate code to Cost of Goods Sold transactions");
       }
        
});










 $('#sale').click(function(){        
        var sales=$('#glcode').val();

       if(sales)
       {
        $.post("sacctcode/Savesalescode",
                        // {staffid(in database):sid(variable here)etc},
                        {sales:sales},
                        function (o) {
                          


                            alert(o.message);
                            $('#sales').val(o.sales);



                      }, 'json'
                      );


       }
       else
       {
        alert("Please, select the appropriate code to sales transactions");
       }
        





    });






    $('#savecash').click(function(){        
        var cash=$('#glcode').val();

       if(cash)
       {
        $.post("sacctcode/Savecashcode",
                        // {staffid(in database):sid(variable here)etc},
                        {cash:cash},
                        function (o) {
                          


                            alert(o.message);
                            $('#cash').val(o.cash);



                      }, 'json'
                      );


       }
       else
       {
        alert("Please, select the appropriate code to cash transactions");
       }
        





    });



$('#savedelivery').click(function(){        
        var delivery=$('#glcode').val();       
      
      if(delivery)
      {
        $.post("sacctcode/savedeliverycode",                       
                        {delivery:delivery},
                        function (o) {
                            alert(o.message);
                            $('#delivery').val(o.delivery);
                      }, 'json'
                      );

      }
      else
      {
        alert("Please, select the appropriate code for transactions");
      }
        






    });



$('#savedebtor').click(function(){        
        var debtor=$('#glcode').val();       
      
      if(debtor)
      {
        $.post("sacctcode/Savedebtorcode",                       
                        {debtor:debtor},
                        function (o) {
                            alert(o.message);
                            $('#debtor').val(o.debtor);
                      }, 'json'
                      );

      }
      else
      {
        alert("Please, select the appropriate code for transactions");
      }
        






    });






$('#savecreditor').click(function(){        
        var creditor=$('#glcode').val();
      
      if(creditor)
      {
        $.post("sacctcode/Savecreditorcode",
                        // {staffid(in database):sid(variable here)etc},
                        {creditor:creditor},
                        function (o) {
                          


                            alert(o.message);
                            $('#creditor').val(o.creditor);



                      }, 'json'
                      );

      }
      else
      {
        alert("Please, select the appropriate code for credit transactions");
      }
        






    });


});





