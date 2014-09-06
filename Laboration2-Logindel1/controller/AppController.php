<?php

/**
 * The main contoller for the application.
 * 
 * @author Svante Arvedson
 */
class AppController
{
	/**
	 * The application runs from here. 
	 *
	 * @return void
	 */
	public function run()
	{
		session_start();
		
		if (Request::isPostback())
		{
			$view = new HTMLView();
			
			switch ($view->getAction())
			{
				case Strings::$ActionParameterValueLogin:
					$authenticationController = new AuthenticationController();
					$authenticationController->doLogin();
					break;
				case Strings::$ActionParameterValueLogout:
					$authenticationController = new AuthenticationController();
					$authenticationController->doLogout();
					break;
			}
		}
		else
		{
			if (Request::userIsAuthenticated())
			{
				$view = new AuthenticatedView();
				$view->setUser(Session::get(Strings::$AuthenticatedUser));
			}
			else
			{
				$view = new UnauthenticatedView();
				
				if (Session::varIsSet(Strings::$Error))
				{
					$view->setErrorMessage(Session::get(Strings::$Error));
					Session::unsetVar(Strings::$Error);
				}
			}

			$view->createHTML();
			$view->echoHTML();
		}
	}
}