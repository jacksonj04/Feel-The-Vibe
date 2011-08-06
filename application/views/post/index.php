<div class="grid_12">
	<h1><?php echo $title; ?></h1>
</div>

<div class="grid_8" id="viewer"> 
	
	<pre>
	
	<?php print_r($paragraphs); ?>
	
	</pre>
	
	<?php
	
	// Loop through all our incoming tags
	
	foreach ($paragraphs[1] as $paragraph_id => $paragraph_tag){
		echo '<' . $paragraph_tag . ' id="para_' . $paragraph_id . '">' . $paragraphs[2][$paragraph_id] . '</' . $paragraph_tag . '>';
	}
	
	?>
	
</div> 

<aside class="grid_4 last"> 
	
	<div class="box bg_contrast"> 
	
		<h3>Comments Plz!</h3>
		
		<?php
		
		if ($this->tweet->logged_in()){
			echo '<p>We don\'t yet have any comments on this page. To leave yours just click on the paragraph which sparked your thoughts.</p>';
		}else{
			echo '<p>We don\'t yet have any comments on this page. To leave yours you\'ll first need to <a href="' . site_url('signin') . '">sign in</a>.</p>';
		}
		
		?>
	
	</div>
			
</aside>