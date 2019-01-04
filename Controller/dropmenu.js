$(document).on("ready", function() {
	$('ul li:has(ul)').on('click', function(e) {
		$(".dropdown-menu").not($("ul", this)).slideUp("fast")
		.next();
		$(this).find('ul').slideToggle("fast")
		.end();
            
	});
});