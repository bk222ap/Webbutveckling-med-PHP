<?php

/**
 * Handles the view for an unauthenticated user
 * 
 * @author Svante Arvedson
 */
class UnauthenticatedView extends HTMLview
{
	/**
	 * @var string	Contains error message
	 */
	private $errorMessage;
	
	/**
	 * Creates the HTML code
	 * 
	 * @return void
	 */	
	public function createHTML()
	{
		$this->setTitle("Ej inloggad");
		$this->setBody($this->createBody());
	}
	
	/**
	 * Returns the username given in the form
	 * 
	 * @throws Exception	Throws exception if request isn't postback
	 * @return string	The username given in the form
	 */
	public function getUsername()
	{
		if (!Request::isPostback())
		{
			throw new Exception(Strings::$ErrorIsNotPostback);
		}
		
		return Request::getPOST(Strings::$InputUsername);
	}
	
	/**
	 * Returns the password given in the form
	 * 
	 * @throws Exception	Throws exception if request isn't postback
	 * @return string	The password given in the form
	 */
	public function getPassword()
	{
		if (!Request::isPostback())
		{
			throw new Exception(Strings::$ErrorIsNotPostback);
		}
		
		return Request::getPOST(Strings::$InputPassword);
	}
	
	/**
	 * Setter for $this->errorMessage
	 * 
	 * @param string $errorMessage	A string with the error message
	 * @return void
	 */
	public function setErrorMessage($errorMessage)
	{
		$this->errorMessage = $errorMessage;
	}
	
	/**
	 * Creates the HTML for the documents body
	 * 
	 * @return string	The HTML code
	 */
	private function createBody()
	{
		$body = '<h1>Laboration 2 - ba222ec</h1>
				<h2>Ej inloggad</h2>
				<form method="POST" action="?' . Strings::$ActionParameterIndex . '=' . Strings::$ActionParameterValueLogin . '">
					<fieldset>
						<legend>Logga in:</legend>' . "\n";
		// If there is an error massage
		if ($this->errorMessage != null)
		{
			$body .= '<p>' . $this->errorMessage . '</p>' . "\n";
		}
		$body .= '<label for="' . Strings::$InputUsername . '">Användarnamn: </label>
					<input id="' . Strings::$InputUsername . '" name="' . Strings::$InputUsername . '" type="text" autofocus="autofocus" />
					<label for="' . Strings::$InputPassword . '">Lösenord: </label>
					<input id="' . Strings::$InputPassword . '" name="' . Strings::$InputPassword . '" type="password" />
					<label for="' . Strings::$InputSaveCredentials . '">
						Håll mig inloggad: <input id="' . Strings::$InputSaveCredentials . '" name="' . Strings::$InputSaveCredentials . '" type="checkbox">
					</label>
					<input type="submit" name="' . Strings::$InputLoginButton . '" value="Logga in" />
				</fieldset>
			</form>';
			
		return $body;
	}
}
