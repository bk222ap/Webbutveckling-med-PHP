<?php

/**
 * This class contains all strings used in the application.
 * 
 * @author Svante Arvedson
 */
class Strings
{
	// static variables
	public static $ActionParameterIndex = 'action';
	public static $ActionParameterValueLogin = 'login';
	public static $ActionParameterValueLogout = 'logout';
	public static $InputUsername = 'username';
	public static $InputPassword = 'password';
	public static $InputSaveCredentials = 'saveCredentials';
	public static $InputLoginButton = 'login';
	public static $InputLogoutButton = 'logout';
	
	// Error messages for UI
	public static $ErrorLoginNoUsername = 'Du måste ange ett användarnamn!';
	public static $ErrorLoginNoPassword = 'Du måste ange ett lösenord!';
	public static $ErrorLoginWrongUsername = 'Felaktigt användarnamn!';
	public static $ErrorLoginWrongPassword = 'Felaktigt lösenord!';
	
	// Exception Messages
	public static $ErrorUserUnset = '$user must be an instance of User.';
	public static $ErrorTitleUnset = '$title must not be null.';
	public static $ErrorBodyUnset = '$body must not be null.';
	public static $ErrorUnexistingUsername = 'Username does not exist.';
	public static $ErrorIsNotPostback = 'The request is not a postback.';
}