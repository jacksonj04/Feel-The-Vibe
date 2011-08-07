<div class="grid_12">
	
	<h1>Create a New Page</h1>

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
		
		<?php elseif ($exists) : ?>
		
		<h2>We've done this already!</h2>
		
		<p>There is already at least one version of this document which is being commented on. We strongly recommend you use one of these, but if you really want to you can create a whole new copy (for example if the text on the page has changed substantially.</p>
		
		<ul>
		
		<?php
		
			foreach ($exists->result() as $existing){
				echo '<li><a href="' . site_url($existing->series_id) . '">' . $existing->title . '</a> retrieved ' . date('l jS F, g.ia', $existing->generated) . '</li>';
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
		
			<?php echo form_open('', array('class'=>'box bg_light')); ?>
			
				<p class="inputwrapper">
					<label for="url">URL</label><br>
					<input type="url" id="url" name="url" placeholder="Enter a URL here…" class="text">
				</p>
				
				<p>
					<input type="submit" value="Parse the URL" name="create" id="create">
				</p>
			</form>
			
			<?php echo form_close(); ?>
			
			<p>Want to make it even easier? Drag our bookmarklet (below) to your bookmarks bar!</p>
			
			<p><a style="padding:5px;background:#666;color:white;border-radius:5px;" href="javascript:(function(){var FTVForm=document.createElement('form');FTVForm.setAttribute('method','post');FTVForm.setAttribute('action','http://feelthevi.be/create');var FTVFieldURL=document.createElement('input');FTVFieldURL.setAttribute('type','hidden');FTVFieldURL.setAttribute('name','url');FTVFieldURL.setAttribute('value',window.location);FTVForm.appendChild(FTVFieldURL);var FTVFieldCreate=document.createElement('input');FTVFieldCreate.setAttribute('type','hidden');FTVFieldCreate.setAttribute('name','create');FTVFieldCreate.setAttribute('value','Create');FTVForm.appendChild(FTVFieldCreate);document.body.appendChild(FTVForm);FTVForm.submit();})()" title="feelthevi.be">Drag Me!</a></p>
		
		<?php endif;
		
	}else{
	
		// There is no signed in user. Tell the person to sign the hell in.
		
		echo '<p>It\'s great that you want to start commenting on something, but first of all we need to know who you are. Please sign in (using Twitter, no more accounts necessary, and we don\'t even tweet from your account) and we can get started!</p>
		
			<p><a href="' . site_url('signin') . '"><img src="' . base_url() . 'img/signin.png" title="Sign in with Twitter"></a></p>';
	
	}
	
	?>

</div>