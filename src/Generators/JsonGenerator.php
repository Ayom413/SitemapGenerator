<?php
namespace SitemapGenerator\Generators;

use SitemapGenerator\Interfaces\GeneratorInterface;

class JsonGenerator extends GeneratorInterface
{
    public function generate(array $data, string $filePath)
    {
        file_put_contents($filePath, json_encode($data));
    }
}
