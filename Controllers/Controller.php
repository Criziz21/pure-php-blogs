<?php

namespace MyApp\Controllers;

use MyApp\Core\FileManager;

class Controller
{
  protected function prepareLayout($filename)
  {
    $new_layout = FileManager::readFile($filename);
    // task:outsource links don't replace
    $new_layout = preg_replace_callback('%href=\"(.*?)\"%', function ($matches) {
      $matches[1] = 'href="' . "http://" . 'chat' . '/' . $matches[1] . '"';
      return $matches[1];
    }, $new_layout);
    return $new_layout;
  }

  // [$layout, ["var" => "value1", "var2" => "value2"]]
  private function str_ends_with_arr(string $str, array $arr)
  {
    for ($i = 0; $i < count($arr); $i++) {
      if (str_ends_with($str, $arr[$i])) {
        return true;
      }
    }
    return false;
  }
  protected function render($layoutAndData)
  {
    $prepareLayout = (!self::str_ends_with_arr($layoutAndData[0], ['.html', '.php', '.htmx', '.template'])) ? self::prepareLayout($layoutAndData[0]) : $layoutAndData[0];
    if (isset($layoutAndData[1])) {
      foreach ($layoutAndData[1] as $key => $value) {
        $prepareLayout = str_replace("{{ " . $key . " }}", $value, $prepareLayout);
      }
    }
    return $prepareLayout;
  }

  protected function renderOne($layoutAndData)
  {
    $prepareLayout = (!self::str_ends_with_arr($layoutAndData[0], ['.html', '.php', '.htmx', '.template'])) ? self::prepareLayout($layoutAndData[0]) : $layoutAndData[0];
    if (isset($layoutAndData[1])) {
      foreach ($layoutAndData[1] as $key => $value) {
        $prepareLayout = str_replace("{{ " . $key . " }}", $value, $prepareLayout);
      }
    }
    return $prepareLayout;
  }

  protected function renderAll($layoutAndData)
  {

    if (count($layoutAndData[1]) > 1) { // check is not ready
      $mainLayout = "";
      for ($i = 0; $i < count($layoutAndData[1]); $i++) {
        $prepareLayout = (!self::str_ends_with_arr($layoutAndData[0], ['.html', '.php', '.htmx', '.template'])) ? self::prepareLayout($layoutAndData[0]) : $layoutAndData[0];
        if (isset($layoutAndData[1])) {
          foreach ($layoutAndData[1] as $key => $value) {
            $prepareLayout = str_replace("{{ " . $key . " }}", $value, $prepareLayout);
          }
        }
        $mainLayout = $mainLayout . $prepareLayout;
      }
      return $mainLayout;
    } else {
      return self::renderOne($layoutAndData);
    }

  }

  // renders multiple views [$layout, ["var1" => "value1", "var2" => "value2"], ["var1" => "value2", "var2" => "value2"]]
}