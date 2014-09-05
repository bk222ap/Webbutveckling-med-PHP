<?php

class User
{
	private $username;
	private $password;
	
	public function __construct($username) 
	{
		// For the moment this is not data from a database.
		if ($username != "Admin") 
		{
			throw new Exception("Unexisting username");
		}
		
		$this->username = $username;
		$this->password = "Password"; // This should also be fetched from the database.
	}
	
	public function getUsername()
	{
		return $this->username;
	}
	
	public function getPassword()
	{
		return $this->password;
	}
}
