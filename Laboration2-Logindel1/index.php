<?php

require_once ("src/view/CookieService.php");
require_once ("src/view/HTMLView.php");
require_once ("src/view/AuthenticationView.php");
require_once ("src/controller/AppController.php");
require_once ("src/controller/AuthenticationController.php");
require_once ("src/model/AuthenticationModel.php");
require_once ("src/model/User.php");
require_once ("src/model/TempUser.php");
require_once ("src/model/LoginException.php");
require_once ("src/model/InvalidUsernameException.php");
require_once ("src/model/InvalidPasswordException.php");
require_once ("src/model/HTMLException.php");
require_once ("src/model/SessionService.php");

// AppController runs the application
$appController = new AppController();
$appController->run();