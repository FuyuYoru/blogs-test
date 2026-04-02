<?php

$router->get('/', 'HomeController@index');
$router->get('/category/{id}', 'CategoryController@show');
$router->get('/article/{id}', 'ArticleController@show');