<?php

namespace SitemapGenerator\Exeptions;

class InvalidData extends \InvalidArgumentException
{
    public function __construct($message = "Invalid data format of the pages.information passed to the function must be an array.")
    {
        parent::__construct($message);
    }
}