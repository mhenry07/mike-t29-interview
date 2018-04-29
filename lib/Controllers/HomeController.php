<?php
namespace MikeT29\Controllers;

use \MikeT29\Models as Models;

class HomeController {
  private $t29_settings;
  private $div_state_service;

  public function __construct($t29_settings, $div_state_service) {
    $this->t29_settings = $t29_settings;
    $this->div_state_service = $div_state_service;
  }

  // default index action (for GET requests)
  public function index() {
    $t29 = new Models\T29($this->t29_settings, $this->div_state_service);

    $model = $t29->createViewModel();
    require_once($this->t29_settings['web_dir'] . '/views/index.php');
  }

  // saveState action (for AJAX POST requests)
  public function saveState() {
    foreach (Models\DivStateService::DIVS as $div) {
      if (isset($_POST[$div])) {
        $state = ($_POST[$div] == 1) ? 1 : 0;
        $this->div_state_service->saveState($div, $state);
      }
    }
  }
}
