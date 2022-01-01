/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

  $('#vid').prop("disabled", true);


$('#savevariationitems').click(function(){
  var vartype=$('#ouritem option:selected').html();
 var vartypecode = vartype.substring(0, 1);
 var variation=$('#payitemname').val();
 var accountid=$('#accountid').val();
 var vid=$('#vid').val();
 var abbr=$('#abbr').val();
 var shows=$('#showstatus').val();
     if(vid=='')
      {
        alert("Variation type must be selected");
      }
      else if(variation=='')
      {
      alert("Variation can not be empty");

      }
      else if(abbr=='')
      {
      alert("Variation abbreviation can not be empty");

      }
      else if(accountid=='')
      {
      alert("Variation account must be selected");

      }
      else if(shows=='')
      {
      alert("Variation Showing on report status must be selected");

      }
      else
      {

        $.post("variationitems/savevariationitems",
                        // {staffid(in database):sid(variable here)etc},
                        {vid:vid,variation:variation,vartype:vartype,vartypecode:vartypecode,accountid:accountid,abbr:abbr,shows:shows},
                        function (o) {
                         // $('#snackbar').show();
                         // $('#snackbar').html("<strong style='color: #0FA015'>" + data + "</strong>");
                          var data = JSON.parse(o);

                          for(var i=0; 0 < data.length; i++)
                              {
                                 //add row
                                 var createrow = "<tr><td>" + data[i].variation + "</td><td>" + data[i].vartype + "</td><td>" + data[i].vartypecode + "</td><td>" + data[i].accountid + "</td><td>" + data[i].abbr + "</td></tr>";
                                 $("#tbodyid").append(createrow);                                                                
                                 $('#vid').val('');
                                 $('#payitemname').val('');
                                 $('#accountid').val('');                                   
                                 $('#abbr').val('');
                                 $('#showstatus').val('');
                              }   

                      },
                      );

      }


});
  //verify inputs
 
  



});





