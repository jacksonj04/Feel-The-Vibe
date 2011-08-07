/*
 * jQuery hashchange event - v1.3 - 7/21/2010
 * http://benalman.com/projects/jquery-hashchange-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($,e,b){var c="hashchange",h=document,f,g=$.event.special,i=h.documentMode,d="on"+c in e&&(i===b||i>7);function a(j){j=j||location.href;return"#"+j.replace(/^[^#]*#?(.*)$/,"$1")}$.fn[c]=function(j){return j?this.bind(c,j):this.trigger(c)};$.fn[c].delay=50;g[c]=$.extend(g[c],{setup:function(){if(d){return false}$(f.start)},teardown:function(){if(d){return false}$(f.stop)}});f=(function(){var j={},p,m=a(),k=function(q){return q},l=k,o=k;j.start=function(){p||n()};j.stop=function(){p&&clearTimeout(p);p=b};function n(){var r=a(),q=o(m);if(r!==m){l(m=r,q);$(e).trigger(c)}else{if(q!==m){location.href=location.href.replace(/#.*/,"")+q}}p=setTimeout(n,$.fn[c].delay)}$.browser.msie&&!d&&(function(){var q,r;j.start=function(){if(!q){r=$.fn[c].src;r=r&&r+a();q=$('<iframe tabindex="-1" title="empty"/>').hide().one("load",function(){r||l(a());n()}).attr("src",r||"javascript:0").insertAfter("body")[0].contentWindow;h.onpropertychange=function(){try{if(event.propertyName==="title"){q.document.title=h.title}}catch(s){}}}};j.stop=k;o=function(){return a(q.location.href)};l=function(v,s){var u=q.document,t=$.fn[c].domain;if(v!==s){u.title=h.title;u.open();t&&u.write('<script>document.domain="'+t+'"<\/script>');u.close();q.location.hash=v}}})();return j})()})(jQuery,this);

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

function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

function prependComment(para, comment, user)
{
	$('#commentwindow_'+para).prepend('<div class="comment clearfix"><a href="#" class="avatar"><img src="http://img.tweetimag.es/i/'+user+'_m" /></a><article><aside><a href="http://twitter.com/'+user+'">@'+user+'</a> said:</aside>'+htmlEntities(comment)+'</article></div>');
}

function addNewComment(e)
{
	e.preventDefault();

	var para = $(this).data('paraid');
	var comment = $('#para_newcomment_'+para).val();
	var postid = $('#viewer').data('postid');
	
	$.ajax({
		type:	'POST',
		url:	'/ajax/comment',
		data:	'post='+postid+'&paragraph='+para+'&text='+ encodeURI(comment),
		dataType: 'json',
		success: function(resp)
			{
				if (resp.message == 'Comment added!')
				{
					prependComment(para, comment, resp.twitter);
				}
				
				else
				{
					alert(resp.error);
				}
			},
		error: function()
			{
				alert('Ooops, unable to add comment due to transport error');
			}
	});
}

function addAnotherURL()
{
	$('#addanother').before('<p class="inputwrapper"><input type="url" name="multiurl[]" placeholder="Enter a URL here…" class="text"></p>');
}

$(function(){
	
	// Fake a click when the hash changes
	$(window).hashchange(function(){
		$(location.hash).click();
	});
	
	// Scroll the comments container automatically + trigger hash change on page load
	$(window).bind('scroll', function(){
		
		if (window.pageYOffset > 180)
		{
			$('#commentscontainer').stop().animate({'top':'20px'});
		}
		
		else
		{
			$('#commentscontainer').stop().animate({'top':'260px'});
		}
		
	}).hashchange();
	
	// Move comments window on load
	if (window.pageYOffset > 180)
	{
		$('#commentscontainer').stop().animate({'top':'20px'});
	}
	
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
		
		if (location.hash !== '#'+id)
		{
			
			window.location.href = window.location.protocol + '//' + window.location.hostname + window.location.pathname + '#' + id;
		}
	});
	
	// Add a comment
	$('.addnewcomment').bind('click', addNewComment);
	
	// Add another multi url
	$('#addanother').bind('click', addAnotherURL);


});