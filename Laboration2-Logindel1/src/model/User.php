<?php

/**
 * Represents the User of the application.
 * 
 * @author Svante Arvedson
 */
class User
{
    /**
     * @var string          The Users password
     */
    private $password;
    
	/**
	 * @var string 			The users username
	 */
	private $username;

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
			throw new Exception('Username does not exist.');
		}
		
		$this->username = $username;
		$this->password = Helper::cryptPassword('Password'); // This should also be fetched from the database.
	}
	
    /**
     * Returns the Users password
     * 
     * @return string   The users password
     */
    public function getPassword()
    {
        return $this->password;
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
}