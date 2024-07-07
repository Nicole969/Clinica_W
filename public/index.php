<?php

require_once '../lib/Route.php';

use Lib\Route;

Route::get('/', function () {
    echo "Hola mundo";
});

Route::get('/hola', function () {
    echo "Hola";
});

Route::get('/hola/{name}', function ($name) {
    echo "Hola $name";
});
