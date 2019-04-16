$(document).ready(function(){
 
    // show list of product on first load
    showEventsFirstPage();
    
 
    // when a 'read Events' button was clicked
    $(document).on('click', '.read-events-button', function(){
        showEventsFirstPage();
    });
 
    // when a 'page' button was clicked
    $(document).on('click', '.pagination li', function(){
        // get json url
        var json_url=$(this).find('a').attr('data-page');
 
        // show list of Events
        showEvents(json_url);
    });
 
 
});
 
function showEventsFirstPage(){
    var json_url="http://localhost/Yietapi/event/read_paging.php";
    showEvents(json_url);
}
 
// function to show list of Events
function showEvents(json_url){
 
    // get list of Events from the API
    $.getJSON(json_url, function(data){
 
        // html for listing Events
        readEventsTemplate(data, "");
 
        // chage page title
        changePageTitle("Read Events");
 
    });
}