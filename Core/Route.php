<?php

namespace MyApp\Core;

class Route
{
    static $getTC = [];
    static $postTC = [];
    static function get(string $track, $callback)
    {
        self::$getTC[$track] = $callback;
        // if we want to use post and get methods in same track, we change method of storing $track in $trackAndControllers
        // maybe use two variables to store
    }
    static function post(string $track, $callback)
    {
        self::$postTC[$track] = $callback;
        // need jquery to extract data in exucte method
    }
    static function check($track, $uri)
    {
        $trackSplits = explode("/", $track);
        $uriSplits = explode("/", $uri);
        if (count($trackSplits) != count($uriSplits)) {
            return false;
        }
        for ($i = 0; $i < count($trackSplits); $i++) {
            if (str_contains($trackSplits[$i], "{")) {
                var_dump($trackSplits[$i]);
                $_REQUEST[trim($trackSplits[$i], "{}")] = $uriSplits[$i];
                continue;
            }
            if ($trackSplits[$i] != $uriSplits[$i]) {
                return false;
            }
        }
        return true;
    }
    static function execute()
    {
        // var_dump($_SERVER["REQUEST_URI"]);
        foreach (($_SERVER['REQUEST_METHOD'] == "GET" ? self::$getTC : self::$postTC) as $track => $callback) {
            if (self::check($track, $_SERVER["REQUEST_URI"])) {
                if (is_callable($callback)) {
                    $callback();
                    return;
                } else {
                    (new $callback[0])->{$callback[1]}();
                    return;
                }

            }
        }
        echo "404";
    }
}