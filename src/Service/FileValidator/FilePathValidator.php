<?php

namespace App\Service\FileValidator;

use App\Contract\FileValidator\FilePathValidatorInterface;
use App\Exception\FileNotFoundException;
use App\Exception\InvalidFileException;

class FilePathValidator implements FilePathValidatorInterface
{
    /**
     * {@inheritDoc}
     */
    public function validateFile(string $filepath): void
    {
        if (!file_exists($filepath)) {
            throw new FileNotFoundException("File not found at {$filepath}");
        }

        if (!is_file($filepath) || is_dir($filepath)) {
            throw new InvalidFileException("The path does not point to a valid file: {$filepath}");
        }
    }
}
