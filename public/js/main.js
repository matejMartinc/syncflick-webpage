enquire.register("screen and (min-width:40em)", {
    match : function() {
        $( window ).scroll(function() {
            $(".header").css("top",$(window).scrollTop());
        });

    }
});      


function displayLoader() {
    $(".loader").css("visibility", "visible");
}

            

