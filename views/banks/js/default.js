/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide()


    $('#SaveBanks').click(function(){
        var bankid=$('#bank').val();
        var bank=$('#bank option:selected').html();
        var branch=$('#branch').val();
        var acctno=$('#acctno').val();
        var accountid=$('#accountid').val();

        if(bank == '')
        {
            alert("Bank can not be empty")
            return;
        }
        if(branch == '')
        {
         alert("Branch can not be empty")
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
        $.post("banks/SaveBanks",
                        // {staffid(in database):sid(variable here)etc},
                        {bank:bank,branch:branch,acctno:acctno,accountid:accountid},
                        function (data) {
                          $('#snackbar').show();
                          $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
                      }
                      );
                     $("#tbodyid").empty();
                     $('#tfootid').empty();
                   
             

        


    });

   

    $('#SaveBanks').focusout(function () {
                        $.ajax({
                                type: 'post',
                                url: 'http://localhost:8080/finance/account/models/load_banks.php',
                                data: { },
                                success: function (o) {
                                var data = JSON.parse(o);
                                //create table head here
                               // $('#snackbar').show();
                                // $('#snackbar').html(o);
                                $("#tbodyid").empty();
                                var sn=0;
                                for(var i=0; 0 < data.length; i++)
                                                            {
                                                                //add row
                                sn=i +1;                         
                                                                

                                var createrow = "<tr><td>" + sn + "</td><td>" + data[i].bank + "</td><td>" + data[i].branch + "</td><td>" + data[i].acctno + "</td><td>" + data[i].accountid + "</td/tr>";
                                $("#tbodyid").append(createrow);
                                                                //$('#snackbar').append(data[i].descristion);
                                                                // $('#snackbar').html(o);
                                                                //  $('#snackbar').html(data);
                                                            }




                                 
                                
                                }
                        });


















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





