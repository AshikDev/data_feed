<?php

namespace App\Service\FileValidator;

use App\Contract\FileValidator\FileTypeValidatorInterface;
use App\Exception\InvalidExtensionException;
use App\Exception\InvalidFileException;
use finfo;

class FileTypeValidator implements FileTypeValidatorInterface
{
    /**
     * {@inheritDoc}
     */
    public function validateFile(string $filepath, string $requiredExtension, array $requiredMimeType): void
    {
        // Validate the file extension to quickly filter out non-XML files based on their names.
        $fileExtension = strtolower(pathinfo($filepath, PATHINFO_EXTENSION));
        if ($fileExtension !== $requiredExtension) {
            throw new InvalidExtensionException("Invalid file extension. Expected xml, given {$fileExtension}.");
        }

        // Further validate the file by checking its MIME type.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($filepath);
        if (!in_array($mimeType, $requiredMimeType, true)) {
            throw new InvalidFileException('Invalid MIME type.');
        }
    }
}
