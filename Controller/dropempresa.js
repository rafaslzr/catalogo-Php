$(document).on("ready", function() {
    $('#botonempresa').on('click', function(e) {
        if ($('#mapa').is( ":hidden" )) {
            $("#empresa").slideToggle("slow").next();
            $(this).find('#empresa').slideUp("slow").end();
        } else {
            $("#mapa").slideToggle("slow").next();
            $("#empresa").slideToggle("slow").next();
        }
    });
});