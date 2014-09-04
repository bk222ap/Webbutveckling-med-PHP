<?php

require_once ("view/HTMLView.php");
require_once ("view/AuthenticatedView.php");
require_once ("view/UnauthenticatedView.php");
require_once ("controller/LoginController.php");

$LoginController = new LoginController();

$LoginController->giveFeedback();