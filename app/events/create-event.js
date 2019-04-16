$(document).ready(function(){
 
    // show html form when 'create event' button was clicked
    $(document).on('click', '.create-event-button', function(){
        // load list of organizations
$.getJSON("http://localhost/Yietapi/organizer/read.php", function(data){

// build organizations option html
// loop through returned list of data
var organizations_options_html="";
organizations_options_html+="<select name='organization_id' class='form-control'>";
$.each(data.records, function(key, val){
    organizations_options_html+="<option value='" + val.id + "'>" + val.name + "</option>";
});
organizations_options_html+="</select>";

// we have our html form here where event information will be entered
// we used the 'required' html5 property to prevent empty fields
var create_event_html="";
 
// 'read events' button to show list of events
create_event_html+="<div id='read-events' class='btn btn-primary pull-right m-b-15px read-events-button'>";
    create_event_html+="<span class='glyphicon glyphicon-list'></span> Read events";
create_event_html+="</div>";

// 'create event' html form
create_event_html+="<form id='create-event-form' action='#' method='post' border='0'>";
    create_event_html+="<table class='table table-hover table-responsive table-bordered'>";

     // organizations 'select' field
     create_event_html+="<tr>";
        create_event_html+="<td>Organizer ID</td>";
        create_event_html+="<td>" + organizations_options_html + "</td>";
     create_event_html+="</tr>";
 
        
        // Event Title field
        create_event_html+="<tr>";
            create_event_html+="<td>Event Title</td>";
            create_event_html+="<td><input type='text'  name='title' class='form-control' required /></td>";
        create_event_html+="</tr>";
 
        // description field
        create_event_html+="<tr>";
            create_event_html+="<td>Description</td>";
            create_event_html+="<td><textarea name='description' class='form-control' required></textarea></td>";
        create_event_html+="</tr>";

        // Email field
        create_event_html+="<tr>";
            create_event_html+="<td>Email </td>";
            create_event_html+="<td><input type='text' name='email' class='form-control' required /></td>";
        create_event_html+="</tr>";
 
        // Phone field
        create_event_html+="<tr>";
            create_event_html+="<td>Phone </td>";
            create_event_html+="<td><input type='text' name='phone' class='form-control' required /></td>";
        create_event_html+="</tr>";
 
 
       
 
        // button to submit form
        create_event_html+="<tr>";
            create_event_html+="<td></td>";
            create_event_html+="<td>";
                create_event_html+="<button type='submit' class='btn btn-primary'>";
                    create_event_html+="<span class='glyphicon glyphicon-plus'></span> Create event";
                create_event_html+="</button>";
            create_event_html+="</td>";
        create_event_html+="</tr>";
 
    create_event_html+="</table>";
create_event_html+="</form>";


// inject html to 'page-content' of our app
$("#page-content").html(create_event_html);
 
// chage page title
changePageTitle("Create Event");
 
});
    });
 
    // will run if create event form was submitted
$(document).on('submit', '#create-event-form', function(){
    // get form data
var form_data=JSON.stringify($(this).serializeObject());
// submit form data to api
$.ajax({
    url: "http://localhost/Yietapi/event/create.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result) {
        // event was created, go back to events list
        showEventsFirstPage();
    },
    error: function(xhr, resp, text) {
        // show error to console
        console.log(xhr, resp, text);
    }
});
 
return false;

});
});