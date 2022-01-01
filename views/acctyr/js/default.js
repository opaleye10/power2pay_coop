/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide()
    $('#SaveAcctYear').click(function () {
        var startdate=$('#start_date').val();
        var enddate=$('#end_date').val();
        var acctyr=$('#actualyr').val();
        var astatus=$('#astatus').val();

        if(startdate=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Starting Date of accounting year is mandatory<h4>");
            return;

        }

        if(enddate=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>End Date of accounting year is mandatory<h4>");
            return;

        }
        if(acctyr=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Accounting year is mandatory<h4>");
            return;
        }


        //save the accounting period
        $.post("acctyr/SaveAccountingPeriod",
            {startdate:startdate,enddate:enddate,yr:acctyr,astatus:astatus},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }
        );



    });


    $('#SaveAcctYear').focusout(function () {
        $('#snackbar').html("");
        $('#snackbar').hide();
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





