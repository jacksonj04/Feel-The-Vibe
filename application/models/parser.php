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
				
				// Remove attributes
				$this->body = $this->_removeAttr($this->body);
				
				// Remove comments
				$this->body = $this->_removeComments($this->body);
				
				// Tidy!
				if (function_exists('tidy_parse_string'))
				{
					$tidy = tidy_parse_string($this->body, array('indent'=>true, 'show-body-only' => true), 'UTF8');
					$tidy->cleanRepair();
					$this->body = $tidy->value;
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
	
	private function _removeComments($html)
	{
		$regex = '/<!--(.*)-->/sm';
		$html = preg_replace($regex, '', $html);
		return $html;
	}
	
	private function _reset()
	{
		$this->error = FALSE;
		$this->error_message = NULL;
		$this->title = NULL;
		$this->body = NULL;
	}

}