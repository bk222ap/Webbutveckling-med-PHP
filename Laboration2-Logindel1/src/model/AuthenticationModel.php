<?php

/**
 * Model representing the Authentication module
 * 
 * @author Svante Arvedson
 */
class AuthenticationModel
{
    private static $expirationOfCookies = 10;
    private static $salt = '_Gt65Fr3k';
    
    /**
     * $var $placeUser      The index for the user object
     */
	private static $placeUser = 'AuthenticationModel::User';

    /**
     * Returns TRUE if the user is authenticated
     * 
     * @return boolean  TRUE if the user is authenticated
     */
	public function isUserAuthenticated()
	{
		return Session::varIsSet(self::$placeUser);
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
            $uElements = explode(';', $u, 2);
            // If $user exists in the register
            if ($user->getUsername() === $uElements[0] && $this->cryptPassword($user->getPassword()) === $uElements[1])
            {
                if ($saveCredentials)
                {
                    $user = new TempUser($user->getUsername());
                    $userString = $user->getUsername() . ";" . $this->cryptPassword($user->getPassword()) . ";" . time() . "\n";
                    
                    // Save temp login in a file
                    file_put_contents('files/tempUsers', $userString, FILE_APPEND);
                }
                
                Session::set(self::$placeUser, $user);
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
	}
    
    public function loginUserWithCredentials($username, $password)
    {
        $timestamp = time();
        
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
            $uElements = explode(';', $u, 3);
            
            if ($user->getUsername() === $uElements[0] && 
                $this->cryptPassword($user->getPassword()) === $uElements[1] && 
                $timestamp <= ($uElements[2] + self::$expirationOfCookies))
            {
                Session::set(self::$placeUser, $user);
                return $user;
            }  
        }
        
        // If $user doesn't exist in the register
        throw new LoginException('Unexisting user');
    }
    
    public function getExpirationOfCookies()
    {
        return self::$expirationOfCookies;
    }

    private function cryptPassword($password)
    {
        return crypt($password, self::$salt);
    }

/*    private function createSalt()
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
    } */
}