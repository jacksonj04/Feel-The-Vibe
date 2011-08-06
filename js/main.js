function showHeatMap(e)
{
	e.preventDefault();
	
	$('.para').each(function(i){
	
		var vibe = $(this).data('vibe');
		
		$(this).addClass('vibe'+vibe);
	
	});
}

function hideHeatMap(e)
{
	e.preventDefault();
	
	$('.vibe3,.vibe2,.vibe1,.vibe-1,.vibe-2,.vibe-3').removeClass('vibe3 vibe2 vibe1 vibe-1 vibe-2 vibe-3');
}

$(function(){

	$('#toggleHeatMap').toggle(showHeatMap, hideHeatMap);

});