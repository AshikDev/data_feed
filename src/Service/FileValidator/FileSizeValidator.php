<?php

namespace App\Service\FileValidator;

use App\Contract\FileValidator\FileSizeValidatorInterface;
use App\Exception\FileSizeException;
use Exception;

class FileSizeValidator implements FileSizeValidatorInterface
{
    /**
     * {@inheritDoc}
     */
    public function validateFile(string $filepath, int $maxSizeInMb = 10): void
    {
        $maxSize = $maxSizeInMb * 1024 * 1024;
        $fileSize = @filesize($filepath);

        if ($fileSize === false) {
            throw new Exception("Unable to determine the file size of {$filepath}");
        }

        if ($fileSize === 0) {
            throw new FileSizeException("The file is empty: {$filepath}");
        }

        if ($fileSize > $maxSize) {
            throw new FileSizeException("The file exceeds the maximum allowed size of {$maxSizeInMb} MB.");
        }
    }
}
