<?php

namespace SitemapGenerator\Exeptions;

use Exception;

class InvalidDataType extends Exception
{
    public function __construct(
        $message = "Error. Only json,csv and xml file types are supported."
    ) {
        parent::__construct($message);
    }
}
