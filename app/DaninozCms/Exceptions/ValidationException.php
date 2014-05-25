<?php

namespace DaninozCms\Exceptions;

use Exception;
use Illuminate\Support\MessageBag;

class ValidationException extends Exception
{
    /**
     * @var \Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * @param string $message
     * @param MessageBag $errors
     */
    public function __construct($message, MessageBag $errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }
}