<?php
namespace MyNamespace\SitemapGenerators;
use Interfaces\GeneratorInterface;

Class GenerateCsv extends GeneratorInterface
{
    public function generate(array $data, string $filename)
    {
        $file = fopen($filename,'w');
        fputcsv($file,["loc;lastmod;priority;changefreq"]);
        foreach($data as $line)
        {
            fputcsv($file,$line);
        }
        fclose($file);
        //return $file;
    }
    public function generatejson(array $data, string $filename)
    {
        file_put_contents($filename, json_encode($data));
    }
}

Class GenerateJson extends GeneratorInterface
{

    public function generate(array $data, string $filename)
    {
        file_put_contents($filename, json_encode($data));
    }

}

Class GenerateXml extends GeneratorInterface
{
    public function generate(array $data, string $filename)
    {
        $sxe = new \SimpleXMLElement('<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
         xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 
         http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"></urlset>');
        foreach ($data as $line) {
            $dat = $sxe->addChild("url");
            $dat->addChild("loc", $line["loc"], "lastmod");
            $dat->addChild("lastmod", $line["lastmod"]);
            $dat->addChild("priority", $line["priority"]);
            $dat->addChild("changefreq", $line["changefreq"]);
        }
        
        $sxe->asXML($filename);
    }
    
}