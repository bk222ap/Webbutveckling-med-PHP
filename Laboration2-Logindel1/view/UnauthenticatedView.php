<?php

class UnauthenticatedView extends HTMLview
{
	public function createHTML()
	{
		$this->setTitle("Ej inloggad");
		$this->setBody(
			'<h1>Ej inloggad</h1>
			<form method="POST" action="?' . Strings::$ActionParameterIndex . '=' . Strings::$ActionParameterValueLogin . '">
				<fieldset>
					<legend>Logga in:</legend>
					<label for="' . Strings::$InputUsername . '">Användarnamn: </label>
					<input id="' . Strings::$InputUsername . '" name="' . Strings::$InputUsername . '" type="text" autofocus="autofocus" />
					<label for="' . Strings::$InputPassword . '">Lösenord: </label>
					<input id="' . Strings::$InputPassword . '" name="' . Strings::$InputPassword . '" type="password" />
					<label for="' . Strings::$InputSaveCredentials . '">
						Håll mig inloggad: <input id="' . Strings::$InputSaveCredentials . '" name="' . Strings::$InputSaveCredentials . '" type="checkbox">
					</label>
					<input type="submit" name="' . Strings::$InputLoginButton . '" value="Logga in" />
				</fieldset>
			</form>'
		);
	}
	
	public function getUsername()
	{
		return Helpers::getPostParameter(Strings::$InputUsername);
	}
	
	public function getPassword()
	{
		return Helpers::getPostParameter(Strings::$InputPassword);
	}
}
