<?php

class AuthenticationView extends HTMLView
{
    private $authenticationModel;
    private $cookie;
    private static $placeErrorMessage = 'AuthenticationView::ErrorMessage';
    private static $placeSuccessMessage = 'AuthenticationView::SuccessMessage';
    private static $placeLastUsernameInput = 'AuthenticationView::LastUsernameInput';
    //private static $ActionParameterIndex = 'action';
    private static $NameUsername = 'username';
    private static $NamePassword = 'password';
    private static $NameSaveCredentials = 'saveCredentials';
    private static $NameLoginButton = 'login';
    private static $NameLogoutButton = 'logout';
    
    public function __construct(AuthenticationModel $authenticationModel)
    {
        $this->authenticationModel = $authenticationModel;
        $this->cookie = new Cookie();
        
        if (Request::isPostback())
        {
            $this->addLastUsernameInput($this->getUsername());
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
                <h2>' . $this->authenticationModel->getUser()->getUsername() . ' inloggad</h2>';
        
        if ($successMessage != '')
        {
            $body .= '<p class="success">' . $successMessage . '</p>';
        }
                
        $body .='
                <form method="POST" action="?' . self::$ActionParameterIndex . '=' . Strings::$ActionParameterValueLogout . '">
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
                <form method="POST" action="?' . self::$ActionParameterIndex . '=' . Strings::$ActionParameterValueLogin . '">
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
        
        if ($this->authenticationModel->isUserAuthenticated())
        {
            $title .= $this->authenticationModel->getUser()->getUsername() . ' inloggad';
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
}