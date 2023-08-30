<?php
namespace SitemapGenerator\Exeptions;

class InvalidFilePath extends \RuntimeException
{
    public function __construct($message = "File path is not writable.")
    {
        parent::__construct($message);
    }
}
