<?php

namespace MyApp\Core;

class FileManager
{

  // Function to create a new file 
  static function createFile($filename, $content)
  {
    $file = fopen($filename, 'w');
    fwrite($file, $content);
    fclose($file);
  }

  // Function to read a file 
  static function readFile($filename)
  {
    $file = fopen($filename, 'r');
    $content = fread($file, filesize($filename));
    fclose($file);
    return $content;
  }

  // Function to write to a file 
  static function writeFile($filename, $content)
  {
    $file = fopen($filename, 'w');
    fwrite($file, $content);
    fclose($file);
  }

  static function appendFile($filename, $content)
  {
    $file = fopen($filename, 'a');
    fwrite($file, $content);
    fclose($file);
  }

  static function getLines(string $path)
  {
    $file = fopen($path, 'r');
    if (!$file) {
      throw new \Exception();
    }
    while ($line = fgets($file)) {
      yield $line;
    }
    fclose($file);
  }

  // Function to delete a file 
  static function deleteFile($filename)
  {
    if (file_exists($filename)) {
      unlink($filename);
      return true;
    } else {
      return false;
    }
  }

    // public static function replaceHref($matches) {
      
    // }

  
}