/**
 * jQuery example of a slide out for the example category tree
 */

$('.filteroptions').addClass('hide');

$('.filteroptions').each(function() {
		var $listId = $(this).attr('id');
		$('#' + $listId + ' li').each(function() {
			if ($(this).hasClass('selected')) {
			$('#' + $listId).removeClass('hide');
			$('#' + $listId).addClass('active');
			return false;
		}
	});
});

$('.filteroptions.hide').hide();

$('.label').click(function(event) {
	event.preventDefault();
	var $id = '#' + $(this).attr('id');
	if ($($id + '+ ul.active').length) {
		$($id).removeClass('active');
		$($id + '+ ul').slideUp('slow').removeClass('active');
	} else {
		$($id).addClass('active');
		$($id + '+ ul').slideDown('slow').addClass('active');
	}
});