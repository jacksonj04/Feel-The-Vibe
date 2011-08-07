function showHeatMap(e)
{
	e.preventDefault();
	
	$('.para').each(function(i){
	
		var vibe = $(this).data('vibe');
		
		$(this).addClass(vibe);
	
	});
}

function hideHeatMap(e)
{
	e.preventDefault();
	
	$('.vibe3,.vibe2,.vibe1,.vibe-1,.vibe-2,.vibe-3,.vibe0').removeClass('vibe0 vibe3 vibe2 vibe1 vibe-1 vibe-2 vibe-3');
}

function vibeUp(e)
{
	e.preventDefault();
	
	var para = $(this).parents().find('.para').attr('id');
	para = para.replace('para_');
	
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
	$('.vibe-down').bind('click', vibeDown);

});