<?php

namespace App\Helpers;

class OptionsHelper
{
  /**
   * Private constructor, `new` is disallowed by design.
   */
  private function __construct()
  { }

  public static function getOption($option, $default = null){
    if($result = \App\Models\Option::where('option', $option)->value('value')) {
      return $result;
    }
    else {
      return $default;
    }
  }
}