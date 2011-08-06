<?php
class Parser extends CI_Model
{

	public $error_message = NULL;
	public $title = NULL;
	public $content = NULL;

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
				$this->content = $this->readability->getContent()->innerHTML;
				
				// Remove attributes
				$this->content = $this->_removeAttr($this->content);
				
				// Remove unwanted html and comments
				$this->content = $this->_removeTags($this->content);
				
				// Tidy!
				if (function_exists('tidy_parse_string'))
				{
					$tidy = tidy_parse_string($this->content, array('indent'=>TRUE, 'show-body-only' => TRUE), 'UTF8');
					$tidy->cleanRepair();
					$this->content = $tidy->value;
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
	
	private function _removeTags($html)
	{
		$html = strip_tags($html, '<p><a><li><h1><h2><h3><h4><h5><h6><abbr><blockquote><code>');
		return $html;
	}
		
	private function _removeAttr($html)
	{
		$regex = '/([^<]*<\s*[a-z](?:[0-9]|[a-z]{0,9}))(?:(?:\s*[a-z\-]{2,14}\s*=\s*(?:"[^"]*"|\'[^\']*\'))*)(\s*\/?>[^<]*)/i'; // match any start tag
		
		$chunks = preg_split($regex, $html, -1, PREG_SPLIT_DELIM_CAPTURE);
		$chunkCount = count($chunks);
		
		$strippedString = '';
		for ($n = 1; $n < $chunkCount; $n++)
		{
			$strippedString .= $chunks[$n];
		}
		
		return $strippedString;
	}
	
	private function _reset()
	{
		$this->error = FALSE;
		$this->error_message = NULL;
		$this->title = NULL;
		$this->body = NULL;
	}

}