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
		
		<?php endif;
		
	}else{
	
		// There is no signed in user. Tell the person to sign the hell in.
		
		echo '<p>It\'s great that you want to start commenting on something, but first of all we need to know who you are. Please sign in (using Twitter, no more accounts necessary, and we don\'t even tweet from your account) and we can get started!</p>
		
			<p><a href="' . site_url('signin') . '"><img src="' . base_url() . 'img/signin.png" title="Sign in with Twitter"></a></p>';
	
	}
	
	?>

</div>