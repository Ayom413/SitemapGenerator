<?php
namespace SitemapGenerator\Generators;
class DataGenerator
{
    public function GenerateSitemapData(array $data): array
    {
        $sitemapData = [];
        foreach ($data as $page) {
            $sitemapData[] = [
                "loc" => $page["loc"],
                "lastmod" => $page["lastmod"],
                "priority" => $page["priority"],
                "changefreq" => $page["changefreq"],
            ];
        }

        return $sitemapData;
    }
}
