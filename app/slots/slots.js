
// slot list html
function readSlotsTemplate(data, keywords){
 
    // html for listing slots
var read_slots_html="";


 // search slots form
 read_slots_html+="<form id='search-slot-form' action='#' method='post'>";
 read_slots_html+="<div class='input-group pull-left w-30-pct'>";

     read_slots_html+="<input type='text' value=\"" + keywords + "\" name='keywords' class='form-control slot-search-keywords' placeholder='Search slots...' />";

     read_slots_html+="<span class='input-group-btn'>";
         read_slots_html+="<button type='submit' class='btn btn-default' type='button'>";
             read_slots_html+="<span class='glyphicon glyphicon-search'></span>";
         read_slots_html+="</button>";
     read_slots_html+="</span>";

 read_slots_html+="</div>";
 read_slots_html+="</form>";
 
// when clicked, it will load the create slot form
read_slots_html+="<div id='create-slot' class='btn btn-primary pull-right m-b-15px create-slot-button'>";
    read_slots_html+="<span class='glyphicon glyphicon-plus'></span> Create slot";
read_slots_html+="</div>";

// start table
read_slots_html+="<table class='table table-bordered table-hover'>";
 
    // creating our table heading
    read_slots_html+="<tr>";
        read_slots_html+="<th class='w-3-pct'>id</th>";
       // read_slots_html+="<th class='w-5-pct'>organization_id</th>";
        read_slots_html+="<th class='w-15-pct'>Event Name</th>";
        read_slots_html+="<th class='w-15-pct'>Job Title</th>";
        read_slots_html+="<th class='w-15-pct'>Job Description</th>";
        read_slots_html+="<th class='w-10-pct'>Date</th>";
        /*
        read_slots_html+="<th class='w-15-pct'>Job Start Time</th>";
        read_slots_html+="<th class='w-5-pct'>Job End Time</th>";
        read_slots_html+="<th class='w-5-pct'>Min Position</th>";
        read_slots_html+="<th class='w-5-pct'>Max Position</th>";
*/

        read_slots_html+="<th class='w-45-pct text-align-center'>Action</th>";
    read_slots_html+="</tr>";
     
  // loop through returned list of data
$.each(data.records, function(key, val) {
 
    // creating new table row per record
    read_slots_html+="<tr>";
 
        read_slots_html+="<td>" + val.id + "</td>";
      //  read_slots_html+="<td>" + val.organization_id + "</td>";
      read_slots_html+="<td>" + val.title + "</td>";

        read_slots_html+="<td>" + val.starttime + "</td>";
        read_slots_html+="<td>" + val.description + "</td>";
        read_slots_html+="<td>" + val.date + "</td>";
      //  read_slots_html+="<td>" + val.starttime + "</td>";
      //  read_slots_html+="<td>" + val.endtime + "</td>";
     //   read_slots_html+="<td>" + val.min + "</td>";
     //   read_slots_html+="<td>" + val.max + "</td>";


        // 'action' buttons
        read_slots_html+="<td>";
            // read one slot button
            read_slots_html+="<button class='btn btn-primary m-r-10px read-one-slot-button' data-id='" + val.id + "'>";
                read_slots_html+="<span class='glyphicon glyphicon-eye-open'></span> Read";
            read_slots_html+="</button>";


             // edit slot button
             read_slots_html+="<button class='btn btn-warning m-r-10px update-slot-button' data-id='" + val.id + "'>";
             read_slots_html+="<span class='glyphicon glyphicon-edit'></span> Update";
         read_slots_html+="</button>";
 
            // delete button
            read_slots_html+="<button class='btn btn-danger delete-slot-button' data-id='" + val.id + "'>";
                read_slots_html+="<span class='glyphicon glyphicon-remove'></span> Delete";
            read_slots_html+="</button>";
        read_slots_html+="</td>";
 
    read_slots_html+="</tr>";
 
});
 
// end table
read_slots_html+="</table>";
// pagination
if(data.paging){
    read_slots_html+="<ul class='pagination pull-left margin-zero padding-bottom-2em'>";
 
        // first page
        if(data.paging.first!=""){
            read_slots_html+="<li><a data-page='" + data.paging.first + "'>First Page</a></li>";
        }
 
        // loop through pages
        $.each(data.paging.pages, function(key, val){
            var active_page=val.current_page=="yes" ? "class='active'" : "";
            read_slots_html+="<li " + active_page + "><a data-page='" + val.url + "'>" + val.page + "</a></li>";
        });
 
        // last page
        if(data.paging.last!=""){
            read_slots_html+="<li><a data-page='" + data.paging.last + "'>Last Page</a></li>";
        }
    read_slots_html+="</ul>";
}

// inject to 'page-content' of our app
$("#page-content").html(read_slots_html);

}