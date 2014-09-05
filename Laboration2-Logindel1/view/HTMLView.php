<?php

class HTMLview
{
	private $title;
	private $body;
	
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
	
	public function setTitle($title) 
	{
		$this->title = $title;
	}
	
	public function setBody($body)
	{
		$this->body = $body;
	}
	
	public function getAction()
	{
		return Helpers::getGetParameter(Strings::$ActionParameterIndex);
	}
}