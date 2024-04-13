<?php
use MyApp\Controllers\BlogController;
use MyApp\Core\FileManager;
use MyApp\Core\Route;
use MyApp\Controllers\BasicController;


Route::get("/test/", [BlogController::class, "index"]);
Route::get("/css/{css}", [BasicController::class, "css"]);

// Route::get("/test/", [BlogController::class,"index"]);

// Route::get("/dd", [BasicController::class, "show"]);
// Route::post("/dd", [BasicController::class, "store"]);


// Route::get("/", function () {
//     FileManager::render("index.html");
// });
// echo "dsaf";
Route::execute();