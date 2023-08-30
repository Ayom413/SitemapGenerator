# SitemapGenerator
SitemapGenerator is a library which allows you to generate .xml, .json and ,csv files from data array.

# Installation
You can dowload the library directly from Github, or via using composer. Composer command for downloading: composer require ayom413/sitemap-generator:dev-main.
After that  include the SitemapGenerator class in your PHP file:

require_once './SitemapGenerator/SitemapGenerator.php';

# Usage
Fisrt you need to create the data array for pages data, the file type you want to generate and the file path. After that you need to create the new instance of SitemapGenerator class.
```php
$page = [
    [
        'loc' => 'https://site.ru/news',
        'lastmod' => '2020-12-14',
        'priority' => '1',
        'changefreq' => 'hourly',
    ],
    ];
$fileType = "json"; // or "csv", or "xml"
$filePath = "./sitemap_location";
$generator = new SitemapGenerator($page, $fileType, $filePath);
```
And finally call the generate() method to create a sitemap
```php
$generator->generation();
print_r($generator);
```

# Class structure
The library consists of several classes and interfaces:
SitemapGenerator class is the main class responsible for generating sitemaps.

```GeneratorInterface ``` is an abstract class that defines the generate method for sitemap generators.

```DataGenerator```,```CsvGenerator```, ```JsonGenerator```, and ```XmlGenerator``` classes implement the main sitemap generation.

```ValidateData``` class contains methods that validate the input data, file type, and file path.

```InvalidData```,  ```InvalidDataType```, and ```InvalidFilePath``` classes are exceptions thrown by the library in case of invalid input or incorrect usage.

# Example
```php
<?php

use SitemapGenerator\SitemapGenerator;

require 'vendor\autoload.php';

$page = [
    [
        'loc' => 'https://site.ru/news',
        'lastmod' => '2020-12-14',
        'priority' => '1',
        'changefreq' => 'hourly',
    ],
    [
        'loc' => 'https://site.ru/about',
        'lastmod' => '2020-12-07',
        'priority' => '0.6',
        'changefreq' => 'weekly',
    ],
    [
        'loc' => 'https://site.ru',
        'lastmod' => '2020-12-09',
        'priority' => '0.1',
        'changefreq' => 'daily',
    ],
];

$fileType = 'json';
$fPath = '/result/test/sitemap';
$generator = new SitemapGenerator($page, $fileType, $fPath);
$generator->generation();
print_r($generator->generation());

$fileType = 'csv';
$fPath = '/result/test/sitemap';
$generator = new SitemapGenerator($page, $fileType, $fPath);
$generator->generation();
print_r($generator->generation());

$fileType = 'xml';
$fPath = '/result/test/sitemap';
$generator = new SitemapGenerator($page, $fileType, $fPath);
$generator->generation();
print_r($generator->generation());

print_r('Sitemap is ready!');
```
# License 
This library is distributed under the Apache-2.0 License.
