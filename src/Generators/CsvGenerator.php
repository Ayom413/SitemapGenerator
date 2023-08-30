<?php
namespace SitemapGenerator\Generators;
use Interfaces\GeneratorInterface;

Class GenerateCsv extends GeneratorInterface
{
    public function generate(array $data, string $filepath)
    {
        $file = fopen($filepath,'w');
        fputcsv($file,["loc;lastmod;priority;changefreq"]);
        foreach($data as $line)
        {
            fputcsv($file,$line);
        }
        fclose($file);

    }
}