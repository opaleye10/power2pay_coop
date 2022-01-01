/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div


    $('#saveSalaryCategory').click(function () {
    alert("im working ooo");
    });
    $('#snackbar').hide();
    $('#submitstaffrecord').click(function () {


        var fname=$('#firstname').val();
        var sid=$('#staffid').val();
        var mname=$('#middlename').val();
        var lname=$('#lastname').val();
        var sex=$('#sex').val();
        var cadd=$('#contactaddress').val();
        var pnumber=$('#phonenumber').val();
        var title=$('#title').val();
        var email=$('#email').val();
        var mstatus=$('#mstatus').val();
        var religion=$('#religion').val();
        var cuser=$('#crrt').val();
        var rstatus="Active";
        var  employment=$('#employment').val();
        var deptpost=$('#deptpost').val();
        var bank=$('#bank').val();
        var acctno=$('#acctno').val();


        if(sid =="" || sid.length < 2)        {

            $('#snackbar').show();
            $('#snackbar').html("<h4>Staff Identification number cannot be empty or less than 2 numbers<h4>");
            return;        }
        if(fname =="" || fname.length < 4)
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>first name cannot be empty or less than 4 letters<h4>");
            return;

        }
        if(mname =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Middle name cannot be empty<h4>");
            return;

        }
        if(lname =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Last name cannot be empty<h4>");
            return;

        }
        if(sex =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Sex field cannot be empty<h4>");
            return;

        }
        if(pnumber =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4> Phone Numbercannot be empty<h4>");
            return;

        }
        if(email =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Email cannot be empty<h4>");
            return;

        }
        if(cadd =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Contact Address cannot be empty<h4>");
            return;

        }
        if(title =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Staff Title is neccesary<h4>");
            return;

        }

        if(mstatus =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Marital Status cannot be empty<h4>");
            return;

        }
        if(religion =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Religion cannot be empty<h4>");
            return;

        }
        if(cuser =="")
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Error Occur, please, logout and Login again. If this persist, contact your administrator<h4>");
            return;

        }

     
        
        
        
        $.post("salaryinfo/saverecord",
            // {staffid(in database):sid(variable here)etc},
            {staffid:sid,fname:fname,mname:mname,lname:lname,sex:sex,phonenumber:pnumber,contactaddress:cadd,email:email,title:title,mstatus:mstatus,religion:religion,employment:employment,deptpost:deptpost,bank:bank,acctno:acctno},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }
        );
        //$('#cancelphreason').val('');


    });
    $('#submitstaffrecord').focusout(function () {
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





