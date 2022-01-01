/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div
    $('#snackbar').hide();



    $('#SaveCustomer').click(function () {
        var cname=$('#customername').val();
        var cadd=$('#contactadd').val();
        var cmobile=$('#mobilenumber').val();
        var parentid=$('#parentid').val();
        var subid=$('#subid').val();

        alert(parentid);

        if (cname=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Customer's name cannot be empty<h4>");
            return;
        }
        if (cadd=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Customer's address cannot be empty<h4>");
            return;
        }

        if (cmobile=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Customer's mobile number cannot be empty<h4>");
            return;
        }

        if (cmobile.length < 11 || cmobile.length > 11)
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Customer's mobile number cannot be greater or less than 11 digit<h4>");
            return;
        }
        $.post("inventorysetup/SaveCustomer",
            // {staffid(in database):sid(variable here)etc},
            {customername:cname,address:cadd,mobileno:cmobile,parentid:parentid,subid:subid},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }

        );
        $('#customername').val('');
        $('#contactadd').val('');
        $('#mobilenumber').val('');
    });

    $('#SaveCustomer').focusout(function () {
        $('#snackbar').html("");
        $('#snackbar').hide();
    });

    $('#savesupplierprofile').click(function () {
        var supname=$('#suppliername').val();
        var supadd=$('#supplieraddress').val();
        var supcp=$('#suppliercontactperson').val();
        var supmb=$('#suppliermobileno').val();
        var supemail=$('#supplieremail').val();
        var parentid=$('#parentid').val();
        var subid=$('#subid').val();

        //verify something is input
        if (supname=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Supplier's name cannot be empty<h4>");
            return;
        }

        if (supadd=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Supplier's address cannot be empty<h4>");
            return;
        }
        if(supcp=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Supplier's contact person cannot be empty<h4>");
            return;
        }
        if(supmb=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Supplier's mobile number cannot be empty<h4>");
            return;
        }
        if(supemail=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Supplier's email address cannot be empty<h4>");
            return;
        }

        $.post("inventorysetup/SaveSupplier",
            // {staffid(in database):sid(variable here)etc},
            {supplier:supname,address:supadd,contact_person:supcp,phone_number:supmb,email:supemail,parentid:parentid,subid:subid},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }
        );



    });

    $('#savesupplierprofile').focusout(function () {
        $('#snackbar').html("");
        $('#snackbar').hide();
    });

    $('#saveproductlist').click(function () {
        var pid=$('#pid').val();
        var pname=$('#pname').val();
        var pclass=$('#pclass').val();
        var glsales=$('#glsales').val();
        var glinventory=$('#glinventory').val();
        var parentid=$('#parentid').val();
        var subid=$('#subid').val();



        if (pid=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Product ID cannot be empty<h4>");
            return;
        }
        if (pname=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Product Name cannot be empty<h4>");
            return;
        }
        $.post("inventorysetup/SaveProductList",
            // {staffid(in database):sid(variable here)etc},
            {pid:pid,pname:pname,pclass:pclass,glsales:glsales,glinventory:glinventory,parentid:parentid,subid:subid},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
                //alert(data);
            }
        );

    });
    $('#saveproductlist').focusout(function () {
        $('#snackbar').html("");
        $('#snackbar').hide();
    });


    $('#saveproductclass').click(function () {
        var pcategory=$('#productcategory').val();
        var pclass=$('#productclass').val();
        if (pclass=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Product Class cannot be empty<h4>");
            return;
        }
        $.post("inventorysetup/SaveProductClass",
            // {staffid(in database):sid(variable here)etc},
            {category:pcategory,pclass:pclass},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }
        );



    });

    $('#saveproductclass').focusout(function () {
        $('#snackbar').html("");
        $('#snackbar').hide();
    });


    $('#savecategoryDescription').click(function () {
        var pcategory=$('#description').val();
        var parentid=$('#parentid').val();
        var subid=$('#subid').val();
        if(pcategory=='')
        {
            $('#snackbar').show();
            $('#snackbar').html("<h4>Product category cannot be empty<h4>");
            return;
        }

        $.post("inventorysetup/SaveProductCategory",
            // {staffid(in database):sid(variable here)etc},
            {description:pcategory,parentid:parentid,subid:subid},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
            }
        );

    });


    $('#savecategoryDescription').focusout(function () {
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





