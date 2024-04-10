<?php

namespace App\Service\FileValidator;

use App\Contract\FileValidator\FilePathValidatorInterface;
use App\Contract\FileValidator\FileSizeValidatorInterface;
use App\Contract\FileValidator\FileValidatorInterface;
use App\Contract\FileValidator\FileTypeValidatorInterface;
use App\Exception\FileNotFoundException;
use App\Exception\FileSizeException;
use App\Exception\InvalidExtensionException;
use App\Exception\InvalidFileException;
use App\Utils\AppConstants;
use Exception;

readonly class XmlFileValidator implements FileValidatorInterface
{
    public function __construct(
        private FilePathValidatorInterface $filePathValidator,
        private FileSizeValidatorInterface $fileSizeValidator,
        private FileTypeValidatorInterface $fileTypeValidator
    ) { }

    /**
     * {@inheritDoc}
     *
     * Validates the given file path, size, extension, and type for XML processing.
     */
    public function validateFile(string $filepath): void
    {
        // Validates that the provided path points to a valid file and not a directory, and that the file exists.
        $this->filePathValidator->validateFile($filepath);

        // Validates the file size against a maximum allowed size of 5MB.
        $this->fileSizeValidator->validateFile($filepath, AppConstants::MAX_UPLOAD_SIZE_IN_MB);

        // Validates the XML file by verifying its extension and MIME type.
        $this->fileTypeValidator->validateFile(
            $filepath,
            AppConstants::XML_EXTENSION,
            AppConstants::XML_MIME_TYPE
        );
    }
}
