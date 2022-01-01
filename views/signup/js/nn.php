/**
* Created by Opaleye on 11/07/2016.
*/
$(function () {
/*
This is to display the insert record into the database
*/
$.get('dashboard/xhrGetListings', function (o) {
/*console.log(o[0].text);
*/
for (var i = 0; i < o.length; i++)
{
$('#listInserts').append('<div>' + o[i].text + ' <a class="del" rel="' + o[i].id + '" href="#"> x </a></div>');
//$('#listInserts').append('<div' + o[i].text + '</div>');
}
}, 'json');
/*
This is to insert record into the database
*/
$('#randomInsert').live('submit',function () {
var url=$(this).attr('action');
var data = $(this).serialize();
$.post(url,data, function (o) {
$('#listInserts').append('<div>' + o.text + '<a class="del" rel="'+ o.id +'" href="#"> x </a>  </div>' )
}, 'json');
return false;
});

$('.del').click(function () {
delitem =$(this);
var id=$(this).attr('rel');
$.post('dashboard/xhrDeleteListing',{'id': id}, function (o) {
//$('#listInserts').append('<div>' + o.text + '<a class="del" rel="'+ o.id +'" href="#"> x </a>  </div>' )
alert(1);
//delitem.parent().remove();
}, 'json');
return false;
});
});



//working code
$('.del').click(function () {
delItem = $(this);
var id=$(this).attr('rel');
$.post('dashboard/xhrDeleteListing', {'id': id}, function(o){
delItem.parent().remove()
});
return false;


