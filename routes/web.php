<?php

use Lib\Route;

Route::get('/', function () {
    echo 'Hola mundo';
});

Route::get('/hola', function () {
    echo 'Hola';
});
