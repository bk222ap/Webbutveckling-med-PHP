<?php

class AuthenticatedView extends HTMLview
{
	private $user;
	
	public function createHTML()
	{
		if ($this->user == null)
		{
			throw new Exception(Strings::$ErrorUserUnset);
		}
		
		$username = $this->user->getUsername();
		
		$this->setTitle($username . ' inloggad');
		$this->setBody(
			'<h1>' . $this->user->getUsername() . ' inloggad</h1>
			<p>Välkommen ' . $username . '!</p>
			<form method="POST" action="?' . Strings::$ActionParameterIndex . '=' . Strings::$ActionParameterValueLogout . '">
				<input type="submit" name="' . Strings::$InputLogoutButton . '" value="Logga ut" />
			</form>'
		);
	}
	
	public function setUser(User $user)
	{
		$this->user = $user;
	}
}
