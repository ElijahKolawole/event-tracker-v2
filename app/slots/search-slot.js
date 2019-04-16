$(document).ready(function(){
 
    // when a 'search slots' button was clicked
    $(document).on('submit', '#search-slot-form', function(){
 
        // get search keywords
        var keywords = $(this).find(":input[name='keywords']").val();
 
        // get data from the api based on search keywords
        $.getJSON("http://localhost/api/slot/search.php?s=" + keywords, function(data){
 
            // template in slots.js
            readslotsTemplate(data, keywords);
 
            // chage page title
            changePageTitle("Search slots: " + keywords);
 
        });
 
        // prevent whole page reload
        return false;
    });
 
});