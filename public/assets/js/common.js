$(document).ready(function(){
    // Remove .no-js
    $('html').removeClass('no-js');
    
    // Set the active class. This is done through js as it is a cosmetic effect.
    var INDEX_ROUTE = "/";
    var INDEX_ROUTE_MAPPING = "/about/";
    $.each($(".nav-container .nav li"), function(i){
        // Get the links inside the li.
        var a = $(this).find('a:first');
        // Check if the href target matches the window location
        if (a.length > 0 && (a[0].pathname == window.location.pathname || (window.location.pathname == INDEX_ROUTE && a[0].pathname == INDEX_ROUTE_MAPPING))){
            // add .active to the li
            $(this).addClass('active');
        }
    });

    // Set the active class for side-navigation.
    $.each($(".side-navigation a"), function(i){
        // Check if the href target matches the window location
        if (this.pathname == window.location.pathname || (window.location.pathname == INDEX_ROUTE && this.pathname == INDEX_ROUTE_MAPPING)){
            $(this).addClass('active');
        }
    });

})
