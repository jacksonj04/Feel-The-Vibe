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
	
		<?php echo form_open('/create', array('class'=>'box bg_light')); ?>
		
			<p class="inputwrapper">
				<label for="url">URL</label><br>
				<input type="url" id="url" name="url" placeholder="Enter a URL here…" class="text">
			</p>
			
			<p>
				<input type="submit" value="Go!" name="create">
			</p>
		
		<?php echo form_close(); ?>	
	
	<?php endif; ?>

</div>