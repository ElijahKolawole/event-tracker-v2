$(document).ready(function(){
 
    // show html form when 'create slot' button was clicked
    $(document).on('click', '.create-slot-button', function(){
        // load list of events
$.getJSON("http://localhost/Yietapi/event/read.php", function(data){

// build events option html
// loop through returned list of data
var events_options_html="";
events_options_html+="<select name='event_id' class='form-control'>";
$.each(data.records, function(key, val){
    events_options_html+="<option value='" + val.id + "'>" + val.name + "</option>";
});
events_options_html+="</select>";

// we have our html form here where slot information will be entered
// we used the 'required' html5 property to prslot empty fields
var create_slot_html="";
 
// 'read slots' button to show list of slots
create_slot_html+="<div id='read-slots' class='btn btn-primary pull-right m-b-15px read-slots-button'>";
    create_slot_html+="<span class='glyphicon glyphicon-list'></span> Read slots";
create_slot_html+="</div>";

// 'create slot' html form
create_slot_html+="<form id='create-slot-form' action='#' method='post' border='0'>";
    create_slot_html+="<table class='table table-hover table-responsive table-bordered'>";

     // events 'select' field
     create_slot_html+="<tr>";
     create_slot_html+="<td>Event ID</td>";
     create_slot_html+="<td>" + events_options_html + "</td>";
    create_slot_html+="</tr>";
 
        
        // slot Title field
        create_slot_html+="<tr>";
            create_slot_html+="<td>Slot Title</td>";
            create_slot_html+="<td><input type='text'  name='title' class='form-control' required /></td>";
        create_slot_html+="</tr>";
 
        // description field
        create_slot_html+="<tr>";
            create_slot_html+="<td>Slot Description</td>";
            create_slot_html+="<td><textarea name='description' class='form-control' required></textarea></td>";
        create_slot_html+="</tr>";

        // Date field
        create_slot_html+="<tr>";
            create_slot_html+="<td>Date </td>";
            create_slot_html+="<td><input type='date' name='date' class='form-control' required /></td>";
        create_slot_html+="</tr>";
 
        // Start Time field
        create_slot_html+="<tr>";
            create_slot_html+="<td>Start Time </td>";
            create_slot_html+="<td><input type='time' name='starttime' class='form-control' required /></td>";
        create_slot_html+="</tr>";
 

         // End Time field
         create_slot_html+="<tr>";
            create_slot_html+="<td>End Time </td>";
            create_slot_html+="<td><input type='time' name='endtime' class='form-control' required /></td>";
         create_slot_html+="</tr>";

      // Min position field
      create_slot_html+="<tr>";
        create_slot_html+="<td>Min Position </td>";
        create_slot_html+="<td><input type='number' name='min' class='form-control' required /></td>";
        create_slot_html+="</tr>";

   // Max Position field
    create_slot_html+="<tr>";
        create_slot_html+="<td>Max Position </td>";
        create_slot_html+="<td><input type='number' name='max' class='form-control' required /></td>";
    create_slot_html+="</tr>";
 
       
 
        // button to submit form
        create_slot_html+="<tr>";
            create_slot_html+="<td></td>";
            create_slot_html+="<td>";
                create_slot_html+="<button type='submit' class='btn btn-primary'>";
                    create_slot_html+="<span class='glyphicon glyphicon-plus'></span> Create slot";
                create_slot_html+="</button>";
            create_slot_html+="</td>";
        create_slot_html+="</tr>";
 
    create_slot_html+="</table>";
create_slot_html+="</form>";


// inject html to 'page-content' of our app
$("#page-content").html(create_slot_html);
 
// chage page title
changePageTitle("Create Slot");
 
});
    });
 
    // will run if create slot form was submitted
$(document).on('submit', '#create-slot-form', function(){
    // get form data
var form_data=JSON.stringify($(this).serializeObject());
// submit form data to api
$.ajax({
    url: "http://localhost/Yietapi/slot/create.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result) {
        // slot was created, go back to slots list
        showslotsFirstPage();
    },
    error: function(xhr, resp, text) {
        // show error to console
        console.log(xhr, resp, text);
    }
});
 
return false;

});
});