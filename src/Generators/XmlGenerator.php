<?php
namespace SitemapGenerator\Generators;

use SitemapGenerator\Interfaces\Generator;

class XmlGenerator extends Generator
{
    public function generate(array $data, string $filePath)
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
        $sxe->asXML($filePath);
    }
}
