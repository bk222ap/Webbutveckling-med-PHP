<?php

/**
 * Represents a temporary user of the application
 * 
 * @author Svante Arvedson
 */
class TempUser
{
    /**
     * @var integer $lengthOfPassword   The length of a temporary password
     */
    private static $lengthOfPassword = 12;
    
    /**
     * @var string $username    Users username
     */
    private $username;
    
    /**
     * @var string $password    Users password
     */
    private $password;
    
    /**
     * @var string $timestamp   Time when the instance was created
     */
    private $timestamp;
    
    /**
     * @param string $username  The users username
     * 
     * @throws InvalidUsernameException If provided username isn't valid
     * 
     * @return void
     */
    public function __construct($username)
    {
        if (!is_string($username) || $username == '')
        {
            throw new InvalidUsernameException('Unvalid username.');
        }
        
        $this->username = $username;
        $this->password = base64_encode($this->generatePassword());
        $this->timestamp = time();
    }
    
    /**
     * Returns $this->username
     * 
     * @return string $this->username
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    /**
     * Returns $this->password
     * 
     * @return string $this->password
     */
    public function getPassword()
    {
        return $this->password;
    }
    
    /**
     * Returns $this->timestamp
     * 
     * @return integer $this->timestamp
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
    
    /**
     * Generates a random password
     * 
     * @return string A random password
     */
    private function generatePassword()
    {
        $validChars = 'abcdefghijklmnopqrstuvxyABCDEFGHIJKLMNOPQRSTUVXY123456789!"#¤%&/()=?@£${[]}\+-*';
        $validCharsLength = strlen($validChars);
        $randString = '';
        
        for ($i = 0; $i < self::$lengthOfPassword; $i += 1)
        {
            $index = mt_rand(0, $validCharsLength - 1);
            $randString .= substr($validChars, $index, 1);
        }
        
        return $randString;
    }
}