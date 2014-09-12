<?php

require_once ("src/resources/helpers/Session.php");
require_once ("src/resources/helpers/Request.php");
require_once ("src/view/Cookie.php");
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

// AppController runs the application
$appController = new AppController();
$appController->run();