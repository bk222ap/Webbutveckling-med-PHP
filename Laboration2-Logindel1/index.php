<?php

require_once ("resources/helpers/Helper.php");
require_once ("resources/helpers/Session.php");
require_once ("resources/helpers/Request.php");
require_once ("resources/Strings.php");
require_once ("view/HTMLView.php");
require_once ("view/AuthenticatedView.php");
require_once ("view/UnauthenticatedView.php");
require_once ("controller/AppController.php");
require_once ("controller/AuthenticationController.php");
require_once ("model/User.php");

// AppController runs the application
$appController = new AppController();
$appController->run();