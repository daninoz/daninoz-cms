<?php

Route::group(['prefix' => 'admin'], function()
{

    Route::resource('categories', 'AdminCategoriesController', ['except' => ['show']]);

    Route::resource('tags', 'AdminTagsController', ['except' => ['show']]);

});