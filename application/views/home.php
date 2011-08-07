<div class="grid_8"> 
		
	<h1>Got something to say?</h1>
	
	<h3>Feel The Vibe lets you take any web page and turn it into a document you can comment on paragraph by paragraph.</h3>
	
	<p>Take a news article and add your annotations and opinions, share your views on the latest government white paper, let people instantly comment on your work and more.</p>
	
	<h2 class="border_top padding_top">Recent Documents</h2>
	
	<p>Here are the latest things that people have been commenting on.</p>
	
	<ul>
	
	<?php
	
	foreach ($recents->result() as $recent){
	
		echo '<li><a href="' . site_url($recent->series_id) . '">' . $recent->title . '</a></li>';
	
	}
	
	?>
	
	</ul>
	
</div> 

<aside class="grid_4 last"> 
	
	<div class="box bg_dark"> 
	
		<?php
		
		if ( !$this->tweet->logged_in() )
		{
			
			echo '<h3>Sign In</h3>
			
			<p>Oh no, you\'re not signed in yet!</p>
			
			<p><a href="' . site_url('signin') . '"><img src="' . base_url() . 'img/signin.png" title="Sign in with Twitter"></a></p>';
			
		}
		else
		{
		
			echo '<h3>Hello Again!</h3>
			
			<p>You\'re already signed in. That\'s cool.</p>
			
			<p>If you really want to you can <a href="' . site_url('signout') . '">sign out</a>.</p>';
			
		}
	
		?>
	
	</div>
	
	<div class="box bg_light">
		This site was created at <a href="http://leedshack.com">Leeds Hack 2</a> over the weekend of 7th and 8th of August 2011.
	</div>
			
</aside>