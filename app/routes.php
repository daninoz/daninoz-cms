<?php

Route::group(['prefix' => 'admin'], function()
{

    Route::resource('categories', 'AdminCategoriesController', ['except' => ['show']]);

});
