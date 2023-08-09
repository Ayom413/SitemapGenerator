<?php

namespace SitemapGenerator;

use Exception;
//use JsonException;

class InvalidDataTypeExeption extends Exception
{
    public function __construct(
        $message = "Error. Only json,csv and xml file types are supported."
    ) {
        parent::__construct($message);
    }
}

class InvalidFilePath extends Exception
{
    public function __construct($message = "File path is not writable.")
    {
        parent::__construct($message);
    }
}

class InvalidData extends Exception
{
    public function __construct($message = "Invalid data of the pages.")
    {
        parent::__construct($message);
    }
}

class SitemapGenerator
{
    private $page;
    private $fileType;
    private $fPath;

    function GenerateSitemapData()
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

    private function XmlGeneration($sitemapData)
    {
        $xml = new \SimpleXMLElement('<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
         xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 
         http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd"></urlset>');
        foreach ($sitemapData as $page) {
            $xml->addChild("url");
            $xml->addChild("loc", $page["loc"], "lastmod");
            $xml->addChild("lastmod", $page["lastmod"]);
            $xml->addChild("priority", $page["priority"]);
            $xml->addChild("changefreq", $page["changefreq"]);
        }
        $xml->asXML($this->fPath);
    }

    private function CsvGeneration($sitemapData)
    {
        $file = fopen($this->fPath, "w");
        foreach ($sitemapData as $page) {
            fputcsv($file, $page);
        }
        fclose($file);
    }

    private function JsonGeneration($sitemapData)
    {
        // $jsondata = json_encode($sitemapData, JSON_PRETTY_PRINT);
        file_put_contents($this->fPath, json_encode($sitemapData));
    }

    function generation()
    {
        $sitemapData = $this->GenerateSitemapData();
        switch ($this->fileType) {
            case "csv":
                $this->CsvGeneration($sitemapData);
                break;
            case "json":
                $this->JsonGeneration($sitemapData);
                break;
            case "xml":
                $this->XmlGeneration($sitemapData);
                break;
            default:
                throw new InvalidDataTypeExeption();
        }
    }

    private function FilePathIsOk($fPath)
    {
        $Path = dirname($fPath);
        if (!is_dir($Path)) {
            mkdir($Path, 0777, true);
        }

        try {
            if (!is_writable($Path)) {
                throw new InvalidFilePath();
            }
        } catch (InvalidFilePath $e) {
            echo "Error! InvalidFilePath:" . $e->getMessage();
            die();
        }
    }

    private function DataIsOk($page)
    {
        if (!is_array($page)) {
            throw new InvalidData();
        }

        foreach ($page as $data) {
            if (
                !isset($data["loc"]) ||
                !isset($data["lastmod"]) ||
                !isset($data["priority"]) ||
                !isset($data["changefreq"])
            ) {
                throw new InvalidData();
            }
        }
    }

    private function TypeOfDataIsOk($fileType)
    {
        try {
            if (!in_array($fileType, ["xml", "json", "csv"])) {
                throw new InvalidDataTypeExeption();
            }
        } catch (InvalidDataTypeExeption $e) {
            echo "InvalidDataType:" . $e->getMessage();
            die();
        }
    }

    public function __construct($page, $fileType, $fPath)
    {
        $this->DataIsOk($page);
        $this->TypeOfDataIsOk($fileType);
        $this->FilePathIsOk($fPath);

        $this->page = $page;
        $this->fileType = $fileType;
        $this->fPath = $fPath;
    }
}

