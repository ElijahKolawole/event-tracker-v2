$(document).ready(function(){
 
    // handle 'read one' button click
    $(document).on('click', '.read-one-slot-button', function(){
        // get slot id
var id = $(this).attr('data-id');
// read slot record based on given ID
$.getJSON("http://localhost/Yietapi/slot/read_one.php?id=" + id, function(data){
    // start html
    var read_one_slot_html="";
     
    // when clicked, it will show the slot's list
    read_one_slot_html+="<div id='read-slots' class='btn btn-primary pull-right m-b-15px read-slots-button'>";
        read_one_slot_html+="<span class='glyphicon glyphicon-list'></span> Read slots";
    read_one_slot_html+="</div>";

// slot data will be shown in this table
read_one_slot_html+="<table class='table table-bordered table-hover'>";
 
    // slot ID
    read_one_slot_html+="<tr>";
        read_one_slot_html+="<td class='w-30-pct'>Slot Id</td>";
        read_one_slot_html+="<td class='w-70-pct'>" + data.id + "</td>";
    read_one_slot_html+="</tr>";
 
    // slot Oroganization_ID
    read_one_slot_html+="<tr>";
        read_one_slot_html+="<td>Event ID</td>";
        read_one_slot_html+="<td>" + data.event_id + "</td>";
    read_one_slot_html+="</tr>";
 
    // slot Title
    read_one_slot_html+="<tr>";
        read_one_slot_html+="<td>Title</td>";
        read_one_slot_html+="<td>" + data.title + "</td>";
    read_one_slot_html+="</tr>";
 
    // slot Description
    read_one_slot_html+="<tr>";
        read_one_slot_html+="<td>Description</td>";
        read_one_slot_html+="<td>" + data.description + "</td>";
    read_one_slot_html+="</tr>";

     // slot Email
     read_one_slot_html+="<tr>";
     read_one_slot_html+="<td>Date</td>";
     read_one_slot_html+="<td>" + data.date + "</td>";
 read_one_slot_html+="</tr>";

  // slot Start Time
  read_one_slot_html+="<tr>";
  read_one_slot_html+="<td>Start Time</td>";
  read_one_slot_html+="<td>" + data.starttime + "</td>";
read_one_slot_html+="</tr>";

// slot End Time
read_one_slot_html+="<tr>";
read_one_slot_html+="<td>End Time</td>";
read_one_slot_html+="<td>" + data.endtime + "</td>";
read_one_slot_html+="</tr>";
 
  // event Description
  read_one_event_html+="<tr>";
  read_one_event_html+="<td>Min Position </td>";
  read_one_event_html+="<td>" + data.min + "</td>";
read_one_event_html+="</tr>";

// event Email
read_one_event_html+="<tr>";
read_one_event_html+="<td>Max Position</td>";
read_one_event_html+="<td>" + data.max + "</td>";
read_one_event_html+="</tr>";


read_one_slot_html+="</table>";


// inject html to 'page-content' of our app
$("#page-content").html(read_one_slot_html);
 
// chage page title
changePageTitle("Read One Slot");

});
    });
 
});