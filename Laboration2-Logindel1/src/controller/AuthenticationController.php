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
		$model = new AuthenticationModel();	
		$view = new AuthenticationView($model);

        $inputUsername = $view->getUsername();
        $inputPassword = $view->getPassword();

        try
        {
            if ($view->userWantsToSaveCredentials())
            {
                $user = $model->loginUser($inputUsername, $inputPassword, true);
                $view->saveCredentials($user->getUsername(), $user->getPassword());
                $view->addSuccessMessage('Inloggning lyckades och vi kommer ihåg dig till nästa gång');   
            }
            else
            {
                $model->loginUser($inputUsername, $inputPassword);
                $view->addSuccessMessage('Inloggning lyckades');    
            }
        }
        catch (InvalidUsernameException $e)
        {
            $view->addErrorMessage('Användarnamn saknas');
        }
        catch (InvalidPasswordException $e)
        {
            $view->addErrorMessage('Lösenord saknas');
        }
        catch (LoginException $e)
        {
            $view->addErrorMessage('Felaktigt användarnamn och/eller lösenord');
        }
        catch (Exception $e)
        {
            $view->addErrorMessage('Ett fel inträffade när du försökte logga in');
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
		$model = new AuthenticationModel();
        $view = new AuthenticationView($model);
        
		$model->logoutUser();
		$view->removeCredentials();
        $view->addSuccessMessage('Du har nu loggat ut');

		$view->redirect($_SERVER['PHP_SELF']);
	}
    
    public function doLoginWithCredentials()
    {
        $model = new AuthenticationModel();   
        $view = new AuthenticationView($model);
        $savedCredentials = $view->getSavedCredentials();
        
        try
        {
            $model->loginUserWithCredentials($savedCredentials[0], $savedCredentials[1]);
            $view->addSuccessMessage('Inloggning lyckades via cookies');
        }
        catch (Exception $e)
        {
            $view->addErrorMessage('Felaktig information i cookies');
            $view->removeCredentials();
        }

        $view->redirect($_SERVER['PHP_SELF']);
    }
}