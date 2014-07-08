<?php

Validator::extend('repo_unique', function($attribute, $value, $parameters)
{
    $repositoryName = ucfirst($parameters[0]);

    if (! isset($parameters[1])) {
        $attribute = $parameters[1];
    }

    $repository = App::make('DaninozCms\Repositories\\'.$repositoryName.'\\'.$repositoryName.'RepositoryInterface');
    $element = $repository->getByAttribute($attribute, $value);

    if (isset($element) && (!isset($parameters[2]) || $parameters[2] != $element['id'])) {
        return false;
    }

    return true;
});

Validator::extend('repo_exists', function($attribute, $value, $parameters)
{
    $repositoryName = ucfirst($parameters[0]);

    if (! isset($parameters[1])) {
        $attribute = $parameters[1];
    }

    $repository = App::make('DaninozCms\Repositories\\'.$repositoryName.'\\'.$repositoryName.'RepositoryInterface');

    return $repository->existsByAttribute($attribute, $value);
});