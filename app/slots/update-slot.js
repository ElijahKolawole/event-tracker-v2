$(document).ready(function(){
 
    // show html form when 'update slot' button was clicked
    $(document).on('click', '.update-slot-button', function(){
        // get slot id
var id = $(this).attr('data-id');

// read one record based on given slot id
$.getJSON("http://localhost/Yietapi/slot/read_one.php?id=" + id, function(data){
 
    // values will be used to fill out our form
    var event_id = data.event_id;
    var title = data.title;
   var description = data.description;
   var date = data.date;

   var starttime = data.starttime;
   var endtime = data.endtime;
   var min = data.min;
   var max = data.max;

   
     
    // load list of events
$.getJSON("http://localhost/Yietapi/organizer/read.php", function(data){
 
    // build 'events option' html
    // loop through returned list of data
    var events_options_html="";
   events_options_html+="<select name='event_id' class='form-control'>";
 
    $.each(data.records, function(key, val){
         
        // pre-select option is organizer id is the same
        if(val.id==event_id){
           events_options_html+="<option value='" + val.id + "' selected>" + val.name + "</option>";
        }
 
        else{
           events_options_html+="<option value='" + val.id + "'>" + val.name + "</option>";
        }
    });
   events_options_html+="</select>";
     
   // store 'update slot' html to this variable
var update_slot_html="";
 
// 'read slots' button to show list of slots
update_slot_html+="<div id='read-slots' class='btn btn-primary pull-right m-b-15px read-slots-button'>";
    update_slot_html+="<span class='glyphicon glyphicon-list'></span> Read slots";
update_slot_html+="</div>";
    
// build 'update slot' html form
// we used the 'required' html5 property to prslot empty fields
update_slot_html+="<form id='update-slot-form' action='#' method='post' border='0'>";
    update_slot_html+="<table class='table table-hover table-responsive table-bordered'>";
 
       // events 'select' field
        update_slot_html+="<tr>";
        update_slot_html+="<td>Event Name</td>";
        update_slot_html+="<td>" + events_options_html + "</td>";
        update_slot_html+="</tr>";



        // slot Title field
        update_slot_html+="<tr>";
            update_slot_html+="<td>slot Title</td>";
            update_slot_html+="<td><input value='" + title + "' type='text' name='title' class='form-control' required /></td>";
        update_slot_html+="</tr>";

        // description field
        update_slot_html+="<tr>";
            update_slot_html+="<td>Description</td>";
            update_slot_html+="<td><textarea name='description' class='form-control' required>" + description + "</textarea></td>";
        update_slot_html+="</tr>";


        // date field
        update_slot_html+="<tr>";
            update_slot_html+="<td>Date</td>";
            update_slot_html+="<td><textarea name='date' class='form-control' required>" + date + "</textarea></td>";
        update_slot_html+="</tr>";
 
        // starttime field
        update_slot_html+="<tr>";
            update_slot_html+="<td>starttime</td>";
            update_slot_html+="<td><input value='" + starttime + "' type='text'  name='starttime' class='form-control' required /></td>";
        update_slot_html+="</tr>";
 
        // endtime field
        update_slot_html+="<tr>";
            update_slot_html+="<td>endtime</td>";
            update_slot_html+="<td><input value='" + endtime + "' type='text'  name='endtime' class='form-control' required /></td>";
        update_slot_html+="</tr>";
        

        // min field
        update_slot_html+="<tr>";
            update_slot_html+="<td>Min Position</td>";
            update_slot_html+="<td><input value='" + min + "' type='text'  name='min' class='form-control' required /></td>";
        update_slot_html+="</tr>";


        // max field
        update_slot_html+="<tr>";
            update_slot_html+="<td>Max Position</td>";
            update_slot_html+="<td><input value='" + max + "' type='text'  name='max' class='form-control' required /></td>";
        update_slot_html+="</tr>";
        
 
        update_slot_html+="<tr>";
 
            // hidden 'slot id' to identify which record to delete
            update_slot_html+="<td><input value='" + id + "' name='id' type='hidden' /></td>";
 
            // button to submit form
            update_slot_html+="<td>";
                update_slot_html+="<button type='submit' class='btn btn-info'>";
                    update_slot_html+="<span class='glyphicon glyphicon-edit'></span> Update slot";
                update_slot_html+="</button>";
            update_slot_html+="</td>";
 
        update_slot_html+="</tr>";
 
    update_slot_html+="</table>";
update_slot_html+="</form>";


// inject to 'page-content' of our app
$("#page-content").html(update_slot_html);
 
// chage page title
changePageTitle("Update slot");

});
});


    });
     
    // will run if 'create slot' form was submitted
$(document).on('submit', '#update-slot-form', function(){
     
    // get form data
var form_data=JSON.stringify($(this).serializeObject());

// submit form data to api
$.ajax({
    url: "http://localhost/Yietapi/slot/update.php",
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