<?php

namespace MyApp\Controllers;

class BasicController extends Controller
{
    public function css(){
        header("content-type: text/css");
        // $path = $_REQUEST["css"];
        // // $len = strlen($path);
        // var_dump(str_replace($path,'', "/"));
        // $path = explode("/", $path);
        // 
        // echo file_get_contents("./css/" . $path[count($path) - 1]);
        echo file_get_contents("./css/" . $_REQUEST["css"]);
    }

    public function index()
    {
        echo file_get_contents("index.html");
    }

    public function show() {
        echo file_get_contents("form.html");
    }

    public function store() {
        var_dump($_POST);
    }
    public function getTxt($txt)
    {
        echo $txt;
    }
}