<?php

/**
 * Model representing the Authentication module
 * 
 * @author Svante Arvedson
 */
class AuthenticationModel
{
    private static $expirationOfCookies = 300;
    
    /**
     * $var $placeUser      The index for the user object
     */
	private static $placeUser = 'AuthenticationModel::User';
    private static $placeIP = 'AuthenticationModel::IP';
    private static $placeBrowser = 'AuthenticationModel::Browser';
    
    

    /**
     * Returns TRUE if the user is authenticated
     * 
     * @return boolean  TRUE if the user is authenticated
     */
	public function isUserAuthenticated()
	{
	    $IP = $_SERVER['REMOTE_ADDR'];
        $browser = $_SERVER['HTTP_USER_AGENT'];
        
        if (Session::varIsSet(self::$placeUser))
        {
            if (Session::get(self::$placeIP) === $IP &&
                Session::get(self::$placeBrowser) === $browser)
                {
                    return true;
                }
        }
        return false;
	}

    /**
     * Return the User representing the authenticated user
     * 
     * @return User     The authenticated user
     */
    public function getUser()
    {
        return Session::get(self::$placeUser);
    }
	
    /**
     * Authenticates the user
     * 
     * @param User $user    The user to be authenticated
     */
	public function loginUser($username, $password, $saveCredentials = false)
	{
	    $IP = $_SERVER['REMOTE_ADDR'];
        $browser = $_SERVER['HTTP_USER_AGENT'];
        
	    try
	    {
	        $user = new User($username, $password);
	    }
        catch (InvalidUsernameException $e)
        {
            throw $e;
        }
        catch (InvalidPasswordException $e)
        {
            throw $e;
        }
        
	    $users = file('files/Users', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($users as $u)
        {
            $uElements = explode(',', $u, 3);
            // If $user exists in the register
            if ($user->getUsername() === $uElements[0] && 
                crypt($user->getPassword(), $uElements[2]) === $uElements[1])
            {
                if ($saveCredentials)
                {
                    $user = new TempUser($user->getUsername());
                    $salt = $this->createSalt();
                    $userString = $user->getUsername().",".crypt($user->getPassword(), $salt).",".$salt.",".time().",".$IP.",".$browser."\n";
                    
                    // Save temp login in a file
                    file_put_contents('files/tempUsers', $userString, FILE_APPEND);
                }
                
                Session::set(self::$placeUser, $user);
                Session::set(self::$placeIP, $IP);
                Session::set(self::$placeBrowser, $browser);
                return $user;
            }
        }
        
        // If $user doesn't exist in the register
        throw new LoginException('Unexisting user');
	}
	
    /**
     * Unauthenticate the user
     * 
     * @return void
     */
	public function logoutUser()
	{
		Session::unsetVar(self::$placeUser);
        Session::unsetVar(self::$placeIP);
        Session::unsetVar(self::$placeBrowser);
	}
    
    public function loginUserWithCredentials($username, $password)
    {
        $timestamp = time();
        $IP = $_SERVER['REMOTE_ADDR'];
        $browser = $_SERVER['HTTP_USER_AGENT'];
        
        try
        {
            $user = new User($username, $password);
        }
        catch (Exception $e)
        {
            throw $e;
        }
        
        $users = file('files/tempUsers', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($users as $u)
        {
            /* $uElements[0] == username
             * $uElements[1] == password
             * $uElements[2] == salt
             * $uElements[3] == timestamp
             * $uElements[4] == IP
             * $uElements[5] == browser */
            $uElements = explode(',', $u, 6);

            if ($timestamp <= ($uElements[3] + self::$expirationOfCookies) && 
                $uElements[4] == $IP && 
                $uElements[5] == $browser && 
                $user->getUsername() == $uElements[0])
            {
                if (crypt($user->getPassword(), $uElements[2]) === $uElements[1])
                {
                    Session::set(self::$placeUser, $user);
                    Session::set(self::$placeIP, $IP);
                    Session::set(self::$placeBrowser, $browser);
                    return $user;
                }
            }
        }
        // If $user doesn't exist in the register
        throw new LoginException('Unexisting user');
    }
    
    public function getExpirationOfCookies()
    {
        return self::$expirationOfCookies;
    }

    private function createSalt()
    {
        $lengthOfSalt = 8;
        
        $validChars = 'abcdefghijklmnopqrstuvxyABCDEFGHIJKLMNOPQRSTUVXY123456789';
        $validCharsLength = strlen($validChars);
        $salt = '_';
        
        for ($i = 0; $i < $lengthOfSalt; $i += 1)
        {
            $index = mt_rand(0, $validCharsLength - 1);
            $salt .= substr($validChars, $index, 1);
        }
        
        return $salt;
    }
}