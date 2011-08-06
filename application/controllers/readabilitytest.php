<?php
class Readabilitytest extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->library('readability');
		
		$url = 'http://www.bbc.co.uk/news/world-us-canada-14428930';
		$html = file_get_contents($url);
		
		if (function_exists('tidy_parse_string')) {
			$tidy = tidy_parse_string($html, array('indent'=>true), 'UTF8');
			$tidy->cleanRepair();
			$html = $tidy->value;
		}
		
		$readability->debug = TRUE;
		$this->readability->get($html, $url);
		
		$result = $this->readability->init();
		
		if ($result)
		{
			echo "== Title =====================================\n";
			echo $this->readability->getTitle()->textContent, "\n\n";
			echo "== Body ======================================\n";
			$content = $this->readability->getContent()->innerHTML;
			// if we've got Tidy, let's clean it up for output
			
			if (function_exists('tidy_parse_string'))
			{
				$tidy = tidy_parse_string($content, array('indent'=>true, 'show-body-only' => true), 'UTF8');
				$tidy->cleanRepair();
				$content = $tidy->value;
			}
			
			echo $content;
		
			}
		else
		{
			echo 'Looks like we couldn\'t find the content. :(';
		}
		
	}

} // EOF