<?php

require_once ("resources/Helpers.php");
require_once ("resources/Strings.php");
require_once ("view/HTMLView.php");
require_once ("view/AuthenticatedView.php");
require_once ("view/UnauthenticatedView.php");
require_once ("controller/AppController.php");
require_once ("controller/AuthenticationController.php");
require_once ("model/User.php");

$appController = new AppController();

$appController->run();