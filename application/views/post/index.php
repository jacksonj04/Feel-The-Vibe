<div class="grid_12">
	<h1><?php echo $title; ?></h1>	
</div>

<div class="grid_8 vibeson" id="viewer" data-postid="<?php echo $post_id; ?>">

	<?php
	
	if (!$this->user->getcurrent()) {
		echo '<div class="box bg_contrast"><p>Want to share your vibes and comment on this? <a href="' . site_url('signin') . '">Sign in</a>!</p></div>';
	}
	
	?>

	
	<?php
	
	// Loop through all our incoming tags
	$num_paragraphs = count($paragraphs[1]);
	foreach ($paragraphs[1] as $paragraph_id => $paragraph_tag)
	{
	
		// Get any vibes for the paragraph
		$paragraph_vibes = $this->db->where('post_id',$post_id)->where('paragraph', $paragraph_id)->get('vibes');
		
		// Reset classes
		$paragraph_classes = array();
		
		// If there's a current user *get their vibe*
		if ($user = $this->user->getcurrent()){
			$user_vibe = $this->db->where('post_id',$post_id)->where('paragraph', $paragraph_id)->where('user_id', $user->user_id)->get('vibes');
			if ($user_vibe->num_rows() == 1){
				$vibe_given = $user_vibe->row();
				$paragraph_classes[] = 'vibegiven' . $vibe_given->vibe;
			}
		}
		
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
		echo '<' . $paragraph_tag . ' data-vibe="'.$data_vibe.'" id="para_' . $paragraph_id . '" class="para ' . implode(' ', $paragraph_classes) . '">' . $paragraphs[2][$paragraph_id];
		
		if ($this->user->getcurrent()){
			echo '<span class="sharevibe">
					<a href="#" class="vibe-up" data-paraid="'.$paragraph_id.'" title="I\'m feeling this!"></a>
					<a href="#" title="I\'m not feeling this!" data-paraid="'.$paragraph_id.'" class="vibe-down"></a>
				</span>';
		}
		
		echo '</' . $paragraph_tag . '>';
	}
	
	?>
	
</div> 

<aside class="grid_4 last"> 

	<div class="box bg_light" hidden>
		
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
					<td><a href="http://twitter.com/<?php echo $cap_user_details->twitter; ?>"><?php echo $cap_user_details->name; ?></a></td>
				</tr>
				<tr>
					<th scope="row">Short Link</th>
					<td><a href="<?php echo $shorturl; ?>"><?php echo $shorturl; ?></a></td>
				</tr>
				<tr>
					<th scope="row">Display Vibes</th>
					<td><a href="#" id="toggleHeatMap">On/Off</td>
				</tr>
			</tbody>
		</table>
			
	</div>
	
	<div class="box bg_light" id="commentscontainer">
		
		<div id="allcommentcontainer">
		
			<h3><a href="#">General Comments</a></h3>
			<div>
				
				<?php if ($this->user->getcurrent()): ?>
					
					<form method="post">
			
						<p>
							<label for="newcomment">Add your comment</label><br>
							<textarea name="newcomment" class="newcomment"></textarea>
							<input type="submit" value="Add comment" class="addnewcomment" name="addnewcomment">
						</p>
					
					</form>
					
					<?php else: ?>
					
					<h3>Sign In</h3>
			
					<p>Oh no, you're not signed in yet!</p>
			
					<p>
						<a href="<?php echo site_url('signin'); ?>">
							<img src="<?php echo base_url() . 'img/signin.png'; ?>" title="Sign in with Twitter">
						</a>
					</p>
					
					<?php endif; ?>
				
				<div class="newcommentcontainer">

					<div class="commentwindow">
					
					</div>
					
				</div>

			
			</div>
			
			<?php $i = 0; while ($i !== $num_paragraphs): ?>
			
				<h3><a href="#" id="para_<?php echo $i; ?>_comments">Paragraph <?php echo ($i+1); ?></a></h3>
				<div>
					
					<?php if ($this->user->getcurrent()): ?>
					
					<form method="post">
			
						<p>
							<label for="newcomment">Add your comment</label><br>
							<textarea name="newcomment" class="newcomment"></textarea>
							<input type="submit" value="Add comment" class="addnewcomment" name="addnewcomment">
						</p>
					
					</form>
					
					<?php else: ?>
					
					<h3>Sign In</h3>
			
					<p>Oh no, you're not signed in yet!</p>
			
					<p>
						<a href="<?php echo site_url('signin'); ?>">
							<img src="<?php echo base_url() . 'img/signin.png'; ?>" title="Sign in with Twitter">
						</a>
					</p>
					
					<?php endif; ?>
					
					<div class="newcommentcontainer">
	
						<div class="commentwindow">
						
						</div>
						
					</div>
					
				</div>
						
			<?php $i++; endwhile; ?>
		
		</div>
		
	</div>
				
</aside>