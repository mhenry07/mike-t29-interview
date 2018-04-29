<?php
// author: Mike Henry, 2018

// use Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

use \MikeT29\Controllers as Controllers;
use \MikeT29\Models as Models;

require_once('settings.php');

$div_state_service = new Models\DivStateService();
$controller = new Controllers\HomeController($t29_settings, $div_state_service);

// determine route and route to appropriate action on controller
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $controller->saveState();
} else {
  $controller->index();
}
