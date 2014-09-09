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
		$authenticationModel = new AuthenticationModel();	
		$view = new AuthenticationView($authenticationModel);

        if ($view->getUsername() == '' || $view->getPassword() == ''){
            if ($view->getUsername() == '')
            {
                $view->addErrorMessage('Användarnamn saknas');
            }
            else
            {
                $view->addErrorMessage('Lösenord saknas');
            }
        }
        else
        {
            try
            {
                // Throws Exception if $inputUsername doesn't exist
                $user = new User($view->getUsername());
                
                if (Helper::cryptPassword($view->getPassword()) != $user->getPassword())
                {
                    $view->addErrorMessage('Felaktigt användarnamn och/eller lösenord');
                }
                else
                {
                    // Successful login
                    $view->addSuccessMessage('Inloggning lyckades');
                    $authenticationModel->loginUser($user);
                }
            }
            catch (Exception $e)
            {
                $view->addErrorMessage('Felaktigt användarnamn och/eller lösenord');
            }
        }
        
        $view->redirect($_SERVER['PHP_SELF']);
	}
	
	/**
	 * Are doing the logout.
	 * 
	 * @return void
	 */
	public function doLogout()
	{
		$authenticationModel = new AuthenticationModel();
		$authenticationModel->logoutUser();

        $view = new AuthenticationView($authenticationModel);
        $view->addSuccessMessage('Du har nu loggat ut');

		$view->redirect($_SERVER['PHP_SELF']);
	}
}