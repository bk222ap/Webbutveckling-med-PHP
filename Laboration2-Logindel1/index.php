<?php

require_once ("src/resources/helpers/Helper.php");
require_once ("src/resources/helpers/Session.php");
require_once ("src/resources/helpers/Request.php");
require_once ("src/resources/Strings.php");
require_once ("src/view/Cookie.php");
require_once ("src/view/HTMLView.php");
require_once ("src/view/AuthenticationView.php");
require_once ("src/controller/AppController.php");
require_once ("src/controller/AuthenticationController.php");
require_once ("src/model/AuthenticationModel.php");
require_once ("src/model/User.php");

// AppController runs the application
$appController = new AppController();
$appController->run();