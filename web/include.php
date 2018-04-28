<?php

const ONE_DAY = 86400; // in seconds

class DivSettings {
  public $div_toggled;

  public function __construct() {
    $this->div_toggled = array_fill(0, 4, '');
    for ($i = 1; $i <= 4; $i++) {
      $id = 'div' . $i;
      if (isset($_COOKIE[$id])) {
        if ($_COOKIE[$id]) {
          $this->div_toggled[$i - 1] = 'toggled';
        }
      }
    }
  }

  public function get_toggled_class($divNum) {
    return $this->div_toggled[$divNum - 1];
  }
}

function get_random_image($images) {
  $num_images = count($images);
  $random = random_int(0, $num_images - 1);
  return $images[$random];
}

// generate number string: 1 3 5 7 9 7 5 3 1
function get_number_string() {
  $str = '';
  for ($i = 0; $i < 9; $i++) {
    if ($i > 0) {
      $str = $str . ' ';
    }
    $str = $str . calc_next_number($i);
  }
  return $str;
}

function calc_next_number($i) {
  $num = 2 * $i + 1;
  if ($num > 9) {
    return 18 - $num;
  }
  return $num;
}

// set cookie to save div toggle state from AJAX POST request
function save_state() {
  for ($i = 1; $i <= 4; $i++) {
    $id = 'div' . $i;
    if (isset($_POST[$id])) {
      setcookie($id, $_POST[$id], time() + ONE_DAY * 30);
    }
  }
}
