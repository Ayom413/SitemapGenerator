<?php

namespace SitemapGenerator;


use SitemapGenerator\Generators\GenerateJson;
use SitemapGenerator\Generators\GenerateXml;
use SitemapGenerator\Interfaces\GeneratorInterface;
use SitemapGenerator\Generators\GenerateCsv;
use SitemapGenerator\ValdateData\Validator;

class SitemapGenerator
{
    private array $page;
    private string $fileType;
    private string $filePath;
    // private string $fileName;
    // private array $supportedFormats = ['xml', 'csv', 'json'];

    public function __construct($page, $fileType, $filePath)
    {
        $Path = dirname($filePath);
        if (!is_dir($Path)) {
            mkdir($Path, 0755, true);
        }
        $this->page = $page;
        $this->fileType = $fileType;
        $this->filePath = $filePath; 
        Validator::validatePages($page);
        Validator::validateFileType($fileType);
        Validator::validateFilePath($filePath);
        Validator::validateCorrectPath($filePath, $fileType);
        // Validator::validateFileName($fileName);
    }
    
    function GenerateSitemapData():array
    {
        $sitemapData = [];
        foreach ($this->page as $page) {
            $sitemapData[] = [
                "loc" => $page["loc"],
                "lastmod" => $page["lastmod"],
                "priority" => $page["priority"],
                "changefreq" => $page["changefreq"],
            ];
        }

        return $sitemapData;
    }

    public function generation():string
    {
        
        $sitemapData = $this->GenerateSitemapData();
        switch ($this->fileType) {
            case "csv":
                $csv = new GenerateCsv;
                $csv->generate($sitemapData,$this->filePath.'csv');
                break;
            case "json":
                $json = new GenerateJson;
                $json->generate($sitemapData,$this->filePath.'json');
                break;
            case "xml":
                $xml = new GenerateXml;
                $xml->generate($sitemapData,$this->filePath.'xml');
                break;
            default:
                break;
        }
        return $this->filePath;
    }


}

