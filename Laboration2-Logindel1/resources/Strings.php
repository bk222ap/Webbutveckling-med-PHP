<?php

/**
 * This class contains all strings used in the application.
 * 
 * @author Svante Arvedson
 */
class Strings
{
	// salt for cryptation
	public static $Salt = '_Gt65Fr3k';
	
	// Static variables belonging to login and logout forms
	public static $ActionParameterValueLogin = 'login';
	public static $ActionParameterValueLogout = 'logout';
	public static $InputUsername = 'username';
	public static $InputPassword = 'password';
	public static $InputSaveCredentials = 'saveCredentials';
	public static $InputLoginButton = 'login';
	public static $InputLogoutButton = 'logout';
	
	// Static variables belonging to Session
	public static $AuthenticatedUser = 'authenticatedUser';
	public static $Error = 'error';
	
	// Other static variables
	public static $ActionParameterIndex = 'action';
	
	// Error messages for UI
	public static $ErrorLoginNoUsername = 'Användarnamn saknas';
	public static $ErrorLoginNoPassword = 'Lösenord saknas';
	public static $ErrorLoginWrongUsername = 'Felaktigt användarnamn och/eller lösenord';
	public static $ErrorLoginWrongPassword = 'Felaktigt användarnamn och/eller lösenord';
	
	// Exception Messages
	public static $ErrorUserUnset = '$user must not be null.';
	public static $ErrorTitleUnset = '$title must not be null.';
	public static $ErrorBodyUnset = '$body must not be null.';
	public static $ErrorUnexistingUsername = 'Username does not exist.';
	public static $ErrorIsNotPostback = 'The request is not a postback.';
}