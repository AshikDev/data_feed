<?php

namespace App\Contract\FileReader;

use App\Exception\FileNotReadableException;
use App\Exception\XmlParseException;
use SimpleXMLElement;

interface XmlParserInterface
{
    /**
     * Parse the XML file, if readable and contents are valid.
     *
     * @param string $filepath The path to the XML file to parse.
     * @return SimpleXMLElement The SimpleXMLElement is the representation of the XML file.
     * @throws FileNotReadableException If the file is not readable.
     * @throws XmlParseException If there is an error reading or parsing the XML file.
     */
    public function parse(string $filepath): SimpleXMLElement;
}
