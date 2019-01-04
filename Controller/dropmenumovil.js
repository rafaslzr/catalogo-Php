$(document).on("ready", function() {
    $("#botonhamburg").on('click', function(e) {

            $(".navbar").slideToggle("slow").next();
            $(this).find('#mapa').slideUp("slow").end();



    });
});

