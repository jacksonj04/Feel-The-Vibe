<div class="grid_12">
	<h1><?php echo $title; ?></h1>
</div>

<div class="grid_8" id="viewer" data-postid="<?php echo $post_id; ?>"> 
	
	<?php
	
	// Loop through all our incoming tags
	
	foreach ($paragraphs[1] as $paragraph_id => $paragraph_tag){
	
		// Get any vibes for the paragraph
		$paragraph_vibes = $this->db->where('post_id',$post_id)->where('paragraph', $paragraph_id)->get('vibes');
		
		// Reset classes
		$paragraph_classes = array();
		
		// Reset vibe
		$paragraph_vibe = 0;
		
		foreach ($paragraph_vibes->result() as $vibe){
			if ($vibe->vibe == 'up'){
				$paragraph_vibe++;
			}elseif ($vibe->vibe == 'down'){
				$paragraph_vibe--;
			}
		}
		
		// Cap values
		if ($paragraph_vibe > 3){
			$paragraph_vibe = 3;
		}
		
		if ($paragraph_vibe < -3){
			$paragraph_vibe = -3;
		}
		
		$data_vibe = 'vibe' . (string) $paragraph_vibe;
		$paragraph_classes[] = $data_vibe;
	
		// Output the tag with all relevant classes and stuff
		echo '<' . $paragraph_tag . ' data-vibe="'.$data_vibe.'" id="para_' . $paragraph_id . '" class="para ' . implode(' ', $paragraph_classes) . '">' . $paragraphs[2][$paragraph_id] . '<span class="sharevibe"><a href="#" class="vibe-up" title="I\'m feeling this!"></a><a href="#" title="I\'m not feeling this!" class="vibe-down"></a></span>
		</' . $paragraph_tag . '>';
	}
	
	?>
	
</div> 

<aside class="grid_4 last"> 

	<div class="box bg_light">
		
		<table>
			<tbody>
				<tr>
					<th scope="row">Original Page</th>
					<td><a href="<?php echo $cap_url; ?>"><?php $this->load->helper('text'); echo ellipsize($cap_url,25,0.75); ?></a></td>
				</tr>
				<tr>
					<th scope="row">Captured On</th>
					<td><?php echo date('D j M, g.ia', $cap_time); ?></td>
				</tr>
				<tr>
					<th scope="row">Captured By</th>
					<td><?php echo $cap_user; ?></td>
				</tr>
				<tr>
					<th scope="row">Short Link</th>
					<td><a href="<?php echo $shorturl; ?>"><?php echo $shorturl; ?></a></td>
				</tr>
			</tbody>
		</table>
			
	</div>
	
	<div class="box bg_light">
		<p>
			I'm a floaty comment box!
		</p>
		
		<p>
			<a href="#" id="toggleHeatMap">Toggle vibe heat map
		</p>
	</div>
	
	<?php
	
	if ($comments->num_rows() == 0){
	
		// No comments. Throw up a comment promo box.
	
		echo '<div class="box bg_contrast"> 
		
			<h3>Comments Plz!</h3>';
			
			if ($this->tweet->logged_in()){
				echo '<p>We don\'t yet have any comments on this page. To leave yours just click on the paragraph which sparked your thoughts.</p>';
			}else{
				echo '<p>We don\'t yet have any comments on this page. To leave yours you\'ll first need to <a href="' . site_url('signin') . '">sign in</a>.</p>';
			}
		
		echo '</div>';
		
	}else{
	
		echo '<div style="position:relative">';
	
		foreach ($comments->result() as $comment){
		
			echo '<div id="comment' . $comment->comment_id . '" data-paragraph="' . $comment->paragraph . '" class="comment box bg_light"> 
		
			<p>' . $comment->text . '</p>
			
			</div>';
		
		}
		
		echo '</div>';
		
	}
	
	?>
			
</aside>