<?php

class Helpers
{
	public static function requestIsGET()
	{
		return $_SERVER['REQUEST_METHOD'] == "GET";
	}
	
	public static function requestIsPOST()
	{
		return $_SERVER['REQUEST_METHOD'] == "POST";
	}
	
	public static function getGetParameter($index)
	{
		return $_GET[$index];
	}
	
	public static function getPostParameter($index)
	{
		return $_POST[$index];
	}
}
