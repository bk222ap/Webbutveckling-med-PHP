<?php

/**
 * This class contains helper methods for the application
 * 
 * @author Svante Arvedson
 */
class Helpers
{
	/**
	 * Tells if the request is a postback
	 *
	 * @return boolian 	Returns true if the request is a postback.
	 */
	public static function isPostback()
	{
		return $_SERVER['REQUEST_METHOD'] == "POST";
	}
	
	/**
	 * Gives the GET parameter on the given index
	 * 
	 * @param string	The index to get
	 * @return string 	The GET parameter on the given index
	 */
	public static function getGetParameter($index)
	{
		return $_GET[$index];
	}
	
	/**
	 * Returns the POST parameter on the given index
	 * 
	 * @param string	The index to get
	 * @return string 	The POST parameter on the given index
	 */
	public static function getPostParameter($index)
	{
		return $_POST[$index];
	}
}
