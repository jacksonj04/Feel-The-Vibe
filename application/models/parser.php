<?php
class Parser extends CI_Model
{

	public $error_message = NULL;
	public $title = NULL;
	public $body = NULL;

	public function __construct()
	{
		parent::__construct();
	}
	
	public function url($url)
	{
		$this->_reset();
		
		$this->load->library('readability');
		
		try
		{
			// Get the URL's HTML
			$html = file_get_contents($url);
			if ( ! $html)
			{
				throw new Exception ('Aww snap! I was unable to grab the HTML from the url =(');	
			}
			
			// Tidy tidy tidy!
			if (function_exists('tidy_parse_string')) {
				$tidy = tidy_parse_string($html, array('indent' => TRUE), 'UTF8');
				$tidy->cleanRepair();
				$html = $tidy->value;
			}
			
			// Go!
			$this->readability->get($html, $url);
			$result = $this->readability->init();
			
			if ($result)
			{
				$this->title = $this->readability->getTitle()->textContent;
				$this->body = $this->readability->getContent()->innerHTML;
				
				// Tidy!
				if (function_exists('tidy_parse_string'))
				{
					$tidy = tidy_parse_string($content, array('indent'=>true, 'show-body-only' => true), 'UTF8');
					$tidy->cleanRepair();
					$content = $tidy->value;
				}
				
				return TRUE;
			}
			
			else
			{
				throw new Exception ('Aww snap! I was unable to extract text content =(');
			}
		}
		
		catch (Exception $e)
		{
			$this->error_message = $e->getMessage();
			return FALSE;
		}
	}
	
	private function reset()
	{
		$this->error = FALSE;
		$this->error_message = NULL;
		$this->title = NULL;
		$this->body = NULL;
	}

}