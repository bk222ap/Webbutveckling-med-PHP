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
     * The user register is located in a file
	 *
	 * @throws Exception 		    If $username does not exist
	 * @param string $inputUsername	The username belonging to the user
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
    
    public function getTempPassword()
    {
        return $this->tempPassword;
    }
    
    public function setPassword($password)
    {
        $this->password = $password;
    }
}