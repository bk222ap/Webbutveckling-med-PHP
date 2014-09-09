<?php

/**
 * This class contains helper functions for the application
 * 
 * @author Svante Arvedson
 */
class Helper
{
	/**
	 * Return a crypted password
	 * 
	 * @param string $password	The password to be crypted
	 * @return string			The cryped password
	 */
	public static function cryptPassword($password)
	{
		return crypt($password, Strings::$Salt);
	}
}
