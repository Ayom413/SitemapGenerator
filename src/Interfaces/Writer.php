<?php

namespace MyNamespace\Interfaces;

interface WriterInterface
{
    public function write(array $data, string $filename);

}