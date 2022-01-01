/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){
     $('#snackbar').hide();
      

     $('#oldpass').focusin(function(){
        $('#snackbar').html('');
     });


     $('#cnewpass').focusout(function(){
        var new_password=$('#newpass').val(); 
        var cnew_password=$('#cnewpass').val();
       
        if(cnew_password != new_password)
        {
            alert("New password not the same with the confirmed Password field");
            $('#newpass').val('');
            $('#cnewpass').val('');
            exit();
        }

     });


     $('#newpass').focusout(function(){
        var old_password=$('#oldpass').val();  
        var new_password=$('#newpass').val(); 
        var cnew_password=$('#cnewpass').val();
        if(old_password==new_password)
        {
            alert("You cant use the old password, plz try another words");
            $('#newpass').val('');
            exit();

        } 
        if(new_password.length < 6  )
        {
            alert("Password length cannot be less than six letters");
            $('#newpass').val('');
            exit();
        }

     });

    $('#oldpass').focusout(function(){
        var old_password=$('#oldpass').val();         

        $.post("changepwd/searchpwd",
            {old_password:old_password},
            function (data) {
                if(data.message !='')
                {
                   $('#snackbar').show();
                    $('#snackbar').html("<strong style='color: #0FA015'>" + data.message + "</strong>"); 
                    $('#oldpass').val('');
                }
               

                
            },'json'
        );




    });



});





