// event list html
function readEventsTemplate(data, keywords){
 
    // html for listing events
var read_events_html="";


 // search events form
 read_events_html+="<form id='search-event-form' action='#' method='post'>";
 read_events_html+="<div class='input-group pull-left w-30-pct'>";

     read_events_html+="<input type='text' value=\"" + keywords + "\" name='keywords' class='form-control event-search-keywords' placeholder='Search events...' />";

     read_events_html+="<span class='input-group-btn'>";
         read_events_html+="<button type='submit' class='btn btn-default' type='button'>";
             read_events_html+="<span class='glyphicon glyphicon-search'></span>";
         read_events_html+="</button>";
     read_events_html+="</span>";

 read_events_html+="</div>";
 read_events_html+="</form>";
 
// when clicked, it will load the create event form
read_events_html+="<div id='create-event' class='btn btn-primary pull-right m-b-15px create-event-button'>";
    read_events_html+="<span class='glyphicon glyphicon-plus'></span> Create Event";
read_events_html+="</div>";

// start table
read_events_html+="<table class='table table-bordered table-hover'>";
 
    // creating our table heading
    read_events_html+="<tr>";
        read_events_html+="<th class='w-3-pct'>id</th>";
       // read_events_html+="<th class='w-5-pct'>organization_id</th>";
        read_events_html+="<th class='w-5-pct'>title</th>";
        read_events_html+="<th class='w-15-pct'>description</th>";
        read_events_html+="<th class='w-15-pct'>email</th>";
        read_events_html+="<th class='w-10-pct'>phone</th>";
        read_events_html+="<th class='w-15-pct'>org_name</th>";

        read_events_html+="<th class='w-45-pct text-align-center'>Action</th>";
    read_events_html+="</tr>";
     
  // loop through returned list of data
$.each(data.records, function(key, val) {
 
    // creating new table row per record
    read_events_html+="<tr>";
 
        read_events_html+="<td>" + val.id + "</td>";
      //  read_events_html+="<td>" + val.organization_id + "</td>";
        read_events_html+="<td>" + val.title + "</td>";
        read_events_html+="<td>" + val.description + "</td>";
        read_events_html+="<td>" + val.email + "</td>";
        read_events_html+="<td>" + val.phone + "</td>";
        read_events_html+="<td>" + val.org_name + "</td>";


        // 'action' buttons
        read_events_html+="<td>";
            // read one event button
            read_events_html+="<button class='btn btn-primary m-r-10px read-one-event-button' data-id='" + val.id + "'>";
                read_events_html+="<span class='glyphicon glyphicon-eye-open'></span> Read";
            read_events_html+="</button>";
 
            // edit event button
            read_events_html+="<button class='btn btn-info m-r-10px update-event-button' data-id='" + val.id + "'>";
                read_events_html+="<span class='glyphicon glyphicon-edit'></span> Edit Event";
            read_events_html+="</button>";

             // edit slot button
             read_events_html+="<button class='btn btn-warning m-r-10px update-slot-button' data-id='" + val.id + "'>";
             read_events_html+="<span class='glyphicon glyphicon-edit'></span> Edit Slot";
         read_events_html+="</button>";
 
            // delete button
            read_events_html+="<button class='btn btn-danger delete-event-button' data-id='" + val.id + "'>";
                read_events_html+="<span class='glyphicon glyphicon-remove'></span> Delete";
            read_events_html+="</button>";
        read_events_html+="</td>";
 
    read_events_html+="</tr>";
 
});
 
// end table
read_events_html+="</table>";
// pagination
if(data.paging){
    read_events_html+="<ul class='pagination pull-left margin-zero padding-bottom-2em'>";
 
        // first page
        if(data.paging.first!=""){
            read_events_html+="<li><a data-page='" + data.paging.first + "'>First Page</a></li>";
        }
 
        // loop through pages
        $.each(data.paging.pages, function(key, val){
            var active_page=val.current_page=="yes" ? "class='active'" : "";
            read_events_html+="<li " + active_page + "><a data-page='" + val.url + "'>" + val.page + "</a></li>";
        });
 
        // last page
        if(data.paging.last!=""){
            read_events_html+="<li><a data-page='" + data.paging.last + "'>Last Page</a></li>";
        }
    read_events_html+="</ul>";
}

// inject to 'page-content' of our app
$("#page-content").html(read_events_html);

}