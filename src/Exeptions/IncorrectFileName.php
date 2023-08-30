<?php
namespace SitemapGenerator\Exeptions;

use Exception;

class IncorrectFileName extends Exception
{
    public function __construct($message = "Error: file name must not include the following characters: \,/,|,?,*,<,>,\" ")
    {
        parent::__construct($message);
    }
}