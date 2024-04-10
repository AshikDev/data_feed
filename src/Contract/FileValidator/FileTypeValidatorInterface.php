<?php

namespace App\Contract\FileValidator;

use App\Exception\InvalidExtensionException;
use App\Exception\InvalidFileException;

interface FileTypeValidatorInterface
{
    /**
     * Validates a file by verifying its extension and MIME type.
     *
     * @param string $filepath
     * @param string $requiredExtension
     * @param array $requiredMimeType
     * @return void
     * @throws InvalidExtensionException
     * @throws InvalidFileException
     */
    public function validateFile(string $filepath, string $requiredExtension, array $requiredMimeType): void;
}
