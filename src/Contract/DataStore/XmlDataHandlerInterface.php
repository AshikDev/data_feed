<?php

namespace App\Contract\DataStore;

use App\Exception\FileNotReadableException;
use App\Exception\NoDataSavedException;
use App\Exception\XmlParseException;
use Exception;

interface XmlDataHandlerInterface
{
    /**
     * Parse the XML file, if readable and contents are valid.
     *
     * @param string $filepath The path to the XML file to parse.
     * @return int The int returns number of saved rows.
     * @throws FileNotReadableException If the file is not readable.
     * @throws XmlParseException If there is an error reading or parsing the XML file.
     * @throws NoDataSavedException If no data is saved.
     * @throws Exception If there is an error reading or parsing the XML file.
     */
    public function extractAndSave(string $filepath): int;
}
