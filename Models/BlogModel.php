<?php

namespace MyApp\Models;

use MyApp\Core\FileManager;

class BlogModel {
    // public $id;
    // public $title;
    // public $content;
    // public $created_at;
    // public $updated_at;
    // public $deleted_at;
    // public $created_by;
    // public $updated_by;
    static $blogs = [];
    static $blogs_last_id = 0;

    static function readBlogs() {
        self::$blogs = [];
        $data = [];
        foreach(FileManager::getLines('./db.txt') as $Line) {
            // echo $Line;
            $data[] = explode(';', $Line);
            for ($i = 0; $i < count($data); $i++) {
                [self::$blogs[$i]['id'], self::$blogs[$i]['title'], self::$blogs[$i]['content']] = $data[$i];
            }
        }
        self::$blogs_last_id = end($data)[0];
        return self::$blogs;
    }

    static function updateInfo() {
        if(filesize('./db.txt') > 10) {
            self::readBlogs();
        }
        return;
    }
    static function createBlog($data) {
        self::updateInfo();
        $cur = (string)(((int)(self::$blogs_last_id)) + 1);
        $blog = ($cur == "1" ? '' : "\n") . $cur . ';' . $data['title'] . ';' . $data['content'];
        FileManager::appendFile('./db.txt', $blog);
    }
}