/**
 * Created by Opaleye on 11/07/2016.
 */
$(document).ready(function(){

$('#savelosv').click(function(){
  
  var mcl=$('#mcl').val();
        var customers=$('#customers option:selected').html();
       // var customers=$('#customers').val();
        var cid=$('#cid').val();
        var parentid=$('#parentid').val();
        var subid=$('#subid').val();        
        if(customers)
        {
            if(mcl)
             {
              $.post("maxcreditlevel/updatelosv",
                              // {staffid(in database):sid(variable here)etc},
                              {cid:cid,customers:customers,mcl:mcl,parentid:parentid,subid:subid},
                              function (o) {  
                                var data = JSON.parse(o);
                                                          //create table head here
                                                           // $('#snackbar').show();
                                                          //$('#snackbar').html(o);
                                                            var ntotal=0;
                                                            $("#tbodyid").empty();
                                                             for(var i=0; 0 < data.length; i++)
                                                            {
                                                                //add row                                                                
                                                                var createrow = "<tr><td style='text-align: left'>" + data[i].customers + "</td><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].mcl)) + "</td><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].losv)) + "</td></tr>";
                                                                $("#tbodyid").append(createrow);                                                            
                                                                
                                                              }


                            }
                            );


             }
             else
             {
              alert("Current individual stock value cannot be null or empty");
             }       
        }
        else
        {
          alert("Customer's name cannot be null or empty");
        }
  
});

$('#savemaxcreditlevel').click(function(){        
        
        var mcl=$('#mcl').val();
        var customers=$('#customers option:selected').html();
       // var customers=$('#customers').val();
        var cid=$('#cid').val();
        var parentid=$('#parentid').val();
        var subid=$('#subid').val();        
        if(customers)
        {
            if(mcl)
             {
              $.post("maxcreditlevel/savemcl",
                              // {staffid(in database):sid(variable here)etc},
                              {cid:cid,customers:customers,mcl:mcl,parentid:parentid,subid:subid},
                              function (o) {  
                                var data = JSON.parse(o);
                                                            //create table head here
                                                           // $('#snackbar').show();
                                                            //$('#snackbar').html(o);
                                                            var ntotal=0;
                                                            $("#tbodyid").empty();
                                                             for(var i=0; 0 < data.length; i++)
                                                            {
                                                                //add row                                                                
                                                                var createrow = "<tr><td style='text-align: left'>" + data[i].customers + "</td><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].mcl)) + "</td><td style='text-align: right'>" + (new Intl.NumberFormat().format(data[i].losv)) + "</td></tr>";
                                                                $("#tbodyid").append(createrow);                                                            
                                                                
                                                              }


                            }
                            );


             }
             else
             {
              alert("Maximum Credit level cannot be null or empty");
             }       
        }
        else
        {
          alert("Customer's name cannot be null or empty");
        }

    });



});





