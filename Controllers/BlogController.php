<?php

namespace MyApp\Controllers;
use MyApp\Models\BlogModel;
use MyApp\toolbar;
class BlogController extends Controller {
    public function index() {
        $blogs = BlogModel::readBlogs();
        // need to create multiple rendering for blogs

        // toolbar::dump($blogs);
        echo $this->render([ "index.html" => ['content' => $this->render(['blog__post.html', $blogs])] ]); 
    }
}