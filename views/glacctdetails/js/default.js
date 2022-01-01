/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide();


    $('#SaveChartofAccount').click(function () {

    var subclassid = $('#cid').val();
    var mainid=$('#mainid').val();
    var subid=$('#subid').val();
    var maccount=$('#accountid').val();
    var accountid=subclassid + maccount;
    var gldescription=$('#glaccount').val();

        if (maccount.length > 2 || maccount.length < 2)
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>GL Account ID can not be less or greater than 2 digit number<h4>");
            return;
        }
        if (gldescription=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>GL Account Description cannot be empty<h4>");
            return;
        }
        $.post("glacctdetails/SaveAccountid",
            // {staffid(in database):sid(variable here)etc},
            {mainid:mainid,subid:subid,subclassid:subclassid,accountid:accountid,gldescription:gldescription},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }
        );

        //add row
        var createrow = "<tr><td>" + mainid + "</td><td>" + subid + "</td><td>" + subclassid + "</td><td>" + accountid + "</td><td>" + gldescription + "</td></tr>";
        $("table tbody").append(createrow);
        //$('#mainid').val('');




    });

    $('#SaveChartofAccount').focusout(function () {
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





