<?php

namespace DaninozCms\Validators;

class Category extends Validator
{
    /**
     * @var array
     */
    protected $rules = array(
        "create" => array(
            'name' => 'required|unique:categories,name',
        ),
        "update" => array(
            'name' => 'required|unique:categories,name,:ignore_id:',
        ),
    );
}