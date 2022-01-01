/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide();

    $('#SaveMainAcctHead').click(function () {
        var mainid=$('#mainid').val();
        var msubid=$('#subid').val();
        var subid=mainid + msubid;
        var subheaddesc=$('#glaccthead').val();
        if (mainid=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Main Account code cannot be empty<h4>");
            return;
        }
        if (subid=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Sub Account code cannot be empty<h4>");
            return;
        }
        if (msubid.length > 2 || msubid.length < 2)
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Sub Account less or greater than 2 digit number<h4>");
            return;
        }
        if (subheaddesc=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>GL Main head cannot be empty<h4>");
            return;
        }
        $.post("glmainacct/SaveGLSubhead",
            // {staffid(in database):sid(variable here)etc},
            {mainid:mainid,subid:subid,sub_desc:subheaddesc},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }



        );
        //add row
        var createrow = "<tr><td>" + mainid + "</td><td>" + subid + "</td><td>" + subheaddesc + "</td></tr>";
        $("table tbody").append(createrow);
        //$('#mainid').val('');
        $('#subid').val('');
        $('#glaccthead').val('');
        $('#subid').focus();


    });

    $('#SaveMainAcctHead').focusout(function () {
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





