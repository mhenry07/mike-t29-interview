<?php
namespace MikeT29\Models;

class DivStateService {
  public const DIVS = array('div1', 'div2', 'div3', 'div4');
  private const ONE_DAY = 86400; // in seconds

  // load div toggle states from cookies
  // returns an associative array of booleans representing whether each div is toggled
  public function loadStates() {
    $result = array();
    foreach (self::DIVS as $div) {
      $result[$div] = (isset($_COOKIE[$div]) && $_COOKIE[$div]);
    }
    return $result;
  }

  // set cookie to save div toggle state from AJAX POST request
  public function saveState($div, $state) {
    setcookie($div, $state, time() + self::ONE_DAY * 30);
  }
}
