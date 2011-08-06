<div class="grid_12">
	
	<h1>Create a New Page</h1>

	<?php if ($error) : ?>
	<div class="error">
		<?php echo $error; ?>
	</div>
	<?php endif; ?>
	
	<?php if ($success) : ?>
	
	<div class="success">
		Awesome, you've created <a href="<?php echo $success; ?>"><?php echo $success; ?></a>
	</div>
	
	<?php else: ?>
	
		<?php echo form_open('', array('class'=>'box bg_light')); ?>
		
			<p>Tell us the address of the page you want to make commentable, then relax whilst we do some magic. Your page will be with you in a few seconds.</p>
		
			<p class="inputwrapper">
				<label for="url">URL</label><br>
				<input type="url" id="url" name="url" placeholder="Enter a URL here…" class="text">
			</p>
			
			<p>
				<input type="submit" value="Parse the URL" name="create" id="create">
			</p>
		</form>
		
		<?php echo form_close(); ?>	
	
	<?php endif; ?>

</div>