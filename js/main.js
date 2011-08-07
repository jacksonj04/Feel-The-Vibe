function showHeatMap(e)
{
	e.preventDefault();
	
	$('#viewer').addClass('vibeson');
}

function hideHeatMap(e)
{
	e.preventDefault();
	
	$('#viewer').removeClass('vibeson');
}

function vibeUp(e)
{
	e.preventDefault();
	
	var para = $(this).data('paraid');
	
	var postid = $('#viewer').data('postid');
	
	$.ajax({
		type:	'POST',
		url:	'/ajax/vibeup',
		data:	'post='+postid+'&paragraph='+para,
		dataType: 'json'
	});
}

$(function(){

	$('#toggleHeatMap').toggle(hideHeatMap, showHeatMap);
	
	$('.vibe-up').bind('click', vibeUp);
	//$('.vibe-down').bind('click', vibeDown);

});