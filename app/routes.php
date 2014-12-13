<?php

Route::get('/', [
    'before' => 'permission:post-editor',
    'uses' => 'HomeController@index'
]);

Route::get('login', 'SessionController@store');
