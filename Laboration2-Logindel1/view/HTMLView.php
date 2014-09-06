<?php

/**
 * This is the base class for all views in the application
 * 
 * @author Svante Arvedson
 */
class HTMLview
{
	/**
	 * @var string	The content in the title tag
	 */
	private $title;
	
	/**
	 * @var string	The content in the body tag
	 */
	private $body;
	
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
			throw new Exception(Strings::$ErrorTitleUnset);
		}
		if ($this->body == null)
		{
			throw new Exception(Strings::$ErrorBodyUnset);
		}
		
		$HTML = "
			<!DOCTYPE html>
			<html lang='sv'>
				<head>
					<meta charset='utf-8' />
					<title>$this->title</title>
				</head>
				<body>
					$this->body
				</body>
			</html>";
		
		echo $HTML;
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
	 * This method return the value of the GET parameter "action"
	 * 
	 * @return string	The GET parameter "action"
	 */
	public function getAction()
	{
		return Request::getGET(Strings::$ActionParameterIndex);
	}
}