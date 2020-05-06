$(function() {
  $('.spoiler-toggle').click(function(e) {
    e.preventDefault();
    $(this).parent().toggleClass('open');
  })
});

$('body').on('shown.bs.modal', '.modal', function() {	//Lo mismo pero adentro del modal
	$('.spoiler-toggle').click(function(e) {
		e.preventDefault();
		$(this).parent().toggleClass('open');
	  })
});