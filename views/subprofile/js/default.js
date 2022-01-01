/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide();
    $('#savesubcompanyprofile').click(function () {


        var subfirm=$('#companyName').val();
        var contact=$('#companyAdd').val();
        var parent=$('#maincompany option:selected').html();
        var parentid=$('#maincompany').val();

       

        if(parent =='Select Parent Company')        {

            $('#snackbar').show();
            $('#snackbar').html("<h4>Parent Company Name field cannot be empty<h4>");
            return;        }
        if(subfirm =="")        {

            $('#snackbar').show();
            $('#snackbar').html("<h4>Subsidiary Company Name field cannot be empty<h4>");
            return;        }
        if(contact =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Address field cannot be empty<h4>");
            return;

        }        
       //now try saving the record

        $.post("subprofile/SaveSubProfile",
            // {staffid(in database):sid(variable here)etc},
            {parentid:parentid,subfirm:subfirm,contact:contact},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
                alert(data);
            }
        );
        $('#companyName').val('');
        $('#companyAdd').val('');
        $('#maincompany').val('');


    });
    $('#savesubcompanyprofile').focusout(function () {
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





