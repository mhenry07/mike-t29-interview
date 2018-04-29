<?php
namespace MikeT29\Models;

class T29 {
  private const FILE_MAP_PATH = __DIR__ . '/../../build/file-map.json';

  private $t29_settings;
  private $div_state_service;
  private $file_map;

  public function __construct($t29_settings, $div_state_service) {
    $this->t29_settings = $t29_settings;
    $this->div_state_service = $div_state_service;
  }

  // randomly select an image and return its URL
  public function getRandomImage() {
    $images = $this->t29_settings['random_images'];
    $num_images = count($images);
    $random = self::randomInt(0, $num_images - 1);
    return $images[$random];
  }

  // generate number string: 1 3 5 7 9 7 5 3 1
  public function getNumberString() {
    $str = '';
    for ($i = 0; $i < 9; $i++) {
      if ($i > 0) {
        $str .= ' ';
      }
      $str .= $this->calcNextNumber($i);
    }
    return $str;
  }

  private function calcNextNumber($i) {
    $num = 2 * $i + 1;
    if ($num > 9) {
      return 18 - $num;
    }
    return $num;
  }

  // get list of css classes representing toggle states for each div
  private function mapToggleStatesToClasses() {
    $result = array();
    $div_toggle_states = $this->div_state_service->loadStates();
    foreach ($div_toggle_states as $div => $state) {
      $result[$div] = $state ? 'toggled' : '';
    }
    return $result;
  }

  // get data and map to view model for index view
  public function createViewModel() {
    $result = new IndexViewModel();
    $result->stylesheets = $this->getStylesheets();
    $result->scripts = $this->getScripts();
    $result->cover_image = $this->t29_settings['cover_image'];
    $result->random_image = $this->getRandomImage();
    $result->toggled_classes = $this->mapToggleStatesToClasses();
    $result->number_string = $this->getNumberString();
    return $result;
  }

  public function getStylesheets() {
    return $this->getAssetFiles('.css',
      array('assets/reset.css', 'assets/style.css'));
  }

  public function getScripts() {
    return $this->getAssetFiles('.js', array('assets/script.js'));
  }

  // get list of asset files based on extension (.css or .js)
  // $ext is '.css' or '.js'
  // $default_files is an array of default filenames
  private function getAssetFiles($ext, $default_files) {
    $result = array();

    // attempt to get list of grunt minified, versioned files
    if ($this->loadFileMap()) {
      $result = $this->getVersionedFiles($ext);
    }

    // but if that fails, return default list of source files
    if (count($result) === 0) {
      $result = $default_files;
    }
    return $result;
  }

  // attempt to load the file map which maps minified filenames to versioned filenames (for cache busting)
  private function loadFileMap() {
    if (!isset($this->file_map)) {
      if (file_exists(self::FILE_MAP_PATH)) {
        $json = file_get_contents(self::FILE_MAP_PATH);
        $decoded = json_decode($json, true);
        if (json_last_error() === JSON_ERROR_NONE) {
          $this->file_map = $decoded;
          return true;
        }
      }
      return false;
    }
    return true;
  }

  // attempt to get list of versioned filenames matching the specified file extension
  // $ext is the file extension, e.g. '.css', '.js', etc.
  private function getVersionedFiles($ext) {
    $result = array();
    foreach ($this->file_map as $map) {
      $versionedPath = $map['versionedPath'];
      if (self::stringEndsWith($versionedPath, $ext) && file_exists($this->t29_settings['web_dir'] . '/' . $versionedPath)) {
        $result[] = $versionedPath;
      }
    }
    return $result;
  }

  // utilities

  private static function stringEndsWith($haystack, $needle) {
    $len = strlen($needle);
    return strpos(strtolower($haystack), strtolower($needle), -$len) !== FALSE;
  }

  // use PHP 7 random_int or fall back to old rand
  private static function randomInt($min, $max) {
    if (function_exists('random_int')) {
      return random_int($min, $max);
    } else {
      return rand($min, $max);
    }
  }
}
