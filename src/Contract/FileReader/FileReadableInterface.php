<?php

namespace App\Contract\FileReader;

use App\Exception\FileNotReadableException;

interface FileReadableInterface
{
    /**
     * Validates if a file is readable.
     *
     * @param string $filepath The absolute path to the file to be validated.
     * @throws FileNotReadableException If the file cannot be read or does not exist.
     */
    public function validateFile(string $filepath): void;
}
