<?php

namespace DaninozCms\Validators;

class Tag extends Validator
{
    /**
     * @var array
     */
    protected $rules = array(
        "create" => array(
            'name' => 'required|repo_unique:Tags,name',
        ),
        "update" => array(
            'name' => 'required|repo_unique:Tags,name,:ignore_id:',
        ),
    );
}