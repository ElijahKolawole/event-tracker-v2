$(document).ready(function(){
 
    // when a 'search events' button was clicked
    $(document).on('submit', '#search-event-form', function(){
 
        // get search keywords
        var keywords = $(this).find(":input[name='keywords']").val();
 
        // get data from the api based on search keywords
        $.getJSON("http://localhost/Yietapi/event/search.php?s=" + keywords, function(data){
 
            // template in events.js
            readEventsTemplate(data, keywords);
 
            // chage page title
            changePageTitle("Search events: " + keywords);
 
        });
 
        // prevent whole page reload
        return false;
    });
 
});