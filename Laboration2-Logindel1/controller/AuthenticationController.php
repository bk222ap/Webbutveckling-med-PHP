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
				Session::set(Strings::$Error, Strings::$ErrorLoginNoUsername);
			}
			else
			{
				Session::set(Strings::$Error, Strings::$ErrorLoginNoPassword);
			}
		}
		else
		{
			try
			{
				$user = new User($view->getUsername());
				// Here are the successful login
				if (Helper::cryptPassword($view->getPassword()) == $user->getPassword())
				{
					$view = new AuthenticatedView();
					Session::set(Strings::$AuthenticatedUser, $user);
					$view->setUser($user);
				}
				else
				{
					Session::set(Strings::$Error, Strings::$ErrorLoginWrongPassword);
				}
			}
			catch (exception $e)
			{
				Session::set(Strings::$Error, Strings::$ErrorLoginWrongUsername);
			}
		}
		
		Request::redirect('index.php');
	}
	
	/**
	 * Are doing the logout.
	 * 
	 * @return void
	 */
	public function doLogout()
	{
		Session::unsetVar(Strings::$AuthenticatedUser);
		Request::redirect('index.php');
	}
}