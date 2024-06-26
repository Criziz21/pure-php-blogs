<?php

namespace MyApp\Controllers;

use MyApp\Core\FileManager;
use MyApp\toolbar;

class Controller
{
  public function assets() {
    $mime_types = [
        'txt' => 'text/plain',
        'html' => 'text/html',
        'htm' => 'text/html',
        'php' => 'text/php',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'css' => 'text/css',
        'js' => 'text/javascript',
    ];
    
    $file = $_REQUEST["asset"];
    $mime = "images";
    $path = "other";
    foreach( $mime_types as $mime_type => $value ) {
        if(str_ends_with($file, $mime_type)) {
            $mime = $value;
            break;
        }
    }
    if(str_ends_with($mime,  'css')) {
        $path = "css";
    }
    elseif(str_ends_with($mime,  'js')) {
        $path = "js";
    }
    elseif(str_starts_with($mime,  'image')) {
        $path = "images";
    }
    header("content-type: " . $mime); // to show in sources tab
    readfile("./assets/" . $path . "/" . $file);
}
  protected function prepareLayout_v1($filename)
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
  protected function render_v1($layoutAndData)
  {
    $prepareLayout = (!self::str_ends_with_arr($layoutAndData[0], ['.html', '.php', '.htmx', '.template'])) ? self::prepareLayout_v1($layoutAndData[0]) : $layoutAndData[0];
    if (isset($layoutAndData[1])) {
      foreach ($layoutAndData[1] as $key => $value) {
        $prepareLayout = str_replace("{{ " . $key . " }}", $value, $prepareLayout);
      }
    }
    return $prepareLayout;
  }

  protected function renderOne($layoutAndData)
  {
    $prepareLayout = (!self::str_ends_with_arr($layoutAndData[0], ['.html', '.php', '.htmx', '.template'])) ? self::prepareLayout_v1($layoutAndData[0]) : $layoutAndData[0];
    if (isset($layoutAndData[1])) {
      foreach ($layoutAndData[1] as $key => $value) {
        $prepareLayout = str_replace("{{ " . $key . " }}", $value, $prepareLayout);
      }
    }
    return $prepareLayout;
  }

  protected function prepareLayout($new_layout)
  {
    $new_layout = preg_replace_callback('%href=\"(.*?)\"%', function ($matches) {
      $matches[1] = 'href="' . "http://" . 'chat' . '/' . $matches[1] . '"';
      return $matches[1];
    }, $new_layout);
    return $new_layout;
  }
  protected function render($layoutAndData)
  {
    $mainLayout = ''; // prepare layout is garbage
    // toolbar::dump($layoutAndData);
    if (isset($layoutAndData[1])) {
      // toolbar::dump($layoutAndData);
      foreach ($layoutAndData[1] as $arr) {
        // toolbar::dump($arr);

        $new_layout = FileManager::readFile("./templates/" . $layoutAndData[0]);
        foreach ($arr as $key => $value) {
          $new_layout = str_replace("{{ " . $key . " }}", $value, $new_layout);
        }
        $mainLayout = $mainLayout . $new_layout;
        // echo $mainLayout;
      }

    }
    return self::prepareLayout($mainLayout);

  }

  // renders multiple views [$layout, ["var1" => "value1", "var2" => "value2"], ["var1" => "value2", "var2" => "value2"]]
}