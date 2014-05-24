<?php

namespace DaninozCms\Validators;

use DaninozCms\Exceptions\ValidationException;
use Illuminate\Validation\Factory as V;

class Validator
{
    /**
     * @var array Input data to validate
     */
    protected $input;

    /**
     * @var string The rules can have different types
     */
    protected $type;

    /**
     * @var int Used to update unique values to ignore current id
     */
    protected $id;

    /**
     * @var array Rules for validator
     */
    protected $rules;

    /**
     * @var array Custom error messages
     */
    protected $customMessages = array();

    /**
     * @var \Illuminate\Validation\Factory
     */
    protected $validator;

    /**
     * @param V $validator
     */
    public function __construct(V $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Load the data to validate
     * @param array $input
     * @param string $type
     * @param  $id
     */
    protected function setData($input, $type, $id = NULL)
    {
        $this->input = $input;
        $this->type = $type;
        if ($id) {
            $this->rules[$type] = str_replace(':ignore_id:', $id, $this->rules[$type]);
        }
    }

    /**
     * Validates the fields
     * @throws ValidationException
     */
    public function validate($input, $type, $id = NULL)
    {
        $this->setData($input, $type, $id);

        $validator = $this->validator->make($this->input, $this->rules[$this->type], $this->customMessages);
        if ($validator->fails()) {

            throw new ValidationException('Validation failed', $validator->errors());
        }
    }
}