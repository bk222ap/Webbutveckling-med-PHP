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
		if (Helpers::isPostback())
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
			$view = new UnauthenticatedView();
			$view->createHTML();
			$view->echoHTML();
		}
	}
}