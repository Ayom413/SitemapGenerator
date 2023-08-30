<?php

namespace SitemapGenerator\Interfaces;

abstract class Generator
{
    abstract public function generate(array $data, string $filePath);
}
