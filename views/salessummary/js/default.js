$(document).ready(function(){



	$('#daterangereport').hide();
	
	$('#daily').click(function(){
      document.getElementById("daterange").checked = false;
      document.getElementById("daily").checked = true;
      $('#dailyreport').show();
      $('#daterangereport').hide();

  });



	$('#daterange').click(function(){
      document.getElementById("daily").checked = false;
      document.getElementById("daterange").checked = true;
      $('#daterangereport').show();
      $('#dailyreport').hide();
  });


});