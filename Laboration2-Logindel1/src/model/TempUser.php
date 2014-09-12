<?php

class TempUser
{
    private static $lengthOfPassword = 12;
    
    private $username;
    private $tempPassword;
    private $timestamp;
    
    public function __construct($username)
    {
        $tempPassword = $this->generateRandomString();
        
        $this->username = $username;
        $this->tempPassword = base64_encode($tempPassword);
        $this->timestamp = time();
    }
    
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getPassword()
    {
        return $this->tempPassword;
    }
    
    public function getTimestamp()
    {
        return $this->timestamp;
    }
    
    private function generateRandomString()
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