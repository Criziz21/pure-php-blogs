<?php

namespace MyApp\Controllers;
use MyApp\Models\BlogModel;
use MyApp\toolbar;
class BlogController extends Controller {

    public function test(array $data) {
        toolbar::dump($data);
        
    }

    public function index() {
        $blogs = BlogModel::readBlogs();
        // need to create multiple rendering for blogs

        // toolbar::dump($blogs);
        // toolbar::dump([['content' => 'str']]);
        // $this->test([["id" => 1, "title" => "new_title","content" => "sm content"], ["id" => 1, "title" => "new_title","content" => "sm content"], []]);
        echo $this->render([ "index.html", [['blogs' => $this->render(['blog__post.html', $blogs])]] ]); 
        // echo $this->render(["index.html", [['blogs' => 'str']]]);
        // echo $this->render(['blog__post.html', $blogs]);

    }
}