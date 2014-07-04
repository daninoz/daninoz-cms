<?php

namespace DaninozCms\Validators;

class Tag extends Validator
{
    /**
     * @var array
     */
    protected $rules = array(
        "create" => array(
            'name' => 'required|unique:tags,name',
        ),
        "update" => array(
            'name' => 'required|unique:tags,name,:ignore_id:',
        ),
    );
}