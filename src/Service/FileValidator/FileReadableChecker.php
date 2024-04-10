<?php

namespace App\Service\FileValidator;

use App\Contract\FileValidator\FileReadableCheckerInterface;
use App\Exception\FileNotReadableException;

class FileReadableChecker implements FileReadableCheckerInterface
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
