$(document).ready(function(){



	


    $('#trnno').prop("disabled", true);
    $('#balanceathand').prop("disabled", true);

    $('#saveexpenses').click(function(){
        var amount=$('#amount').val();
        var description=$('#description').val();
        var tme=$('#tme').val();
        var refno=$('#orefno').val();
        var trnno=$('#trnno').val();
        var trndate=$('#currentdate').val();
        var acct2debit=$('#acct2debit').val();
        var acct2credit=$('#acct2credit').val();
        var period =$('#period').val();

        if(amount==0 || amount==''){
          alert("Amount cannot be zero or null");
        }
        else if(description=='')
        {
          alert("Description cannot be empty");
        }
        else if(tme=='')
        {
          alert("System Error occur, please restart the application");
        }
        else if(acct2debit ==null)
        {
          alert("Account to Debit not selected");
        }
        else if(acct2credit ==null)
        {
          alert("Account to credit not selected");
        }
        else if(trndate=='')
        {
          alert("transaction date not selected");
        }
        else
        {

                         $.post("otherpays/savexpenses",                             
                              {trndate:trndate,trnno:trnno,tme:tme,refno:refno,amount:amount,acct2credit:acct2credit,acct2debit:acct2debit,description:description},
                              function (data) {
                               alert(data.message);
                               $ref=('EXP/'+ period +'/'+ data.Refno);
                               $('#trnno').val($ref);
                               $('#tme').val(data.Refno); 
                               $('#orefno').val('');
                               $('#description').val('');
                               $('#amount').val('0.0');                           
                                                            
                            },'json'
                            );
                                


        }

        


    });


 


});