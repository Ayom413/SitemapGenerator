<?php
namespace SitemapGenerator\SitemapGenerators;
use Interfaces\GeneratorInterface;

Class GenerateJson implements GeneratorInterface
{

    public function generate(array $data, string $filePath)
    {
        file_put_contents($filePath, json_encode($data));
    }

}