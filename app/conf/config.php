<?php

define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define('CONTROLLER_PATH', ROOT . "/controllers/");
define('MODEL_PATH', ROOT . "/models/");
define('VIEW_PATH', ROOT . "/views/");
define('CONFIG_PATH', ROOT . "/conf/");

require_once (CONFIG_PATH . "db.php");

