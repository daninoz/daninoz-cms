<?php

namespace DaninozCms\Repositories;

use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        $app->bind('DaninozCms\Repositories\Categories\CategoriesRepositoryInterface',
            'DaninozCms\Repositories\Categories\CategoriesEloquentRepository');

        $app->bind('DaninozCms\Repositories\Tags\TagsRepositoryInterface',
            'DaninozCms\Repositories\Tags\TagsEloquentRepository');
    }

}