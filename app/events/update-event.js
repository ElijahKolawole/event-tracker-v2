$(document).ready(function(){
 
    // show html form when 'update event' button was clicked
    $(document).on('click', '.update-event-button', function(){
        // get event id
var id = $(this).attr('data-id');

// read one record based on given event id
$.getJSON("http://localhost/Yietapi/event/read_one.php?id=" + id, function(data){
 
    // values will be used to fill out our form
    var organization_id = data.organization_id;
    var title = data.title;
    var description = data.description;
    var email = data.email;
    var phone = data.phone;
   
     
    // load list of organizations
$.getJSON("http://localhost/Yietapi/organizer/read.php", function(data){
 
    // build 'organizations option' html
    // loop through returned list of data
    var organizations_options_html="";
   organizations_options_html+="<select name='organization_id' class='form-control'>";
 
    $.each(data.records, function(key, val){
         
        // pre-select option is organizer id is the same
        if(val.id==organization_id){
           organizations_options_html+="<option value='" + val.id + "' selected>" + val.name + "</option>";
        }
 
        else{
           organizations_options_html+="<option value='" + val.id + "'>" + val.name + "</option>";
        }
    });
   organizations_options_html+="</select>";
     
   // store 'update event' html to this variable
var update_event_html="";
 
// 'read events' button to show list of events
update_event_html+="<div id='read-events' class='btn btn-primary pull-right m-b-15px read-events-button'>";
    update_event_html+="<span class='glyphicon glyphicon-list'></span> Read events";
update_event_html+="</div>";
    
// build 'update event' html form
// we used the 'required' html5 property to prevent empty fields
update_event_html+="<form id='update-event-form' action='#' method='post' border='0'>";
    update_event_html+="<table class='table table-hover table-responsive table-bordered'>";
 
       // organizations 'select' field
        update_event_html+="<tr>";
        update_event_html+="<td>Organizer Name</td>";
        update_event_html+="<td>" + organizations_options_html + "</td>";
        update_event_html+="</tr>";



        // Event Title field
        update_event_html+="<tr>";
            update_event_html+="<td>Event Title</td>";
            update_event_html+="<td><input value='" + title + "' type='text' name='title' class='form-control' required /></td>";
        update_event_html+="</tr>";

        // description field
        update_event_html+="<tr>";
            update_event_html+="<td>Description</td>";
            update_event_html+="<td><textarea name='description' class='form-control' required>" + description + "</textarea></td>";
        update_event_html+="</tr>";
 
        // Email field
        update_event_html+="<tr>";
            update_event_html+="<td>Email</td>";
            update_event_html+="<td><input value='" + email + "' type='text'  name='email' class='form-control' required /></td>";
        update_event_html+="</tr>";
 
        // Phone field
        update_event_html+="<tr>";
            update_event_html+="<td>Phone</td>";
            update_event_html+="<td><input value='" + phone + "' type='text'  name='phone' class='form-control' required /></td>";
        update_event_html+="</tr>";
        
        
 
        update_event_html+="<tr>";
 
            // hidden 'event id' to identify which record to delete
            update_event_html+="<td><input value='" + id + "' name='id' type='hidden' /></td>";
 
            // button to submit form
            update_event_html+="<td>";
                update_event_html+="<button type='submit' class='btn btn-info'>";
                    update_event_html+="<span class='glyphicon glyphicon-edit'></span> Update event";
                update_event_html+="</button>";
            update_event_html+="</td>";
 
        update_event_html+="</tr>";
 
    update_event_html+="</table>";
update_event_html+="</form>";


// inject to 'page-content' of our app
$("#page-content").html(update_event_html);
 
// chage page title
changePageTitle("Update Event");

});
});


    });
     
    // will run if 'create event' form was submitted
$(document).on('submit', '#update-event-form', function(){
     
    // get form data
var form_data=JSON.stringify($(this).serializeObject());

// submit form data to api
$.ajax({
    url: "http://localhost/Yietapi/event/update.php",
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