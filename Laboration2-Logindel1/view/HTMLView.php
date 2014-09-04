<?php

class HTMLview
{
	private $title;
	private $body;
	private $cssPaths = array();

	public function __construct($title, $body)
	{
		$this->title = $title;
		$this->body = $body;
	}
	
	public function echoHTML()
	{
		$HTML = "
			<!DOCTYPE>
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
}
