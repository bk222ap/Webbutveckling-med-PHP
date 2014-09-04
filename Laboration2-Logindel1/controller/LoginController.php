<?php

class LoginController
{
	// Controllern frågar UnauthenticatedView om formuläret är ifyllt på korrekt sätt.
	// Just nu görs inte den kontrollen och ingen loggas in, endast vyn byts.
	
	public function giveFeedback()
	{
		$view = null;

		if ($_SERVER['REQUEST_METHOD'] == "GET")
		{
			if (isset($_GET['inloggad']))
			{
				$view = new AuthenticatedView();
			}
			else
			{
				$view = new UnauthenticatedView();
			}
			
			$view->echoHTML();
		}
		else
		{
			if (isset($_POST['logOut']))
			
				
			}
			else if (isset($_POST['logIn']))
			{
				header("Location: ?inloggad=sant");
			}
		}
	}	
}