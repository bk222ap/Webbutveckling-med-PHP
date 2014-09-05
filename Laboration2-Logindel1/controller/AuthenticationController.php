<?php

/**
 * This class is doing the Login and Logout.
 * 
 * @author Svante Arvedson
 */
class AuthenticationController
{
	/**
	 * Are doing the login.
	 * 
	 * @return void
	 */
	public function doLogin()
	{
		$view = new UnauthenticatedView();
		
		if ($view->getUsername() == '' || $view->getPassword() == '')
		{
			if ($view->getUsername() == '')
			{
				$view->setErrorMessage(Strings::$ErrorLoginNoUsername);
			}
			else
			{
				$view->setErrorMessage(Strings::$ErrorLoginNoPassword);
			}
		}
		else
		{
			try
			{
				$user = new User($view->getUsername());
				// Here are the successful login
				if ($view->getPassword() == $user->getPassword())
				{
					$view = new AuthenticatedView()
					$view->setUser($user);
				}
				else
				{
					$view->setErrorMessage(Strings::$ErrorLoginWrongPassword);
				}
			}
			catch (exception $e)
			{
				$view->setErrorMessage(Strings::$ErrorLoginWrongUsername);
			}
		}
		$view->createHTML();
		$view->echoHTML();
	}
	
	/**
	 * Are doing the logout.
	 * 
	 * @return void
	 */
	public function doLogout()
	{
		$view = new UnauthenticatedView();
		$view->createHTML();
		$view->echoHTML();
	}
}