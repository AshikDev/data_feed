<?php

namespace App\Contract\FileValidator;

use App\Exception\FileNotFoundException;
use App\Exception\FileSizeException;
use App\Exception\InvalidExtensionException;
use App\Exception\InvalidFileException;
use Exception;

interface FileValidatorInterface
{
    /**
     * Validates the given file path, size, extension, and type.
     *
     * @param string $filepath The path to the file to be validated.
     *
     * @throws FileNotFoundException If the file does not exist.
     * @throws InvalidFileException If the path does not point to a valid file.
     * @throws InvalidExtensionException If the file extension is not 'xml'.
     * @throws FileSizeException If the file exceeds the maximum allowed size.
     * @throws Exception For any other errors encountered during file validation.
     */
    public function validateFile(string $filepath): void;
}
