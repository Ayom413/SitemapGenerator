<?php

namespace SitemapGenerator\Validators;

use SitemapGenerator\Exeptions\InvalidFilePath;
use SitemapGenerator\Exeptions\InvalidData;
use SitemapGenerator\Exeptions\InvalidDataType;

class ValidateData
{
    
    public static function validatePages($pages): void
    {
        if (!is_array($pages)) {
            throw new InvalidData(
                "Invalid pages data format. Information passed to the function must be an array."
            );
        }

        foreach ($pages as $page) {
            if (
                !isset($page["loc"]) ||
                !isset($page["lastmod"]) ||
                !isset($page["priority"]) ||
                !isset($page["changefreq"])
            ) {
                throw new InvalidData(
                    'Invalid pages data. Every page must include: \'loc\', \'lastmod\', \'priority\', \'changefreq\''
                );
            }
        }
    }

    public static function validateFileType($fileType): void
    {
        if (!in_array($fileType, ["xml", "json", "csv"])) {
            throw new InvalidDataType();
        }
    }

    public static function validateFilePath($filePath): void
    {
        $Path = dirname($filePath);

        if (!is_writable($Path)) {
            throw new InvalidFilePath();
        }
    }
    public static function validate(
        array $page,
        string $fileType,
        string $filePath
    ) {
        ValidateData::validatePages($page);
        ValidateData::validateFileType($fileType);
        ValidateData::validateFilePath($filePath);
    }
}
