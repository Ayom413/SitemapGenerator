<?php

namespace SitemapGenerator;

use SitemapGenerator\Generators\Csvgenerator;
use SitemapGenerator\Generators\JsonGenerator;
use SitemapGenerator\Generators\XmlGenerator;
use SitemapGenerator\Validators\ValidateData;
use SitemapGenerator\Generators\DataGenerator;

class SitemapGenerator
{
    private array $page;
    private string $fileType;
    private string $filePath;

    public function __construct($page, $fileType, $filePath)
    {
        $Path = dirname($filePath);
        if (!is_dir($Path)) {
            mkdir($Path, 0755, true);
        }
        $fileType = strtolower($fileType);
        $this->page = $page;
        $this->fileType = $fileType;
        $this->filePath = $filePath;
        ValidateData::validate($page, $fileType, $filePath);
    }

    public function generation(): string
    {
        $newData = new DataGenerator();
        $sitemapData = $newData->generateSitemapData($this->page);
        switch ($this->fileType) {
            case "csv":
                $csv = new Csvgenerator();
                $csv->generate($sitemapData, $this->filePath . ".csv");
                break;
            case "json":
                $json = new JsonGenerator();
                $json->generate($sitemapData, $this->filePath . ".json");
                break;
            case "xml":
                $xml = new XmlGenerator();
                $xml->generate($sitemapData, $this->filePath . ".xml");
                break;
            default:
                break;
        }
        return "Sitemap." .
            $this->fileType .
            " has been generated at: " .
            $this->filePath .
            "\n";
    }
}
