<?php

namespace SitemapGenerator\ValdateData;

use SitemapGenerator\Exceptions\InvalidFilePath;
use SitemapGenerator\Exceptions\InvalidData;
use SitemapGenerator\Exceptions\InvalidDataTypeExeption;


class Validator
{
    private $errors = [];
   static public function validatePages($pages):void
    {
        try {
        if (!is_array($pages)) {
            $errors = throw new InvalidData('Invalid pages data format.information passed to the function must be an array.');
        }
        } catch (InvalidData $e) {
            echo "InvalidData:" . $e->getMessage();
            die();
        }
        foreach ($pages as $page) {
            if (!isset($page['loc']) || !isset($page['lastmod']) || !isset($page['priority']) || !isset($page['changefreq'])) {
                $errors = throw new InvalidData('Invalid pages data. Every page must include: \'loc\', \'lastmod\',\'priority\',\'changefreq\'');
                die();
            }
        }
    }

    static public function validateFileType($fileType):void
    {
        
            try {
                if (!in_array($fileType, ["xml", "json", "csv"])) {
                    throw new InvalidDataTypeExeption();
                }
            } catch (InvalidDataTypeExeption $e) {
                echo "InvalidDataType:" . $e->getMessage();
                // die();
            }
        
    }

    static public function validateFilePath($filePath):void
    {
        $Path = dirname($filePath);

        try {
            if (!is_writable($Path)) {
                throw new InvalidFilePath();
            }
        } catch (InvalidFilePath $e) {
            echo "Error! InvalidFilePath:" . $e->getMessage();
            die();
        }


    }
    static public function validateCorrectPath($filePath,$fileType):void
    {
        try {
            if(substr($filePath, -strlen($fileType)) !== $fileType){
                throw new InvalidFilePath();
            }
        }catch (InvalidFilePath $e) {
            echo "Error! InvalidFilePath:" . $e->getMessage();
            die();
    }
}
    // static public function validateFileName($fileName):void
    // {
    //     $forbidden = ["\\", "/", "|", "*", "\"", "?", "<", ">"];
    //     foreach($forbidden as $char){
    //         if(strpos($fileName,$char) !== false){
    //             throw new IncorrectFileName();
    //             break;
    //         }
    //     }
    // }
}