<?php

class AuthenticationView extends HTMLView
{
    private $model;
    private $cookie;
    private static $placeErrorMessage = 'AuthenticationView::ErrorMessage';
    private static $placeSuccessMessage = 'AuthenticationView::SuccessMessage';
    private static $placeLastUsernameInput = 'AuthenticationView::LastUsernameInput';
    private static $placeSavedUsername = 'AuthenticationView::SavedUsername';
    private static $placeSavedPassword = 'AuthenticationView::SavedPassword';
    private static $NameUsername = 'username';
    private static $NamePassword = 'password';
    private static $NameSaveCredentials = 'saveCredentials';
    private static $NameLoginButton = 'login';
    private static $NameLogoutButton = 'logout';
    
    public function __construct(AuthenticationModel $model)
    {
        $this->model = $model;
        $this->cookie = new Cookie();
        
        if (Request::isPostback())
        {
            if ($this->userPressedLogin())
            {
                $this->addLastUsernameInput($this->getUsername());
            }
        }
    }
    
    private function createAuthenticatedBody()
    {
        $errorMessage = $this->getErrorMessage();
        $successMessage = $this->getSuccessMessage();
        $lastUsernameInput = $this->getLastUsernameInput();

        $body = '
            <div id="main">
                <h1>Laboration 2 - ba222ec</h1>
                <h2>' . $this->model->getUser()->getUsername() . ' är inloggad</h2>';
        
        if ($successMessage != '')
        {
            $body .= '<p class="success">' . $successMessage . '</p>';
        }
                
        $body .='
                <form method="POST" action="">
                    <input type="submit" name="' . self::$NameLogoutButton . '" value="Logga ut" />
                </form>' . "\n";
                
        return $body;
    }
    
    private function createUnauthenticatedBody()
    {
        $errorMessage = $this->getErrorMessage();
        $successMessage = $this->getSuccessMessage();
        $lastUsernameInput = $this->getLastUsernameInput();
        
        $body = '
            <div id="main">
                <h1>Laboration 2 - ba222ec</h1>
                <h2>Ej inloggad</h2>';
        
        if ($successMessage != '')
        {
            $body .= '<p class="success">' . $successMessage . '</p>';
        }
                    
        $body .='
                <form method="POST" action="">
                    <fieldset>
                        <legend>Logga in:</legend>' . "\n";

        // If there is an error massage
        if ($errorMessage != '')
        {
            $body .= '<p class="error">' . $errorMessage . '</p>' . "\n";
        }
            
        $body .= '<span class="row">
                    <label for="' . self::$NameUsername . '">Användarnamn: </label>
                    <input id="' . self::$NameUsername . '" name="' . self::$NameUsername . 
                       '" type="text" autofocus="autofocus" value="' . $lastUsernameInput . '" />
                 </span>
                 <span class="row">
                      <label for="' . self::$NamePassword . '">Lösenord: </label>
                      <input id="' . self::$NamePassword . '" name="' . self::$NamePassword . '" type="password" />
                 </span>
                 <span class="row">
                      <label for="' . self::$NameSaveCredentials . '">
                          Håll mig inloggad: <input id="' . self::$NameSaveCredentials . '" name="' . self::$NameSaveCredentials . '" type="checkbox">
                      </label>
                 </span>
                 <span class="row">
                    <input type="submit" name="' . self::$NameLoginButton . '" value="Logga in" />
                 </span>
                 </fieldset>
            </form>' . "\n";
            
        return $body;
    }

    public function createHTML()
    {
        $body = '';
        $title = '';
        $date = ucfirst(utf8_encode(strftime('%A den %#d %B ' . utf8_decode('år') . ' %Y. Klockan ' . utf8_decode('är') . ' [%H:%M:%S].')));
        
        if ($this->model->isUserAuthenticated())
        {
            $title .= $this->model->getUser()->getUsername() . ' är inloggad';
            $body .= $this->createAuthenticatedBody();
        }
        else
        {
            $title .= 'Ej inloggad';
            $body .= $this->createUnauthenticatedBody();
        }
        
        $body .= '<p>' . $date . '</p>
            </div>';
        
        $this->setBody($body);
        $this->setTitle($title);
    }

    public function getPassword()
    {
        return Request::getPOST(self::$NamePassword);
    }
    
    public function getUsername()
    {
        return Request::getPOST(self::$NameUsername);
    }

    public function addErrorMessage($message)
    {
        $this->cookie->saveCookie(self::$placeErrorMessage, $message);
    }
    
    public function addSuccessMessage($message)
    {
        $this->cookie->saveCookie(self::$placeSuccessMessage, $message);
    }
    
    public function saveCredentials($username, $password)
    {
        $this->cookie->saveCookie(self::$placeSavedUsername, $username, time()+$this->model->getExpirationOfCookies());
        $this->cookie->saveCookie(self::$placeSavedPassword, $password, time()+$this->model->getExpirationOfCookies());
    }
    
    public function userWantsToSaveCredentials()
    {
        return Request::isPOSTset(self::$NameSaveCredentials);
    }

    public function userPressedLogin()
    {
        return Request::isPOSTset(self::$NameLoginButton);
    }

    public function userPressedLogout()
    {
        return Request::isPOSTset(self::$NameLogoutButton);
    }

    public function removeCredentials()
    {
        $this->cookie->unsetCookie(self::$placeSavedUsername);
        $this->cookie->unsetCookie(self::$placeSavedPassword);
    }

    public function getSavedCredentials()
    {
        $username = $this->cookie->loadCookie(self::$placeSavedUsername);
        $password = $this->cookie->loadCookie(self::$placeSavedPassword);
        
        return array($username, $password);
    }

    private function addLastUsernameInput($lastInput)
    {
        $this->cookie->saveCookie(self::$placeLastUsernameInput, $lastInput);
    }
    
    private function getLastUsernameInput()
    {
        return $this->cookie->loadOnceCookie(self::$placeLastUsernameInput);
    }
    
    private function getErrorMessage()
    {
        return $this->cookie->loadOnceCookie(self::$placeErrorMessage);
    }
    
    private function getSuccessMessage()
    {
        return $this->cookie->loadOnceCookie(self::$placeSuccessMessage);
    }

    public function credentialsIsSaved()
    {
        return $this->cookie->cookieIsset(self::$placeSavedUsername) && $this->cookie->cookieIsset(self::$placeSavedPassword);
    }
}