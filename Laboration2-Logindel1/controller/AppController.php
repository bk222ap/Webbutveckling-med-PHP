<?php

class AppController
{
	public function run()
	{
		if (Helpers::requestIsGET())
		{
			$view = new UnauthenticatedView();
			$view->createHTML();
			$view->echoHTML();
		}
		else
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
	}
}