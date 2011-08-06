<?php
class Readabilitytest extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->load->model('parser');
		$url = 'http://www.bbc.co.uk/news/world-us-canada-14428930';
		
		$this->parser->url($url);
		
		
		echo $this->removeAttr($this->parser->body);
	}
	
	function removeAttr( $htmlString )
	{
		$regEx = '/([^<]*<\s*[a-z](?:[0-9]|[a-z]{0,9}))(?:(?:\s*[a-z\-]{2,14}\s*=\s*(?:"[^"]*"|\'[^\']*\'))*)(\s*\/?>[^<]*)/i'; // match any start tag
		
		$chunks = preg_split($regEx, $htmlString, -1,  PREG_SPLIT_DELIM_CAPTURE);
		$chunkCount = count($chunks);
		
		$strippedString = '';
		for ($n = 1; $n < $chunkCount; $n++) {
			$strippedString .= $chunks[$n];
		}
		
		return $strippedString;
	}

} // EOF