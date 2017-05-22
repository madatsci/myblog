<?php

ini_set('display_errors', E_ALL);

require_once '../app/core/Route.php';
require_once '../app/core/Config.php';
require_once '../app/core/Validator.php';
require_once '../app/core/DataBase.php';
require_once '../app/core/MyLogger.php';
require_once '../app/core/Controller.php';
require_once '../app/core/View.php';
require_once '../app/core/Model.php';

session_start();
\App\Core\Route::start();
