<?php
namespace SitemapGenerator\Generators;

use SitemapGenerator\Interfaces\GeneratorInterface;

class Csvgenerator extends GeneratorInterface
{
    public function generate(array $data, string $filepath)
    {
        $file = fopen($filepath, "w");
        fputcsv($file, ["loc;lastmod;priority;changefreq"]);
        foreach ($data as $line) {
            fputcsv($file, $line);
        }
        fclose($file);
    }
}
