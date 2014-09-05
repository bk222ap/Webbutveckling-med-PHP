<?php

class AuthenticationController
{
	public function doLogin()
	{
		$view = new UnauthenticatedView()
		
		$user = new User($view->getUsername());
		$view = new AuthenticatedView();
		$view->setUser($user);
		$view->createHTML();
		$view->echoHTML();
	}
	
	public function doLogout()
	{
		$view = new UnauthenticatedView();
		$view->createHTML();
		$view->echoHTML();
	}
}