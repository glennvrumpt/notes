<?php

$router->get('/', 'NoteController@index');
$router->post('/note', 'NoteController@store');
$router->get('/note/{id}', 'NoteController@show');
$router->put('/note/{id}', 'NoteController@update');
$router->delete('/note/{id}', 'NoteController@destroy');
