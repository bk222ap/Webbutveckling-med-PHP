<?php

/**
 * The main contoller for the application.
 * 
 * @author Svante Arvedson
 */
class AppController
{
    /**
     * This function configure the application to run in swedish
     * 
     * @return void
     */
    private function configureLocale()
    {
        setlocale(LC_ALL, array('sv_SE', 'swedish_sweden', 'sv'));
        date_default_timezone_set('Europe/Stockholm');
    }
    
	/**
	 * The application runs from here. 
	 *
	 * @return void
	 */
	public function run()
	{
		$this->configureLocale();
		Session::start();

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
			$authenticationModel = new AuthenticationModel();
			
			if ($authenticationModel->isUserAuthenticated())
			{
				$view = new AuthenticationView($authenticationModel);
			}
			else
			{
				$view = new AuthenticationView($authenticationModel);
			}

			$view->createHTML();
			$view->echoHTML();
		}
	}
}