<?php

namespace App\Service\FileReader;

use App\Contract\FileReader\FileReadableInterface;
use App\Exception\FileNotReadableException;

class FileReadableChecker implements FileReadableInterface
{
    /**
     * {@inheritDoc}
     */
    public function validateFile(string $filepath): void
    {
        if (!is_readable($filepath)) {
            throw new FileNotReadableException("The file is not readable: {$filepath}");
        }
    }
}
