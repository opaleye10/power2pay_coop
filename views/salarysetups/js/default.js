/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

    //hide comment div

    $('#snackbar').hide();
    var urldelete ='<img src="http://localhost:8080/finance/account/public/images/delete.png" style="width: 1.2em; height: 1.2em;">';
    var urledit ='<img src="http://localhost:8080/finance/account/public/images/edit.png" style="width: 1.2em; height: 1.2em;">';


    $('#SaveAllowanceButton').click(function(){
        var allwdesc=$('#salallowance').val();

        $.post("salarysetups/saveallw",
            // {staffid(in database):sid(variable here)etc},
            {allwdesc:allwdesc},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>");   



                var createrow = "<tr><td>" + mid + "</td><td>" + data.allwid + "</td><td>" + allwdesc + "</td><td>" + urldelete + "Delete</td></tr>";
                $("tbodyid_allw").append(createrow);             
            },'json'
        );        
        $('#salallowance').val('');
        $('#salallowance').focus();

    });

    $('#SaveUnionButton').click(function() {
        var salunion = $('#salunion').val();
        var bankunion = $('#bankunion').val();
        var acctno = $('#acctno').val();
        var mid="101";
        $.post("salarysetups/saveunionlist",
            // {staffid(in database):sid(variable here)etc},
            {salunion:salunion,bankunion:bankunion,acctno:acctno},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");                
            }
        );
        var createrow = "<tr><td>" + mid + "</td><td>" + salunion + "</td><td>" + bankunion + "</td><td>" + acctno + "</td><td>" + urldelete + "Delete</td></tr>";
        $("tbodyid_union").append(createrow);
        $('#gnabbr').val('');
        $('#gn').val('');
        $('#gn').focus();

        


    });


    $('#SaveGradeNameButton').click(function () {
        
        var gradename = $('#gn').val();
        var abbr = $('#gnabbr').val();
        var astatus = $('#gstatus').val();
        
        
        //return;
        var mid="101";
        $.post("salarysetups/SaveGradeName",
            // {staffid(in database):sid(variable here)etc},
            {gradename:gradename,abbr:abbr,astatus:astatus},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");                
            }
        );
        var createrow = "<tr><td>" + mid + "</td><td>" + abbr + "</td><td>" + astatus + "</td><td>" + urldelete + "Delete</td><td>" + urledit + "Edit</td></tr>";
        $("tbodyid_Gn").append(createrow);
        $('#gnabbr').val('');
        $('#gn').val('');
        $('#gn').focus();







    });



    $('#SaveBankButton').click(function () {
        
        var bank = $('#bankdesc').val();
        
        //return;
        var mid="101";
        $.post("salarysetups/SaveBank",
            // {staffid(in database):sid(variable here)etc},
            {bank:bank},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
                // alert(data);
            }
        );
        var createrow = "<tr><td>" + mid + "</td><td>" + bank + "</td><td>" + urldelete + "Delete</td</tr>";
        $("#tbodyid_bank").append(createrow);
        $('#bank').val('');
        $('#bank').focus();

    });





    $('#saveSalaryDept').click(function () {       
        var dept= $('#dept').val();
        var astatus = 'Active';

        $.post("salarysetups/SaveDepartment",
            // {staffid(in database):sid(variable here)etc},
            {dept:dept,astatus:astatus},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
                // alert(data);
            }
        );

       var createrow = "<tr><td>101</td><td>" + dept + "</td><td>" + astatus + "</td><td>" + urldelete + "</td><td>" + urledit + "</td></tr>";
        $("#tbodyid_dept").append(createrow);
        $('#dept').val('');
        $('#dept').focus();
    });




    $('#saveSalaryCategory').click(function () {
        var category = $('#category').val();
        var astatus=$('#catstatus').val();
        var tempno=100;
        if(category=='')
        {
            alert("Please, enter category");
            return
        }

        $.post("salarysetups/SaveCategory",
            // {staffid(in database):sid(variable here)etc},
            {category:category,astatus:astatus},
            function (data) {
                $('#snackbar').show();
                $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
               // alert(data);
            }
        );
        tempno ++;
        var createrow = "<tr><td>" + tempno + "</td><td>" + category + "</td><td>" + astatus + "</td><td>" + urldelete + " delete</td><td>" + urledit + " edit</td></tr>";
        $("#tbodyid_cat").append(createrow);
        $('#dept').val('');
        $('#dept').focus();
        $('#category').val('');
        $('#category').focus();

    });


    $('#saveSalaryCategory').focusout(function () {
        $('#snackbar').html("");
        $('#snackbar').hide();
    });







});





