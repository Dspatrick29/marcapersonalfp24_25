<?php


Route::get('curriculos', [CurriculoController::class, 'getIndex']);
Route::get('curriculos/show/{id}', [CurriculoController::class, 'getShow']);
Route::get('curriculos/create', [CurriculoController::class, 'getCreate']);
Route::get('curriculos/edit/{id}', [CurriculoController::class, 'getEdit']);
