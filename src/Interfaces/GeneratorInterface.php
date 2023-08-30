<?php

namespace SitemapGenerator\Interfaces;

abstract class GeneratorInterface
{
    abstract public function generate(array $data, string $filePath);
}
