<?php

namespace App\Contract\FileValidator;

use App\Exception\FileNotFoundException;
use App\Exception\InvalidFileException;

interface FilePathValidatorInterface
{
    /**
     * Validates that the provided path points to a valid file and not a directory, and that the file exists.
     *
     * @param string $filepath The path to the file to be validated.
     *
     * @throws FileNotFoundException If the file does not exist.
     * @throws InvalidFileException If the path is not a file (e.g., it's a directory or invalid).
     */
    public function validateFile(string $filepath): void;
}
