/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide();
    $('#savecompanyprofile').click(function () {


        var companyname=$('#companyName').val();
        var companyadd=$('#companyAdd').val();
        var companymobile=$('#companyMobiletelno').val();


        if(companyname =="")        {

            $('#snackbar').show();
            $('#snackbar').html("<h4>Company Name field cannot be empty<h4>");
            return;        }
        if(companyadd =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Company Address field cannot be empty<h4>");
            return;

        }
        if(companymobile =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Company Mobile Number cannot be empty<h4>");
            return;
        }
       //now try saving the record

        $.post("profile/SaveProfile",
            // {staffid(in database):sid(variable here)etc},
            {companyname:companyname,companyaddress:companyadd,companymobile:companymobile},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }
        );
        $('#companyName').val('');
        $('#companyAdd').val('');
        $('#companyMobiletelno').val('');


    });
    $('#savecompanyprofile').focusout(function () {
        $('#snackbar').html("");
        $('#snackbar').hide();
    });




    $('#submitphcancelreason').click(function () {
        $('#cancelphreason').focus();
        var reason = $('#cancelphreason').val();
        if(reason=="" || reason.length < 5)
        {
            $('#response').html("<h4 style='color: red;'>Reason can not be empty or lesser than 5 letter words<h4>");
            return;
        }
        var mmfid=$('#myid').val();
        var refno= $('#phCancel_control').attr('rel');
        $.post("dashboard/SavePHcancelReason",
            // {reasons:reason,phno:refno,mmfid:mmfid},
            {reasons:reason,email:mmfid,phno:refno},
            function (data) {
                $('#response').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }
        );
        $('#cancelphreason').val('');


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


});





