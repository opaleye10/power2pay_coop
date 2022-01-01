/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function()
{
    //hide comment div
    $('#snackbar1').hide();


    $('#processme').click(function(){
        
        $('#snackbar1').show();
         $.post("salaryprocess/processme",
            // {staffid(in database):sid(variable here)etc},
            {},
            function (data) {
                alert(data);
                $('#snackbar1').hide();
            }

        );
    });



});





