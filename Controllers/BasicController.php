<?php

namespace MyApp\Controllers;

use MyApp\Core\FileManager;

class BasicController extends Controller
{
    
    public function index() // there it needs abstaction layer for the headers, response class 
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