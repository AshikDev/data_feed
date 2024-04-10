<?php

namespace App\Contract\FileValidator;

use App\Exception\FileSizeException;
use Exception;

interface FileSizeValidatorInterface
{
    /**
     * Validates the file size against a maximum allowed size.
     *
     * @param string $filepath The path to the file to be validated.
     * @param int $maxSizeInMb The default maximum size is 10MB.
     * @throws FileSizeException If the file does not exist, is empty, or exceeds the maximum allowed size.
     * @throws Exception For any other errors encountered during validation.
     */
    public function validateFile(string $filepath, int $maxSizeInMb = 10): void;
}
