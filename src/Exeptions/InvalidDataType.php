<?php

namespace SitemapGenerator\Exceptions;

use Exception;

class InvalidDataTypeExeption extends Exception
{
    public function __construct(
        $message = "Error. Only json,csv and xml file types are supported."
    ) {
        parent::__construct($message);
    }
}