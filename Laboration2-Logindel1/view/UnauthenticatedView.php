<?php

class UnauthenticatedView extends HTMLview
{
	public function __construct()
	{	
		$title = "Ej inloggad";
		$body = "
				<div id='main'>
					<h1>Ej inloggad</h1>
					<form method='POST' action='#'>
						<fieldset>
							<legend>Logga in:</legend>
							<label for='username'>Användarnamn: </label>
							<input id='username' name='username' type='text' autofocus='autofocus' />
							<label for='password'>Lösenord: </label>
							<input id='password' name='password' type='password' />
							<label for='saveCredentialsYes'>
								Håll mig inloggad: <input id='saveCredentialsYes' name='saveCredentials' type='checkbox'>
							</label>
							<input type='submit' name='logIn' value='Logga in' />
						</fieldset>
					</form>
				</div>";
		
		parent::__construct($title, $body);
	}
}
