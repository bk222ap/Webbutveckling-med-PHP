<?php

class AuthenticatedView extends HTMLview
{
	public function __construct()
	{	
		$title = "Ulla inloggad";
		$body = "
				<div id='main'>
					<h1>Ulla inloggad</h1>
					<p>Välkommen Ulla!</p>
					<form method='POST' action='#'>
						<fieldset>
							<legend>Logga ut:</legend>
							<input type='button' name='logOut' value='Logga ut' />
						</fieldset>
					</form>
				</div>";
		
		parent::__construct($title, $body);
	}
}
