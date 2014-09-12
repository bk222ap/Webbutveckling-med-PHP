<?php

/**
 * Represents a User of the application.
 * 
 * @author Svante Arvedson
 */
class User
{
    /**
     * @var string The Users password
     */
    private $password;
    
	/**
	 * @var string The users username
	 */
	private $username;

	/**
	 * @param string $inputUsername	The username belonging to the user
     * 
     * @throws InvalidUsernameException If $username isn't valid
     * @throws InvalidPasswordException If $password isn't valid
     * 
     * @return void
	 */
	public function __construct($username, $password) 
	{
	    if (!is_string($username) || $username == '')
	    {
	        throw new InvalidUsernameException('Unvalid username.');
	    }
        if (!is_string($password) || $password == '')
        {
            throw new InvalidPasswordException('Unvalid password.');
        }
        
	    $this->username = $username;
        $this->password = $password;
	}
	
    /**
     * Returns this->password
     * 
     * @return string   this->password
     */
    public function getPassword()
    {
        return $this->password;
    }
    
	/**
	 * Returns the this->username
	 * 
	 * @return string 	this->username
	 */
	public function getUsername()
	{
		return $this->username;
	}
}