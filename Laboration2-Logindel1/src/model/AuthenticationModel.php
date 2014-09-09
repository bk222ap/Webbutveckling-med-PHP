<?php

/**
 * Model representing the Authentication module
 * 
 * @author Svante Arvedson
 */
class AuthenticationModel
{
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
	public function loginUser($user)
	{
		Session::set(self::$placeUser, $user);
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
}