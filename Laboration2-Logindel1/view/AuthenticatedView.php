<?php

/**
 * Handles the View for an authenticated user
 * 
 * @author Svante Arvedson
 */
class AuthenticatedView extends HTMLview
{
	/**
	 * @var User 	The authenticated user
	 */
	private $user;

	/**
	 * Creates the HTML code
	 * 
	 * @throws Exception	Throws exception if $this->user isn't set
	 * @return void
	 */	
	public function createHTML()
	{
		if ($this->user == null)
		{
			throw new Exception(Strings::$ErrorUserUnset);
		}
		$this->setTitle($this->user->getUsername() . ' inloggad');
		$this->setBody($this->createBody());
	}
	
	/**
	 * Assigns $this->user
	 * 
	 * @param User $user	An instance of User
	 * @return void
	 */
	public function setUser(User $user)
	{
		$this->user = $user;
	}
	
	/**
	 * The method creates the HTML code for the documents body tag
	 * 
	 * @return string	The HTML code for the documents body tag
	 */
	private function createBody()
	{
		$body = '<h1>' . $this->user->getUsername() . ' inloggad</h1>
				<p>Välkommen ' . $this->user->getUsername() . '!</p>
				<form method="POST" action="?' . Strings::$ActionParameterIndex . '=' . Strings::$ActionParameterValueLogout . '">
					<input type="submit" name="' . Strings::$InputLogoutButton . '" value="Logga ut" />
				</form>';
				
		return $body;
	}
}
