<?php

/**
 * This is the base class for all views in the application
 * 
 * @author Svante Arvedson
 */
class HTMLview
{
	/**
	 * @var string	The content in the body tag
	 */
	private $body;
	
	/**
	 * @var string	The content in the title tag
	 */
	private $title;
	
	/**
	 * This function echos the HTML code.
	 *
	 * @throws Exception	Throws an exception if $this->title or $this->body isn't set. 
	 * @return void
	 */
	public function echoHTML()
	{
		if ($this->title == null)
		{
			throw new Exception('$title must not be null.');
		}
		if ($this->body == null)
		{
			throw new Exception('$body must not be null.');
		}
		
		$HTML = '
			<!DOCTYPE html>
			<html lang="sv">
				<head>
					<meta charset="utf-8" />
					<title>' . $this->title . '</title>
					<link rel="stylesheet" href="content/css/site.css" />
				</head>
				<body>'
					. $this->body . "\n" .
				'</body>
			</html>';
		
		echo $HTML;
	}
	
    /**
     * Redirects to a new page
     * 
     * @return void
     */
    public function redirect($address)
    {
        header('Location: ' . $address);
    }
    
	/**
	 * Setter for $this->body
	 * 
	 * @param string $body	The body content
	 * @return void
	 */
	public function setBody($body)
	{
		$this->body = $body;
	}
	
	/**
	 * Setter for $this->title
	 * 
	 * @param string $title	The title content
	 * @return void
	 */
	public function setTitle($title) 
	{
		$this->title = $title;
	}
}