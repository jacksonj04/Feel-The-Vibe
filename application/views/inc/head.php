<!doctype html> 
<!--[if IEMobile 7 ]><html class="no-js iem7" lang="en"><![endif]--> 
<!--[if lt IE 7 ]><html class="no-js ie ie6" lang="en"><![endif]--> 
<!--[if IE 7 ]><html class="no-js ie ie7" lang="en"><![endif]--> 
<!--[if IE 8 ]><html class="no-js ie ie8" lang="en"><![endif]--> 
<!--[if IE 9 ]><html class="no-js ie ie9" lang="en"><![endif]--> 
<!--[if (gte IE 9)|!(IE)]><!--><html class="no-js not-ie" lang="en"><!--<![endif]--> 
<head> 
	<meta charset="utf-8"> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
	<link rel="dns-prefetch" href="//c94471.r71.cf3.rackcdn.com"> 
	<link rel="dns-prefetch" href="//c94471.ssl.cf3.rackcdn.com"> 
	<link rel="dns-prefetch" href="//c95725.r25.cf3.rackcdn.com"> 
	<link rel="dns-prefetch" href="//c95725.ssl.cf3.rackcdn.com"> 
 
	<title>Feel The Vibe<?php if (isset($title)) echo ' - ' . $title; ?></title> 
	<meta name="description" content="Make any web page a document you can comment on paragraph by paragraph."> 
	<meta name="author" content="Team Feel The Vibe"> 
	
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0"> 
 
	<link rel="stylesheet" href="http://c94471.r71.cf3.rackcdn.com/cwd.css">
	<link rel="stylesheet" href="http://c94471.r71.cf3.rackcdn.com/ui.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/vibe.css"> 
	<script src="http://c94471.r71.cf3.rackcdn.com/modernizr.js"></script> 
	
</head> 
 
<body> 
 
	<header id="cwd_header" role="banner" style="background:#3D008B url(<?php echo base_url(); ?>img/head.png) no-repeat center;"> 
	
		<section class="cwd_container"> 
	
			<hgroup class="grid_12" id="cwd_hgroup" style="background:none;"> 
						
				<a href="/"> 
					<h1>Feel The Vibe</h1> 
					<h2>Share your inane ramblings with the world.</h2> 
				</a> 
							
			</hgroup> 
 
		</section> 
			
	</header> 
	
	<nav class="cwd_container" role="navigation"> 
		<ul id="cwd_navigation" class="grid_12">  
			<li<?php if ($currentpage == 'home') echo ' class="current"'; ?>><a href="<?php echo site_url(); ?>">Home</a></li>
			<li<?php if ($currentpage == 'create') echo ' class="current"'; ?>><a href="<?php echo site_url('create'); ?>">Create</a></li>
	        <li<?php if ($currentpage == 'about') echo ' class="current"'; ?>><a href="<?php echo site_url('about'); ?>">About</a></li>
	        <li<?php if ($currentpage == 'help') echo ' class="current"'; ?>><a href="<?php echo site_url('help'); ?>">Help</a></li>
    	</ul>  
	</nav> 
	
	<section class="cwd_container" id="cwd_content" role="main"> 