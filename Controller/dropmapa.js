$(document).on("ready", function() {
    $('#botonmapa').on('click', function(e) {
        if ($('#empresa').is( ":hidden" )) {
            $("#mapa").slideToggle("slow").next();
            $(this).find('#mapa').slideUp("slow").end();
        } else {
            $("#empresa").slideToggle("slow").next();
            $("#mapa").slideToggle("slow").next();
        }
    });
});