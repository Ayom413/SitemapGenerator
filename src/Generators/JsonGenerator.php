<?php
namespace SitemapGenerator\Generators;

use SitemapGenerator\Interfaces\Generator;

class JsonGenerator extends Generator
{
    public function generate(array $data, string $filePath)
    {
        file_put_contents($filePath, json_encode($data));
    }
}
