<?php

/**
 * This class contains static functions for the request
 * 
 * @author Svante Arvedson
 */
class Request
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
	 * @param string $index	The index to get
	 * @return string 		The GET parameter on the given index
	 */
	public static function getGET($index)
	{
		return $_GET[$index];
	}
	
	/**
	 * Returns the POST parameter on the given index
	 * 
	 * @param string $index	The index to get
	 * @return string 		The POST parameter on the given index
	 */
	public static function getPOST($index)
	{
		return $_POST[$index];
	}
	
	/**
	 * Redirects user to a new page
	 * 
	 * @param string $to 	The page to go to
	 * @return void
	 */
	public static function redirect($to)
	{
		header('Location: ' . $to);
	}
	
	/**
	 * Returns TRUE if user is authenticated
	 * 
	 * @return bool		TRUE is user is authenticated
	 */
	public static function userIsAuthenticated()
	{
		return Session::varIsSet(Strings::$AuthenticatedUser);
	}
}