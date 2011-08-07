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
	
	$('#para_'+para).addClass('vibegivenup');
	$('#para_'+para).removeClass('vibegivendown');
	
	var postid = $('#viewer').data('postid');
	
	$.ajax({
		type:	'POST',
		url:	'/ajax/vibeup',
		data:	'post='+postid+'&paragraph='+para,
		dataType: 'json'
	});
}

function vibeDown(e)
{
	e.preventDefault();
	
	var para = $(this).data('paraid');
	
	$('#para_'+para).addClass('vibegivendown');
	$('#para_'+para).removeClass('vibegivenup');
	
	var postid = $('#viewer').data('postid');
	
	$.ajax({
		type:	'POST',
		url:	'/ajax/vibedown',
		data:	'post='+postid+'&paragraph='+para,
		dataType: 'json'
	});
}

$(function(){

	$('#toggleHeatMap').toggle(hideHeatMap, showHeatMap);
	
	$('.vibe-up').bind('click', vibeUp);
	$('.vibe-down').bind('click', vibeDown);
	
	if ($('#allcommentcontainer').length == 1)
	{
		$('#allcommentcontainer').accordion({ autoHeight: false });
	}
	
	// Click on paragraph to expand comment accordion
	$('.para').click(function(){
		var id = $(this).attr('id');
		$('#'+id+'_comments').click();
		window.location.href = window.location.href + '#para_' + id;
	});

});