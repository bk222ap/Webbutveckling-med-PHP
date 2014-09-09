<?php

/**
 * This class contains static methods for handling the Session
 * 
 * @author Svante Arvedson
 */
class Session
{
	/**
	 * Return value stored in a session variable
	 * 
	 * @param string $key	The key to get the variable value
	 * @return mixed		The value in the variable
	 */
	public static function get($key)
	{
		return $_SESSION[$key];
	}
	
	/**
	 * Check if a session variable is set
	 * 
	 * @param string $key	The key to the variable to check
	 * @return bool			TRUE if variable is set, else FALSE
	 */
	public static function varIsSet($key)
	{
		return isset($_SESSION[$key]);
	}
		
	/**
	 * Sets a session variable
	 * 
	 * @param string $key	The key to the assigned variable
	 * @param mixed $value	The value stored in the variable
	 * @return void
	 */
	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}
	
	/**
	 * Starts a new session
	 * 
	 * @return void
	 */
	public static function start()
	{
		session_start();
	}
	
	/**
	 * Unsets a session variable
	 * 
	 * @param string $key	The key to unset
	 * @return void
	 */
	public static function unsetVar($key)
	{
		unset($_SESSION[$key]);
	}
}