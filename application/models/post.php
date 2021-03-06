<?php
class Post extends CI_Model
{

	private $series = NULL;
	private $page = 1;

	function __construct()
	{
		parent::__construct();
	}
	
	function add($url, $title, $content, $series = NULL, $page = 1, $user_id = NULL, $return = 'permalink')
	{		
		try
		{
			$title = trim($title);
			$content = trim($content);
			
			if ( $title == '' || $content == '')
			{
				throw new Exception ('Empty title or content');
			}
					
			if ($series == NULL)
			{
				$series = substr(md5(uniqid()), 0, 10);
			}
			$this->series = $series;
			
			if ($page !== 1)
			{
				$this->page = $page;
			}
			
			$short_url = NULL;
			if ($su = $this->_shorturl())
			{
				$short_url = $su;
			}
			
			$add = array(
				'original_url'	=> $url,
				'title'			=> $title,
				'content'		=> $content,
				'generated'		=> time(),
				'shorturl'		=> $short_url,
				'user_id'		=> $user_id,
				'series_id'		=> $series,
				'page'			=> $page
			);
			
			if ($this->db->insert('posts', $add))
			{
				switch ($return)
				{
					case 'series':
						return $this->series;
					break;
					default:
						return $this->_permalink();
					break;
				}
			}
			
			else
			{
				throw new Exception ('Failed to save post in the database');
			}
		}
		
		catch (Exception $e)
		{
			$this->error_message = $e->getMessage();
		}
	}
	
	function get($series = '', $page = 1)
	{
		try
		{
			if ($series == '')
			{
				throw new Exception ('Missing series');
				return FALSE;
			}
			
			$result = $this->db->get_where('posts', array('series_id' => $series, 'page' => $page));
			
			if ($result->num_rows() == 1)
			{
				$post = $result->row();
				
				return array(
					'title' => $post->title,
					'content' => $post->content,
					'post_id' => $post->post_id,
					'cap_url' => $post->original_url,
					'cap_time'	=>	$post->generated,
					'cap_user'	=>	$post->user_id,
					'shorturl'	=>	$post->shorturl
				);
			}
			
			else
			{
				throw new Exception ('Can\'t find post');
				return FALSE;
			}
		}
		
		catch (Exception $e)
		{
			$this->error_message = $e->getMessage();
		}
	}
	
	public function comments($postid)
	{
		$comments_query = $this->db->query('SELECT users.`twitter` AS `twitter`, comments.paragraph AS `paragraph`, comments.text AS `comment`, comments.timestamp AS `timestamp` FROM comments JOIN users ON users.user_id = comments.user_id WHERE comments.post_id = '.$postid.' ORDER BY paragraph ASC, timestamp DESC');
		
		$comments = array();
		
		if ($comments_query->num_rows() > 0)
		{
			foreach ($comments_query->result() as $comment)
			{
				if (isset($comments[(string)$comment->paragraph]) && ! is_array($comments[(string)$comment->paragraph]))
				{
					$comments[(string)$comment->paragraph] = array();
				}
				$comments[(string)$comment->paragraph][] = array(
					'twitter' => $comment->twitter,
					'comment' => $comment->comment,
					'timestamp' => $comment->timestamp
				);
			}
		}
		
		return $comments;
		
	}
	
	private function _shorturl()
	{
		if ($short = file_get_contents('http://lncn.eu/api?longurl=' . urlencode($this->_permalink())))
		{
			return $short;
		}
		
		else
		{
			return FALSE;
		}
	}
	
	private function _permalink()
	{
		$link = site_url() . $this->series;
		
		if ($this->page !== 1)
		{
			$link .= '/' . $page;
		}
		
		return $link;
	}

}