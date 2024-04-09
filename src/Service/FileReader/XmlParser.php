<?php

namespace App\Service\FileReader;

use App\Contract\FileReader\FileReadableInterface;
use App\Contract\FileReader\XmlLoaderInterface;
use App\Contract\FileReader\XmlParserInterface;
use App\Exception\XmlParseException;
use App\Utils\AppConstants;
use DOMDocument;
use SimpleXMLElement;
use Throwable;
use XMLReader;

readonly class XmlParser implements XmlParserInterface
{
    public function __construct(
        private FileReadableInterface $fileReadableChecker,
        private XmlLoaderInterface $xmlLoader
    ) { }

    /**
     * {@inheritDoc}
     */
    public function parse(string $filepath): SimpleXMLElement
    {
        // Validates if the file is readable
        $this->fileReadableChecker->validateFile($filepath);

        try {
            $reader = new XMLReader();
            if (!$reader->open($filepath)) {
                throw new XmlParseException("Cannot open XML file: $filepath");
            }

            $domNode = false;
            while ($reader->read()) {
                // Look for the start of the chunk element
                if ($reader->nodeType == XMLReader::ELEMENT && $reader->name == AppConstants::XML_FIRST_NODE) {
                    $dom = new DOMDocument();
                    $domNode = $reader->expand($dom);
                    $reader->close();
                    break;
                }
            }

            return $this->xmlLoader->load($domNode);
        } catch (Throwable $e) {
            throw new XmlParseException("Failed to read XML file at {$filepath}: " . $e->getMessage());
        }
    }
}
