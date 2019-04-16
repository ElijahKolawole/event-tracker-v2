$(document).ready(function(){
 
    // handle 'read one' button click
    $(document).on('click', '.read-one-event-button', function(){
        // get event id
var id = $(this).attr('data-id');
// read event record based on given ID
$.getJSON("http://localhost/Yietapi/event/read_one.php?id=" + id, function(data){
    // start html
    var read_one_event_html="";
     
    // when clicked, it will show the event's list
    read_one_event_html+="<div id='read-events' class='btn btn-primary pull-right m-b-15px read-events-button'>";
        read_one_event_html+="<span class='glyphicon glyphicon-list'></span> Read events";
    read_one_event_html+="</div>";

// event data will be shown in this table
read_one_event_html+="<table class='table table-bordered table-hover'>";
 
    // event ID
    read_one_event_html+="<tr>";
        read_one_event_html+="<td class='w-30-pct'>Event Id</td>";
        read_one_event_html+="<td class='w-70-pct'>" + data.id + "</td>";
    read_one_event_html+="</tr>";
 
    // event Oroganization_ID
    read_one_event_html+="<tr>";
        read_one_event_html+="<td>Oroganization_ID</td>";
        read_one_event_html+="<td>" + data.organization_id + "</td>";
    read_one_event_html+="</tr>";
 
    // event Title
    read_one_event_html+="<tr>";
        read_one_event_html+="<td>Event Title</td>";
        read_one_event_html+="<td>" + data.title + "</td>";
    read_one_event_html+="</tr>";
 
    // event Description
    read_one_event_html+="<tr>";
        read_one_event_html+="<td>Description</td>";
        read_one_event_html+="<td>" + data.description + "</td>";
    read_one_event_html+="</tr>";

     // event Email
     read_one_event_html+="<tr>";
     read_one_event_html+="<td>Email</td>";
     read_one_event_html+="<td>" + data.email + "</td>";
 read_one_event_html+="</tr>";

  // event Phone
  read_one_event_html+="<tr>";
  read_one_event_html+="<td>Phone</td>";
  read_one_event_html+="<td>" + data.phone + "</td>";
read_one_event_html+="</tr>";
 
read_one_event_html+="</table>";



// -----------------------------------------------------------------------------
//------------------------------------------------------------------------------
// Adding Table for SLOTS  --------- TESTING -------------------------------//


read_one_event_html+="<table class='table table-bordered table-hover'>";


// Job title
read_one_event_html+="<tr>";
read_one_event_html+="<td class='w-30-pct'>Job Title</td>";
read_one_event_html+="<td class='w-70-pct'>" + data.job_title + "</td>";
read_one_event_html+="</tr>";

 
    // event ID
    read_one_event_html+="<tr>";
        read_one_event_html+="<td class='w-30-pct'>Job Description</td>";
        read_one_event_html+="<td class='w-70-pct'>" + data.job_description + "</td>";
    read_one_event_html+="</tr>";
 
    // event Oroganization_ID
    read_one_event_html+="<tr>";
        read_one_event_html+="<td>Job Start Time</td>";
        read_one_event_html+="<td>" + data.starttime + "</td>";
    read_one_event_html+="</tr>";
 
    // event Title
    read_one_event_html+="<tr>";
        read_one_event_html+="<td>Job End Time</td>";
        read_one_event_html+="<td>" + data.endtime + "</td>";
    read_one_event_html+="</tr>";
 
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

  

 
 
read_one_event_html+="</table>";





// inject html to 'page-content' of our app
$("#page-content").html(read_one_event_html);
 
// chage page title
changePageTitle("Read One Event");

});
    });
 
});