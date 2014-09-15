<?php

/**
 * Model representing the authentication module
 * 
 * @author Svante Arvedson
 */
class AuthenticationModel
{
    /**
     * @var integer $expirationOfCookies    The valid length of a cookie in seconds
     */
    private static $expirationOfCookies = 60;
    
    /**
     * @var string $placeBrowser    The session name for the browser information
     */
    private static $placeBrowser = 'AuthenticationModel::Browser';
    
    /**
     * @var string $placeIP     The session name for the IP number information
     */
    private static $placeIP = 'AuthenticationModel::IP';
    
    /**
     * @var $placeUser      The session name for the user object
     */
	private static $placeUser = 'AuthenticationModel::User';
    
    /**
     * @var SessionService $sessionService  An instance of SessionService class
     */
    private $sessionService;
    
    /**
     * @return void
     */
    public function __construct()
    {
        $this->sessionService = new SessionService();
    }    

    /**
     * Getter for self::$expirationOfCookies
     * 
     * @return integer self::$expirationOfCookies
     */
    public function getExpirationOfCookies()
    {
        return self::$expirationOfCookies;
    }

    /**
     * Return the User representing the authenticated user
     * 
     * @return User     The authenticated user
     */
    public function getUser()
    {
        return $this->sessionService->load(self::$placeUser);
    }
	
    /**
     * Returns TRUE if the user is authenticated
     * 
     * @return boolean  TRUE if the user is authenticated
     */
    public function isUserAuthenticated($IP, $browser)
    {
        if ($this->sessionService->issetVar(self::$placeUser))
        {
            if ($this->sessionService->load(self::$placeIP) === $IP &&
                $this->sessionService->load(self::$placeBrowser) === $browser)
                {
                    return true;
                }
        }
        return false;
    }
    
    /**
     * Authenticates the user
     * 
     * @param string $username  Users username
     * @param string $password  Users password
     * @param boolean $saveCredentials  If user wants to save her credentials
     * 
     * @throws InvalidUsernameException If the provided username isn't valid
     * @throws InvalidPasswordException If the provided password isn't valid
     * @throws LoginException   If user doesn't exist in the register
     * 
     * @return User The authenicated user
     */
	public function loginUser($username, $password, $IP, $browser, $saveCredentials = false)
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
                
                $this->sessionService->save(self::$placeUser, $user);
                $this->sessionService->save(self::$placeIP, $IP);
                $this->sessionService->save(self::$placeBrowser, $browser);
                return $user;
            }
        }
        
        // If $user doesn't exist in the register
        throw new LoginException('Unexisting user');
	}
	
    /**
     * Authenticates an user with saved credentials
     * 
     * @param string $username  Users username
     * @param string $password  Users password
     * 
     * @throws Exception    If provided username or password isn't valid
     * @throws LoginException If user doesn't exist in the register
     * 
     * @return User The authenticated user
     */
    public function loginUserWithCredentials($username, $password, $IP, $browser)
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
                $user->getUsername() == $uElements[0] &&
                crypt($user->getPassword(), $uElements[2]) == $uElements[1])
            {
                $this->sessionService->save(self::$placeUser, $user);
                $this->sessionService->save(self::$placeIP, $IP);
                $this->sessionService->save(self::$placeBrowser, $browser);
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
		$this->sessionService->remove(self::$placeUser);
        $this->sessionService->remove(self::$placeIP);
        $this->sessionService->remove(self::$placeBrowser);
	}

    /**
     * Creates salt for cryptation of password
     * 
     * @return string   Salt for cryptation of password
     */
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