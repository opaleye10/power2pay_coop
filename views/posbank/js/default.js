$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide();






    $('#SaveBanks').click(function(){
        var bankid=$('#bank').val();
        var bank=$('#bank option:selected').html();
        var posname=$('#posname').val();
        var acctno=$('#acctno').val();
        var accountid=$('#accountid').val();
        if(bank == '')
        {
            alert("Bank can not be empty")
            return;
        }
        if(posname == '')
        {
         alert("POS Description can not be empty")
            return;   
        }
        if(acctno == '')
        {
         alert("Account Number can not be empty")
            return;   
        }
        if(accountid == '')
        {
            alert("GL AccountID can not be empty")
            return;
        }
        
        $.post("posbank/SaveBankpos",                        
                        {posname:posname,bank:bank,acctno:acctno,accountid:accountid},
                        function (data) {
                            //$data=array('bank'=>$data['bank'],'accountnum'=>$data['acctno'],'posmachine'=>$data['posname'],'message'=>$stringsave);
                          $('#snackbar').show();
                          $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>");
                           var createrow = "<tr><td>" + data.posmachine + "</td><td>" + data.bank + "</td><td>" + data.accountnum + "</td></tr>";
                            $("#tbodyid").append(createrow);
                      },'json'
                      );
        $('#bank').val('');        
        $('#posname').val('');
        $('#acctno').val('');
        $('#accountid').val('');
                    
                     
    });

   


});