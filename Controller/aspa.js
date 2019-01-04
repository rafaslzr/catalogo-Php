$(document).on("ready", function() {
    $('#botonhamburg').on('click', function(e) {
        //if($('.navbar').css( {'display' : 'none'} )) {
            $("#button div").css({
                'border' : '5px solid rgba(0,100,0,1)',
                'border-radius' : '0%',
                'margin-left' : '0px',
                'margin-top' : '24px',
                'animation' : 'division 300ms linear 1',
                'width' : '75px',
                'top' : '0px',
                'height' : '0px' });
            $("#button div:nth-child(2)").css({
                'width' : '0px',
                'border' : '0px'});
            $("#button div:nth-child(3)").css({
                'transform' : 'rotate(45deg)'});
            $("#button div:nth-child(1)").css({
                'transform' : 'rotate(-45deg)'});
        //}
    });
    /*$('#botonhamburg').off('click', function(e) {
            $("#button div:nth-child(3)").css({
                'transform' : 'rotate(5deg)'});
    });*/
});
/*
 * $("#button").css({
                'width' : '70px',
                'height' : '70px',
                'transition' : 'all 300ms cubic-bezier(.61, .01, .42, 1)',
                'cursor' : 'pointer',
                'background' : 'transparent',
                'border' : '0px',

                'position' : 'absolute',
                'float' : 'right',
                'right' : '95px',
                'top' : '70px',
                'color' : 'red' });
            $("#button div").css({
                'height' : '0px',
                'border' : 'red',
                'width' : '75px',
                'display' : 'block',
                'position' : 'absolute',
                'transition' : 'all 300ms cubic-bezier(.61, .01, .42, 1)',
                'background' : 'rgba(0,100,0,1)' });
            $("#button div:nth-child(2)").css({
                'top' : '25px'});
            $("#button div:nth-child(3)").css({
                'top' : '50px'});
            $("#button div:nth-child(1)").css({
                'top' : '0px'});
 */