<h1 class="grid_12 margin_bottom">Create a New Page</h1>

<div class="grid_8">

	<?php
	
	if ($this->user->getcurrent()) {
	
		if ($error) : ?>
		<div class="error">
			<?php echo $error; ?>
		</div>
		<?php endif; ?>
		
		<?php if ($success) : ?>
		
		<div class="success">
			Awesome, you've created <a href="<?php echo $success; ?>"><?php echo $success; ?></a>
		</div>
		
		<?php elseif (isset($exists)) : ?>
		
		<h2>We've done this already!</h2>
		
		<p>There is already at least one version of this document which is being commented on. We strongly recommend you use one of these, but if you really want to you can create a whole new copy (for example if the text on the page has changed substantially.</p>
		
		<ul>
		
		<?php
		
			foreach ($exists->result() as $existing){
			
				$count_comments = $this->db->where('post_id', $existing->post_id)->get('comments');
				$count_vibes = $this->db->where('post_id', $existing->post_id)->get('vibes');
			
				echo '<li><b><a href="' . site_url($existing->series_id) . '">' . $existing->title . '</a></b> retrieved ' . date('l jS F, g.ia', $existing->generated) . '<br>' . $count_comments->num_rows() . ' comments, ' . $count_vibes->num_rows() . ' vibes.</li>';
			}
		
		?>
		
		</ul>
		
		<p>Not what you're after? Click the button!</p>
		
		<?php echo form_open(''); ?>

					<input type="hidden" id="url" name="url" value = "<?php echo $url; ?>">
					<input type="hidden" id="forceparse" name="forceparse" value = "forceparse">
				
				<p>
					<input type="submit" value="Create a new copy" name="create" id="create">
				</p>
			</form>
			
			<?php echo form_close(); ?>
		
		<?php else: ?>
		
			<p>Tell us the address of the page you want to make commentable, then relax whilst we do some magic. Your page will be with you in a few seconds.</p>
		
			<?php echo form_open(''); ?>
			
				<p>
					<label for="submiturl" class="visuallyhidden">Enter a URL</label>
					<input type="url" id="submiturl" name="url" placeholder="Enter a URL here…" class="text">
					<input type="submit" value="Make this page commentable!" name="create" id="create">
				</p>
				
			</form>
			
			<?php echo form_close(); ?>
					
		<?php endif;
		
	}else{
	
		// There is no signed in user. Tell the person to sign the hell in.
		
		echo '<p>It\'s great that you want to start commenting on something, but first of all we need to know who you are. Please sign in (using Twitter, no more accounts necessary, and we don\'t even tweet from your account) and we can get started!</p>
		
			<p><a href="' . site_url('signin') . '"><img src="' . base_url() . 'img/signin.png" title="Sign in with Twitter"></a></p>';
	
	}
	
	?>

</div>

<div class="grid_4 last">

	<?php if ($this->user->getcurrent()):	?>
	
	<div class="box bg_light">
		
		<h3>Want to make it even easier?</h3>
		
		<p>Drag our bookmarklet to your bookmarks bar!</p>
			
		<p>
			<a class="button" href="javascript:(function(){var FTVForm=document.createElement('form');FTVForm.setAttribute('method','post');FTVForm.setAttribute('action','http://feelthevi.be/create');var FTVFieldURL=document.createElement('input');FTVFieldURL.setAttribute('type','hidden');FTVFieldURL.setAttribute('name','url');FTVFieldURL.setAttribute('value',window.location);FTVForm.appendChild(FTVFieldURL);var FTVFieldCreate=document.createElement('input');FTVFieldCreate.setAttribute('type','hidden');FTVFieldCreate.setAttribute('name','create');FTVFieldCreate.setAttribute('value','Create');FTVForm.appendChild(FTVFieldCreate);document.body.appendChild(FTVForm);FTVForm.submit();})()" title="feelthevi.be">Drag Me!</a>
		</p>
		
	</div>
	
	<?php
	endif;
	?>
	
</div>