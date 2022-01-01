/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide();


//make the snackbar disappear
    $('#savesubglacct').focusout(function () {
        $('#snackbar').html("");
        $('#snackbar').hide();
    });

    //save the class details
    $('#savesubglacct').click(function () {
        var mainid=$('#mainid').val();
        var subid=$('#subid').val();
        var mclassid=$('#classid').val();
        var classid= subid + mclassid;
        var classdesc =$('#classdesc').val();

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
        if (mclassid.length > 2 || mclassid.length < 2)
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>GL Class ID can not be less or greater than 2 digit number<h4>");
            return;
        }
        if (classdesc=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>GL Class head cannot be empty<h4>");
            return;
        }
        $.post("glsubacct/SaveSubClass",
            // {staffid(in database):sid(variable here)etc},
            {mainid:mainid,subid:subid,subclassid:classid,descristion:classdesc},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }
        );
        //add row
        var createrow = "<tr><td>" + mainid + "</td><td>" + subid + "</td><td>" + classid + "</td><td>" + classdesc + "</td></tr>";
        $("table tbody").append(createrow);
        //$('#mainid').val('');



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





