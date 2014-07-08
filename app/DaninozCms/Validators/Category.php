<?php

namespace DaninozCms\Validators;

class Category extends Validator
{
    /**
     * @var array
     */
    protected $rules = array(
        "create" => array(
            'name' => 'required|repo_unique:Categories,name',
        ),
        "update" => array(
            'name' => 'required|repo_unique:Categories,name',
        ),
    );
}