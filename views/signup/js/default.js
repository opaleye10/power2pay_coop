

$(document).ready(function(){

 $('#snackbar').hide();
 //var URL='https://app.power2pay.com.ng';
 var URL ='http://localhost:8080/finance/account';

$('#createuser').click(function(){
  var parentid=$('#parentid').val();
  var subid=$('#subid').val();
  var roleid=$('#approle').val();
  var staffid=$('#staff').val();
  var username=$('#username').val();
  var password=$('#mypwd').val();
  var logintype="User";  
  var mstatus=$('#mstatus').val();

  if(parentid=='')
  {
    alert("Application error occur, logout and start again");
    return;
  }
  if(subid=='')
  {
    alert("Application error occur, logout and start again");
    return;
  }
  if(roleid=='')
  {
    alert("Please, select a role for the user");
    return;
  }
  if(staffid=='')
  {
    alert("Please, select a staff the staff record");
    return;
  }
  if(username=='')
  {
    alert("Please, enter a unique user name");
    return;
  }
  if(password=='')
  {
    alert("Password cannot be empty");
    return;
  }
  if(mstatus=='')
  {
    alert("Please, select a status");
    return;
  }

  
  $.post("signup/createuser",
      {parentid:parentid,subid:subid,roleid:roleid,staffid:staffid,username:username,password:password,logintype:logintype,mstatus:mstatus},
      function(data){
        alert(data);
      }
    );


             $.ajax({
                  type: 'post',
                  url: 'http://localhost:8080/finance/account/models/load_alluserpersubid.php',
                  data: {subid:subid,parentid:parentid},
                  success: function (o) {
                   //var data = JSON.parse(o);
                   //create table head here
                   $('#snackbar').show();
                  $('#snackbar').html(o);


                   }

                });


  $('#staff').val('');
  $('#username').val('');
  $('#mypwd').val('');    
  $('#mstatus').val('');









});


$('#username').focusout(function(){
  //check if the username exist for the company
  var parentid=$('#parentid').val();
  var subid=$('#subid').val();
  var username=$('#username').val();

   $.ajax({
                  type: 'post',
                  url: 'https://app.power2pay.com.ng/models/load_userpersubid.php',
                  data: {subid: subid,parentid:parentid,username:username},
                  success: function (o) {
                   //var data = JSON.parse(o);
                   //create table head here
                   //$('#snackbar').show();
                  //$('#snackbar').html(o);


                   }

                });
});





$('#mypwd').focusout(function () {

       
        
    });
$('#mypwd1').focusout(function () {

       var pwd1=$('#mypwd').val();
       var pwd2=$('#mypwd1').val();
       if(pwd1 == pwd2)
       {
            
       }
        else
       {
        alert("Pwd not correct");
        $('#mypwd').val('');
        $('#mypwd1').val('');
       }
    });


});





