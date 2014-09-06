<?php

/**
 * Represents the User of the application.
 * 
 * @author Svante Arvedson
 */
class User
{
	/**
	 * @var string 			The users username
	 */
	private $username;
	
	 /**
	 * @var string 			The Users password
	 */
	private $password;
	
	/**
	 * Constructor method for this class 
	 *
	 * @throws Exception 		If $username does not exist
	 * @param string $username	The username belonging to the user
	 */
	public function __construct($username) 
	{
		// For the moment this is not data from a database.
		if ($username != "Admin") 
		{
			throw new Exception(Strings::$ErrorUnexistingUsername);
		}
		
		$this->username = $username;
		$this->password = Helper::cryptPassword('Password'); // This should also be fetched from the database.
	}
	
	/**
	 * Returns the Users username
	 * 
	 * @return string 	The users username
	 */
	public function getUsername()
	{
		return $this->username;
	}
	
	/**
	 * Returns the Users password
	 * 
	 * @return string 	The users password
	 */
	public function getPassword()
	{
		return $this->password;
	}
}
