$(document).ready(function(){
 
    // show list of product on first load
    showSlotsFirstPage();
    
 
    // when a 'read Slots' button was clicked
    $(document).on('click', '.read-slots-button', function(){
        showSlotsFirstPage();
    });
 
    // when a 'page' button was clicked
    $(document).on('click', '.pagination li', function(){
        // get json url
        var json_url=$(this).find('a').attr('data-page');
 
        // show list of Slots
        showSlots(json_url);
    });
 
 
});
 
function showSlotsFirstPage(){
    var json_url="http://localhost/Yietapi/slot/read_paging.php";
    showSlots(json_url);
}
 
// function to show list of Slots
function showSlots(json_url){
 
    // get list of Slots from the API
    $.getJSON(json_url, function(data){
 
        // html for listing Slots
        readSlotsTemplate(data, "");
 
        // chage page title
        changePageTitle("Read Slots");
 
    });
}