<?php
namespace MikeT29\Models;

// view model for home page (web/views/index.php)
class IndexViewModel {
  public $stylesheets;
  public $scripts;
  public $cover_image;
  public $random_image;
  public $toggled_classes; // an associative array of id => class
  public $number_string;
}
